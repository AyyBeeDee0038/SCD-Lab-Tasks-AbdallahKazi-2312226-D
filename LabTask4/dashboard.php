<?php
// Start session and check if the user is logged in
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit();
}

// Include the database connection
include('db_connect.php');

// Initialize search and sort values
$search = '';
$sort_by = 'id'; // Default sorting by student ID

// Handle search functionality
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = $_GET['search'];
    $search = "%" . $search . "%"; // Wildcards for search query
} else {
    $search = "%"; // Default to show all students if no search term is provided
}

// Handle sorting functionality
if (isset($_GET['sort_by'])) {
    $sort_by = $_GET['sort_by'];
}

// Define allowed sorting columns to prevent SQL injection
$allowed_sort_columns = ['name', 'marks'];
if (!in_array($sort_by, $allowed_sort_columns)) {
    $sort_by = 'id'; // Fallback to id if invalid column is provided
}

// Build the SQL query based on search and sort parameters
$sql = "SELECT * FROM students WHERE name LIKE ? OR roll_no LIKE ? ORDER BY $sort_by";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $search, $search); // Bind search query to both name and roll_no
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css"> <!-- Link to iOS-style CSS -->
</head>
<body>
    <div class="container">
        <h1>Welcome, <?php echo $_SESSION['user_name']; ?>!</h1>

        <!-- Button to Add New Student -->
        <a href="add_student.php"><button>Add Student</button></a>

        <!-- Search form -->
        <form method="GET" action="dashboard.php" class="search-form">
            <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="Search by name or roll number" />
            <button type="submit">Search</button>
        </form>

        <!-- Sorting options -->
        <div class="sorting">
            <a href="dashboard.php?sort_by=name"><button>Sort by Name</button></a>
            <a href="dashboard.php?sort_by=marks"><button>Sort by Marks</button></a>
        </div>

        <!-- Display students table -->
        <h2>All Students</h2>

        <!-- Table for displaying students -->
        <div class="table-container">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Roll No</th>
                    <th>Email</th>
                    <th>Marks</th>
                    <th>Department</th>
                    <th>Actions</th>
                </tr>
                <?php
                if ($result->num_rows > 0) {
                    // Loop through all students and display them
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row['id'] . "</td>
                                <td>" . $row['name'] . "</td>
                                <td>" . $row['roll_no'] . "</td>
                                <td>" . $row['email'] . "</td>
                                <td>" . $row['marks'] . "</td>
                                <td>" . $row['department'] . "</td>
                                <td>
                                    <a href='edit_student.php?id=" . $row['id'] . "'><button>Edit</button></a>
                                    <a href='delete_student.php?id=" . $row['id'] . "'><button>Delete</button></a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No students found</td></tr>";
                }
                ?>
            </table>
        </div>

        <!-- Logout Button -->
        <a href="logout.php"><button>Logout</button></a>
    </div>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
