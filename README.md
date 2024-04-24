
# CRUD NEWS

Mini CRUD news

## Envirenement

- PHP LARAVEL

## FIRST

- Clone les projet dans votre racine ou extracte le fichier zip

## INSTALLATION BACK
- Accéder au projet
- Commencé par faire un petit `php artisan cache:clear`
- Après `composer install`
- Dans le fichier .env configure les variables suite au variable local

- Lancé la commande `php artisan migrate` pour mis a joure votre base de donne lie au projet
- Initialise les donnes de la base de données

```md
php artisan db:seed --class=CategorySeeder
php artisan db:seed --class=NewSeeder
php artisan db:seed --class=UserSeeder
``` 

Lance votre serveur local en `php artisan serve` ou en mettre en place un VHOST
Commance a teste ENDPOINT API