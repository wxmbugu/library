 ## Library
   - a simple library management site using laravel and vue js.
   
### Prerequisite
Ensure you have the following installed:
 1. php
 2. npm
 3. composer

#### Setup
``` 
git clone https://github.com/wxmbugu/library
```
#### Run Server
```
$ cd library
$ php artisan serve
```
#### Run Client
```
$ cd vue-library
$ npm run dev
```

#### Issues
 - when running migrations you have first to comment out `App\Providers\ExtensionBookLoanServiceProvider::class` in config/app.php for one to run migrations or run server
 - after commenting it out you first run migrations then you can now start your server.
