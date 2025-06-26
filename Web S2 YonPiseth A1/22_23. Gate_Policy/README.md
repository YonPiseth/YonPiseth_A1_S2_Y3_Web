# Laravel Gates and Policies

## តើ Gates និង Policies គឺជាអ្វី?

**Gates** និង **Policies** គឺជា authorization features នៅ​ក្នុង Laravel ដែល​គ្រប់គ្រង​ការ​ចូល​ដំណើរការ​ទៅកាន់ resources 
និង​កំណត់​សកម្មភាព​អ្វី​ដែល user អាច​អនុវត្ត​បាន។

-   **Gates:** Simple closures ដែល​កំណត់​ថា user អាច authorization ដើម្បី​អនុវត្ត​សកម្មភាព​ដែល​បាន​ផ្ដល់​ឱ្យ​ឬ​អត់។ 
ជា​ធម្មតា​ពួក​គេ​ត្រូវ​បាន​ប្រើ​សម្រាប់​សកម្មភាព​ដែល​មិន​ទាក់ទង​ទៅ​នឹង model ឬ resource ជាក់លាក់​ណាមួយ​ទេ។
-   **Policies:** Classes ដែល​រៀបចំ authorization logic សម្រាប់ model ឬ resource ជាក់លាក់​ណាមួយ។ ពួក​គេ​កំណត់ methods 
ដែល​ត្រូវ​គ្នា​ទៅ​នឹង​សកម្មភាព​ដែល user ចង់​អនុវត្ត​លើ model (ឧទាហរណ៍ `create`, `update`, `delete`)។

## Gates និង Policies នៅ​ក្នុង Project នេះ

### Gates

-   **`admin`:** បាន​កំណត់​នៅ​ក្នុង `AuthServiceProvider.php`។ ពិនិត្យ​មើល​ថា user មាន role `admin` ឬ​អត់។

    ```php
    Gate::define('admin', function (User $user) {
        return $user->role === 'admin';
    });
    ```

    Gate នេះ​អាច​ត្រូវ​បាន​ប្រើ​ដើម្បី protect routes ឬ actions ដែល​គួរ​តែ​អាច​ចូល​ដំណើរការ​បាន​តែ​ administrators
     ប៉ុណ្ណោះ។ ឧទាហរណ៍:

    ```php
    if (Gate::allows('admin')) {
        // The user is an admin...
    }
    ```

### Policies

-   **`UserPolicy`:** ស្ថិត​នៅ​ក្នុង `app/Policies/UserPolicy.php`។ កំណត់ authorization rules សម្រាប់ `User` model។

    -   **`update(User $user, User $model)`:** កំណត់​ថា user អាច update profile របស់ user ផ្សេង​ទៀត​ឬ​អត់។ មាន​តែ users 
    ដែល​មាន role `admin` ទេ​ដែល​អាច update users ផ្សេង​ទៀត​បាន។
    -   **`delete(User $user, User $model)`:** កំណត់​ថា user អាច delete profile របស់ user ផ្សេង​ទៀត​ឬ​អត់។ មាន​តែ users 
    ដែល​មាន role `admin` ទេ​ដែល​អាច delete users ផ្សេង​ទៀត​បាន។

    `UserPolicy` ត្រូវ​បាន​ register នៅ​ក្នុង `AuthServiceProvider.php`:

    ```php
    protected $policies = [
        User::class => UserPolicy::class,
    ];
    ```

    Policy នេះ​អាច​ត្រូវ​បាន​ប្រើ​នៅ​ក្នុង controllers ឬ views ដើម្បី authorize actions លើ `User` models។ ឧទាហរណ៍:

    ```php
    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);

        // Update the user...
    }
    ```
