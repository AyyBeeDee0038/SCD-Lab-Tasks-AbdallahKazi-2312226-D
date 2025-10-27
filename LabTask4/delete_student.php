<?php
// Include the database connection
include('db_connect.php');

// Get student ID from URL
$id = $_GET['id'];

// Delete student from the database
$sql = "DELETE FROM students WHERE id = '$id'";

if ($conn->query($sql) === TRUE) {
    echo "Student deleted successfully.";
    header('Location: dashboard.php'); // Redirect to dashboard after deleting student
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
