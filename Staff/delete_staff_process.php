<?php
// Include your database connection file
include_once("../db_connection.php");

// Check if the staff ID is provided
if (isset($_GET['id'])) {
    // Sanitize the input to prevent SQL injection
    $staffId = mysqli_real_escape_string($conn, $_GET['id']);

    // Perform the deletion
    $sql = "DELETE FROM staff WHERE staff_id = '$staffId' AND user_id='$_SESSION['id']'";
    if ($conn->query($sql) === TRUE) {
        // Deletion successful: Redirect to staff_details.php with a success message
        header("Location: staff_details.php?success=Staff member deleted successfully");
        exit();
    } else {
        // Error: Redirect to staff_details.php with an error message
        header("Location: staff_details.php?error=This staff member is assigned to one or more departments. Please remove the association with departments before deleting.");
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
