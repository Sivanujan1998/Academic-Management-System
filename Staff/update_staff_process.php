<?php
session_start();

// Include your database connection file
include_once("../db_connection.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $staffId = $_POST["id"];
    $name = $_POST["name"];
    $jobTitle = $_POST["job_title"];
    $salary = $_POST["salary"];

    // Update data in the database
    $updatesql = "UPDATE staff SET name = '$name', job_title = '$jobTitle', salary = '$salary' WHERE staff_id = '$staffId'";
    
    if ($conn->query($updatesql) === TRUE) {
        // Success: Redirect to staff_details.php with a success message
        header("Location: staff_details.php?id=$staffId&success=Staff member updated successfully");
        exit();
    } else {
        // Error: Redirect to staff_details.php with an error message
        header("Location: staff_details.php?id=$staffId&error=Error updating staff member");
        exit();
    }
} else {
    // Redirect to staff_details.php if the form is not submitted
    header("Location: staff_details.php");
    exit();
}

// Close the database connection
$conn->close();
?>
