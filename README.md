# School Management System

A modern web-based School Management System built with Laravel, providing role-based dashboards and management for Admins, Teachers, and Students.

## Features

- **Role-based Authentication:** Admin, Teacher, and Student logins with secure access.
- **Admin Dashboard:**
  - Manage teachers, students, and time tables.
  - View statistics (total users, admins, teachers, students).
- **Teacher Dashboard:**
  - View assigned classes and students.
  - View class time tables with class/section dropdown.
- **Student Dashboard:**
  - View personal and academic information.
  - View class time table.
- **Time Table Management:**
  - Admins can create, edit, and delete time table entries.
  - Teachers and students can view their relevant class time tables.
- **User Profiles:**
  - Detailed profiles for students and teachers.
- **Secure Routing:**
  - Middleware ensures only authorized users access their respective dashboards and features.

## Tech Stack

- **Backend:** Laravel (PHP)
- **Frontend:** Blade, Tailwind CSS
- **Database:** SQLite (default, can be changed)
- **Authentication:** Laravel Jetstream & Fortify

## Getting Started

### Prerequisites
- PHP >= 8.1
- Composer
- Node.js & npm
- SQLite (or MySQL/PostgreSQL)

### Installation
1. **Clone the repository:**
   ```sh
   git clone <your-repo-url>
   cd school-management-system
   ```
2. **Install PHP dependencies:**
   ```sh
   composer install
   ```
3. **Install Node dependencies:**
   ```sh
   npm install
   ```
4. **Copy and configure environment:**
   ```sh
   cp .env.example .env
   # Edit .env as needed (DB, mail, etc.)
   ```
5. **Generate application key:**
   ```sh
   php artisan key:generate
   ```
6. **Run migrations and seeders:**
   ```sh
   php artisan migrate --seed
   ```
7. **Build frontend assets:**
   ```sh
   npm run build
   ```
8. **Start the development server:**
   ```sh
   php artisan serve
   ```

### Default Admin Login
- Email: `admin@example.com`
- Password: `password`

> Update credentials in the database as needed.

## Project Structure

- `app/Models/` — Eloquent models (User, StudentProfile, TeacherProfile, TimeTable, etc.)
- `app/Http/Controllers/` — Controllers for each role and resource
- `resources/views/` — Blade templates for dashboards and CRUD
- `routes/web.php` — Web routes with role-based middleware
- `database/migrations/` — Database schema
- `database/seeders/` — Initial data

## Customization
- Update `.env` for your database and mail settings.
- Add more features (attendance, grades, notifications, etc.) as needed.

## License

This project is open-source and available under the [MIT License](LICENSE).
