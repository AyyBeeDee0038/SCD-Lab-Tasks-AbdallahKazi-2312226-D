<?php
// Include the database connection
include('db_connect.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $roll_no = $_POST['roll_no'];
    $email = $_POST['email'];
    $marks = $_POST['marks'];
    $department = $_POST['department'];

    // Insert the new student into the database
    $sql = "INSERT INTO students (name, roll_no, email, marks, department) 
            VALUES ('$name', '$roll_no', '$email', '$marks', '$department')";

    if ($conn->query($sql) === TRUE) {
        echo "New student added successfully.";
        header('Location: dashboard.php'); // Redirect to dashboard after adding student
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <link rel="stylesheet" href="style.css"> <!-- Link to iOS-style CSS -->
</head>
<body>
    <div class="container">
        <h1>Add New Student</h1>
        <form method="POST" action="add_student.php">
            <input type="text" name="name" placeholder="Name" required><br>
            <input type="text" name="roll_no" placeholder="Roll No" required><br>
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="number" name="marks" placeholder="Marks" required><br>
            <input type="text" name="department" placeholder="Department" required><br>
            <button type="submit">Add Student</button>
        </form>
        <a href="dashboard.php"><button>Back to Dashboard</button></a>
    </div>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
