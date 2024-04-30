<?php
session_start();
if(isset($_SESSION['status'])){
    include('../php_files/status.php');
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="../../css files/Login_page.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <style>
    </style>
</head>

<body>
    <div class="login-section">
        <div class="formbox">
            <form action="Student_login.php" method="post">
                <i class='bx bxs-user' id="usericon"></i>
                <h2>Student Sign In</h2>
                <div class="input-box">
                    <span class="icon">
                        <i class='bx bxs-envelope'></i>
                    </span>
                    <input type="text" id="user" name="student_id" required>
                    <label for="user">User id </label>
                </div>

                <div class="input-box">
                    <span class="icon">
                        <i class='bx bxs-lock-alt'></i>
                    </span>
                    <input type="password" id="password" name="password" required>
                    <label for="password">Password</label>
                </div>

                <div class="remember-password">
                    <label for="remember">
                        <input type="checkbox" name="remember" id="remember">Remember Me
                    </label>
                    <a href="#">Forgot Password ?</a>
                </div>
                <button type="submit" class="btn">Log In</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>
