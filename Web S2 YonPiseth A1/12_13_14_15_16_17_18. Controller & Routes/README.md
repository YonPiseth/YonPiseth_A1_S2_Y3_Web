# Laravel Controllers និង Routes

## តើ Controller ជាអ្វីនៅក្នុង Laravel?

នៅក្នុង Laravel, Controller គឺជា class ដែលគ្រប់គ្រងសំណើ HTTP ដែលចូលមក។ វាដើរតួជាអន្តរការីរវាង 
model (ទិន្នន័យ) និង view (បទបង្ហាញ)។ Controller ទទួលខុសត្រូវចំពោះការដំណើរការការបញ្ចូលរបស់អ្នកប្រើប្រាស់ ការធ្វើអន្តរកម្មជាមួយ model ដើម្បីទាញយក 
ឬរក្សាទុកទិន្នន័យ ហើយបន្ទាប់មកបញ្ជូនទិន្នន័យនោះទៅ view ដើម្បីបង្ហាញដល់អ្នកប្រើប្រាស់។

## តើ Route ជាអ្វីនៅក្នុង Laravel?

Route គឺជាចំនុចបញ្ចប់ URL ដែលត្រូវបានផ្គូផ្គងទៅនឹងសកម្មភាព Controller ជាក់លាក់ ឬការបិទ។ 
នៅពេលដែលអ្នកប្រើប្រាស់ចូលមើល Route, Laravel អនុវត្តកូដដែលត្រូវគ្នាកំណត់ក្នុងនិយមន័យ Route ។ 
Routes ត្រូវបានកំណត់នៅក្នុងឯកសារ `routes/web.php` ។

## ឧទាហរណ៍

នៅក្នុងឧទាហរណ៍នេះ យើងបានបង្កើត Controller ដែលមានឈ្មោះថា `ExampleController` និង Route ទៅកាន់វានៅ `/example` ។

### ExampleController

`ExampleController` គឺជា Controller សាមញ្ញដែលមានវិធីសាស្ត្រតែមួយដែលមានឈ្មោះថា `index` ។ 
វិធីសាស្ត្រ `index` ត្រឡប់ខ្សែអក្សរ "Hello, world!" ។

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExampleController extends Controller
{
    public function index()
    {
        return "Hello, world!";
    }
}
```

### Route

Route ទៅកាន់ `ExampleController` ត្រូវបានកំណត់នៅក្នុងឯកសារ `routes/web.php` ។

```php
use App\Http\Controllers\ExampleController;

Route::get('/example', [ExampleController::class, 'index']);
```

Route នេះគូសផែនទី URL `/example` ទៅវិធីសាស្ត្រ `index` នៃ `ExampleController` ។ 
នៅពេលដែលអ្នកប្រើប្រាស់ចូលមើល `/example`, Laravel នឹងប្រតិបត្តិវិធីសាស្ត្រ `index` 
ហើយបង្ហាញខ្សែអក្សរ "Hello, world!" នៅក្នុងកម្មវិធីរុករក។
