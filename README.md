## Description

Implémentation d'un site web **vulnérable** simulant une messagerie.

Ce site permet de tester différents failles de sécurité.

## Installation

Si vous utilisez l'image Docker proposée pour le cours, vous pouvez copier directement le répertoire "site" et son contenu (explications dans la donnée du projet).

#### Install Docker 

Une fois le repos git cloné, il y a deux scripts nommés "install" à la racine du projet. Le fichier .bat est pour Windows et le .sh pour Linux et MacOS.

Le script installera l'image docker automatiquement et lancera les deux commandes pour démarrer nginx et le serveur php.

Une fois le script exécuté vous n'avez plus qu'à aller sur votre navigateur et aller sur l'url : [http://localhost:8080/](http://localhost:8080/)

Note : Si vous stoppez le conteneur docker, il vous faudra exécuter les commandes suivantes après l'avoir relancé :

```bash
docker exec -u root sti_project service nginx start
docker exec -u root sti_project service php5-fpm start
```



### Permissions sur databases  ###
La création d'un utilisateur, l'envoie de message, etc. nécessite de pouvoir écrire dans le fichier de la base de donnée ainsi de la lire. Pour avoir les droits d'écritures et de lectures, il faut mettre comme propriétaire `www-data`  sur le dossier `databases` et ses sous-répertoires

> sudo docker exec -it sti_project  /bin/bash
>
> cd usr/share/nginx
>
> chown  www-data databases -R



## Description du repo git

Le répertoire "site" contient deux répertoires :

    - databases
    - html

Le répertoire "databases" contient :

    - database.sqlite : un fichier de base de données SQLite

Le répertoire "html" contient :

    - exemple.php : un fichier php qui réalise des opérations basiques SQLite sur le fichier contenu dans le repertoire databases
    - helloworld.php : un simple fichier hello world pour vous assurer que votre container Docker fonctionne correctement
    - phpliteadmin.php : une interface d'administration pour la base de données SQLite qui se trouve dans le repertoire databases

Le mot de passe pour phpliteadmin est "admin".

## Configurations

#### Base de donnée

La base de donnée est déjà prête à l'emploi et vous n'avez pas à y toucher. Toutefois dans le cas ou vous voudriez la reconstruire pour une raison ou une autre, dans le dossier "ScriptsSQL", il y a le script de création de la base de donnée. A noter qu'il vous faudra supprimer manuellement toutes les tables de la base de donnée avant de l'utiliser.

#### Utilisateurs

Deux utilisateurs sont déjà présents dans la base de donnée :

- Un administrateur : login : admin, mdp : admin
- Un utilisateur : login : user, mdp : user

Il est possible de créer des utilisateurs supplémentaire depuis la page de login du site.



## Présentation du site

## Inbox

Après s'être connecté, un utilisateur peut aller sur InBox pour afficher la liste des messages. Ceux-ci seront triés par date de réception. Tout à droite, dans l'encadré rouge, trois boutons permettent de :

1) Supprimer le message

2) Afficher le message

3) Ecrire une réponse

![menu](doc/assets/menu.PNG)

En cliquant sur le bouton Profil, l'utilisateur pourra modifié son profil.



## Administration

### Page d'administration

Un administrateur peut gérer les utilisateurs et modifier leur profil. 

- L'onglet "Administration", en rouge, permet d'accéder à cette page. 

- Dans l'encadré vert se trouve les boutons permettant de supprimer et de modifier le profil.
- Dans l'encadré mauve, l'administrateur peut modifier le rôle de l'utilisateur

![page-administration-2](doc/assets/page-administration-2.PNG)

## Page de profil

Une fois que l'administrateur a accéder au profil de l'utilisateur, il peut :

1) Modifier le mot de passe (encadré n°1)

2) Modifier l'activité du compte (encadré n°2)

![profil-admin](doc/assets/profil-admin.PNG)

## Source 

Une partie du design et de la structure du code provient du travail de fin de CFC de Ryan Sauge dont le code est disponible publiquement :
[https://github.com/rya-sge/travail-cfc](https://github.com/rya-sge/travail-cfc)

