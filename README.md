# Employee Management System (CRUD-Me)

A **Laravel 11** application designed for managing employees with a focus on security and role-based access control. This project is fully containerized using **Docker** for a seamless "plug-and-play" experience.

## 🚀 Key Features
* **Complete CRUD**: Manage users/employees (Create, Read, Update, Delete).
* **Role-Based Access Control (RBAC)**: Secure management of rights and permissions using the Spatie Laravel-Permission package.
* **Profile Management**: Users can update their personal information and upload custom avatars.
* **Automated Environment**: One-command setup including dependency installation, database migration, and seeding.

## 🛠️ Tech Stack
* **Backend**: Laravel 11 (PHP 8.2).
* **Frontend**: Blade Templates, Bootstrap, and Vite for asset bundling.
* **Database**: MySQL 8.0.
* **DevOps**: Docker & Docker Compose.

---

## 📦 Installation Guide

### Prerequisites
* **Docker Desktop** installed and running.
* **Port availability**: Ensure ports **8080** (Web) and **3306** (MySQL) are not currently in use by other services on your machine.

### Step-by-Step Setup

1.  **Clone the repository**:
    ```bash
    git clone [https://github.com/votre-nom-utilisateur/laravel-employee-management-crud.git](https://github.com/votre-nom-utilisateur/laravel-employee-management-crud.git)
    cd laravel-employee-management-crud
    ```

2.  **Environment Configuration**:
    The system automatically creates a `.env` file from `.env.example` during startup. Ensure your `.env.example` matches the Docker configuration:
    * `DB_HOST=db`
    * `DB_DATABASE=crud_me`
    * `DB_PASSWORD=root`

3.  **Build and Launch**:
    ```bash
    docker compose up -d --build
    ```

4.  **Access the App**:
    Open your browser at **[http://localhost:8080](http://localhost:8080)**.

---

## ⚙️ How it works (Automated Setup)
To make the project "recruiter-friendly", a custom `entrypoint.sh` script automates the following on every startup:
1.  Installs PHP dependencies via **Composer**.
2.  Installs JS dependencies and builds assets via **NPM**.
3.  Synchronizes the environment file.
4.  Generates the application security key.
5.  **Refreshes the database and runs seeders** to provide immediate test data.

## 🔑 Default Credentials
Once the installation is complete, you can test the Role-Based Access Control using these two accounts :

### 1. Administrator Account (Full Access)
* **Email**: `admin@example.com`
* **Password**: `password`
* **Role**: Admin (Can create, edit, and delete any employee).

### 2. Standard User Account (Restricted Access)
* **Email**: `user@example.com`
* **Password**: `password`

---
*Developed as part of CESI's two-year computer development study programme.*
