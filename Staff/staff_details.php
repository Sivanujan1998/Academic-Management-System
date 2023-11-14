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
    <title>Staff Management</title>
    <link rel="stylesheet" href="../Style/common.css">
</head>
<body>
    <h1> <?php echo $_SESSION['full_name']; ?>'s Staff Management</h1>

        <div class="addcomponent">
        <h2>Add New Staff Member</h2>
        <form action="add_staff_process.php" method="post">
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name" required><br><br>

            <label for="jobTitle">Job Title:</label><br>
            <input type="text" id="jobTitle" name="job_title" required><br><br>

            <label for="salary">Salary:</label><br>
            <input type="number" id="salary" name="salary" required><br><br>

            <input type="submit" id="addstaffbtn" class="addstaff" value="Add Staff">
        </form>
        </div>



    <h2>Existing Staff Records</h2>
    
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
            <th>Staff ID</th>
            <th>Name</th>
            <th>Job Title</th>
            <th>Salary</th>
            <th>Action</th>
        </tr>
        <?php
            // Include your database connection file
            include_once("../db_connection.php");

            // Fetch all staff records from the database
            $sql = "SELECT * FROM staff";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["staff_id"] . "</td>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["job_title"] . "</td>";
                    echo "<td>" . $row["salary"] . "</td>";
                    echo "<td>";
                    echo '<div class="action">';
                    echo '<button class="updatebutton" onclick="showUpdateComponent(' . $row["staff_id"] . ')">Update</button>';
                    echo '<button class="deletebutton" onclick="deleteComponent(' . $row["staff_id"] . ')">Delete</button>';
                    echo '</div>';
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No staff records found</td></tr>";
            }

            // Close the database connection
            $conn->close();
            ?>
    </table>

            <button id="logout" onclick="javascript:window.location.href='../dashboard.php'" type="submit">Back to Dashboard</button>

    <script>
        function showUpdateComponent(staffID) {
                      // Redirect to the update page with the staffID parameter
                      window.location.href = 'update_staff.php?id=' + staffID;
        }

        function deleteComponent(staffID) {
            // Ask for confirmation before deleting
            var confirmDelete = confirm("Are you sure you want to delete this staff member?");
            
            // If the user confirms, redirect to delete_staff_process.php with the staffID parameter
            if (confirmDelete) {
                window.location.href = 'delete_staff_process.php?id=' + staffID;
            }
        }

    </script>
</body>
</html>

