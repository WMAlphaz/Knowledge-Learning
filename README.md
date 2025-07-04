# PROJET BILAN : Créer la plateforme e-learning « Knowledge Learning »


## Ce dont vous avez besoin :

- **XAMPP**
- **PHP (Version 8.2 minimum requise)**
- **Composer**
- **Symfony (Version 5.0 minimum requise)**

## Installation
Suivez les étapes ci-dessous pour installer et lancer le projet :

1. **Créer un dossier pour le projet**  
   Dans le répertoire `htdocs` de XAMPP, créez un dossier nommé `knowledge_learning`.

2. **Ajouter les fichiers du projet**  
   Vous pouvez soit :  
   - **Cloner le projet** directement dans ce dossier en ouvrant VSCode et en tapant dans le terminal :  
     ```sh
     cd chemin/vers/htdocs/knowledge_learning
     git clone https://github.com/WMAlphaz/Plateforme-Knowledge-Learning.git .
     ```  
   - **Ou bien copier manuellement** les fichiers du projet dans ce dossier si vous les avez téléchargés autrement.

3. **Installer les dépendances PHP**  
     ```sh
     composer install
     ```  

4. **Configurer la base de données**  
     ```sh
     php bin/console doctrine:database:create
     ```
   **Lancez les migrations pour créer les tables :**
     ```sh
     php bin/console doctrine:migrations:migrate
     ```

5. **Charger les données de test (fixtures)**  
     ```sh
     php bin/console doctrine:fixtures:load
     ```

## Accès
**URL du site :** http://localhost:8000/
**Identifiant admin :** johndoe@gmail.com
**Mot de passe admin :** admin
**Carte de paiement test (Stripe) :** 
    - **Numéro :** 4242 4242 4242 4242
    - **Date d’expiration et code CVV :** n’importe quelle valeur

## Tests unitaires

1. **Créez la base de données de test :**
     ```sh
     php bin/console doctrine:database:create --env=test
     ```

2. **Mettez à jour le schéma de la base de données de test :**
     ```sh
     php bin/console doctrine:schema:update --force --env=test
     ```

3. **Chargez les fixtures en environnement test :**
     ```sh
     php bin/console doctrine:fixtures:load --env=test
     ```

4. **Lancez les tests PHPUnit :**
     ```sh
     php bin/phpunit
     ```

## En cas de problème
Si vous avez une erreur liée à l’accès à la base de données, il est probable que l’extension "intl" de PHP ne soit pas activée. 
**Pour ce faire :** 
    - Ouvrez votre fichier php.ini
    - Recherchez la ligne suivante : ```;extension=intl```
    - Supprimez le point-virgule ";" au début de la ligne pour activer l’extension : ```extension=intl```
    - Enregistrez le fichier et redémarrez votre serveur Apache via XAMPP.