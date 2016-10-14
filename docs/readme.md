- cambio nome alla app per i namespace

** php artisan app:name Cms


** authentication

Want to get started fast? Just run 

php artisan make:auth 
and 
php artisan migrate

These two commands will take care of scaffolding your entire authentication system!


At its core, Laravel's authentication facilities are made up of "guards" and "providers

Guards define how users are authenticated for each request. 
For example, Laravel ships with a session guard which maintains state using session storage and cookies.


Providers define how users are retrieved from your persistent storage. Laravel ships with support for retrieving users using Eloquent and the database query builder. However, you are free to define additional providers as needed for your application.



** users management




** package.json file