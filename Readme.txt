CLINIC APPOINTMENT MANAGEMENT SYSTEM
===================================

1. PROJECT OVERVIEW
-------------------
The Clinic Appointment Management System is a web-based application developed
using PHP and MySQL. The main purpose of this project is to simplify the process
of managing clinic operations such as patients, doctors, and appointments.

This system allows users to:
• Register and login securely
• Manage patients and doctors
• Book, view, edit, and delete appointments
• Check appointment slot availability using AJAX
• Perform quick searches without page reload

The project is suitable for academic use and learning CRUD operations,
authentication, and AJAX in PHP.

--------------------------------------------------

2. TECHNOLOGIES USED
-------------------
• PHP (Core PHP for backend logic)
• MySQL (Database management)
• HTML (Structure of web pages)
• CSS (Styling and layout)
• JavaScript (Client-side interaction)
• AJAX (Asynchronous data handling)
• XAMPP (Local server environment)

--------------------------------------------------

3. DETAILED FOLDER & FILE EXPLANATION
------------------------------------

ROOT FOLDER: clinic_app
This is the main project directory that contains all files related to the
clinic application.

--------------------------------------------------

assets/
This folder contains all frontend static resources like CSS and JavaScript.

assets/css/
• style.css
  This file controls the visual design of the website including layout,
  colors, fonts, buttons, and page alignment.

assets/js/
• app.js
  This file handles client-side functionality such as AJAX requests,
  slot availability checking, and dynamic page interactions without reload.

--------------------------------------------------

auth/
This folder manages user authentication and access control.

• login.php
  Displays the login form and validates user credentials.

• register.php
  Handles new user registration and stores user details in the database.

• logout.php
  Ends the user session and logs the user out of the system.

• auth_check.php
  Ensures that only logged-in users can access protected pages.
  If a user is not logged in, they are redirected to the login page.

--------------------------------------------------

config/
This folder contains configuration files.

• db.php
  Establishes a connection between the application and the MySQL database.
  All database credentials are stored here to avoid repetition.

--------------------------------------------------

includes/
This folder contains reusable components and helper functions.

• header.php
  Contains the common page header, navigation bar, and links to CSS/JS files.
  Included at the top of multiple pages.

• footer.php
  Contains the common footer section displayed on all pages.

• functions.php
  Stores reusable PHP functions such as data validation, fetching records,
  and helper methods used across the project.

--------------------------------------------------

public/
This folder contains the main application pages accessible to the user.

• index.php
  The dashboard or homepage of the application after successful login.

• patients.php
  Displays the list of patients stored in the database.

• edit_patient.php
  Allows editing patient details.

• delete_patient.php
  Removes patient records from the database.

• doctors.php
  Displays doctor information and availability.

• edit_doctor.php
  Allows editing doctor details.

• add_appointment.php
  Displays a form to create a new appointment.

• book_appointment.php
  Processes appointment booking and saves it to the database.

• appointments.php
  Displays all booked appointments.

• edit_appointment.php
  Allows modification of appointment details.

• delete_appointment.php
  Deletes an appointment from the system.

• ajax_check_slots.php
  Uses AJAX to check available appointment slots in real-time
  without reloading the page.

• search_ajax.php
  Provides live search functionality using AJAX.

--------------------------------------------------

4. SYSTEM FEATURES EXPLAINED
----------------------------
• Authentication System
  Secure login and registration using PHP sessions.

• Patient Management
  Add, view, edit, and delete patient records.

• Doctor Management
  Manage doctor details and availability.

• Appointment Management
  Book, edit, view, and cancel appointments.

• AJAX Integration
  Real-time slot checking and search without page refresh.

• Reusable Components
  Header and footer files reduce code duplication.

--------------------------------------------------

5. HOW TO RUN THE PROJECT
------------------------
1. Install XAMPP on your system
2. Copy the project folder "clinic_app" to:
   C:/xampp/htdocs/
3. Start Apache and MySQL from XAMPP Control Panel
4. Open phpMyAdmin and create a database
5. Update database credentials in:
   config/db.php
6. Import the project database (if SQL file is provided)
7. Open browser and go to:
   http://localhost/clinic_app/public/index.php

--------------------------------------------------

6. LEARNING OUTCOMES
-------------------
• Understanding PHP project structure
• Implementing CRUD operations
• Session-based authentication
• AJAX communication in PHP
• Code reusability and modular design
• Database connectivity using PDO/MySQL

--------------------------------------------------

7. AUTHOR INFORMATION
---------------------
Developed by: Barsha Ghartixettri
Purpose: Academic & learning project

--------------------------------------------------

8. CONCLUSION
-------------
This Clinic Appointment Management System demonstrates a practical
implementation of backend and frontend integration using PHP and AJAX.
It is designed to be simple, organized, and easy to understand for beginners.
