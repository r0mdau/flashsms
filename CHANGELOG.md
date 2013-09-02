# 1.0.0 (unfixed)
- **Nouveautés
  - Autoloader retravaillé, tous les fichiers et ceux des sous répertoires du dossier "core" sont inclus au projet.
  - Création d'un fichier de configuration `settings.php` permettant de définir des variables superglobales.
  - Bootstrap d'initialisation des variables de l'application

## 0.2.0 (28 Août 2013)
- **Fonctionnalité**
  - Lorsqu'un champ n'est pas bien renseigné dans le formulaire d'envoi, les informations correctement
    saisies sont enregistrées en session pour les conserver dans le formulaire

### 0.1.1 (26 Août 2013)
- **Bug**
  - La fonction getNameOf retourne désormais le nom de la personne associé au numéro envoyé en paramètre

## 0.1.0 (25 Août 2013)

Première version de l'application flashsms

- **Fonctionnalités**
  - Envoyer un sms
  - Parser au format json et afficher les sms reçus
  - Envoyer un sms PDU class 0
  - Gérer un annuaire de contacts, association nom avec numéro uniquement
  - Gérer des listes de diffusions de sms
- **Contraintes**
  - Utilisation du logiciel gammu
  - Il faut brancher et configurer une clé 3G 
  - Il faut une carte sim avec abonnement SMS
  - Développé sur un raspberry pi modèle B

## TODO :
1. Avoir un système de conversation avec une personne en particulier pour ne pas perdre le fil de la discussion
2. Lots of things ...
