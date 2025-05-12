# Entretien-piege

# Entretien d'embauche piégé - Application interactive

Une application interactive de narration où vous passez un entretien d'embauche avec des choix qui influencent le résultat.

## Aperçu

Cette application se compose de:
- Un backend Laravel V12.10.2 fournissant une API RESTful
- Un frontend Vue.js V3.5.13 pour l'interface utilisateur
- Système de progression sauvegardée
- Authentification des utilisateurs
- Navigation dynamique entre les chapitres

## Fonctionnalités

- 5 chapitres interactifs + 3 fins différentes (accepté, refusé, blacklisté)
- API RESTful versionnée (/api/v1)
- Authentification sécurisée avec Laravel Sanctum
- Sauvegarde automatique de la progression
- Interface utilisateur responsive

## Prérequis

- PHP 8.1 ou supérieur
- Composer
- Node.js 14+ et npm
- MySQL ou autre base de données supportée par Laravel

## Installation Backend

veuillez vous rendre dans le dossier backend
   ```bash
   cd entretien-piege-backend
   ```


1. Cloner le dépôt backend
2. Installer les dépendances:
   ```bash
   composer install
   ```
3. Copier le fichier d'environnement:
   
   ```bash
   cp .env.example .env
   ```
4. Configurer le fichier `.env` (base de données, etc.)
5. Générer la clé d'application:
   ```bash
   php artisan key:generate
   ```
6. Exécuter les migrations et seeds:
   ```bash
   php artisan migrate --seed
   ```

## Installation Frontend
Veuillez vous rendre dans le dossier frontend pour installer les dépendances front.

1. Cloner le dépôt frontend
2. Installer les dépendances:
   ```bash
   npm install
   ```
3. Configurer le port de l'API si nécessaire dans le fichier `axios.js`


## Script Pour Démarrer Les Serveurs: 
   - Veuillez starter le serveur avec la commande suivante: 
      ```bash
      
      ./start.sh

      ```


## Structure de l'histoire

L'histoire est composée de 5 chapitres:
1. Invitation à l'entretien
2. Début de l'entretien
3. Question morale 1
4. Question morale 2
5. Résultat (3 fins possibles)

## Technologies utilisées

- **Backend**:
  - Laravel V12.10.2
  - Laravel Sanctum pour l'authentification
  - API RESTful versionnée
  - MySQL

- **Frontend**:
  - Vue.js V3.5.13 avec Composition API
  - Vue Router pour la navigation
  - Pinia pour la gestion d'état
  - Axios pour les requêtes HTTP

## Compte Admin Pour Route Protégée

Un compte admin à été créé afin de répondre à la demande d'une route protégée et accessible uniquement à un admin: 


Veuillez vous connecter avec : 

   ```bash
   Email: admin@example.com
   mp: fullstache1234!
   
   ```

   - **Vous pouvez vous connecter dans postman.**

   Requête "POST" à l'url suivant:

   ```bash
      http://127.0.0.1:8000/api/v1/login

   ```

   Body de la requête: 

   ```bash
      {
          "email": "admin@example.com",
          "password": "fullstache1234!"
      }
   ```


   **Deuxième partie "GET"**



   Récupérer le token JWT obtenu grâce au login et le mettre dans la section 
   "Authorization" -> bearer token -> mettre le JWT dans la zone de texte prévue à cet effet.

   Requête de type "GET"


   ```bash
      URL de la route protégée: http://127.0.0.1:8000/api/v1/admin/only
   ```
   
   Et vous allez recevoir un message vous assurant que vous êtes connectés en tant qu'admin. 

