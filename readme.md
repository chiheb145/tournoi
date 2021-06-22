command list

git clone https://github.com/chiheb145/tournoi.git
cd tournoi
composer install
cp .env.example .env
php artisan key:generate


Assurez-vous de définir les informations de connexion à la base de données correctes
avant d'exécuter les migrations Variables d'environnement.

php artisan migrate
php artisan db:seed

Exécuter le serveur de développement laravel

php artisan serve

L'API est désormais accessible à l'adresse

http://localhost:8000/api
