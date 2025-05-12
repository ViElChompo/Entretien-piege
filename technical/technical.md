## Prérequis

- PHP 8.1 ou supérieur
- Composer
- Node.js 14+ et npm
- SQLite ou autre base de données supportée par Laravel

## Technologies utilisées

- **Backend**:

  - Laravel V12.10.2
  - Laravel Sanctum pour l'authentification
  - API RESTful versionnée
  - SQLite

- **Frontend**:
  - Vue.js V3.5.13 avec Composition API
  - Vue Router pour la navigation
  - Pinia pour la gestion d'état
  - Axios pour les requêtes HTTP

## Clonez le repo

```bash
    git clone https://github.com/ViElChompo/Entretien-piege.git
```

## Installation Backend

Veuillez vous rendre dans le dossier backend

```bash
cd entretien-piege-backend
```

1. Installer les dépendances:
   ```bash
   composer install
   ```
2. Copier le fichier d'environnement:

   ```bash
   cp .env.example .env
   ```

3. Configurer le fichier `.env` (base de données, etc.)
4. Générer la clé d'application:
   ```bash
   php artisan key:generate
   ```
5. Exécuter les migrations et seeds:
   ```bash
   php artisan migrate --seed
   ```

## Installation Frontend

Veuillez vous rendre dans le dossier frontend pour installer les dépendances du frontend.

1. Installer les dépendances:
   ```bash
   npm install
   ```
2. Configurer le port de l'API si nécessaire dans le fichier `axios.js`

## Script Pour Démarrer Les Serveurs:

- Veuillez démarrer les serveurs avec la commande suivante:

  start.sh est un petit script qui s'occupe de lancer les serveurs des dossiers front et back pour vous.

  ```bash

  ./start.sh

  ```

## Compte Admin Pour Route Protégée

Un compte admin à été créé afin de répondre à la demande d'une route protégée et accessible uniquement à un admin:

Veuillez vous connecter avec :

```bash
Email: admin@example.com
mp: fullstache1234!

```

- **Vous pouvez vous connecter dans Postman ou avec Curl.**

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
