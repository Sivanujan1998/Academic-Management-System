<?php
session_start();
include 'db_connection.php';

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT id, full_name, email, password FROM users WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        $_SESSION['id'] = $row['id'];
        $_SESSION['full_name'] = $row['full_name'];
        $_SESSION['email'] = $row['email'];
        header('Location: dashboard.php');
    } else {
        $_SESSION['error_message'] = "Invalid password";
        header('Location: index.php');
    }
} else {
    $_SESSION['error_message'] = "User not found";
    header('Location: index.php');
}

$conn->close();
?>
