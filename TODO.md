# TODO: Correct AuthController and User Model for Laravel Authentication

## Steps to Complete

-   [x] Update app/Models/User.php: Change class to extend Authenticatable instead of Model, add necessary use statement.
-   [x] Update app/Http/Controllers/AuthController.php: Fix imports (remove incorrect Validated import, use Validator facade), correct validation rules ('username' => 'required|string', 'password' => 'required|string|min:4'), complete login method with Auth::attempt, redirect on success, return errors on failure.
-   [ ] Test the login functionality by running the app and attempting login.
