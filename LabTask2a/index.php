<?php
// Student Data: Using associative array for each student
$students = [
    [
        'name' => 'Ali',
        'age' => '20 years', // Age is in string format
        'marks' => '78,65,90,55,88',
        'status' => ''
    ],
    [
        'name' => 'Ayesha',
        'age' => '21 years',
        'marks' => '90,85,92,80,88',
        'status' => ''
    ],
    [
        'name' => 'Bilal',
        'age' => '21 years',
        'marks' => '30,45,28,40,35',
        'status' => ''
    ]
];

// Function to process marks and calculate total, average, and status
function processStudentData(&$students) {
    foreach ($students as &$student) {
        // 1. Age Casting (Converting age to integer)
        $student['age'] = (int) filter_var($student['age'], FILTER_SANITIZE_NUMBER_INT);
        
        // 2. Marks Processing (Converting marks into an array)
        $marks = explode(',', $student['marks']);
        $student['marks'] = array_map('intval', $marks); // Convert marks to integers
        
        // 3. Calculate Total and Average
        $totalMarks = array_sum($student['marks']);
        $average = $totalMarks / count($student['marks']);
        
        // 4. Update status based on average
        if ($average >= 80) {
            $student['status'] = 'Excellent';
        } elseif ($average >= 60) {
            $student['status'] = 'Good';
        } elseif ($average >= 40) {
            $student['status'] = 'Pass';
        } else {
            $student['status'] = 'Fail';
        }
        
        // Add Average and Message to the student array
        $student['average'] = $average;
        $student['message'] = getMessageBasedOnStatus($student['status']);
    }
}

// Function to get message based on status
function getMessageBasedOnStatus($status) {
    switch ($status) {
        case 'Excellent':
            return "Awarded Scholarship";
        case 'Good':
            return "Can Apply for Internship";
        case 'Pass':
            return "Needs Improvement";
        case 'Fail':
            return "Repeat Semester";
    }
}

// Process the students' data
processStudentData($students);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Information</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Student Information</h1>
        <table>
            <tr>
                <th>Name</th>
                <th>Age</th>
                <th>Marks</th>
                <th>Average</th>
                <th>Status</th>
                <th>Message</th>
            </tr>

            <?php foreach ($students as $student): ?>
            <tr>
                <td><?php echo $student['name']; ?></td>
                <td><?php echo $student['age']; ?></td>
                <td><?php echo implode(', ', $student['marks']); ?></td>
                <td><?php echo number_format($student['average'], 2); ?></td>
                <td><?php echo $student['status']; ?></td>
                <td><?php echo $student['message']; ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>
