<?php

session_start();
include("../php_files/Database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve username and password from the form
    $username = $_POST["student_id"];
    $password = $_POST["password"];

    // Check if both fields are filled
    if (!empty($username) && !empty($password)) {
        // Prepare and execute SQL query to fetch password for the given username
        $id_search = "SELECT password FROM student WHERE student_id = '$username' LIMIT 1";
        $result = $conn->query($id_search);

        if ($result->num_rows == 1) {
            // Fetch the hashed password from the result
            $row = $result->fetch_assoc();
            $hashed_password = $row['password'];

            // Verify password
            if ($password == $hashed_password) {
                $_SESSION["loggedin"] = true; 
                $_SESSION["User_id"] = $username;
                header("Location: main.php");
                exit();
            } else {
                // Password is incorrect
                $_SESSION['status'] = 'error';
                $_SESSION['text'] = "Incorrect ID or password";
                header("Location: Student_login_page.php"); // Redirect to login page
                exit();
            }
        } else {
            // No student found with the given username
            $_SESSION['status'] = 'error';
            $_SESSION['text'] = "No student with the given username";
            header("Location: Student_login_page.php"); // Redirect to login page
            exit();
        }
    } else {
        // Username or password is empty
        $_SESSION['status'] = 'error';
        $_SESSION['text'] = "Username or password cannot be empty";
        header("Location: Student_login_page.php"); // Redirect to login page
        exit();
    }
} else {
    // If request method is not POST, redirect to login page
    header("Location: Student_login_page.php");
    exit();
}
?>