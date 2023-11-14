<?php
session_start();
// Include your database connection file
include_once("../db_connection.php");

// Check if the staff ID is provided
if (isset($_GET['id'])) {
    // Sanitize the input to prevent SQL injection
    $staffId = mysqli_real_escape_string($conn, $_GET['id']);

    // Fetch the staff record from the database
    $sql = "SELECT * FROM staff WHERE staff_id = '$staffId'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $jobTitle = $row['job_title'];
        $salary = $row['salary'];
    } else {
        // If staff record is not found, redirect to staff_details.php
        header("Location: staff_details.php?error=Staff member not found");
        exit();
    }
} else {
    // If staff ID is not provided, redirect to staff_details.php
    header("Location: staff_details.php");
    exit();
}

// Close the database connection
$conn->close();
?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Management</title>
    <link rel="stylesheet" href="../Style/common.css">
    <Style>    
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }
    </Style>
</head>
<body>
    
<div class="updatestaff">

                <h2>Update Staff Member</h2>
                <form action="update_staff_process.php" method="post">
                <input type="hidden" name="id" value="<?php echo $staffId; ?>">
                
                <label for="name">Name:</label><br>
                <input type="text" id="name" name="name" value="<?php echo $name; ?>" required><br><br>

                <label for="jobTitle">Job Title:</label><br>
                <input type="text" id="jobTitle" name="job_title" value="<?php echo $jobTitle; ?>" required><br><br>

                <label for="salary">Salary:</label><br>
                <input type="number" id="salary" name="salary" value="<?php echo $salary; ?>" required><br><br>

                <input type="submit" class="updatestaff" value="Update Staff">
                <button class="backbutton" onclick="javascript:history.back()">Back</a>
    </form>
</div>
</body>
</html>