Here’s the updated README file with the correct repository URL:

---

# Anonymous Application

## Introduction

Welcome to the Anonymous Application! This Laravel-based application is currently under development. Below is a detailed overview of the features implemented so far, setup instructions, and usage guidelines.

## Features Implemented So Far

### Authentication

Implemented using Laravel Sanctum, the authentication system includes:

- **User Registration:** Users can create an account.
- **User Login:** Users can log in with their credentials.
- **Token-Based Authentication:** Routes are protected using Sanctum tokens to ensure secure access.

### Message Management

The `MessageController` handles the following functionalities:

- **Viewing Messages:** Users can view all messages.
- **Posting Messages:** Users can post new messages.
- **Deleting Messages:** Users can delete their messages.

### Feedback Management

The `FeedbackController` takes care of:

- **Recording Feedback:** Feedback submitted through the contact page is recorded and stored in the database.
- **Feedback Notification:** Users receive a confirmation message via queue after their feedback is recorded.

### Admin Functionality

The application includes a robust admin system:

- **Admin Routes & Controllers:** Admin-specific routes and controllers for managing the application.
- **Permissions:** A permission system to control access to specific features and functionalities.

### Blade Breeze Template

A customized Blade Breeze template is implemented to enhance the frontend experience.

### Routes

- **Public Routes:** Accessible without authentication.
- **Protected Routes:** Accessible only to authenticated users, secured with middleware.

## Getting Started

### Prerequisites

- PHP (>= 8.0)
- Composer
- MySQL or any other supported database
- Laravel (>= 8.0)

### Installation

1. **Clone the repository:**
    ```sh
    git clone https://github.com/artisticwrist/anonymous-app.git
    cd anonymous-app
    ```

2. **Install dependencies:**
    ```sh
    composer install
    ```

3. **Create a copy of the .env file:**
    ```sh
    cp .env.example .env
    ```

4. **Generate an application key:**
    ```sh
    php artisan key:generate
    ```

5. **Configure your database in the .env file:**

6. **Run the database migrations:**
    ```sh
    php artisan migrate
    ```

7. **Install Laravel Sanctum:**
    ```sh
    php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
    php artisan migrate
    ```

### Running the Application

Start the local development server:

```sh
php artisan serve
```

Visit `http://localhost:8000` in your browser to access the application.

## Usage

### Authentication

- **Register:** `POST /api/register`
- **Login:** `POST /api/login`
- **Logout:** `POST /api/logout`

### Message Management

- **View Messages:** `GET /api/messages`
- **Post Message:** `POST /api/messages`
- **Delete Message:** `DELETE /api/messages/{id}`

### Feedback Management

- **Submit Feedback:** `POST /api/feedback`

### Admin Management

- **Access Admin Panel:** Admin routes and controls available for managing the application.

## Contributing

Contributions are welcome! Please fork the repository and submit a pull request for review.

## License

This project is licensed under the MIT License.

---

For any issues or questions, please open an issue on GitHub.

Thank you for using the Anonymous Application!
