# Gestion des Véhicules avec Symfony


## Prérequis

Avant de commencer, assurez-vous d'avoir installé ce qui suit :

- PHP >= 7.4
- Composer
- Symfony CLI

## Installation

1. **Cloner le projet depuis GitHub :**

    git clone https://github.com/houssemfathalli/vehicle-management.git
  

2. **Installer les dépendances PHP via Composer :**

    cd vehicle-management
    composer install


3. **Configurer la base de données :**

    - Assurez-vous que vos paramètres de base de données sont configurés dans le fichier `.env`.
    - Créez la base de données et exécutez les migrations :

      php bin/console doctrine:database:create
      php bin/console doctrine:migrations:migrate


4. **Démarrer le serveur de développement :**

    symfony serve


5. **Accéder à l'application dans votre navigateur :**

    Ouvrez votre navigateur et accédez à `http://localhost:8000`.

