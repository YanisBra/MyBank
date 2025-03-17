# Guide de configuration et démarrage du projet

## 1. Configuration et démarrage du client (React avec Vite)

- **Se rendre dans le dossier client :**
  ```bash
  cd client/
  ```

- **Installer les dépendances :**
  ```bash
  npm install
  ```

- **Construire l'image Docker pour le client :**
  ```bash
  docker build -t client .
  ```

- **Lancer le conteneur Docker du client :**
  ```bash
  docker run -p 5173:5173 client
  ```

## 2. Configuration et démarrage du serveur (Symfony)

- **Se rendre dans le dossier serveur :**
  ```bash
  cd server/
  ```

- **Installer les dépendances PHP avec Composer :**
  ```bash
  composer install
  ```

- **Construire et démarrer les conteneurs Docker pour le serveur :**
  ```bash
  docker compose up --build
  ```

- **Lancer le conteneur Docker du server :**
  ```bash
  docker compose up -d
  ```

- **Vérifier que le conteneur du serveur est bien en cours d'exécution dans l'application Docker Desktop.**
  Si nécessaire, allez dans l'onglet **Container** et démarrez manuellement le conteneur.

## 3. Vérification de l'application

- Une fois les deux parties (client et serveur) démarrées, accédez à l'application via votre navigateur :
  - **Frontend (React)** : [http://localhost:5173](http://localhost:5173)
  - **Backend (Symfony)** : [http://localhost:8000](http://localhost:8000)
