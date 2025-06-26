# Laravel Middleware

`Middleware` គឺជាស្រទាប់មួយដែលស្ថិតនៅចន្លោះ request និង response នៅក្នុង application របស់អ្នក។ 
វាអនុញ្ញាតឱ្យអ្នកត្រួតពិនិត្យ និងកែប្រែ request មុនពេលវាទៅដល់ `controller` របស់អ្នក និងកែប្រែ response 
មុនពេលវាត្រូវបានផ្ញើត្រឡប់ទៅអ្នកប្រើប្រាស់វិញ។ 

ឯកសារ README នេះផ្តល់នូវឧទាហរណ៍នៃ `middleware` ដែលមានស្រាប់ និង `middleware` ដែលបង្កើតដោយខ្លួនឯងនៅក្នុង Laravel ។ 

## ឧទាហរណ៍ `Middleware` ដែលមានស្រាប់ (Built-in Middleware Example)

Laravel រួមបញ្ចូល `middleware` ដែលមានស្រាប់ជាច្រើនសម្រាប់កិច្ចការទូទៅ ដូចជាការផ្ទៀងផ្ទាត់ភាពត្រឹមត្រូវ ការការពារ CSRF 
និងច្រើនទៀត។ ឧទាហរណ៍សាមញ្ញនៃសមាសភាគដែលមានស្រាប់គឺ class `Controller` មូលដ្ឋាន: 

```php
<?php

namespace App\Http\Controllers;

abstract class Controller
{
    //
}
```

ឯកសារ `Controller.php` នេះគឺជាសមាសភាគដែលមានស្រាប់នៅក្នុង Laravel ។ វាបម្រើជា class មូលដ្ឋានសម្រាប់ `controller` 
ទាំងអស់នៅក្នុង application របស់អ្នក។ 

## ឧទាហរណ៍ `Middleware` ដែលបង្កើតដោយខ្លួនឯង (Custom Middleware Example)

អ្នកអាចបង្កើត `middleware` ផ្ទាល់ខ្លួនរបស់អ្នកដើម្បីដោះស្រាយកិច្ចការជាក់លាក់នៅក្នុង application របស់អ្នក។ នេះគឺជាឧទាហរណ៍នៃ 
`middleware` ផ្ទាល់ខ្លួនដែលកត់ត្រា `messages` មុន និងក្រោយពេល request ត្រូវបានដោះស្រាយ: 

```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SampleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Perform action before the request is handled
        error_log('SampleMiddleware: Before request');

        $response = $next($request);

        // Perform action after the request is handled
        error_log('SampleMiddleware: After request');

        return $response;
    }
}
```

ដើម្បីប្រើ `middleware` នេះ: (To use this middleware:)

1.  ចុះឈ្មោះវានៅក្នុង `app/Http/Kernel.php` នៅក្នុង array `$middleware` (សម្រាប់ global middleware) ឬ array 
`$routeMiddleware` (សម្រាប់ named middleware) ។ 

2.  អនុវត្តវាទៅ routes ជាក់លាក់ ឬ route groups ដោយប្រើ method `middleware` ។ 


ឧទាហរណ៍នៃការចុះឈ្មោះនៅក្នុង `Kernel.php`: (Example of registering in `Kernel.php`:)

```php
protected $middleware = [
    // ...
    \App\Http\Middleware\SampleMiddleware::class,
];
```

ឧទាហរណ៍នៃការអនុវត្តទៅ route មួយ: (Example of applying to a route:)

```php
Route::get('/example', function () {
    // ...
})->middleware(\App\Http\Middleware\SampleMiddleware::class);
