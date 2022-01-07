# Instalacja

Na komputerze z zainstalowanym php i composer'em instalujemy Laravela
    
    composer global require laravel/installer

Pobieramy projekt (np. korzystając z komendy gitclone)

    tu komenda clone

W folderze projektu wchodzimy w config/database.php i ustawiamy używaną przez nas bazę (np. mysql) oraz ustawiamy login i hasło do bazy.

W konsoli, będąc w głównym folderze projektu, uruchamiamy komendę:

     php artisan migrate

W celu dodania rekordów do bazy, uruchamiamy komendę:

    php artisan db:seed


Aplikację uruchamiamy komendą:

    php artisan serve

Startowe dane użytkownika:
Login: admin@admin.com
hasło: zaq1@WSX
Możemy zmienić je po zalogowaniu w zakładce 'Change password'
