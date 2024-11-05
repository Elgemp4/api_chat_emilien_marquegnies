## Installation

Afin de pouvoir installer l'api dans xampp il faut suivre les étapes suivantes : 

1. Depuis le dossier de XAMMP déposer le dossier avec le projet laravel dans le dossier `htdocs`
2. Dans le panneau de contrôle XAMPP appuyer sur config puis `<browse> [Apache]` afin d'ouvrir l'explorateur de fichier dans le dossier de apache.
3. Aller dans le dossier `conf` puis le dossier `extra` et ouvrir le fichier `httpd-vhosts.conf`
4. Dans ce fichier ajouter l'entrée vers le dossier publique du projet laravel. Exemple (adapter le chemin à côté de DocumentRoot selon pour sa machine) : Le premier vhost est là afin de garder les fonctionallité de base de apache et l'autre afin d'ajouter le site.
```
<VirtualHost *:80>
       DocumentRoot "C:/xampp8.2/htdocs/"
       ServerName localhost
</VirtualHost>
<VirtualHost *:80>
       DocumentRoot "C:/xampp8.2/htdocs/api_chat_emilien_marquegnies/public"
       ServerName laravel.localhost
</VirtualHost>
```
5. Redémarrer apache et vous êtes tout bon ! Vous pouvez maintenant accéder à l'api via l'adress laravel.localhost
