# Fresbeegolf-kirppis



   * Clone your project
    Go to the folder application using cd command on your cmd or terminal
    Run `composer install` on your cmd or terminal
    Copy .env.example file to .env on the root folder. You can type `copy .env.example .env` if using command prompt Windows or `cp .env.example .env` if using terminal, Ubuntu
    Open your .env file and change the database name (DB_DATABASE) to whatever you have, username (DB_USERNAME) and password (DB_PASSWORD) field correspond to your configuration.
    By default, the username is root and you can leave the password field empty. (This is for Xampp)
    By default, the username is root and password is also root. (This is for Lamp)
 *   Run `php artisan key:generate`
 *   Run `php artisan migrate`
 *   Run `php artisan serve`
 *   Go to `localhost:8000`

## Specified key was too long error

As outlined in the Migrations guide to fix this all you have to do is edit your AppServiceProvider.php file and inside the boot method set a default string length:


```php
use Illuminate\Support\Facades\Schema;

public function boot()
{
    Schema::defaultStringLength(191);
}
```
### ENV
PASSPORT_LOGIN_ENDPOINT="http://localhost:8000/oauth/token"
PASSPORT_CLIENT_ID=2
PASSPORT_CLIENT_SECRET="key here"
