# ProjetWeb

Lorsque vous allez pull ou clone le projet mettez vous à la racine du projet et faites la commande :
```
composer install
```
Sinon vous aurez des erreur dans votre projet !

Ensuite pour avoir la base de donnée correcte merci de faire la commande :
```
php bin/console doctrine:migrations:migrate
```
Pour le moment il vous faudra remplir la base de donnée manuellement. 
N'oubliez pas de configurer votre adresse de base de donnée dans le fichier .env
