# `Crazy_Charly_Day_TechTitans` <br><br>

## `Nom de l'équipe : TechTitans` <br><br>

###### `COLLIN Alex`
###### `AUBURTIN Romain`
###### `MALAVASI Valentin`
###### `POZZO DI BORGO Noa` <br><br><br><br><br>



## `Application “click & collect”` <br><br>
### `Court-circuit Nancy`

###### `Présentation`


L’épicerie de la coopérative Court-circuit Nancy, qui s’inscrit dans le courant de l’économie
sociale et solidaire, souhaite développer son activité click & collect. Elle dispose déjà d’un
site développé avec Prestashop mais ne répondant pas aux besoins de la coopérative, en
particulier car ce site ne dispose pas d'indicateur représentatif de la commande en lien avec
les valeurs portées par la coopérative (produits locaux et circuits courts). L’épicerie souhaite
donc un développement spécifique décrit dans ce cahier des charges.

###### `Objectif de l'application :`

Proposer un nouveau site de click & collect, en phase avec les valeurs de la coopérative et
intégrant des fonctionnalités définies sur mesure avec ses besoins.
Présentation générale des fonctionnalités
Les fonctionnalités concernent d’une part les utilisateurs (front-office) et les gestionnaires
(back-office). On y retrouve les fonctionnalités classiques d’un site de e-commerce,
auxquelles s’ajoutent certaines fonctions spécifiques au développement durable et à
l'expérience utilisateur.

La particularité des produits proposés est qu’ils peuvent l’être à l’unité ou en vrac, suivant
leur nature. Par convention, au niveau de la représentation des attributs des produits, on
considérera qu’un poids de 0 indique qu’il est disponible en vrac ; le prix associé sera alors
le prix au kg. Si le poids est différent de 0, il indique alors le poids unitaire de cet article en
kg et le prix associé est alors le prix unitaire. Les interfaces devront s’adapter en fonction de
la nature des produits, lors des ajouts à la commande ainsi que dans leur affichage par
exemple, pour qu’il n’y ait pas d'ambiguïté sur la nature des informations présentées.
Pour éviter de devoir gérer l'authentification, on pourra, dans un premier temps, disposer de
deux adresses distinctes : une pour le front-office, destinée aux membres, et une seconde
pour le back-office, destinée aux administrateurs (pour commencer, ces adresses ne
nécessiteront pas d'authentification).

###### `Description détaillée des fonctionnalités :`

On conseille de ne s’intéresser aux fonctionnalités étiquetées comme « avancées » qu’à
partir du moment où l’application développée comporte déjà un ensemble de fonctionnalités
de base cohérentes.

###### `Affichage et navigation dans le catalogue`

1. Affichage de la liste des produits. Présentation des produits existants en décrivant
   sommairement leurs attributs (nom, prix, localisation et image associée). On souhaite
   afficher l’ensemble des produits à raison de 5 par page.
2. Affichage d'un produit. Provoque l’affichage de la plupart des attributs du produit et d’une
   carte affichant la localisation de son producteur ou de son fournisseur.
3. Affichage du catalogue dans une carte (avancé) : une carte affiche la localisation de
   l'ensemble des produits disponibles. Il est possible de cliquer sur une localisation pour
   afficher un lien vers la page affichant les détails du produit concerné. Une des solutions les
   plus simples est d’utiliser l’exemple quick-start de Leaflet :
   https://leafletjs.com/examples/quick-start/example.html
4. Recherche : recherche dans le catalogue et filtrage des produits par lieu et/ou par
   catégorie.

###### `Gestion des commandes`

5. Ajout au panier : chaque produit peut être ajouté dans le panier en gérant sa quantité ou
   son poids (en fonction de la nature du produit). Cette fonctionnalité doit être intégrée à la
   page présentant l’affichage des produits (cf. fonctionnalité n°2).
6. Affichage du panier : le panier présente l'ensemble de la commande courante de
   l'utilisateur, le prix de cette commande et un indicateur carbone de la commande. Par défaut,
   cet indicateur sera lié au poids et à la distance des producteurs ou fournisseurs des produits
   commandés. On pourra prendre la somme sur l'ensemble des produits commandés des
   poids des produits multipliés par la distance à leur producteur/fournisseur.
7. Validation du panier : l'utilisateur peut lancer la validation de sa commande sur la page
   affichant son panier (cf. fonctionnalité n° 6). Une fois la commande validée, l’utilisateur
   choisit une date de rendez-vous pour venir chercher ses produits. Le paiement se fait sur
   place à la boutique lors du retrait.
8. Liste générale des commandes validées (administrateurs) : les gestionnaires peuvent
   afficher la liste des commandes et des RDV.

   ###### `Gestion des produits (avancé, pour les administrateurs)`

9. Création d’un produit : un produit est désigné par un nom et des attributs. Plusieurs
   attributs les décrivent : poids (poids pour les produits unitaires ou zéro pour le vrac), prix
   (prix unitaire ou prix par kg), description courte, détails ou description longue, ville d’origine,
   distance par la route, coordonnées GPS, catégorie. L’image associée a pour nom l’ID du
   produit et l'extension .jpg.
10. Modification d’un produit : un produit peut être modifié (changement des attributs ou
    d’image associée).

###### `Gestion avancée du catalogue (avancé)`
    
11. Classement des produits : le catalogue peut être affiché de différentes manières en
    fonction des choix de l'utilisateur. Les produits peuvent être triés par note, par nombre de
    commandes, s’ils sont ou non dans les favoris de l’utilisateur, par nombre de vues, par
    popularité des produits (nombre d’utilisateurs ayant mis le produit en favoris)…
12. Produits mis en avant : le site peut mettre en avant certains produits, comme les produits
    les mieux notés, les plus commandés, les plus visités ou les produits en promotion (pour
    cette dernière possibilité, il faut naturellement s’intéresser au préalable au support des
    promotions, au niveau de la base et au niveau des traitements).
13. Recommandations : la page qui affiche un produit est complétée par la liste des produits
    fréquemment visités ou achetés ensemble.

###### `Hiérarchie de produits (avancé)`

14. Gestion des hiérarchies de catégories : on souhaite améliorer la gestion des catégories
    en créant une hiérarchie. Chaque catégorie peut être rattachée à une catégorie parent. Les
    catégories de tête ont pour parent la catégorie 0 (qui n’existe pas). Les produits restent liés
    à une catégorie par défaut, mais il est possible de les lier à plusieurs catégories.

###### `Gestion des comptes utilisateurs (avancé)`

Note : si cette catégorie de fonctionnalités est très intéressante techniquement, elle est plus
    difficile à valoriser dans le cadre d’un développement centré sur une journée. Elle est donc
    plutôt à considérer si la plupart des autres fonctionnalités ont déjà été traitées.

15. Création d’un nouveau compte : un utilisateur peut se créer un compte. Il doit alors saisir
    un login (unique sur le site), un mot de passe et des informations de contact. Les autres
    données d’un membre sont : nom, prénom, mail, téléphone.
16. Accès avec authentification : l’utilisateur doit fournir un login et un mot de passe pour
    s’authentifier dans l’application et accéder à son compte. Il doit également pouvoir se
    déconnecter.
17. Modification de compte : l’utilisateur peut modifier les informations relatives à son
    compte (en dehors de son login) s’il s’est connecté au préalable.
18. Affichage de la liste des utilisateurs (administrateurs) : une page affiche la liste des
    utilisateurs avec leur nom, ainsi qu’un lien pour chacun d’eux vers une description plus
    complète. Cette liste est accessible uniquement aux administrateurs. Des liens vers les
    actions menant aux fonctionnalités administrateurs implantées peuvent éventuellement être
    ajoutés en regard de chaque utilisateur.
19. Compte administrateur : certains comptes ont des privilèges d’administration sur le site,
    ce qui leur permet de réaliser certaines des opérations décrites dans ce document.
    L’affichage détaillé d’un membre par un administrateur permet d’accéder à l’ajout de
    l’utilisateur affiché comme nouvel administrateur.
20. Favoris utilisateurs : un utilisateur dispose d'une liste de favoris. Un produit peut être
    ajouté à la liste des favoris de l’utilisateur et l'utilisateur peut accéder à la liste de ses favoris
    pour les ajouter directement à son panier ou pour accéder au descriptif du produit.

###### `Gestion encore plus avancée pour les utilisateurs (avancé++)`

21. Historique des commandes passées : à partir de son profil, un utilisateur peut afficher
    l'ensemble des commandes qu'il a validées. Un indicateur global concernant l'ensemble des
    commandes passées peut être affiché.
22. Historique de navigation de l’utilisateur : l'utilisateur peut accéder à son historique de
    navigation pour connaître la liste des produits qu'il a consultés précédemment.
23. Note et commentaires : les utilisateurs peuvent noter les produits et ajouter des
    commentaires à partir de la page descriptive du produit.
24. Validation des commentaires (avancé, administrateurs) : les gestionnaires doivent valider
    les commentaires laissés par les utilisateurs en les modifiant si besoin