# ProjektZespolowy
<br>
Podstawowa konfiguracja w plikach pdf od Mateusza. Dodatkowo...

W pliku <strong>C:\xampp\apache\conf\extra\httpd-vhosts.conf</strong> dodać:
```
<VirtualHost *:80>
    DocumentRoot "C:/xampp/htdocs/zespolowy.localhost/public"
    ServerName zespolowy.localhost
    ServerAlias www.zespolowy.localhost
    ErrorLog "logs/zespolowy.localhost-error.log"
    CustomLog "logs/zespolowy.localhost-access.log" common
</VirtualHost>
```

W pliku <strong>C:\Windows\System32\drivers\etc\hosts</strong> dodać:
```
127.0.0.1       zespolowy.localhost
```

W plikach pdf jest opisane wszystko dla PHPStorm. Można też zainstalować VS Code z rozszerzeniami z tego linku: https://code.visualstudio.com/docs/languages/php

oraz 

https://marketplace.visualstudio.com/items?itemName=TheNouillet.symfony-vscode
https://marketplace.visualstudio.com/items?itemName=mblode.twig-language-2


-------

Zainstalujcie gita i w terminalu wpiszcie:
```
git clone https://github.com/michaelspace/ProjektZespolowy.git
git branch develop
git checkout develop
git pull
```
Zawartość folderu ProjektZespolowy przekopiować do katalogu <strong>zespolowy.localhost</strong>

W terminalu w folderze z tą zawartością po przekopiowaniu:
```
composer update
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

Po konfiguracjach mając włączony Apache oraz MySQL możemy uruchomić serwer i sprawdzić, czy wszystko działa:
```
php bin/console server:run
```
W przeglądarce otwieramy: <strong>zespolowy.localhost</strong>

Baza danych z encjami dostępna: <strong>zespolowy.localhost/phpmyadmin</strong>
