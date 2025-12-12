<?php
include 'db.php';
$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $pass = $_POST['password'];
    $confirm_pass = $_POST['confirm_password'];

    // 1. Validation
    if (empty($name) || empty($email) || empty($pass)) {
        $msg = "<span class='error'>All fields are required.</span>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $msg = "<span class='error'>Invalid email format.</span>";
    } elseif ($pass !== $confirm_pass) {
        $msg = "<span class='error'>Passwords do not match.</span>";
    } else {
        // Check if email exists
        $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            $msg = "<span class='error'>Email already registered.</span>";
        } else {
            // 2. Hash Password
            $hashed_password = password_hash($pass, PASSWORD_DEFAULT);
            $token = bin2hex(random_bytes(50)); // Generate random token

            // Insert User
            $stmt = $conn->prepare("INSERT INTO users (name, email, password, verification_token) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $name, $email, $hashed_password, $token);

            if ($stmt->execute()) {
                // 3. Email Simulation (Since XAMPP can't send real mail easily)
                $link = "http://localhost/lab8/verify.php?token=$token";
                
                // In a real server, you use: mail($email, "Verify Email", "Click: $link");
                // For this lab, we show the link on screen:
                $msg = "<span class='success'>Registration successful! <br> 
                        <b><a href='$link'>[DEBUG: Click here to Verify Email]</a></b></span>";
            } else {
                $msg = "<span class='error'>Error: " . $conn->error . "</span>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="style.css"></head>
<body>
    <div class="container">
        <h2>Register</h2>
        <?php echo $msg; ?>
        <form method="POST">
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email Address" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            <button type="submit">Sign Up</button>
        </form>
        <a href="login.php">Already have an account? Login</a>
    </div>
</body>
</html>