<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Academic Management System</title>
    <link rel="stylesheet" href="Style/index.css">
</head>
<body>
    <div class="container">
        <h1>Welcome to the Academic Management System</h1>
        <div class="options">
            <button class="button1" onclick="showSignInForm()">Sign In</button>
            <button class="button2" onclick="showSignUpForm()">Sign Up</button>
        </div>

        <?php if(isset($_SESSION['error_message'])) { ?>
                <p style="color: red;"><?php echo $_SESSION['error_message']; ?></p>
                <?php unset($_SESSION['error_message']); ?>
        <?php } ?>

        <?php if(isset($_SESSION['success_message'])) { ?>
                <p style="color: green;"><?php echo $_SESSION['success_message']; ?></p>
                <?php unset($_SESSION['success_message']); ?>
        <?php } ?>

        <div id="signInForm" class="form-container" style="display: none;">
            <h2>Sign In</h2>
            <form action="login.php" method="post">
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <br>
                <button class="index_button1" type="submit">Sign In</button>
            </form>
        </div>

        <div id="signUpForm" class="form-container" style="display: none;">
            <h2>Sign Up</h2>
            <form action="register.php" method="post">
                <input type="text" name="full_name" placeholder="Organization Full Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="password" name="confirm_password" placeholder="Re-enter Password" required>
                <br>
                <button class="index_button2" type="submit">Sign Up</button>
            </form>
        </div>
    </div>

    <script>
        function showSignInForm() {
            document.getElementById("signInForm").style.display = "block";
            document.getElementById("signUpForm").style.display = "none";
        }

        function showSignUpForm() {
            document.getElementById("signUpForm").style.display = "block";
            document.getElementById("signInForm").style.display = "none";
        }
    </script>
</body>
</html>
