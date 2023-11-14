<?php
// Include your database connection file
include_once("../db_connection.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $job_title = $_POST["job_title"];
    $salary = $_POST["salary"];

    // Validate data (perform more validation as needed)
    if (empty($name) || empty($job_title) || empty($salary)) {
        // Handle validation error (redirect back to the form with an error message, for example)
        header("Location: staff.php?error=Please fill in all fields");
        exit();
    }

    // Insert data into the database
    $sql = "INSERT INTO staff (name, job_title, salary) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $job_title, $salary);

    if ($stmt->execute()) {
        // Success: Redirect to staff_details.php with a success message
        header("Location: staff_details.php?success=Staff member added successfully");
        exit();
    } else {
        // Error: Redirect to staff_details.php with an error message
        header("Location: staff_details.php?error=Error adding staff member");
        exit();
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
} else {
    // Redirect to staff_details.php if the form is not submitted
    header("Location: staff_details.php");
    exit();
}
?>
