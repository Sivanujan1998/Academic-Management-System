<?php
session_start();

// Include your database connection file
include_once("../db_connection.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input data
    $deptId = mysqli_real_escape_string($conn, $_POST['dept_id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $hodId = mysqli_real_escape_string($conn, $_POST['hod']);

    // Update department data in the database
    $updateDepartment = "UPDATE department SET name='$name', address='$address', hod_id='$hodId' WHERE dept_id='$deptId'";

    if ($conn->query($updateDepartment) === TRUE) {
        // Successful update: Redirect to department_details.php with success message
        header("Location: department_details.php?id=$deptId&success=Department updated successfully");
        exit();
    } else {
        // Error in update: Redirect to department_details.php with error message
        header("Location: department_details.php?id=$deptId&error=Invalid HOD ID");
        exit();
    }
} else {
    // If the form is not submitted, redirect to department_details.php
    header("Location: department_details.php");
    exit();
}

// Close the database connection
$conn->close();
?>
