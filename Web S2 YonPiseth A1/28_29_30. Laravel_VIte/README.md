# ការធ្វើចំណាកស្រុកពី Laravel Mix ទៅ Laravel Vite

ឯកសារនេះផ្តល់នូវការណែនាំអំពីការធ្វើចំណាកស្រុកគម្រោង Laravel របស់អ្នកពី Laravel Mix ទៅ Laravel Vite។

## សេចក្តីផ្តើមអំពី Laravel Vite

Laravel Vite គឺជា `next-generation frontend tooling` ដែលផ្តល់នូវបទពិសោធន៍នៃការអភិវឌ្ឍន៍លឿន និងមានប្រសិទ្ធភាពជាងមុន 
បើប្រៀបធៀបទៅនឹង Laravel Mix។ វាប្រើប្រាស់ `Vite` ដែលជា `build tool` ដែលផ្តល់នូវ `lightning-fast hot module replacement 
(HMR)` និង `optimized production builds` ។

**អត្ថប្រយោជន៍សំខាន់ៗរបស់ Laravel Vite:**

*   **Faster Build Times:** `On-demand compilation` របស់ Vite និង `HMR` កាត់បន្ថយ `build times` យ៉ាងខ្លាំង 
ជាពិសេសសម្រាប់គម្រោងធំៗ។
*   **Improved Development Experience:** `HMR` របស់ Vite អនុញ្ញាតឱ្យអ្នកឃើញការផ្លាស់ប្តូរនៅក្នុង `browser` 
របស់អ្នកស្ទើរតែភ្លាមៗ ដោយមិនចាំបាច់ `full page reloads` ។
*   **Modern JavaScript Features:** Vite គាំទ្រ `modern JavaScript features` ដូចជា `ES modules`, `TypeScript`, និង `JSX` 
ចេញពីប្រអប់។
*   **Simplified Configuration:** Laravel Vite ធ្វើឱ្យ `configuration process` កាន់តែសាមញ្ញ ផ្តល់នូវបទពិសោធន៍កាន់តែប្រសើរ។

## ជំហានធ្វើចំណាកស្រុក

1.  **Install Laravel Vite:**

    ```bash
    composer require laravel/vite
    ```

2.  **Update `vite.config.js`:**

    បង្កើតឯកសារ `vite.config.js` នៅក្នុង `project root` របស់អ្នក។ ការកំណត់រចនាសម្ព័ន្ធមូលដ្ឋានអាចមើលទៅដូចនេះ:

    ```javascript
    import { defineConfig } from 'vite';
    import laravel from 'laravel-vite-plugin';

    export default defineConfig({
        plugins: [
            laravel({
                input: ['resources/css/app.css', 'resources/js/app.js'],
                refresh: true,
            }),
        ],
    });
    ```

    *   **input:** កំណត់ `entry points` សម្រាប់ឯកសារ `CSS` និង `JavaScript` របស់អ្នក។ កែតម្រូវ `paths` 
    ទាំងនេះដើម្បីឱ្យត្រូវនឹង `project structure` របស់អ្នក។
    *   **refresh:** បើកដំណើរការ `automatic browser refresh` នៅពេលដែលការផ្លាស់ប្តូរត្រូវបានធ្វើឡើងចំពោះ `Blade templates`
    
     របស់អ្នក។

3.  **Update `app.blade.php` (ឬឯកសារប្លង់មេរបស់អ្នក):**

    ជំនួស `Laravel Mix asset links` ជាមួយ `Vite directives` :

    ```html
    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100
         dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
            @yield('content')
        </div>
    </body>
    </html>
    ```

    *   `@vite(['resources/css/app.css', 'resources/js/app.js'])`: `directive` នេះចាក់ `tags` `<link>` និង `<script>`
     ដែលចាំបាច់សម្រាប់ឯកសារ `CSS` និង `JavaScript` របស់អ្នក។

4.  **Remove Laravel Mix:**

    ```bash
    npm uninstall laravel-mix
    npm uninstall webpack
    npm uninstall webpack-cli
    ```

5.  **Update your scripts in `package.json`:**

    ```json
    "scripts": {
        "dev": "vite",
        "build": "vite build"
    },
    ```

6.  **Run Vite:**

    ```bash
    npm run dev
    ```

    This will start the Vite development server. You should now be able to see your changes in the browser with HMR.

7.  **Build for Production:**

    ```bash
    npm run build
    ```

    This will create optimized production assets in the `public/build` directory.

## Configuration

ឯកសារ `vite.config.js` អនុញ្ញាតឱ្យអ្នកកែតម្រូវឥរិយាបថរបស់ `Vite` ។ សូមមើល `Vite documentation` សម្រាប់បញ្ជីជម្រើសពេញលេញ:
 [https://vitejs.dev/config/](https://vitejs.dev/config/)

## Troubleshooting

*   **"Target container is not a DOM element."** កំហុសនេះជាធម្មតាកើតឡើងនៅពេលដែល `Vite` កំពុងព្យាយាមចាក់ `assets` ទៅក្នុង 
`DOM element` ដែលមិនមាន។ ត្រូវប្រាកដថាឯកសារ `app.blade.php` របស់អ្នកមានផ្នែក `<head>` និង `<body>` ត្រឹមត្រូវ។
*   **CSS or JavaScript changes are not reflected in the browser.** សាកល្បងសម្អាត `browser cache` របស់អ្នក ហើយចាប់ផ្តើម 
`Vite development server` ឡើងវិញ។

## សេចក្តីសន្និដ្ឋាន

ការធ្វើចំណាកស្រុកទៅ `Laravel Vite` អាចធ្វើឱ្យប្រសើរឡើងនូវ `development workflow` របស់អ្នកយ៉ាងខ្លាំង។ 
តាមរយៈការធ្វើតាមជំហានទាំងនេះ អ្នកអាចផ្លាស់ប្តូរគម្រោងរបស់អ្នកได้อย่างរលូន និងទាញយកអត្ថប្រយោជន៍ពី `performance benefits` 
របស់ `Vite` ។
