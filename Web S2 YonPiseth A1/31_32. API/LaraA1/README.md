# ឧទាហរណ៍ API Laravel: សៀវភៅ

នេះគឺជាឧទាហរណ៍សាមញ្ញនៃ API ដែលបានបង្កើតនៅក្នុង Laravel សម្រាប់ការគ្រប់គ្រងសៀវភៅ។

## របៀបដែលវាត្រូវបានបង្កើត

1.  **Model:** `Book` model ត្រូវបានបង្កើតដោយប្រើ command `php artisan make:model Book`។
2.  **Migration:** ឯកសារ migration ត្រូវបានបង្កើតដោយប្រើ command `php artisan make:migration create_books_table`។ ឯកសារ migration បន្ទាប់មកត្រូវបានកែប្រែដើម្បីរួមបញ្ចូល fields `title` និង `author` ។
3.  **Controller:** `BookController` ត្រូវបានបង្កើតដោយប្រើ command `php artisan make:controller BookController`។ controller រួមបញ្ចូល methods ដូចខាងក្រោម:
    *   `index`: ត្រឡប់សៀវភៅទាំងអស់។
    *   `store`: បង្កើតសៀវភៅថ្មី។
    *   `show`: ត្រឡប់សៀវភៅជាក់លាក់មួយ។
    *   `update`: កែប្រែសៀវភៅជាក់លាក់មួយ។
    *   `destroy`: លុបសៀវភៅជាក់លាក់មួយ។
4.  **Routes:** API routes ត្រូវបានកំណត់នៅក្នុងឯកសារ `routes/api.php` ដោយប្រើ command `Route::resource('books', BookController::class);` ។

## របៀបប្រើវា

ដើម្បីប្រើ API អ្នកត្រូវ:

1.  Run `php artisan serve` នៅក្នុង directory `LaraA1` ។ វានឹងផ្តល់ URL ដូចជា `http://127.0.0.1:8000` ។
2.  បើក terminal ថ្មី (ឬ command prompt) ។
3.  ត្រូវប្រាកដថា terminal ថ្មីនេះ មិនស្ថិតនៅក្នុង directory `LaraA1` ទេ! ឧទាហរណ៍ អ្នកអាចស្ថិតនៅក្នុង directory `C:\Users\Yon Piseth\School Y3\Subject\Web\Semester2\Laravel\API` ។
4.  បន្ទាប់មកអ្នកអាចប្រើ tools ដូចជា Postman ឬ `curl` ពី terminal ថ្មីនេះ។ នេះគឺជាឧទាហរណ៍មួយចំនួន:

*   **Get all books:**

    ```bash
    curl http://127.0.0.1:8000/api/books
    ```
*   **Create a new book:**

    ```bash
    curl -X POST -H "Content-Type: application/json" -d '{"title": "The Lord of the Rings", "author": "J.R.R. Tolkien"}' http://127.0.0.1:8000/api/books
    ```
*   **Get a specific book:**

    ```bash
    curl http://127.0.0.1:8000/api/books/1
    ```
*   **Update a book:**

    ```bash
    curl -X PUT -H "Content-Type: application/json" -d '{"title": "The Hobbit", "author": "J.R.R. Tolkien"}' http://127.0.0.1:8000/api/books/1
    ```
*   **Delete a book:**

    ```bash
    curl -X DELETE http://127.0.0.1:8000/api/books/1
    ```

**The API is now working correctly. You can use the above commands to interact with the API.**
