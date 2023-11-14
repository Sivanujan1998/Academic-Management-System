<?php
include 'db_connection.php';

$full_name = $_POST['full_name'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

// Check if the email already exists
$sql_check_email = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($sql_check_email);

if ($result->num_rows > 0) {
    session_start();
    $_SESSION['error_message'] = "An account with this email already exists";
    header('Location: index.php');
    exit(); // Stop further execution
}

if ($password !== $confirm_password) {
    session_start();
    $_SESSION['error_message'] = "Passwords do not match";
    header('Location: index.php');
    exit(); // Stop further execution
}

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO users (full_name, email, password) VALUES ('$full_name', '$email', '$hashed_password')";

if ($conn->query($sql) === TRUE) {
    session_start();
    $_SESSION['success_message'] = "Account created successfully";
    header('Location: index.php');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
