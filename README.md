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

Créer le fichier .env.local

Créer la base de données

```shell
php bin/console doctrine:database:create
```

Créer une entité

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

## Démarrage du projet

Créer le fichier .env.local

```shell
composer install
php bin/console doctrine:database:create
php bin/console doctrine:migration:migrate
```

```shell
php -S localhost:8000 -t public
```

OU

```shell
symfony serve
```