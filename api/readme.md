# Art public

## Configurations : 
Les fichiers suivants sont à modifier en fonction de la configuration du site (url, accès MySQL, etc)
- /js/define.js
- /api/db_info.php (prendre le fichier db_info_modele.php et le renommer)
- /api/config.php
- /api/.htaccess
- /api/admin/.htaccess


## Routes disponibles
- https://jmartel.webdev.cmaisonneuve.qc.ca/art-pub-mtl/api/ - Accueil
- https://jmartel.webdev.cmaisonneuve.qc.ca/art-pub-mtl/api/oeuvre - Les oeuvres
- https://jmartel.webdev.cmaisonneuve.qc.ca/art-pub-mtl/api/oeuvre/ID - Une oeuvre (remplacer ID par le numero de l'oeuvre)
- https://jmartel.webdev.cmaisonneuve.qc.ca/art-pub-mtl/api/artiste - Les artistes
- https://jmartel.webdev.cmaisonneuve.qc.ca/art-pub-mtl/api/artiste/ID - Un artiste (remplacer ID par le numero de l'artiste)
- https://jmartel.webdev.cmaisonneuve.qc.ca/art-pub-mtl/api/admin/oeuvre/ - Admin, liste des oeuvres
- https://jmartel.webdev.cmaisonneuve.qc.ca/art-pub-mtl/api/admin/oeuvre/miseajour - Admin, importation des données publiques