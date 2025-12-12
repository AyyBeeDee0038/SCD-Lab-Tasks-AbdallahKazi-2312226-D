<?php
include 'db.php';
$msg = "";

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // 1. Validation
    if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
        $msg = "<p class='error'>All fields are required!</p>";
    } elseif ($password !== $confirm_password) {
        $msg = "<p class='error'>Passwords do not match!</p>";
    } else {
        // Check if email already exists
        $check = $conn->query("SELECT id FROM users WHERE email='$email'");
        if ($check->num_rows > 0) {
            $msg = "<p class='error'>Email already registered!</p>";
        } else {
            // 2. Password Hashing
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $token = bin2hex(random_bytes(50)); // Generate unique token

            // Insert User
            $sql = "INSERT INTO users (name, email, password, verification_token) VALUES ('$name', '$email', '$hashed_password', '$token')";
            
            if ($conn->query($sql) === TRUE) {
                // 3. Simulate Email Sending (Display link on screen for Lab Task purposes)
                $verifyLink = "http://localhost/LabTask8/verify.php?token=$token";
                $msg = "<div class='success'>
                            Registration successful!<br>
                            <strong>SIMULATED EMAIL:</strong><br>
                            Please click this link to verify: <br>
                            <a href='$verifyLink'>VERIFY ACCOUNT</a>
                        </div>";
            } else {
                $msg = "<p class='error'>Error: " . $conn->error . "</p>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Register</title>
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <?php echo $msg; ?>
        <form method="POST" action="">
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email Address" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            <button type="submit" name="register">Register</button>
        </form>
        <a href="login.php">Already have an account? Login</a>
    </div>
</body>
</html>