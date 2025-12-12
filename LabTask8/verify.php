<?php
include 'db.php';

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    
    // Find user with this token
    $result = $conn->query("SELECT * FROM users WHERE verification_token='$token' LIMIT 1");

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        if ($user['is_verified'] == 1) {
             echo "<h3>Account already verified. <a href='login.php'>Login here</a></h3>";
        } else {
            // Mark as verified
            $update = $conn->query("UPDATE users SET is_verified=1 WHERE verification_token='$token'");
            if ($update) {
                echo "<h3>Email Verified Successfully! <a href='login.php'>Login Now</a></h3>";
            }
        }
    } else {
        echo "<h3>Invalid Token.</h3>";
    }
} else {
    echo "<h3>No token provided.</h3>";
}
?>