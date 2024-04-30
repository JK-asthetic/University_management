<?php
// Start session to store user login status
session_start();

$correct_username = "Student";
$correct_password = "123";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["User"];
    $password = $_POST["password"];
    
    if ($username === $correct_username && $password === $correct_password) {
        $_SESSION["loggedin"] = true; 
        header("Location: ../dashboard/Panel.php");
        exit;
    } else {
        echo "Incorrect username or password";
    }
}
?>
