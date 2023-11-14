<?php
session_start();

// Include your database connection file
include_once("../db_connection.php");

// Check if the department ID is provided in the URL
if (!isset($_GET['id'])) {
    header("Location: department.php?error=Department ID not provided");
    exit();
}

$deptId = mysqli_real_escape_string($conn, $_GET['id']);

// Fetch the existing department data from the database
$sql = "SELECT * FROM department WHERE dept_id = '$deptId'";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    header("Location: department.php?error=Department not found");
    exit();
}

$departmentData = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Department</title>
    <link rel="stylesheet" href="../Style/common.css">
</head>
<Style>    
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }</Style>
<body>
<div class="updatestaff">
    <h2>Update Department</h2>

    <form action="update_department_process.php" method="post">
        <input class="input" type="hidden" name="dept_id" value="<?php echo $deptId; ?>">

        <label for="name">Name:</label><br>
        <input class="input" type="text" id="name" name="name" value="<?php echo $departmentData['name']; ?>" required><br><br>

        <label for="address">Address:</label><br>
        <input class="input" type="text" id="address" name="address" value="<?php echo $departmentData['address']; ?>" required><br><br>

        <label for="hod">HOD ID:</label><br>
        <input class="input" type="text" id="hod" name="hod" value="<?php echo $departmentData['hod_id']; ?>" required><br><br>

        <input type="submit" class="updatestaff"  value="Update Department">
    </form>

    <button class="backbutton" onclick="javascript:history.back()">Back</button>
</div>
</body>
</html>
