# Pré-requis:

1. Avoir installé Symfony sur son ordinateur
2. Avoir une serveur de base de données sur son ordinateur

# Installation du projet

1. Clonez ce projet dans votre ordinateur
2. Créez une base de données "parkings" sur votre phpmyadmin ou en ligne de commande 
3. Importez le fichier parkings.sql dans votre base de données "parkings" qui va créer 2 entrées de test
4. Modifiez le fichier .env.local situé à la racine du projet pour mettre vos propres paramètres de connection à votre base de données
5. Ouvrez un terminal et exécutez la commande symfony server:start
6. Testez l'URL http://127.0.0.1:8000/api/parkings avec votre navigateur internet

# Utilisation du projet

1. Lancez Postman ou tout autre logiciel de gestion d'API
2. Allez sur http://127.0.0.1:8000/api/parkings pour faire des requêtes GET ou POST
3. Allez sur http://127.0.0.1:8000/api/parkings/{id} pour faire des requêtes GET, PUT, DELETE ou PATCH

