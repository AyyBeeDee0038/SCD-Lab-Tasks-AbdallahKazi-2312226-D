<?php
// Include the database connection
include('db_connect.php');

// Get student ID from URL
$id = $_GET['id'];

// Fetch the student data from the database
$sql = "SELECT * FROM students WHERE id = '$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $roll_no = $_POST['roll_no'];
    $email = $_POST['email'];
    $marks = $_POST['marks'];
    $department = $_POST['department'];

    // Update student data in the database
    $sql = "UPDATE students SET name='$name', roll_no='$roll_no', email='$email', marks='$marks', department='$department' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Student updated successfully.";
        header('Location: dashboard.php'); // Redirect to dashboard after editing student
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
    <title>Edit Student</title>
    <link rel="stylesheet" href="style.css"> <!-- Link to iOS-style CSS -->
</head>
<body>
    <div class="container">
        <h1>Edit Student</h1>
        <form method="POST" action="edit_student.php?id=<?php echo $id; ?>">
            <input type="text" name="name" value="<?php echo $row['name']; ?>" required><br>
            <input type="text" name="roll_no" value="<?php echo $row['roll_no']; ?>" required><br>
            <input type="email" name="email" value="<?php echo $row['email']; ?>" required><br>
            <input type="number" name="marks" value="<?php echo $row['marks']; ?>" required><br>
            <input type="text" name="department" value="<?php echo $row['department']; ?>" required><br>
            <button type="submit">Update Student</button>
        </form>
        <a href="dashboard.php"><button>Back to Dashboard</button></a>
    </div>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
