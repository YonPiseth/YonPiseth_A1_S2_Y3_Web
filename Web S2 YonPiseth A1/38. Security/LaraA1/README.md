# Laravel 12 JWT Authentication with RBAC Authorization Example

គម្រោងនេះបង្ហាញពីការអនុវត្តជាក់ស្តែងនៃ JWT (JSON Web Token) authentication រួមបញ្ចូលគ្នាជាមួយ RBAC (Role-Based Access Control) authorization នៅក្នុងកម្មវិធី Laravel 12។

## លក្ខណៈពិសេស (Features)

*   **JWT Authentication**: ការផ្ទៀងផ្ទាត់អ្នកប្រើប្រាស់ប្រកបដោយសុវត្ថិភាពដោយប្រើ package `tymon/jwt-auth`។
*   **User Registration & Login**: API endpoints សម្រាប់ការចុះឈ្មោះអ្នកប្រើប្រាស់ និងការចូល។
*   **Token Management**: Endpoints សម្រាប់ refresh និង invalidate JWT tokens។
*   **Role-Based Access Control (RBAC)**:
    *   `roles` និង `permissions` tables សម្រាប់កំណត់ user roles និង permissions ដែលពាក់ព័ន្ធ។
    *   ទំនាក់ទំនង Many-to-many រវាង Users, Roles, និង Permissions។
    *   `HasRoles` trait សម្រាប់ `User` model ដើម្បីងាយស្រួលពិនិត្យ roles និង permissions។
    *   Custom `RoleMiddleware` ដើម្បីការពារ routes ដោយផ្អែកលើ user roles។
*   **Admin Dashboard Example**: API route ដែលត្រូវបានការពារ (`/api/admin/dashboard`) ដែលអាចចូលប្រើបានតែដោយអ្នកប្រើប្រាស់ដែលមាន 'admin' role ប៉ុណ្ណោះ។

## ការដំឡើង (Setup and Installation)

អនុវត្តតាមជំហានទាំងនេះដើម្បីដំឡើង និងដំណើរការគម្រោង៖

1.  **Clone the repository (ប្រសិនបើមាន) ឬចូលទៅកាន់ project directory:**
    ```bash
    cd LaraA1
    ```

2.  **Install Composer dependencies:**
    ```bash
    composer install
    ```

3.  **Install the `tymon/jwt-auth` package:**
    ```bash
    composer require tymon/jwt-auth
    ```

4.  **Publish the JWT configuration file:**
    ```bash
    php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
    ```

5.  **Generate the JWT secret key:**
    ```bash
    php artisan jwt:secret
    ```
    នេះនឹងបន្ថែម `JWT_SECRET` ទៅក្នុង file `.env` របស់អ្នក។

6.  **Configure Database (ណែនាំ SQLite សម្រាប់ការដំឡើងរហ័ស):**
    បើក file `.env` របស់អ្នក ហើយត្រូវប្រាកដថា database connection ត្រូវបានកំណត់ទៅ `sqlite`:
    ```dotenv
    DB_CONNECTION=sqlite
    # DB_HOST=127.0.0.1
    # DB_PORT=3306
    # DB_DATABASE=Security
    # DB_USERNAME=root
    # DB_PASSWORD=
    ```
    បង្កើត file database SQLite ទទេមួយ៖
    ```bash
    type nul > database\database.sqlite
    ```
    (នៅលើ Linux/macOS, ប្រើ `touch database/database.sqlite`)

7.  **Run Database Migrations and Seeders:**
    នេះនឹងបង្កើត tables ដែលចាំបាច់ (users, roles, permissions, pivot tables) និង seed initial data (admin និង regular users, roles, និង permissions)។
    ```bash
    php artisan migrate --seed
    ```
    *   **Seeded Users:**
        *   **Admin User**: `admin@example.com` / `password`
        *   **Regular User**: `user@example.com` / `password`

8.  **Start the Laravel Development Server:**
    ```bash
    php artisan serve
    ```
    API នឹងអាចចូលប្រើបាននៅ `http://127.0.0.1:8000`។

## API Endpoints និងការធ្វើតេស្ត (Testing)

អ្នកអាចប្រើ tools ដូចជា [Postman](https://www.postman.com/downloads/) ឬ [Insomnia](https://insomnia.rest/download) ដើម្បីធ្វើតេស្ត API endpoints។

### Authentication Endpoints (`/api/auth`)

*   **Register a New User**
    *   **URL**: `POST http://127.0.0.1:8000/api/auth/register`
    *   **Body (JSON)**:
        ```json
        {
            "name": "Your Name",
            "email": "your_email@example.com",
            "password": "your_password",
            "password_confirmation": "your_password"
        }
        ```
    *   **Note**: `password` និង `password_confirmation` ត្រូវតែដូចគ្នា។

*   **Login User**
    *   **URL**: `POST http://127.0.0.1:8000/api/auth/login`
    *   **Body (JSON)**:
        ```json
        {
            "email": "admin@example.com",
            "password": "password"
        }
        ```
    *   **Response**: ត្រឡប់ `access_token` ប្រសិនបើជោគជ័យ។ ចម្លង token នេះសម្រាប់ protected routes។

*   **Get Authenticated User Details**
    *   **URL**: `POST http://127.0.0.1:8000/api/auth/me`
    *   **Headers**: `Authorization: Bearer YOUR_ACCESS_TOKEN`
    *   **Response**: ត្រឡប់ព័ត៌មានលម្អិតរបស់អ្នកប្រើប្រាស់ដែលបានផ្ទៀងផ្ទាត់បច្ចុប្បន្ន។

*   **Refresh Token**
    *   **URL**: `POST http://127.0.0.1:8000/api/auth/refresh`
    *   **Headers**: `Authorization: Bearer YOUR_ACCESS_TOKEN`
    *   **Response**: ត្រឡប់ `access_token` ថ្មី។

*   **Logout User**
    *   **URL**: `POST http://127.0.0.1:8000/api/auth/logout`
    *   **Headers**: `Authorization: Bearer YOUR_ACCESS_TOKEN`
    *   **Response**: `{"message": "Successfully logged out"}`

### Protected RBAC Endpoint (`/api/admin`)

*   **Access Admin Dashboard**
    *   **URL**: `GET http://127.0.0.1:8000/api/admin/dashboard`
    *   **Headers**: `Authorization: Bearer YOUR_ACCESS_TOKEN`
    *   **Expected Behavior**:
        *   ប្រសិនបើ `YOUR_ACCESS_TOKEN` ជាកម្មសិទ្ធិរបស់ `admin@example.com` (ឬអ្នកប្រើប្រាស់ណាមួយដែលមាន 'admin' role):
            `{"message": "Welcome to the Admin Dashboard!"}` (HTTP Status 200)
        *   ប្រសិនបើ `YOUR_ACCESS_TOKEN` ជាកម្មសិទ្ធិរបស់ `user@example.com` (ឬអ្នកប្រើប្រាស់ណាមួយដែលគ្មាន 'admin' role):
            `{"message": "Forbidden. You do not have the required role."}` (HTTP Status 403)
        *   ប្រសិនបើគ្មាន token ឬ token មិនត្រឹមត្រូវត្រូវបានផ្តល់:
            `{"message": "Unauthorized."}` (HTTP Status 401)

## ទិដ្ឋភាពទូទៅនៃរចនាសម្ព័ន្ធគម្រោង (Project Structure Overview)

*   `app/Models/User.php`: Implements `JWTSubject` និង uses `HasRoles` trait។
*   `app/Models/Role.php`: Eloquent model សម្រាប់ roles, ជាមួយ `users()` និង `permissions()` relationships។
*   `app/Models/Permission.php`: Eloquent model សម្រាប់ permissions, ជាមួយ `roles()` relationship។
*   `app/Traits/HasRoles.php`: Trait ដែលមាន helper methods សម្រាប់ role និង permission checking (`hasRole`, `hasPermissionTo`, `assignRole`)។
*   `app/Http/Controllers/AuthController.php`: គ្រប់គ្រង JWT authentication logic (register, login, logout, refresh, me)។
*   `app/Http/Controllers/AdminController.php`: Example controller ជាមួយ role-protected endpoint។
*   `app/Http/Middleware/RoleMiddleware.php`: Custom middleware ដើម្បីអនុវត្ត role-based authorization។
*   `routes/api.php`: កំណត់ API routes ទាំងអស់ រួមទាំង authentication និង protected admin routes ជាមួយ middleware។
*   `bootstrap/app.php`: Configured ដើម្បី load `api.php` routes និង register `RoleMiddleware`។
*   `config/auth.php`: Configured ដើម្បីប្រើ `jwt` driver សម្រាប់ `api` guard។
*   `database/migrations/*`: Migration files សម្រាប់ `roles`, `permissions`, `role_user`, និង `permission_role` tables។
*   `database/seeders/*`: Seeders សម្រាប់ populating initial roles, permissions, និង users។
