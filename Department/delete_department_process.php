<?php
session_start();

// Include your database connection file
include_once("../db_connection.php");

// Check if the department ID is provided in the URL
if (isset($_GET['id'])) {
    $departmentId = mysqli_real_escape_string($conn, $_GET['id']);

    // Check if the department with the provided ID exists
    $checkDepartment = "SELECT * FROM department WHERE dept_id = '$departmentId'";
    $result = $conn->query($checkDepartment);

    if ($result->num_rows > 0) {
        // Department exists, proceed with deletion
        $deleteDepartment = "DELETE FROM department WHERE dept_id = '$departmentId'";

        if ($conn->query($deleteDepartment) === TRUE) {
            // Successful deletion: Redirect to department_details.php with success message
            header("Location: department_details.php?success=Department deleted successfully");
            exit();
        } else {
            // Error in deletion: Redirect to department_details.php with error message
            header("Location: department_details.php?error=Error deleting department");
            exit();
        }
    } else {
        // Department doesn't exist: Redirect to department_details.php with error message
        header("Location: department_details.php?error=Department not found");
        exit();
    }
} else {
    // Department ID not provided: Redirect to department_details.php
    header("Location: department_details.php");
    exit();
}

// Close the database connection
$conn->close();
?>
