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
7. Démarrer le serveur:
   ```bash
   php artisan serve
   ```

## Installation Frontend

1. Cloner le dépôt frontend
2. Installer les dépendances:
   ```bash
   npm install
   ```
3. Configurer l'URL de l'API si nécessaire dans le fichier `axios.js`
4. Démarrer le serveur de développement:
   ```bash
   npm run dev
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

- **Script Serveur Web**:
   - Veuillez starter le serveur avec la commande suivante: 
      ```bash
      
      ./start.sh

      ```