# partiel_symfony

## Qu'est-ce qu'un container de services ? Quel est son rôle ?

Cela Permet de centraliser la création des objets (ou services) afin de pouvoir faire par exmple de l'autowiring (injection de dépendances).



## Quelle est la différence entre les commandes make:entity et make:user lorsqu'on utilise la console Symfony ?

make:entity permet de créer une entité avec tous les champs que l'on souhaite (crée également un répository associé).
make:user est lui beaucoup plus adapté pour de l'authentification cela permet donc de créer un utilisateur avec un email, une liste de role et un mot de passe (crée également un répository associé). Cependant cela modifie également le security.yml

Exemple :
providers:
        # used to reload user from session & other features (e.g. switch_user)
        app_user_provider:
            entity:
                class: App\Entity\User
                property: email
Cela permet de définir quel propriété est unique et qui servira d'identifiant.




## Quelle commande utiliser pour charger les fixtures dans la base de données ?
    php bin/console doctrine:fixtures:load




## Résumez de manière simple le fonctionnement du système de versions "Semver"
elle est découpé en 3 partie (1.2.3)
Le premier chiffre corresponds à une version majeur de l'application (donc un ensemble de grosse fonctionalité)
Le deuxième chiffre corresponds à une version mineur de l'application 
Le troisème chiffre corresponds à un patch de l'application




## Qu'est-ce qu'un Repository ? A quoi sert-il ?
Un repository est un une couche applicative permettant l'accès à des données d'une entitée en base de donnée cette couche à été crée afin de séparer les responsabilités. => lien entre un objet et la base de donnée.




## Quelle commande utiliser pour voir la liste des routes ?
php bin/console debug:router


## Dans un template Twig, quelle variable globale permet d'accéder à la requête courante, l'utilisateur courant, etc...?
app.



## Pour mettre à jour la structure de la base de données, quelles sont les 2 possibilités que nous avons abordées en cours ?

Faire une migrations l'avantage est que cela crée une base qui sert d'historique aux mise à jour de la base, et que cela génère un script qui permet de faire un retour arrière.
php bin/console make:migration => crée le script
php bin/console doctrine:migrations:migrate => exécute le script

Faire un schema update:
php bin/console doctrine:schema:update --dump-sql => permet de voir la requête SQL qui va être executée pour mettre à jour la base.
php bin/console doctrine:schema:update --force permet d'exécuter la requête.



## Quelle commande permet de créer une classe de contrôleur ?

php bin/console make:controller

## Décrivez succintement l'outil Flex de Symfony

Symfony flex => listes des packages de symfony => directement lié a composer (des alias on été créés)