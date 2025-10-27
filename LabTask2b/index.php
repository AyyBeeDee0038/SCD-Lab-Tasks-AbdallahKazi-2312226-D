<?php
// Sample passwords (hardcoded array)
$passwords = [
    "hello",
    "Hello123",
    "Abc!2024",
    "test"
];

// Function to check password strength
function check_password(string $pwd): array {
    // Initialize the result array
    $result = [
        'length_ok' => false,
        'has_upper' => false,
        'has_digit' => false,
        'has_special' => false,
        'score' => 0
    ];

    // Check password length (>= 8)
    if (strlen($pwd) >= 8) {
        $result['length_ok'] = true;
        $result['score'] += 1;
    }

    // Check if password contains at least one uppercase letter
    if (preg_match('/[A-Z]/', $pwd)) {
        $result['has_upper'] = true;
        $result['score'] += 1;
    }

    // Check if password contains at least one digit
    if (preg_match('/\d/', $pwd)) {
        $result['has_digit'] = true;
        $result['score'] += 1;
    }

    // Check if password contains at least one special character
    if (preg_match('/[^A-Za-z0-9]/', $pwd)) {
        $result['has_special'] = true;
        $result['score'] += 1;
    }

    return $result;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Strength Checker</title>
    <link rel="stylesheet" href="style.css"> <!-- Link to the iOS-style CSS -->
</head>
<body>
    <div class="container">
        <h1>Password Strength Checker</h1>
        <div class="password-results">
            <?php
            // Process and display results for each password
            foreach ($passwords as $password) {
                $check = check_password($password);
                $strength = "";
                $class = "";

                // Assign strength based on score
                if ($check['score'] <= 1) {
                    $strength = "Weak";
                    $class = "weak";
                } elseif ($check['score'] == 2) {
                    $strength = "Medium";
                    $class = "medium";
                } else {
                    $strength = "Strong";
                    $class = "strong";
                }

                // Output password strength result with CSS classes for styling
                echo "<div class='password-result $class'>";
                echo "<span>Password: \"$password\"</span>";
                echo "<span>Score: {$check['score']}/4</span>";
                echo "<span>Strength: $strength</span>";
                echo "</div>";
            }
            ?>
        </div>
    </div>
</body>
</html>
