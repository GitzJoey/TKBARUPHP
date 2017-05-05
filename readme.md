# Toko Baru - TKBARU PHP Version

A web application focusing on the usage of popular framework, handpicked with consideration.
To meet the everyday programming/coding obstacle and giving the best solution that we can find.

This project initially to create a simple POS (Point of Sales) that catering the basic of POS,
like buy, sell, stock, report. But it still open to extend the capabilities like, linking to
bank, payment, payroll, accounting, etc.

This project is porting from Java version, you can find the Java version [here!](https://github.com/gitzjoey/tkbarujava/)

# The Goal
The Goal is to become the ***most up to date*** POS system using the most up to date technology and
based with the best practice that every people in the world is using. Only with this goal we are
forced to always learn and learn and learn to adapt with the latest technology and make us keep up to date
with the current technology.

# Requirements
* [PHP](http://php.net)
* [Laravel](http://www.laravel.com)
* [VueJS](http://www.vuejs.org)
* [Composer](http://getcomposer.org) 
* [NodeJS/NPM](http://nodejs.org)
* [Git](http://git-scm.com)
* [Mysql](http://mysql.com)

# Installation
Clone repository
```
$ git clone https://github.com/gitzjoey/tkbaruphp.git
```

Do composer install/update

```
$ composer install

or

$ composer update
```

Do NPM Install
```
$ npm install
```

Do Mix
```
$ npm run dev
```

Rename the .env.example to .env and change setting accordingly.
```
Windows -> $ copy .env.example .env
  
Linux   -> $ cp .env.example .env
```

Generate application key
```
$ php artisan key:generate
```

Do Migration and Seeder
```
$ php artisan migrate 
```

Do Seeder
```
$ php artisan db:seed
```

Linking public/storage
```
$ php artisan storage:link
```

If something seem not right maybe try to dump-autoload and redo the process
```
$ composer dump-autoload
```

Setup for admin user 
```
$ php artisan app:install
```


# Features Suggestion
Fell free to add any feature suggestion by creating new **Issues**, and we can start discussing it

# Contributing
Start contributing by joining the team
