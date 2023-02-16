<?php

namespace iutnc\crazyCharlieDay\action;

use iutnc\crazyCharlieDay\db\ConnectionFactory;

class CatalogueAction
{
    public function execute(): string{
        $html = '<h1>Catalogue</h1>';
        // Connexion à la base de données
        $pdo = ConnectionFactory::makeConnection();

        // Traitement de la recherche
        $search = isset($_GET['q']) ? $_GET['q'] : '';
        $search = trim($search);
        $search = htmlspecialchars($search);

        // Nombre maximum de produits à afficher par page
        $produits_par_page = 5;

        // Construction de la clause WHERE de la requête SQL en fonction de la recherche
        $where_clause = '';
        $query_params = [];
        if (!empty($search)) {
            $where_clause = 'WHERE nom LIKE :search';
            $query_params['search'] = '%'.$search.'%';
        }

        // Récupération du nombre total de produits
        $requete = $pdo->prepare('SELECT COUNT(*) AS total FROM produits '.$where_clause);
        $requete->execute($query_params);
        $resultat = $requete->fetch();
        $total_produits = $resultat['total'];

        // Calcul du nombre total de pages
        $total_pages = ceil($total_produits / $produits_par_page);

        // Récupération du numéro de page demandée dans l'URL, ou utilisation de la première page par défaut
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;

        // Vérification que le numéro de page demandée est valide
        if ($page < 1 || $page > $total_pages) {
            $page = 1;
        }

        // Calcul de l'offset de la plage de produits à afficher
        $offset = ($page - 1) * $produits_par_page;

        // Récupération des produits pour la page demandée
        $requete = $pdo->prepare('SELECT * FROM produits '.$where_clause.' ORDER BY id LIMIT :offset, :limite');
        $requete->bindValue('offset', $offset, PDO::PARAM_INT);
        $requete->bindValue('limite', $produits_par_page, PDO::PARAM_INT);
        $requete->execute($query_params);
        $produits = $requete->fetchAll();

        // Affichage de la barre de recherche
        $html .= '<form action="/catalogue" method="get">
                   <label for="search">Rechercher :</label>
                   <input type="text" id="search" name="q" placeholder="Rechercher..." value="'.$search.'">
                   <button type="submit">Rechercher</button>
                 </form>';

        // Affichage des produits
        foreach ($produits as $produit) {
            $html .= '<div class="produit"><h2>' . htmlspecialchars($produit['nom']) . '</h2><img src="' . htmlspecialchars($produit['image']) . '"><p>' . htmlspecialchars($produit['description']) . '</p><p>' . htmlspecialchars($produit['prix']) . ' €</p>
            <form method="post">
              <input type="hidden" name="produit_id" value="' . htmlspecialchars($produit['id']) . '">
              <button type="submit" name="ajouter_au_panier">Ajouter au panier</button>
            </form>
            </div>';
        }

        // Traitement du formulaire d'ajout au panier
        if (isset($_POST['ajouter_au_panier'])) {
            session_start();
            $produit_id = $_POST['produit_id'];
            $requete = $pdo->prepare('SELECT * FROM produits WHERE id = :id');
            $requete->bindValue('id', $produit_id, PDO::PARAM_INT);
            $requete->execute();
            $produit = $requete->fetch();
            $_SESSION['panier'][] += $produit;
        }

        return $html;
    }
}