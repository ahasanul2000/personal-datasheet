# Personal Data Sheet Management - Assessment 1

This section of the **Personal Data Sheet Management** project implements basic user management and authentication features using Laravel's built-in functionalities. This assessment focuses on creating a solid foundation for managing user data effectively.

## Assessment Overview

### Level 1: Basic User Management and Authentication

**Goals**:

-   Implement Laravel's built-in authentication.
-   Create basic CRUD (Create, Read, Update, Delete) functionalities for users.

## Implementation Details

### Instructions

1. **Initialize a New Project**:

    - Created a new Laravel project using the latest version.

2. **Utilize Laravel's Default Login Feature**:

    - Integrated Laravel's built-in authentication features, including registration, login, and password reset functionalities.
    - Implemented the `Auth::routes()` method in `routes/web.php` to enable default authentication routes.

3. **User Management Pages**:

    - Created the following pages:
        - **List Users**: A page that displays all registered users in a paginated format.
        - **View User**: A page that displays the details of a single user.
        - **Create User**: A form to add new users, including fields for user details and an option to upload a photo as a user avatar.
        - **Edit User**: A form for editing existing user details.
        - **Delete User**: Implemented functionality to delete users with an option for soft deletion.

4. **Soft Delete Functionality**:
    - Implemented soft delete functionality using Laravel's Eloquent ORM.
    - Created pages to list soft-deleted users, allowing admins to restore or permanently delete them.

### Notes

-   All user routes are secured with the `auth` middleware to ensure that only authenticated users can access them.
-   User forms are set to enable photo uploads, with the appropriate encoding type to handle file uploads.

## Features

-   **User Authentication**: Secure login and registration using Laravel's built-in authentication.
-   **CRUD Operations**:
    -   Create, read, update, and delete user records easily through the web interface.
-   **Soft Delete**: Ability to soft delete users and manage their records effectively.
-   **User Avatar Upload**: Users can upload photos, which are stored alongside their profiles.

## Usage

-   Access the application at `http://localhost:8000` after running the development server.
-   Navigate to the user management section to perform CRUD operations on users.
-   Ensure to log in with valid credentials to access user management features.

---

## Level 2: Advanced User Management

**Goals**:

-   Implement the Service Pattern for user management.
-   Write unit tests for your service class.
-   Implement validation for user data.

### Instructions

1. **Ensure Level 1 Functionalities Are Complete**:

    - Confirm that all functionalities from Level 1 are working as intended.

2. **Create a Service Class**:

    - Developed a service class for handling user-related operations, encapsulating the business logic.

3. **Define an Interface**:

    - Created an interface for the service class, defining necessary user management methods.

4. **Develop Unit Tests**:

    - Wrote unit tests for the service class to cover key functionalities:
        - Listing users
        - Adding new users
        - Updating existing users
        - Soft deleting users
        - Handling trashed users

5. **Integrate User Service into Controller**:

    - Replaced direct model calls in the UserController with service methods to ensure better separation of concerns.

6. **Define and Apply Validation Rules**:
    - Created a dedicated request class for user data and defined validation rules to ensure data integrity.

### Notes

-   Consider additional test cases to improve test coverage.
-   Customize method names and validation rules according to project requirements.
-   Ensure proper service binding in your application's service provider.

## Conclusion

This assessment provides a solid foundation for user management within the Personal Data Sheet Management system. The implementation of the Service Pattern and unit tests enhances maintainability and reliability, laying the groundwork for future enhancements.

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
