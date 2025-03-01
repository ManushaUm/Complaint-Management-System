## Complaint Management System | Documentation

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

-   [Simple, fast routing engine](https://laravel.com/docs/routing).
-   [Powerful dependency injection container](https://laravel.com/docs/container).
-   Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
-   Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
-   Database agnostic [schema migrations](https://laravel.com/docs/migrations).
-   [Robust background job processing](https://laravel.com/docs/queues).
-   [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

# Complaint Management System

A **Laravel-based** Complaint Management System designed to streamline the process of logging, assigning, and tracking customer complaints efficiently.

## 🚀 Features

- **Role-Based Access Control** (Admin, Department Heads, Unit Heads, and Members)
- **Complaint Logging & Tracking**
- **Assignment Workflow** (Customer Care → Unit Member → Unit Head → Department Head)
- **Status Updates** (Received, Open, In-Progress, Closed, Rejected, Reopened)
- **Reopening Complaints** (Either as new or reversing the last step)
- **Automated Notifications** (Emails, Messages, or Printable Letters for Status Updates)
- **Dynamic Role & User Management**
- **Report Generation**

## 🛠️ Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/ManushaUm/Complaint-Management-System.git
   cd Complaint-Management-System
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Set up the environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   Update the `.env` file with your database configuration.

4. **Run database migrations**
   ```bash
   php artisan migrate --seed
   ```

5. **Start the application**
   ```bash
   php artisan serve
   ```

6. **Compile assets** (if using Vue/React frontend)
   ```bash
   npm run dev
   ```

## 📌 Usage

- **Admin Dashboard:** Manage users, complaints, and reports.
- **Customer Care:** Log and categorize complaints.
- **Department Heads:** Assign complaints to unit heads.
- **Unit Members:** Work on complaints and update statuses.
- **Customers:** Track complaint progress and receive notifications.

## 📜 API Endpoints (will change still going on dev)

| Method | Endpoint | Description |
|--------|-------------|-------------|
| POST | `/api/login` | User login |
| POST | `/api/register` | User registration |
| GET | `/api/complaints` | Get all complaints |
| POST | `/api/complaints` | Create a new complaint |
| PUT | `/api/complaints/{id}` | Update complaint status |
| DELETE | `/api/complaints/{id}` | Delete complaint |

## 📄 License


<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>


This project is open-source and available under the **MIT License**.


