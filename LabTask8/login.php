<?php
session_start();
include 'db.php';
$msg = "";

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM users WHERE email='$email'");

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // 1. Verify Password
        if (password_verify($password, $user['password'])) {
            // 2. Check Email Verification
            if ($user['is_verified'] == 1) {
                // 3. Create Session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                header("Location: dashboard.php");
                exit();
            } else {
                $msg = "<p class='error'>Please verify your email first!</p>";
            }
        } else {
            $msg = "<p class='error'>Incorrect password!</p>";
        }
    } else {
        $msg = "<p class='error'>User not found!</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <?php echo $msg; ?>
        <form method="POST" action="">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login">Login</button>
        </form>
        <a href="index.php">Create an account</a>
    </div>
</body>
</html>