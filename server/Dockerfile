# Utilise l’image officielle PHP 8.2 en mode CLI
FROM php:8.2-cli

# Met à jour la liste des paquets et installe les dépendances système + extensions PHP nécessaires
RUN apt-get update && apt-get install -y \
    libzip-dev unzip git && docker-php-ext-install zip pdo pdo_mysql

# Copie l’exécutable Composer depuis l’image officielle Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Définit le dossier de travail dans le conteneur
WORKDIR /app

# Copie tous les fichiers du projet dans le conteneur
COPY . .

# Installe les dépendances PHP du projet via Composer
RUN composer install

# Démarre le serveur PHP intégré sur le port 8000 et sert les fichiers du dossier public
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]