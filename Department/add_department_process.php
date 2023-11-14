<?php
session_start();

// Include your database connection file
include_once("../db_connection.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $address = $_POST["address"];
    $hodId = $_POST["hod"];
    $user_id =  $_POST["id"];

    // Check if the HOD ID exists in the staff table
    $hodIdCheck = "SELECT * FROM staff WHERE staff_id = '$hodId' AND user_id='$user_id'";
    $hodIdResult = $conn->query($hodIdCheck);

    if ($hodIdResult->num_rows == 0) {
        // If HOD ID doesn't exist, redirect with an error message
        header("Location: department_details.php?error=Invalid HOD ID");
        exit();
    }

    // Insert data into the department table
    $sql = "INSERT INTO department (name, address, hod_id, user_id) VALUES ('$name', '$address', '$hodId','$user_id')";

    if ($conn->query($sql) === TRUE) {
        // Success: Redirect to department_details.php with a success message
        header("Location: department_details.php?success=Department added successfully");
        exit();
    } else {
        // Error: Redirect to department_details.php with an error message
        header("Location: department_details.php?error=Error adding department");
        exit();
    }
} else {
    // Redirect to department_details.php if the form is not submitted
    header("Location: department_details.php");
    exit();
}

// Close the database connection
$conn->close();
?>
