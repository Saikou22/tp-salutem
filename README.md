# Salutem Symfony

## Création du projet

```shell
composer create-project symfony/skeleton salutem
```

OU

```shell
symfony new salutem
```

### Doctrine

```shell
composer require symfony/orm-pack
```

Créer le fichier .env.local et ajouter la ligne `DATABASE_URL`

Créer la base de données

```shell
php bin/console doctrine:database:create
```

Créer une entité (c'est la partie qui demande de la concentration donc on éteind la TV, on coupe la musique et on ferme la porte à clé !)

```shell
php bin/console make:entity
```

Générer les migrations

```shell
php bin/console make:migration
```

Exécuter les migrations

```shell
php bin/console doctrine:migration:migrate
```

En cas de problème dans l'exécution des migrations (problème de synchronisation entre les fichiers PHP et la base de données) :

Supprimer les fichiers PHP de migration puis :

```shell
php bin/console doctrine:database:drop --force
php bin/console doctrine:database:create
php bin/console make:migration # Cette commande va générer 1 seul fichier de migration contenant l'ensemble des requêtes SQL pour créer la base de données
php bin/console doctrine:migration:migrate
```

### Doctrine fixtures

```shell
composer require --dev orm-fixtures
```

Générer un fichier de fixtures

```shell
php bin/console make:fixture
```

Exécuter les fixtures

```shell
php bin/console doctrine:fixtures:load
```

### Installation de WebPack Encore

```shell
composer require symfony/webpack-encore-bundle
npm install
```

#### Activation de SASS

Décommenter la ligne suivante dans le fichier webpack.config.js :

```shell
.enableSassLoader()
```

Installer les dépendances NPM :

```shell
npm install sass-loader@^12.0.0 sass --save-dev
```

Renommer le fichier `assets/styles/app.css` en `assets/styles/app.scss`
et modifier la ligne appelant le fichier CSS dans le `assets/app.js`.

### Installation de Twig

```shell
composer require twig
```

### Création d'un controller pour la page d'accueil

Exécuter la commande suivante avant de créer le fichier Twig (la commande va le créer pour vous).

```shell
php bin/console make:controller
```

Saisir le nom du controller `DefaultController` puis modifier le fichier.



## Démarrage du projet

### Mettre en place l'environnement (une seule fois, après avoir récupéré le projet)

Créer le fichier .env.local

```shell
composer install
php bin/console doctrine:database:drop --force
php bin/console doctrine:database:create
php bin/console doctrine:migration:migrate
php bin/console doctrine:fixtures:load
```

### Démarrer le serveur PHP

```shell
php -S localhost:8000 -t public
```

OU

```shell
symfony serve
```