# 📄 Document Status Tracking System

A Laravel 12 web application, it manages registrar request for documents status with admin dashboards and features interactive reports using DataTables and ChartJs.

> 🚀 This project was developed during my time as a Registrar Staff on QSU Registrar using Laravel 12 as a full-stack framework and MySQL as the database.

---

## 📌 Features

- 📊 Interactive data tables using DataTables
- 📈 Visual reports using Chart.js
- 🔐 Admin authentication system
- 🛠 Admin dashboard for managing documents.

---

## 🧰 Tech Stack

- **Backend:** PHP (Laravel Framework)
- **Frontend** Laravel Blade 
- **Database:** MySQL
- **Libraries & APIs:**
  - [DataTables](https://datatables.net/) – for enhanced table functionality
  - [Chart.js](https://www.chartjs.org/) – for graphical data representation
  

## 🔧 Installation

1. **Clone the repository:**
   ```bash
   git clone https://github.com/nixon-dev/registrar-project.git
2. **Install vendors**
   ```bash
   composer install
3. **Import MySQL DB**
4. **After importing MySQL DB, change credentials in .env**
      ```python
      DB_CONNECTION=mysql
      DB_HOST=127.0.0.1
      DB_PORT=3306
      DB_DATABASE=registrar
      DB_USERNAME=root
      DB_PASSWORD=
      ```
 5. **Run laravel server**
    ```php
    php artisan serve


