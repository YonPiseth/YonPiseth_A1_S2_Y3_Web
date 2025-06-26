# Laravel Gemini Chatbot

នេះគឺជាកម្មវិធី chatbot សាមញ្ញមួយដែលត្រូវបានបង្កើតឡើងដោយប្រើ Laravel ដែលរួមបញ្ចូលជាមួយ Google Gemini API។

## លក្ខណៈពិសេស (Features)

*   ចំណុចប្រទាក់ជជែក (Chat interface) ដើម្បីធ្វើអន្តរកម្មជាមួយម៉ូដែល AI របស់ Gemini។
*   Backend ដំណើរការដោយ Laravel សម្រាប់គ្រប់គ្រងសំណើ API (API requests)។
*   ប្រើ Guzzle HTTP client សម្រាប់ការទំនាក់ទំនងដោយផ្ទាល់ជាមួយ Gemini API។

## តម្រូវការជាមុន (Prerequisites)

មុនពេលអ្នកចាប់ផ្តើម សូមប្រាកដថាអ្នកបានដំឡើងដូចខាងក្រោម៖

*   PHP (>= 8.2)
*   Composer
*   Laravel (បានដំឡើងរួចហើយនៅក្នុង Project នេះ)
*   Google Cloud Project ដែលបានបើក Generative Language API។
*   Gemini API Key។

## ការដំឡើង (Installation)

1.  **ចូលទៅកាន់ថត Project:**
    ```bash
    cd LaraA1
    ```

2.  **ដំឡើង Dependencies របស់ Composer:**
    ```bash
    composer install
    ```
    នេះនឹងដំឡើងកញ្ចប់ PHP (PHP packages) ចាំបាច់ទាំងអស់ រួមទាំង `guzzlehttp/guzzle` និង `google/cloud`។

3.  **រៀបចំ Environment Variables:**
    *   ចម្លងឯកសារ Environment គំរូ៖
        ```bash
        cp .env.example .env
        ```
    *   បើកឯកសារ `.env` ដែលទើបបង្កើតថ្មី ហើយ Update ដូចខាងក្រោម៖
        *   `APP_KEY`: នេះគួរតែត្រូវបានបង្កើតដោយស្វ័យប្រវត្តិដោយ Laravel។ ប្រសិនបើមិនទាន់ទេ សូមដំណើរការ `php artisan key:generate`។
        *   `GEMINI_API_KEY`: ជំនួស `YOUR_GEMINI_API_KEY` ជាមួយ Gemini API Key ពិតប្រាកដរបស់អ្នក។
        *   `GOOGLE_CLOUD_PROJECT_ID`: ជំនួស `YOUR_GOOGLE_CLOUD_PROJECT_ID` ជាមួយ Google Cloud Project ID របស់អ្នក។ (ចំណាំ៖ សម្រាប់ការចូលប្រើ API Key ដោយផ្ទាល់ទៅ Generative Language API, `GOOGLE_CLOUD_PROJECT_ID` មិនត្រូវបានប្រើប្រាស់យ៉ាងតឹងរ៉ឹងនៅក្នុង API URL ទេ ប៉ុន្តែវាជាការអនុវត្តល្អក្នុងការរក្សាវាឱ្យបានត្រឹមត្រូវ ប្រសិនបើអ្នកមានគម្រោងប្រើប្រាស់សេវាកម្ម Google Cloud ផ្សេងទៀត។)

4.  **បង្កើត Application Key (ប្រសិនបើមិនទាន់បានបង្កើត):**
    ```bash
    php artisan key:generate
    ```

5.  **ដំណើរការ Database Migrations (ស្រេចចិត្ត ប៉ុន្តែត្រូវបានណែនាំសម្រាប់ការគ្រប់គ្រង Session):**
    ```bash
    php artisan migrate
    ```

## ការកំណត់រចនាសម្ព័ន្ធ (Configuration)

### Gemini API Key

Gemini API Key របស់អ្នកគួរតែត្រូវបានកំណត់នៅក្នុងឯកសារ `.env`៖

```
GEMINI_API_KEY=YOUR_ACTUAL_GEMINI_API_KEY
```

### Google Cloud Project ID

Google Cloud Project ID របស់អ្នកក៏គួរតែត្រូវបានកំណត់នៅក្នុងឯកសារ `.env` ផងដែរ៖

```
GOOGLE_CLOUD_PROJECT_ID=YOUR_ACTUAL_GOOGLE_CLOUD_PROJECT_ID
```

## ការដំណើរការកម្មវិធី (Running the Application)

1.  **ត្រូវប្រាកដថា Server ទាំងអស់របស់ Laravel ត្រូវបានបញ្ឈប់។** ប្រសិនបើអ្នកមាន Server ណាមួយកំពុងដំណើរការ សូមចូលទៅកាន់ Terminal រៀងៗខ្លួន ហើយចុច `Ctrl+C`។

2.  **សម្អាត Laravel Cache:**
    ```bash
    php artisan optimize:clear
    ```

3.  **ចាប់ផ្តើម Laravel Development Server:**
    ```bash
    php artisan serve
    ```
    នេះនឹងចាប់ផ្តើម Server ជាធម្មតានៅលើ `http://localhost:8000`។

4.  **ចូលប្រើ Chatbot:**
    បើក Web Browser របស់អ្នកហើយចូលទៅកាន់៖
    ```
    http://localhost:8000/chatbot
    ```

## ការប្រើប្រាស់ (Usage)

*   វាយសាររបស់អ្នកទៅក្នុងប្រអប់បញ្ចូល (input field) នៅផ្នែកខាងក្រោមនៃចំណុចប្រទាក់ជជែក។
*   ចុច `Enter` ឬចុចប៊ូតុង "Send" ដើម្បីផ្ញើសាររបស់អ្នកទៅ Gemini AI។
*   ការឆ្លើយតបរបស់ Chatbot នឹងបង្ហាញនៅក្នុងប្រវត្តិជជែក។

## ការដោះស្រាយបញ្ហា (Troubleshooting)

*   **"Error communicating with the server."**: ពិនិត្យមើល Console របស់ Developer ក្នុង Browser របស់អ្នកសម្រាប់ Network errors និងឯកសារ Laravel log (`storage/logs/laravel.log`) សម្រាប់ Backend errors។
*   **`cURL error 60: SSL certificate problem`**: នេះជាញឹកញាប់ជាបញ្ហានៅក្នុង Development environment។ `ChatbotController.php` បច្ចុប្បន្នបានបិទការផ្ទៀងផ្ទាត់ SSL (SSL verification) សម្រាប់ Guzzle requests ជាដំណោះស្រាយបណ្តោះអាសន្ន។ សម្រាប់ការប្រើប្រាស់ក្នុង Production, ការរៀបចំ SSL certificate ត្រឹមត្រូវត្រូវបានណែនាំ។
*   **`404 Not Found` ពី Gemini API**:
    *   ត្រូវប្រាកដថា `GEMINI_API_KEY` របស់អ្នកត្រឹមត្រូវ ហើយមានសិទ្ធិចូលប្រើ Gemini API។
    *   ផ្ទៀងផ្ទាត់ថាឈ្មោះ Model (`gemini-1.5-flash`) ត្រឹមត្រូវ និងត្រូវបានគាំទ្រដោយ Generative Language API។ Google តែងតែ Update Models និង API versions របស់ខ្លួន។ សូមយោងទៅឯកសារផ្លូវការរបស់ Google Gemini API សម្រាប់ឈ្មោះ Models និង API endpoints ចុងក្រោយបំផុត។
