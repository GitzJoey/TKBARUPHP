# Toko Baru - TKBARU PHP Version

A web application focusing on the usage of popular framework, handpicked with consideration.
To meet the everyday programming/coding obstacle and giving the best solution that we can find.

This project initially to create a simple POS (Point of Sales) that catering the basic of POS,
like buy, sell, stock, report. But it still open to extend the capabilities like, linking to
bank, payment, payroll, accounting, etc.

The Goal is to become the most up to date POS system using the most up to date technology and
based with the best practice that every people in the world is using. 

This project is porting from Java version, you can find the Java version [here!](https://bitbucket.org/gitzjoey/tkbaru/)

# Requirements
* PHP >= 5.5.9
* Composer 
* NodeJS/NPM
* Git
* Mysql

# Installation
Clone repository
```
git clone https://github.com/gitzjoey/tkbaruphp.git
```

Do composer install/update

```
composer install

or

composer update
```

Do NPM Install
```
npm install
...

Generate css/js
```
gulp --production
...

Rename the .env.example to .env and change setting accordingly.
 
Generate application key
```
$ php artisan key:generate
```

Do Migration and Seeder
```
$ php artisan migrate 
$ php artisan db:seed
```

# Features Suggestion
Fell free to add any feature suggestion by creating new **Issues**, and we can start discussing it

# Contributing
Start contributing by joining the team