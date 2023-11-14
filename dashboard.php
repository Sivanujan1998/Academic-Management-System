<?php
session_start();

// Redirect to index.php if user is not logged in
if (!isset($_SESSION['id'])) {
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Academic Management System</title>
    <link rel="stylesheet" href="Style/dashboard.css">
</head>
<body>
    <div class="container">
        <div>
            <h1>Welcome, <?php echo $_SESSION['full_name']; ?> to the Dashboard</h1>
            <div class="buttons">
                <a href="Department/department_details.php">Department Details</a>
                <a href="Staff/staff_details.php">Staff Details</a>
                <form action="logout.php" method="post">
                    <button id="logout" type="submit">Logout</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
