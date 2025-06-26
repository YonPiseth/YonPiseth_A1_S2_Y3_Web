# Blade នៅក្នុង Laravel (Lastest Release)

Blade គឺជាប្រព័ន្ធ Template ដ៏សាមញ្ញ ប៉ុន្តែមានថាមពលរបស់ Laravel. មិនដូចប្រព័ន្ធ Template PHP ដ៏ពេញនិយមផ្សេងទៀតទេ Blade 
មិនរឹតបន្តឹងអ្នកពីការប្រើប្រាស់កូដ PHP ធម្មតានៅក្នុង Views របស់អ្នកទេ។ Blade Views ទាំងអស់ត្រូវបានចងក្រងទៅជាកូដ PHP ធម្មតា 
ហើយត្រូវបាន Cache រហូតដល់ពួកវាត្រូវបានកែប្រែ ដែលមានន័យថា Blade បន្ថែម Overhead សូន្យដល់ Application របស់អ្នក។ Blade 
ផ្តល់នូវផ្លូវកាត់ងាយស្រួលសម្រាប់ Control Structures PHP ទូទៅ ដូចជា If Statements និង Loops ជាដើម។

## ការណែនាំជាជំហាន ៗ ៖ ការបង្កើត Layout Views ដោយប្រើ Blade

ការណែនាំនេះនឹងនាំអ្នកឆ្លងកាត់ការបង្កើត Layout View ដោយប្រើ Blade នៅក្នុង Laravel ។

**1. បង្កើត Layout File:**

   - បង្កើត Directory មួយដែលមានឈ្មោះថា `layouts` នៅក្នុង Directory `resources/views` ប្រសិនបើវាមិនទាន់មាន ៖
     ```
     mkdir resources/views/layouts
     ```
   - បង្កើត File មួយដែលមានឈ្មោះថា `app.blade.php` នៅក្នុង Directory `resources/views/layouts` ។ File នេះនឹងបម្រើជា Layout 
   មេរបស់អ្នក។

   ```blade
   <!DOCTYPE html>
   <html lang="en">
   <head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <title>@yield('title', 'Laravel App')</title>
       <link rel="stylesheet" href="{{ asset('css/app.css') }}">
   </head>
   <body>
       <div class="container">
           @yield('content')
       </div>
       <script src="{{ asset('js/app.js') }}"></script>
   </body>
   </html>
   ```

**2. កំណត់ Sections:**

   - ប្រើ Directive `@yield` ដើម្បីកំណត់ Sections នៅក្នុង Layout File របស់អ្នក។ Sections ទាំងនេះនឹងត្រូវបានបំពេញដោយ 
   Content ពី Individual Views របស់អ្នក។
   - នៅក្នុង Example ខាងលើ `@yield('title', 'Laravel App')` កំណត់ Section សម្រាប់ Page Title ហើយ `@yield('content')` កំណត់
    Section សម្រាប់ Main Content ។

**3. បង្កើត Views:**

   - បង្កើត Individual View Files (ឧទាហរណ៍ `home.blade.php`, `about.blade.php`) នៅក្នុង Directory `resources/views` ។

   ```blade
   @extends('layouts.app')

   @section('title', 'Home Page')

   @section('content')
       <h1>Welcome to the Home Page!</h1>
       <p>This is the content of the home page.</p>
   @endsection
   ```

**4. ប្រើ Layout:**

   - ប្រើ Directive `@extends` ដើម្បីបញ្ជាក់ Layout មួយណាដែល View គួរតែ Extend ។ នៅក្នុង Example ខាងលើ `@extends('layouts.
   app')` បង្ហាញថា View ប្រើ Layout `app.blade.php` ។

**5. បំពេញ Sections:**

   - ប្រើ Directive `@section` ដើម្បីបំពេញ Sections ដែលបានកំណត់នៅក្នុង Layout ជាមួយ Content ពី View របស់អ្នក។
   - Directive `@section('title', 'Home Page')` កំណត់ Page Title ទៅ "Home Page" ហើយ Directive `@section('content')` ផ្តល់ 
   Main Content សម្រាប់ Page ។

**6. ដាក់បញ្ចូល Assets:**

   - ប្រើ Function `asset()` ដើម្បីដាក់បញ្ចូល CSS និង JavaScript Assets នៅក្នុង Layout របស់អ្នក។
   - `<link rel="stylesheet" href="{{ asset('css/app.css') }}">` ដាក់បញ្ចូល File `app.css` ពី Directory `public/css` ។
   - `<script src="{{ asset('js/app.js') }}"></script>` ដាក់បញ្ចូល File `app.js` ពី Directory `public/js` ។

**7. បង្កើត Routes:**

   - កំណត់ Routes នៅក្នុង File `routes/web.php` របស់អ្នកដើម្បីបង្ហាញ Views របស់អ្នកនៅក្នុង Browser ។

   ```php
   Route::get('/', function () {
       return view('home');
   });
   ```


ការណែនាំនេះផ្តល់នូវទិដ្ឋភាពទូទៅជាមូលដ្ឋាននៃការបង្កើត Layout Views ដោយប្រើ Blade នៅក្នុង Laravel ។ 
អ្នកអាចពង្រីកបន្ថែមលើបញ្ហានេះដោយបន្ថែម Sections ទៅ Layout បន្ថែមទៀត បង្កើត Views បន្ថែមទៀត និងបន្ថែម Styling និង 
Functionality ទៅ CSS និង JS Files បន្ថែមទៀត។
