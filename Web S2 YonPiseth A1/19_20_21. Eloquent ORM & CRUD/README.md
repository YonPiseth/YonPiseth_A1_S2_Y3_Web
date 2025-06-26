# ការបង្កើតប្រតិបត្តិការ CRUD នៅក្នុង Laravel MVC ជាមួយ Eloquent ORM

README នេះផ្តល់នូវការណែនាំជាជំហាន ៗ អំពីរបៀបបង្កើតប្រតិបត្តិការ CRUD (Create, Read, Update, Delete) នៅក្នុងកម្មវិធី 
Laravel MVC (Model-View-Controller) ដោយប្រើ Eloquent ORM (Object-Relational Mapping)។

## ជំហានទី 1: Create a Model

ប្រើពាក្យបញ្ជា `artisan make:model` ដើម្បីបង្កើត Model ថ្មី។ ឧទាហរណ៍ដើម្បីបង្កើត `Product` Model សូមដំណើរការ:

```
cd LaraA1
php artisan make:model Product
```

This will create a file `LaraA1/app/Models/Product.php`.

## ជំហានទី 2: Create a Migration

បង្កើត Migration សម្រាប់តារាងទិន្នន័យដែលត្រូវគ្នាដោយប្រើពាក្យបញ្ជា `artisan make:migration` ។ ឧទាហរណ៍ដើម្បីបង្កើត 
Migration សម្រាប់តារាង `products` សូមដំណើរការ:

```
cd LaraA1
php artisan make:migration create_products_table
```

This will create a file in the `LaraA1/database/migrations` directory. បើកឯកសារ Migration ហើយកំណត់ Schema តារាងនៅក្នុង 
`up` method ។

## ជំហានទី 3: Configure the Database

កំណត់រចនាសម្ព័ន្ធការតភ្ជាប់ Database របស់អ្នកនៅក្នុងឯកសារ `LaraA1/.env` ។ កែប្រែ `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, 
`DB_DATABASE`, `DB_USERNAME`, និង `DB_PASSWORD` variables ឱ្យត្រូវនឹងការកំណត់ Database របស់អ្នក។

```
cd LaraA1
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

## ជំហានទី 4: Run the Migrations

ដំណើរការ Migrations ដើម្បីបង្កើតតារាង Database ដោយប្រើពាក្យបញ្ជា `artisan migrate`:

```
cd LaraA1
php artisan migrate
```

If you encounter a "key length too long" error, you may need to set the default string length in the `LaraA1/app/Providers/
AppServiceProvider.php` file.

## ជំហានទី 5: Create a Controller

បង្កើត Controller ដើម្បីដោះស្រាយប្រតិបត្តិការ CRUD ដោយប្រើពាក្យបញ្ជា `artisan make:controller`:

```
cd LaraA1
php artisan make:controller ProductController
```

This will create a file `LaraA1/app/Http/Controllers/ProductController.php`.

## ជំហានទី 6: Implement CRUD Methods in the Controller

បើកឯកសារ Controller ហើយអនុវត្ត CRUD methods: `index`, `store`, `show`, `update`, និង `destroy` ។

## ជំហានទី 7: Define Routes

កំណត់ Routes សម្រាប់ប្រតិបត្តិការ CRUD នៅក្នុងឯកសារ `LaraA1/routes/web.php` ។ ប្រើ `Route::resource` method ដើម្បីកំណត់ 
Routes ដែលចាំបាច់ទាំងអស់សម្រាប់ Controller:

## Eloquent ORM

Eloquent ORM គឺជា Object-Relational Mapper ដែលអនុញ្ញាតឱ្យអ្នកធ្វើអន្តរកម្មជាមួយតារាង Database របស់អ្នកដូចជា Objects ។ 
តារាង Database នីមួយៗមាន "Model" ដែលត្រូវគ្នាដែលត្រូវបានប្រើដើម្បីធ្វើអន្តរកម្មជាមួយតារាងនោះ។

នៅក្នុងឧទាហរណ៍នេះ `Product` Model ត្រូវបានប្រើដើម្បីធ្វើអន្តរកម្មជាមួយតារាង `products` ។ អ្នកអាចប្រើ Model ដើម្បីបង្កើត
 អាន កែប្រែ និងលុប Records នៅក្នុងតារាង។
