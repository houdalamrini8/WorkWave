# WorkWave – Application Web de Gestion des Offres d'Emploi

## Présentation

WorkWave est une application web développée dans le cadre d'un projet tutoré de fin d'études.

Elle permet de mettre en relation les candidats à la recherche d'un emploi et les entreprises souhaitant publier des offres de recrutement. La plateforme offre une interface intuitive permettant la gestion des profils, des offres d'emploi et des candidatures.

---

## Fonctionnalités

### Candidat

- Création d'un compte
- Authentification
- Création et modification du profil
- Consultation des entreprises
- Consultation des offres d'emploi
- Consultation des profils des candidats
- Publication et suppression de commentaires
- Consultation du CV

### Entreprise

- Création d'un compte
- Authentification
- Création d'offres d'emploi
- Modification d'une offre
- Suppression d'une offre
- Consultation des candidats
- Consultation des entreprises
- Consultation des offres
- Publication et suppression de commentaires

---

## Technologies utilisées

- PHP
- MySQL
- HTML5
- CSS3
- JavaScript
- Bootstrap

### Outils

- Visual Studio Code
- EasyPHP
- phpMyAdmin
- Enterprise Architect
- Looping
- Canva

---

## Installation

### 1. Cloner le dépôt

```bash
git clone https://github.com/houdalamrini8/WorkWave.git
```

### 2. Importer la base de données

Importer le fichier :

```
database/workwave.sql
```

dans phpMyAdmin.

### 3. Configurer la connexion

Modifier les informations de connexion dans :

```
config.php
```

ou

```
database.php
```

### 4. Lancer le projet

Démarrer Apache et MySQL avec EasyPHP (ou XAMPP).

Puis ouvrir :

```
http://localhost/WorkWave
```

---

## Structure du projet

```
WorkWave
│
├── css/
├── javascript/
├── images/
├── plugins/
├── uploads/
├── database/
├── docs/
├── screenshots/
│
├── index.php
├── config.php
├── database.php
├── connexion.php
├── logout.php
└── ...
```

---


## Auteur

**Houda LAMRINI**

Projet réalisé dans le cadre du Projet Tutoré – Faculté des Sciences Dhar El Mahraz – Université Sidi Mohamed Ben Abdellah de Fès.
