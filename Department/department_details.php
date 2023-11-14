<?php
session_start();

// Redirect to index.php if user is not logged in
if (!isset($_SESSION['id'])) {
    header('Location: ../index.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Department Management</title>
    <link rel="stylesheet" href="../Style/common.css">
</head>
<body>
    <h1><?php echo $_SESSION['full_name']; ?>'s Department Management</h1>

    <h2>Add New Department</h2>
    <form action="add_department_process.php" method="post">
    <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" required><br><br>

        <label for="address">Address:</label><br>
        <input type="text" id="address" name="address" required><br><br>

        <label for="hod">HOD ID:</label><br>
        <input type="text" id="hod" name="hod" required><br><br>

        <input type="submit" id="addstaffbtn" class="addstaff" value="Add Department">
    </form>

    <h2>Existing Department Records</h2>

    <?php
    // Check for success or error messages and display them
    if (isset($_GET['success'])) {
        echo '<p style="color: green;">' . $_GET['success'] . '</p>';
    } elseif (isset($_GET['error'])) {
        echo '<p style="color: red;">' . $_GET['error'] . '</p>';
    }
    ?>

    <table>
        <tr>
            <th>Department ID</th>
            <th>Name</th>
            <th>Address</th>
            <th>HOD ID</th>
            <th>Action</th>
        </tr>

        <?php

        // Include your database connection file
        include_once("../db_connection.php");

            // Fetch all staff records from the database for the current user
            $user_id = $_SESSION['id'];

            // Using prepared statement to avoid SQL injection
            $sql = "SELECT * FROM department WHERE user_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $user_id);  // Assuming user_id is an integer, adjust accordingly
            $stmt->execute();

            $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["dept_id"] . "</td>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["address"] . "</td>";
                echo "<td>" . $row["hod_id"] . "</td>";
                echo "<td>";
                echo '<div class="action">';
                echo '<button class="updatebutton" onclick="showUpdateComponent(' . $row["dept_id"] . ')">Update</button>';
                echo '<button class="deletebutton" onclick="deleteComponent(' . $row["dept_id"] . ')">Delete</button>';
                echo '</div>';
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No department records found</td></tr>";
        }

        // Close the database connection
        $conn->close();
        ?>

    </table>

    <button id="logout" onclick="javascript:window.location.href='../dashboard.php'" type="submit">Back to Dashboard</button>

    <script>
        function showUpdateComponent(dept_id) {
                      // Redirect to the update page with the staffID parameter
                      window.location.href = 'update_department.php?id=' + dept_id;
        }

        function deleteComponent(dept_id) {
            // Ask for confirmation before deleting
            var confirmDelete = confirm("Are you sure you want to delete this Department Data?");
            
            // If the user confirms, redirect to delete_department_process.php with the dept_id parameter
            if (confirmDelete) {
                window.location.href = 'delete_department_process.php?id=' + dept_id;
            }
        }

    </script>
</body>
</html>
