# FlashSMS avec PHP, jQuery, Bootstrap Twitter et Gammu
Application hébergée sur un serveur web tel Apache2 ou Nginx. Avec cette application il est possible d'envoyer des SMS depuis un navigateur internet, d'envoyer des SMS PDU class 0 et de créer des listes de diffusions SMS.

## Projet
* Langages de développement : `PHP` `HTML5` `Javascript`
* Frameworks : `Bootstrap Twitter` `jQuery`

## Auteur

**Romain Dauby**

+ [https://github.com/r0mdau/](https://github.com/r0mdau/)
+ [http://www.romaindauby.fr](http://www.romaindauby.fr)


## Date de début
* Début du projet : 21/06/2013

## Git Source du projet : 

[https://github.com/r0mdau/flashsms](https://github.com/r0mdau/flashsms)

## Contraintes techniques du projet :
* Il faut posséder un lecteur de carte SIM type clé 3G reconnue par le serveur.
* Fonctionne sur toute distribution capable d'afficher des pages HTML, d'interpréter le langage PHP côté serveur et d'utiliser le logiciel gammu.

## Démarrage rapide (Debian) :
* Installer gammu et comgt : `apt-get install gammu comgt`
* Brancher le lecteur de carte SIM avec la carte insérée
* Configurer gammu : `gammu--configure` Les paramètres que je ne cite pas doivent être laissés comme tels ou vides.
 * port = /dev/ttyUSB1
 * connection = at
 * synchronizetime = yes
 * logfile = /var/log/gammu.log
 * logformat = textalldate
* Lancer la commande : `comgt -d /dev/ttyUSB1` Vous devrez ensuite saisir le code PIN de votre carte SIM.
* Donner les droits à l'utilisateur d'Apache ou Nginx (www-data généralement) d'exécuter des commandes gammu. Pour faire des tests : `su www-data` et ensuite `echo "mon message" | gammu --sendsms TEXT +33654545454`
* Cloner le repo : `git clone http://git.romaindauby.fr/flashsms`
* Se placer dans le répertoire flashsms : `cd flashsms`
* Créer le dossier datas : `mkdir datas` puis donner les droits de lecture et d'écriture à l'utilisateur www-data
* Faire pointer votre hôte virtuel vers le dossier flashsms
* Exécuter une tâche cron : `crontab -e`
 * \* * * * * php -f <path>/flashsms/cronMessages.php
Une fois toutes ces étapes correctement réalisées, vous pouvez accéder à l'application depuis votre navigateur.

## Bug tracker

Si vous avez des problèmes pour l'installation, des questions ou des bugs sur le projet, [merci d'ouvrir un ticket](https://github.com/r0mdau/flashsms/issues). Avant d'ouvrir un ticket, merci de vérifier que la réponse à votre demande n'a jamais été traitée.

## Communauté

Rester à la page sur le développement du projet et les nouveautés de la communauté.

* Suivez [@r0mdau sur Twitter](http://twitter.com/r0mdau)

## Copyright and license

Copyright 2013 r0mdau, Inc under [the Apache 2.0 license](LICENSE).
