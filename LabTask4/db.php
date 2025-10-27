<?php
// db.php - MySQLi connection (simple, reusable)
$DB_SERVER = "localhost";
$DB_USERNAME = "root";
$DB_PASSWORD = "";
$DB_NAME = "student_management";

$conn = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

// Check connection
if ($conn->connect_errno) {
    // In production, log errors and show a user-friendly message instead
    die("Database connection failed: " . $conn->connect_error);
}

// Recommended charset
$conn->set_charset("utf8mb4");
?>
