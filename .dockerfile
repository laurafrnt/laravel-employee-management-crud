FROM php:8.2-apache

# Installation des dépendances système et extensions PHP
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl

# Installation de Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Installation de Node.js et NPM (pour les assets)
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Nettoyage du cache apt
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Installation des extensions PHP pour Laravel & MySQL
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Activation du module Rewrite d'Apache (crucial pour les routes Laravel)
RUN a2enmod rewrite

# Définition du répertoire de travail
WORKDIR /var/www/html

# On donne les droits au serveur web sur les dossiers de stockage
RUN chown -R www-data:www-data /var/www/html

# Copier le script d'entrée
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Définir le point d'entrée
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
