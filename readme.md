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
* Composer 
* NodeJS/NPM
* Git

# Installation
Coming Soon 

# Features Suggestion
Fell free to add any feature suggestion by creating new **Issues**, and we can start discussing it

# Contributing
Start contributing by joining the team

# Belajar CRUD dengan Laravel 5

# Daftar isi
* [Persiapan](#yang-perlu-dipersiapkan)
* [Installasi](#installasi)
* [Konfigurasi](#konfigurasi)
* [Migration](#migration)
* [Seeder](#seeder)
* [Model](#model)
* [Interface](#interface)
* [Repository](#repository)
* [Service Provider](#service-provider)
* [Form Request](#form-request)
* [Controller](#controller)
* [Dependency/Method Injection](#dependency-method-injection)
* [Routing](#routing)
* [Testing dengan Postman](#testing-dengan-rest-client-postman)
* [Kontributor](#kontributor)

# Yang perlu dipersiapkan
- PHP, disarankan :
    - PHP >= 5.5.9
    - OpenSSL PHP Extension
    - PDO PHP Extension
    - Mbstring PHP Extension
    - Tokenizer PHP Extension
- Serve Bundle
    - [Homestead](http://laravel.com/docs/5.1/homestead)
    - [Xampp](https://www.apachefriends.org/index.html)
    - [Wamp](http://www.wampserver.com/en/)
    - [Winginx](http://winginx.com/en/) (rewrite PHP 5.4 to 5.5 or ^)
- [Composer](https://getcomposer.org/)
- Database server 
    - Mysql
    - Postgre
    - MongoDB
- [Postman](https://chrome.google.com/webstore/detail/postman/fhbjgbiflinjbdggehcddcbncdddomop), chrome extention
- [Git](https://git-scm.com/)

# Instalasi
### Melalui composer create-project
Ketikkan pada terminal/command prompt

```
composer create-project laravel/laravel FolderApp --prefer-dist
```

Clone repository ini

```
git clone https://github.com/cyberid41/belajar-crud-laravel-5.git
```

Jangan lupa untuk melakukan composer update

```
composer update
```

# Konfigurasi
### Directory Permissions
```
storage/
bootstrap/cache/
```

### Application Key
Generate application key, ketikkan perintah berikut

```
$ php artisan key:generate
```

### Application Namespace
Application namespace ini berfungsi sebagai namesapce application, hmm ribet kedengarannya yahh???

Langsung saja coba sendiri ketikkan perintah pada terminal

```
$ php artisan app:name MyApps  
```

Al hasil semua namespace yang secara default adalah ```App``` akan berubah menjadi ```MyApps```.

### Beberapa configurasi yang perlu dilakukan
Buat database baru, dan isi konfiguarsi di file ```.env```

```
// file .env

APP_ENV=local
APP_DEBUG=true
APP_KEY=Xm67S04I78Y3az5NDx8jM9jotsasE6D2

DB_HOST=localhost
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret

CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_DRIVER=sync

MAIL_DRIVER=smtp
MAIL_HOST=mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
```

# Migration

Buat 1 file migration, 1 migration mewakili 1 table
 
```
$ php artisan make:migration create_user_table
```

### Jalankan migration table agar dieksekusi menjadi table didatabase

```
$ php artisan migrate 
```

# Seeder
 
```
$ php artisan make:seeder UserTableSeeder
```

Jangan lupa daftarin class seedernya di ```database\seeds\DatabaseSeeder.php```

Kalau sudah selesai run seeder

```
$ php artisan db:seeder
```

### Menggunakan ModelFactory untuk mengisi dummy data

Buka file ```database/factories/ModelFactory.php``` definisikan class yang akan diisi dummy data menggunakan FakerGenerator, generator ini menyediakan dummy data berkualitas berikut beberapa data yang bisa kita generate menggunakan FakerGenerator

```
 string $name
 string $firstName
 string $firstNameMale
 string $firstNameFemale
 string $lastName
 string $title
 string $titleMale
 string $titleFemale
 string $citySuffix
 string $streetSuffix
 string $buildingNumber
 string $city
 string $streetName
 string $streetAddress
 string $postcode
 string $address
 string $country
 float  $latitude
 float  $longitude
 string $ean13
 string $ean8
 string $isbn13
 string $isbn10
 string $phoneNumber
 string $company
 string $companySuffix
 string $creditCardType
 string $creditCardNumber
 string creditCardNumber($type = null, $formatted = false, $separator = '-')
 \DateTime $creditCardExpirationDate
 string $creditCardExpirationDateString
 string $creditCardDetails
 string $bankAccountNumber
 string $swiftBicNumber
 string $vat
 string $word
 string|array $words
 string|array words($nb = 3, $asText = false)
 string $sentence
 string sentence($nbWords = 6, $variableNbWords = true)
 string|array $sentences
 string|array sentences($nb = 3, $asText = false)
 string $paragraph
 string paragraph($nbSentences = 3, $variableNbSentences = true)
 string|array $paragraphs
 string|array paragraphs($nb = 3, $asText = false)
 string $text
 string text($maxNbChars = 200)
 realText($maxNbChars = 200, $indexSize = 2)
```

# Model
Model boleh ditaruh dimana saja secara default model ditaruh dibawah foldr ```app/``` namun dalam contoh modelkita taruh pada folder ```Entities```

# Repository
Repositories ini adalah sebuah folder yang berfungsi untuk menampung semua logika Query baik itu database atau cache, 
kita membuat folder ini sendiri dengan nama ```Repositories```. Saya sudah sediakan satu file yang bernama ```AbstractRepository.php```
Untuk menangani Query yang bersifat global agar code ini bisa dipakai pada ```Repository``` lainnya.
 
# Interface
Interface ini adalah penghubung antara ```Controller``` ke ```Repository``` yang akan diinject di Controller pada method 
```__construct``` atau langsung pada method di Controller. Saya juga telah sediakan 4 ```interface``` yang biasa saya gunakan, 
Karena kita mengikuti style laravel folder ```Interface``` diganti dengan ```Contracts```    
yaitu :

```
Crudable.php
Repository.php
Paginable.php
Searchable.php
```
Yang nanti interface tersebut yang akan diinject ke ```Controller```.

# Service Provider/Service Container
Folder ini secara default disediakan oleh framework, fungsinya sebagai container. Ituloh dia yang daftarin ```interface``` dan repository agar 
bisa diinject secara realtime di Controlller. Jadi ketika kita membuat interface atau repository agar bisa dipakai harus 
didaftarkan dahulu di file ```app/Providers/AppServiceProvider.php```

Pada project ini saya menggunakan ```Contextual Binding```, berikut cara mendaftarkannya:

```php
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // mendaftarkan user crudable
        $this->app->when('App\Http\Controllers\Admin\UserController')
             ->needs('App\Contracts\Crudable')
             ->give('App\Domain\Repositories\Admin\UserRepository');
    }
```

Dengan demikian pada ```UserController``` nanti bisa diinject ```Crudable``` dan mengarah pada ```UserRepository```

# Form Request
Form Request ini biasanya difungsikan untuk menangkap request dari url atau parameter yang dikirim melalui http method 
(POST,GET,PUT,Patch,Delete). Dan juga biasa difungsikan sebagai Form Validation Request, nanti penggunannya langsung inject
 method di ```Controller```.

Cara membuat form request dengan perintah :

```
$ php artisan make:request User\\UserCreateFormRequest
```

Hasil generate di dalam folder ```app/Http/Requests/User```, tanda '\\' akan otomatis membuat folder baru, ini berlaku 
untuk semua perintah ```make``` di ```artisan command```. 

# Controller
Controller bisanya untuk membuat aplikasi CRUD menggunakan resource controller, berikut perintahnya :

```
$ php artisan make:controller User\\UserController
```

Secara otomatis akan generate beberapa method yang umum digunakan seperti, kemudian difile ```routes.php``` kita tambahkan 
 code sebagai berikut :

```php
Route::resource('user', 'User\UserController');
```

Jika kita ketikkan perintah

```
$ php artisan route:list
```

Maka akan tampil route yang didaftarkan lengkap dengan named route, method yang dibolehkan dan controllernya:

Domain    |Method    | Uri              | Action                                              | Route Name
----------|----------|------------------|-----------------------------------------------------|-------------
          |GET       | /                | App\Http\Controllers\User\UserController@index      | user.index
          |GET       | user/create      | App\Http\Controllers\User\UserController@create     | user.create
          |POST      | user             | App\Http\Controllers\User\UserController@store      | user.store
          |GET       | user/{user}      | App\Http\Controllers\User\UserController@show       | user.show
          |GET       | user/{user}/edit | App\Http\Controllers\User\UserController@edit       | user.edit
          |PUT/PATCH | user/{user}      | App\Http\Controllers\User\UserController@update     | user.update
          |DELETE    | user/{user}      | App\Http\Controllers\User\UserController@destroy    | user.destroy

# Dependency/Method Injection
Setelah didaftarkan aplikasi di Service Provider, Repository bisa diinject di controller melalui method ```__construct```

```php
    /**
     * @var UserRepository
     */
    protected $user;

    /**
     * @param UserRepository $user
     */
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }
```

Dan juga method injection contohnya, inject ```UserCreateFormRequest``` ke controller

```php
    /**
     * Store a newly created resource in storage.
     *
     * @param UserCreateRequest $request
     *
     * @return mixed
     */
    public function store(UserCreateRequest $request)
    {
        return $this->user->create($request->all());
    }
```

# Routing
Routing ini perannya penting sekali, setiap url yang akan diakses harus didaftarkan dahulu di ```routes.php```, beberapa 
perintah/ artisan command yang berhubungan dengan route :

```
// melihat daftar routes yang telah didaftarkan
$ php artisan route:list

// create route cache file, agar lebih cepat diakses
$ php artisan route:cache

// clear route cache file
$ php artisan route:clear
```

Berikut saya daftarkan route untuk aplikasi ini:

```php
Route::group(['namespace' => 'User', 'prefix' => 'api/v1'], function () {

    Route::resource('user', 'UserController');
    
});
```

Penjelasannya, route tersebut saya group untuk memudahkan dalam pengaturan/managemen route yang semisal atau 1 folder/namesapce
```
namesapce = folder/namespace
prefix = prefix route untuk mengelompokkan dalam hal pengaksesan api/v1, api/v2
```
# Testing dengan Rest client (Postman)
Jika akan test endpoint url harus menyertakan header, hal ini juga berlaku ketika kita request Http Method (POST,PUT,PATCH,GET,DELETE)
menggunakan Ajax, berikut headernya :

```
X-Requested-With : XMLHttpRequest
```

Jangan lupa untuk menyertakan inputan ```_token``` dibody setiap POST, PUT dan DELETE, jika menggunakan postman untuk mendapatkan 
```csrf_token``` dengan mendaftarkan pada route:

```php
// get token
Route::get('give-me-token', function () {
    return csrf_token();
});
```

**NB :** token ini hanya untuk sementara, sebisa mungkin gunakan url yang sulit untuk ditebak.

# kontributor
Edi Santoso

[email]([mailto:edicyber@gmail.com)

[@cyberid41](https://github.com/cyberid41)

[facebook](https://facebook.com/cyberid41)

[linkedin](https://id.linkedin.com/in/cyberid41)

# kontributor
sandi permana soebagio

$ composer install

$ gulp --prod

$ php artisan key:generate

$ php artisan migrate

$ php artisan db:seed

$ php artisan serve



membuat truck
$ php artisan make:migration create_truck_table

mengeksekusi file migrate untuk membuat table yg baru saja di buat
$ php artisan migrate






