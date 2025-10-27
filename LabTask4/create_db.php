<?php
$DB_SERVER = "localhost";
$DB_USERNAME = "root";
$DB_PASSWORD = "";

// Connect without selecting a database
$conn = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD);
if ($conn->connect_errno) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$dbName = "student_management";
if ($conn->query("CREATE DATABASE IF NOT EXISTS `$dbName` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci")) {
    echo "Database '$dbName' checked/created.<br>";
} else {
    die("Error creating database: " . $conn->error);
}

// Select the database
$conn->select_db($dbName);

// Create users table
$createUsers = "
CREATE TABLE IF NOT EXISTS users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;
";

if ($conn->query($createUsers) === TRUE) {
    echo "Table 'users' checked/created.<br>";
} else {
    echo "Error creating users table: " . $conn->error . "<br>";
}

// Create students table
$createStudents = "
CREATE TABLE IF NOT EXISTS students (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    roll_no VARCHAR(50) NOT NULL,
    email VARCHAR(150),
    marks INT DEFAULT 0,
    department VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unique_roll (roll_no)
) ENGINE=InnoDB;
";

if ($conn->query($createStudents) === TRUE) {
    echo "Table 'students' checked/created.<br>";
} else {
    echo "Error creating students table: " . $conn->error . "<br>";
}

$conn->close();
?>
