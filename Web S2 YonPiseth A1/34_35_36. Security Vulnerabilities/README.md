# Laravel Security Demo (LaraA1)

គម្រោងនេះគឺជាកម្មវិធី Laravel មូលដ្ឋានដែលបង្ហាញពីមុខងារសុវត្ថិភាពដែលបានបង្កើតឡើងប្រឆាំងនឹងភាពងាយរងគ្រោះនៃគេហទំព័រទូទៅ៖ SQL Injection, Cross-Site Scripting (XSS), និង Cross-Site Request Forgery (CSRF)។


## លក្ខណៈពិសេសសុវត្ថិភាពដែលបានបង្ហាញ (Security Features Demonstrated)

Laravel ផ្តល់នូវការការពារដ៏រឹងមាំ និងរួចជាស្រេចប្រឆាំងនឹងភាពងាយរងគ្រោះនៃគេហទំព័រទូទៅជាច្រើន។ គម្រោងនេះគូសបញ្ជាក់ដូចខាងក្រោម៖

### 1. ការការពារ SQL Injection (SQL Injection Prevention)

Eloquent ORM និង Query Builder របស់ Laravel ប្រើប្រាស់ PDO parameter binding ដោយស្វ័យប្រវត្តិ។ យន្តការនេះបំបែកកូដ SQL ចេញពីទិន្នន័យដែលផ្តល់ដោយអ្នកប្រើប្រាស់ ធានាថាការបញ្ចូលទិន្នន័យព្យាបាទមិនអាចផ្លាស់ប្តូរសំណួរ SQL ដែលបានគ្រោងទុកនោះទេ។

**របៀបដែលវាដំណើរការ (How it works)**: នៅពេលអ្នកប្រើ methods ដូចជា `where()`, `find()`, ឬ `insert()` ជាមួយ Eloquent ឬ Query Builder, Laravel នឹង bind តម្លៃដោយស្វ័យប្រវត្តិ ការពារ SQL Injection។

**ឧទាហរណ៍ (Conceptual)**:
```php
// នៅក្នុង controller ឬ model
$user_input = $request->input('username');
$users = DB::table('users')->where('username', $user_input)->get();
// ឬប្រើ Eloquent:
// $user = User::where('username', $user_input)->first();
// ទាំងពីរត្រូវបានការពារពី SQL Injection។
```

### 2. ការការពារ Cross-Site Scripting (XSS) Prevention

Blade templating engine របស់ Laravel គេចវេស (escapes) រាល់ output ទាំងអស់ដែលត្រូវបាន echo ដោយប្រើ syntax `{{ }}` ដោយស្វ័យប្រវត្តិ។ នេះបំប្លែងតួអក្សរពិសេស HTML (ដូចជា `<`, `>`, `&`, `"`, `'`) ទៅជា HTML entities របស់ពួកវា ដែលធ្វើឱ្យពួកវាគ្មានគ្រោះថ្នាក់នៅក្នុង browser ជំនួសឱ្យការប្រតិបត្តិពួកវាជាកូដ។

**របៀបដែលវាដំណើរការ (How it works)**: ទិន្នន័យណាមួយដែលបង្ហាញនៅក្នុង Blade views របស់អ្នកតាមរយៈ `{{ $variable }}` ត្រូវបានគេចវេសដោយស្វ័យប្រវត្តិ។

**ការបង្ហាញនៅក្នុងគម្រោងនេះ (Demonstration in this project)**:
ឯកសារ `welcome.blade.php` មាន form មួយដែលអ្នកអាចបញ្ចូលអត្ថបទបាន។ ប្រសិនបើអ្នកបញ្ចូល script ព្យាបាទ (ឧទាហរណ៍ `<script>alert('XSS Attack!');</script>`) កម្មវិធីនឹងបង្ហាញ script នោះជាអត្ថបទធម្មតានៅលើទំព័រ ជំនួសឱ្យការប្រតិបត្តិវា។

### 3. ការការពារ Cross-Site Request Forgery (CSRF) Prevention

Laravel បង្កើត CSRF "token" ដោយស្វ័យប្រវត្តិសម្រាប់ session អ្នកប្រើប្រាស់សកម្មនីមួយៗ។ token នេះត្រូវបានប្រើដើម្បីផ្ទៀងផ្ទាត់ថាអ្នកប្រើប្រាស់ដែលបានផ្ទៀងផ្ទាត់ពិតជាអ្នកដែលធ្វើការស្នើសុំទៅកាន់កម្មវិធី ការពារពាក្យបញ្ជាដែលគ្មានការអនុញ្ញាតពីការបញ្ជូនពី browser របស់អ្នកប្រើប្រាស់ដែលទុកចិត្ត។

**របៀបដែលវាដំណើរការ (How it works)**:
*   សម្រាប់ HTML forms សូមបញ្ចូល `@csrf` Blade directive នៅក្នុង tags `<form>` របស់អ្នក។ នេះបង្កើត hidden input field មួយដែលមាន token។
*   សម្រាប់ AJAX requests, CSRF token អាចត្រូវបានបញ្ចូលក្នុង request headers។ Middleware `VerifyCsrfToken` របស់ Laravel ផ្ទៀងផ្ទាត់ token នេះដោយស្វ័យប្រវត្តិសម្រាប់រាល់ `POST`, `PUT`, `PATCH`, និង `DELETE` requests។

**ការបង្ហាញនៅក្នុងគម្រោងនេះ (Demonstration in this project)**:
form នៅក្នុង `welcome.blade.php` រួមបញ្ចូល `@csrf` directive។ ប្រសិនបើអ្នកព្យាយាមបញ្ជូន form នេះពីប្រភពខាងក្រៅដោយគ្មាន CSRF token ត្រឹមត្រូវ Laravel នឹងបដិសេធការស្នើសុំ។
