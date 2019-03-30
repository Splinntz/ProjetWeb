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

Il va  falloir utiliser yarn pour modifier le css et le javascript (et oui c'est chaud).
Après avoir fait un :
``` 
composer install 
```

il va falloir installer yarn ici : 
https://yarnpkg.com/lang/fr/docs/install/#windows-stable

Puis a la racine du projet faire : 
``` 
yarn install 
```
Et ensuite ouvrez une console a part et mettez vous a la racine du projet et faites :
``` 
yarn run encore dev --watch 
```
Laissez tourner la console pour que vos changements soient pris en compte !

Pour plus d'infos voir : https://symfony.com/doc/current/frontend/encore/installation.html
