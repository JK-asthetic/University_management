<?php
session_start();
include("../../php_files/Database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve necessary data from POST   
    $student_id =  $_SESSION['student_id'] ?? null;
    $pass = $_POST['pass'] ?? null;

    // Ensure that all required fields are not null
    if ($student_id && $pass !== null) {

        // Use prepared statement to prevent SQL injection
        $update_sql = "UPDATE `student` SET `password`= ? WHERE student_id = ?;";
        $update_stmt = mysqli_prepare($conn, $update_sql);
        
        // Bind parameters
        mysqli_stmt_bind_param($update_stmt, "si", $pass, $student_id);

        // Execute the update statement
        if (mysqli_stmt_execute($update_stmt)) {
            $_SESSION["status"] = "Success";
            $_SESSION["text"] = "Data successfully updated";
            unset($_SESSION['student_id']);
            header("Location: student_update_1.php");
            exit();
        } else {
            $_SESSION["status"] = "error";
            $_SESSION["text"] = "An error occurred while updating the data. Please try again later.";
        }
        mysqli_stmt_close($update_stmt);
    } else {
        $_SESSION["status"] = "error";
        $_SESSION["text"] = "Please enter valid values for all fields";
    }
} else {
    $_SESSION["status"] = "error";
    $_SESSION["text"] = "Invalid request method";
}

// Redirect to appropriate page
header("Location: student_update_1.php");
exit();
?>
