# Projet ISI SUPTECH - Site WordPress Complet

Ce dépôt contient l'intégralité du site WordPress personnalisé pour le projet de site web de l'école **ISI SUPTECH** (Institut Supérieur d'Informatique, Sénégal).

## Contenu du projet
* **Dossier WordPress complet** : Code source complet de WordPress, incluant le thème enfant personnalisé **Hello Elementor ISI** (situé dans `/wp-content/themes/helle-elementor-isi/`), les plug-ins nécessaires (comme Elementor), et les médias.
* **Base de données (`database.sql`)** : Export SQL complet à la racine du dépôt, contenant toutes les pages Elementor configurées, les menus, les widgets, et les publications d'événements (incluant le *Forum des entreprises* et le *CTF CyberISI Challenge*).
* **Script de migration (`setup_isi_site.php`)** : Placé à la racine du site, il permet de ré-importer dynamiquement les pages depuis les maquettes HTML.

## Instructions de déploiement (pour le Professeur)

### 1. Installation des fichiers
* Clonez ou téléchargez ce dépôt directement dans le répertoire racine de votre serveur web local (par exemple, le dossier `public` de Local WP ou `htdocs` de XAMPP).

### 2. Restauration de la Base de Données
* Importez le fichier `database.sql` (situé à la racine) dans votre base de données MySQL.
* Si votre URL locale est différente de `http://isi-suptech.local`, effectuez un chercher-remplacer dans votre base de données pour adapter l'URL (par exemple à l'aide de WP-CLI ou du plugin *Better Search Replace*) :
  ```bash
  wp search-replace 'http://isi-suptech.local' 'http://votre-url-locale'
  ```

### 3. Optionnel : Ré-importation du contenu des maquettes (`setup_isi_site.php`)
Si vous préférez reconstruire dynamiquement les pages à partir des fichiers HTML des maquettes d'origine au lieu d'importer le fichier SQL global, vous pouvez utiliser le script `setup_isi_site.php` :
1. **Configurer le chemin des maquettes** : Ouvrez `setup_isi_site.php` et modifiez la ligne 28 pour définir le chemin absolu du dossier contenant les maquettes HTML sur votre système :
   ```php
   $mockup_dir = 'C:/chemin/vers/votre/dossier/CMS2_maquette_ecole/';
   ```
2. **Exécuter le script** :
   * **Via le navigateur** : Accédez à `http://votre-url-locale/setup_isi_site.php`.
   * **Via le terminal** : Exécutez la commande `php setup_isi_site.php` à la racine de votre projet.
3. **Résultat** : Le script activera le thème enfant, créera/mettra à jour toutes les pages avec les shortcodes dynamiques insérés de manière transparente, et appliquera les réglages recommandés.
4. **Nettoyage** : Supprimez le fichier `setup_isi_site.php` de la racine de votre site une fois l'opération terminée.

---
*Projet réalisé et mis en conformité avec les maquettes de conception fournies.*


