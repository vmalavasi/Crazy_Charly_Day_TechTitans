<?php

namespace iutnc\crazyCharlieDay\action;

class CatalogueAction
{
    public function execute(): string{
        $html = '';
        // Connexion à la base de données
        $pdo = new PDO('mysql:host=localhost;dbname=ma_base_de_donnees', 'mon_utilisateur', 'mon_mot_de_passe');

// Nombre maximum de produits à afficher par page
        $produits_par_page = 5;

// Récupération du nombre total de produits
        $requete = $pdo->query('SELECT COUNT(*) AS total FROM produits');
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
        $requete = $pdo->prepare('SELECT * FROM produits ORDER BY id LIMIT :offset, :limite');
        $requete->bindValue('offset', $offset, PDO::PARAM_INT);
        $requete->bindValue('limite', $produits_par_page, PDO::PARAM_INT);
        $requete->execute();
        $produits = $requete->fetchAll();

            // Affichage des produits
        foreach ($produits as $produit) {
            $html += '<div class="produit"><h2>' . htmlspecialchars($produit['nom']) . '</h2><img src="' . htmlspecialchars($produit['image']) . '"><p>' . htmlspecialchars($produit['description']) . '</p><p>' . htmlspecialchars($produit['prix']) . ' €</p>
<button>Ajouter au panier</button>
</div>';
        }

        return $html;
    }
}