# PHP TASK MINI EMPLOYE MANAGEMENT SYSTEM

## 📌 Overview
The **PHP TASK MINI EMPLOYE MANAGEMENT SYSTEM* is a web-based application developed for managing employee records.  
It allows the HR/admin to **add, update, delete, and view employees**, upload profile images, and send **automatic email notifications** upon registration.  

This project is built using **Core PHP** and **MySQL** and is designed to run on **localhost** using XAMPP.  
For local email testing, **MailHog** is integrated to capture outgoing mails without sending them to real addresses.


## ⚙️ Setup Instructions

### 1️⃣ Prerequisites
- [XAMPP](https://www.apachefriends.org/download.html) installed  
- [Composer](https://getcomposer.org/download/) installed  
- [MailHog](https://github.com/mailhog/MailHog) installed (for local email testing)  
- PHP version **>= 7.4**



### 2️⃣ Installation Steps
1. **Clone or copy** the project into `htdocs`:
  C:\xampp\htdocs\verge-sys-task
  https://github.com/Muhammadarshad1-dev/verge-sys-task.git



  cd C:\xampp\htdocs\verge-sys-task
  composer install



  **DATABASE TABLE COLUMS**
  id, employe_name, employe_email, employe_dept, employe_file, date, status



Configure Database Connection
**Open controller/EmployeAdminController.php**
private $servername = 'localhost';
private $username = 'root';
private $pasword  = '';
private $dbname   = 'portfolio';



**Access MailHog at:**
http://localhost:8025




**Technologies Used**
PHP (Core PHP, OOP style)
MySQL (Database)
PHPMailer (Email sending via MailHog)
Bootstrap 5 (Frontend styling)
jQuery & AJAX (Dynamic functionality)
MailHog (Local email testing)




**Main Functionalities**
🔹 **Employee Management**
Add Employee: Name, Email, Department, Profile Image

Edit Employee: Update details and replace profile image

Delete Employee: Remove employee from the system

View All Employees: Display complete list from the database

Update Status: Activate/Deactivate employees

🔹 **Email Notification**
When a new employee is added:

Sends "Congratulations" email to their provided email

Email is captured in MailHog for local testing

🔹 **File Upload**
Profile images are uploaded to public/Profiles/ directory

🔹 **Logging**
All CRUD actions are logged into logs/employees.log

