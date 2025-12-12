<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Dashboard</title>
</head>
<body>
    <div class="container" style="text-align: center;">
        <h2>Welcome, <?php echo $_SESSION['user_name']; ?>!</h2>
        <p>This is a protected dashboard area.</p>
        <p style="color: green;">You have successfully logged in.</p>
        
        <form action="logout.php" method="POST">
            <button type="submit" style="background-color: #dc3545;">Logout</button>
        </form>
    </div>
</body>
</html>