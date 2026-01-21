# GitHub Weekly Commit Challenge - Student Portal

A professional PHP-based student portal designed for Sangameshwar College, Solapur. This project displays the participation and progress of students in the "GitHub Weekly Commit Challenge".

## 🚀 Features
- **Premium Dashboard UI**: Modern, responsive, and attractive design using OKLCH colors and Glassmorphism.
- **Real-time Analytics**: Quick stats for total participating students and total commits.
- **Leaderboard**: Automatically ranks students based on their commit history.
- **Dynamic Database Fetching**: PHP-driven system for retrieving data from MySQL.
- **Exception Handling**: Robust error reporting for database connection issues.

## 🛠️ Database Structure

The project relies on a MySQL database named `college_db` with a table called `students`.

### Table Schema: `students`

| Column | Type | Description |
| :--- | :--- | :--- |
| `id` | `INT` | Primary Key, Auto-Increment. |
| `roll_no` | `VARCHAR(20)` | Unique student identification. |
| `name` | `VARCHAR(100)` | Full name of the student. |
| `email` | `VARCHAR(100)` | Contact email address. |
| `class` | `VARCHAR(50)` | Current class (e.g., BCA-III (SEM-VI)). |
| `commits_count` | `INT` | Total number of GitHub commits. |
| `last_commit_date`| `DATE` | Date of the latest contribution. |

> [!TIP]
> Use the provided `db.sql` file to automatically set up the database and populate it with sample data.

## 📦 Setup Instructions

1. **Prerequisites**: Ensure you have a web server with PHP (v7.4+) and MySQL (e.g., XAMPP, WAMP, or MAMP).
2. **Database Setup**:
   - Open phpMyAdmin or your SQL client.
   - Create a database named `college_db`.
   - Import the `db.sql` file provided in the repository.
3. **Project Deployment**:
   - Move the project folder to your server's root directory (e.g., `C:/xampp/htdocs/`).
4. **Configuration**:
   - Open `display_students.php`.
   - Update the configuration section at the top with your database credentials if they differ from the defaults:
     ```php
     $host = "localhost";
     $username = "root";
     $password = "";
     $dbname = "college_db";
     ```
5. **Run**:
   - Open your browser and navigate to `http://localhost/display_students.php`.

---
© 2026 Department of Computer Science, Sangameshwar College.
