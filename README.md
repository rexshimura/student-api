# student-api
Creating a Web API - PHP

Instructions:
Create a Student Grade Management API. The API should allow students to be added with their exam scores, and it should calculate their final grade and determine if they have passed.  

-- Grade Calculation: The final grade is calculated as:
-- Final Grade=(0.4×Midterm Score)+(0.6×Final Score)
-- A student passes if their Final Grade is 75 or higher. Otherwise, they fail.

API Endpoints
-- Add a Student (with scores)
-- Retrieve all students (with their grades and pass/fail status)
-- Update a student's scores
-- Delete a student
-- Get a single student's final grade and status
-- Get all student final grade and status /* gi usa ra nako */

Additional: Create postman collection
------------------------------------------------------
What i Did:
MVC - Model-View-Controller
STUDENT-API/
├── app/
│   ├── controllers/
│   │   └── StudentController.php   # Controller for student-related operations
│   ├── models/
│   │   └── Student.php             # Student model with database logic
│   ├── views/
│       └── Response.php            # Helper for standardized JSON responses
├── config/
│   └── database.php                # Database connection setup
├── postman/
│   └── student-api.postman_collection.json # Postman collection for testing APIs
├── public/
│   ├── index.php                   # Entry point for API requests
│   └── test_db.php                 # File to test database connection


My Postman have the following collections:
> GET All Students
> POST Add a Student
> GET Get Student by ID
> PUT Update a Student
> DEL Delete a Student

SQL QUERY DONE:
------------------------------------------------------ > FOR THE DATABASE 
CREATE DATABASE student_management;
------------------------------------------------------ > FOR THE TABLE INSIDE THE DATABASE
CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    midterm_score FLOAT NOT NULL,
    final_score FLOAT NOT NULL,
    final_grade FLOAT GENERATED ALWAYS AS ((0.4 * midterm_score) + (0.6 * final_score)) STORED,
    status VARCHAR(10) GENERATED ALWAYS AS (IF(final_grade >= 75, 'Pass', 'Fail')) STORED
);

After Installing and Settig up my Composer, I input this to my terminal
C:\composer\composer.bat require vlucas/phpdotenv















