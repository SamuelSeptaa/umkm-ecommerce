## MARKETPLACE FOR UMKM ECOMMERCE

You can use this project with this step

-   Clone this project to your local repository.
-   On the command line, type
-   `composer update`
-   Setup your .env file like database etc. You also need 2 Public API's for this. [Midtrans](https://docs.midtrans.com/reference/getting-started-with-snap) for Payment API and [Biteship](https://biteship.com/id/docs/intro) for Logistic API.
-   You need to fill this lines of code to your .env

```
        MIDTRANS_IS_PRODUCTION=false
        MIDTRANS_MERCHAT_ID=<your merchant id>
        MIDTRANS_CLIENT_KEY=<your client key>
        MIDTRANS_SERVER_KEY=<your server key>

        BITESHIP_TEST_KEY=<Your biteship key>

```

-   You might also need fill the mail environment if you want the receipt email is sent

```
        MAIL_MAILER=smtp
        MAIL_HOST=<your host>
        MAIL_PORT=<your port>
        MAIL_USERNAME=<your username>
        MAIL_PASSWORD=<your pass>
```

-   Generate key in CMD with `php artisan key:generate`
-   Generate the database tables `php artisan migrate:fresh`
-   Insert the dummy data to database using `php artisan db:seed --class=DatabaseSeeder`
-   You might need to create storage link using `php artisan storage:link`
-   You are good to go, now type `php artisan serve`
-   You can use and modify the app as you like

> **_NOTE:_** My local dev environment is using PHP 8.0.28.
> **_IMPORTANT:_** This App is still on development.

> Contact me if you want to contribute to this project on samuelseptaa@gmail.com
