# Documentation Technique

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

## Installation

### Clonez le repo

```bash
git clone https://github.com/ViElChompo/Entretien-piege.git
```

### Installation Backend

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

### Installation Frontend

Veuillez vous rendre dans le dossier frontend pour installer les dépendances du frontend.

1. Installer les dépendances:
   ```bash
   npm install
   ```
2. Configurer le port de l'API si nécessaire dans le fichier `axios.js`

### Script Pour Démarrer Les Serveurs:

Veuillez démarrer les serveurs avec la commande suivante:

```bash
./start.sh
```

start.sh est un petit script qui s'occupe de lancer les serveurs des dossiers front et back pour vous.

## Accès à la Route Protégée (Admin)

Un compte admin a été créé afin de répondre à la demande d'une route protégée et accessible uniquement à un admin.

### Informations de connexion
- Email: `admin@example.com`
- Mot de passe: `fullstache1234!`

### Utilisation avec Postman

#### Étape 1: Authentification et récupération du token

1. Créez une nouvelle requête POST vers `http://127.0.0.1:8000/api/v1/login`
2. Dans l'onglet "Body", sélectionnez "raw" et format "JSON"
3. Saisissez les informations d'authentification:
   ```json
   {
       "email": "admin@example.com",
       "password": "fullstache1234!"
   }
   ```
4. Envoyez la requête et copiez le token depuis la réponse

#### Étape 2: Accès à la route protégée

1. Créez une nouvelle requête GET vers `http://127.0.0.1:8000/api/v1/admin/only`
2. Dans l'onglet "Authorization":
   - Sélectionnez "Bearer Token" dans le menu déroulant
   - Collez le token copié précédemment
3. Envoyez la requête pour accéder à la route protégée

### Utilisation avec cURL

#### Méthode en deux étapes

**Étape 1**: Authentification
```bash
curl -X POST \
  http://127.0.0.1:8000/api/v1/login \
  -H "Content-Type: application/json" \
  -d '{"email":"admin@example.com","password":"fullstache1234!"}'
```

**Étape 2**: Accès à la route protégée (remplacez [TOKEN] par votre token)
```bash
curl -X GET \
  http://127.0.0.1:8000/api/v1/admin/only \
  -H "Authorization: Bearer [TOKEN]"
```

#### Méthode en une seule commande
```bash
TOKEN=$(curl -X POST \
  http://127.0.0.1:8000/api/v1/login \
  -H "Content-Type: application/json" \
  -d '{"email":"admin@example.com","password":"fullstache1234!"}' \
  -s | grep -o '"token":"[^"]*' | cut -d'"' -f4) && \
curl -X GET \
  http://127.0.0.1:8000/api/v1/admin/only \
  -H "Authorization: Bearer $TOKEN"
```