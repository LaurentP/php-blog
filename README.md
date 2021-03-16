# PHP Blog

C'est un blog léger et minimaliste fait en PHP, sans framework ni librairie, avec la programmation orientée objet et l'architecture MVC. Il nécessite une base de données MySQL ou MariaDB pour fonctionner.

Avant de l'utiliser, il faut le configurer dans le fichier config.php, et importer le fichier php-blog.sql dans une nouvelle base de données. Ces fichiers se trouvent à la racine du projet.

Les liens vers les articles comprennent un slug pour le référencement.

On a le choix de poster ou non une image par article, qui est dupliquée sous forme de miniature pour un chargement plus rapide des pages. La transparence des .png est préservée.

Il possède un routeur qui peut être utilisé pour la création de nouveaux contrôleurs, une interface d'administration, et un formulaire de contact.

Il peut être utilisé comme framework pour démarrer un petit projet.