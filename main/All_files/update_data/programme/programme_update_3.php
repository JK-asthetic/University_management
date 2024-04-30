<?php
session_start();
include("../../php_files/Database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve necessary data from POST   
    $programme_id =  $_SESSION['programme_id'] ?? null;
    $title = $_POST['title'] ?? null;
    $duration = $_POST['duration'] ?? null;
    $level = $_POST['level'] ?? null;
    $code = $_POST['code'] ?? null;

    // Ensure that all required fields are not null
    if ($programme_id && $title && $duration && $level && $code !== null) {

        // Use prepared statement to prevent SQL injection
        $update_sql = "UPDATE `programme` SET `programme_code`= ?,`programme_title`=?,`level`=?,`duration`=? WHERE programme_id = ?;";
        $update_stmt = mysqli_prepare($conn, $update_sql);
        
        // Bind parameters
        mysqli_stmt_bind_param($update_stmt, "ssssi", $code, $title, $level, $duration, $programme_id);

        // Execute the update statement
        if (mysqli_stmt_execute($update_stmt)) {
            $_SESSION["status"] = "Success";
            $_SESSION["text"] = "Data successfully updated";
            unset($_SESSION['programme_id']);
            header("Location: programme_update_1.php");
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
header("Location: programme_update_1.php");
exit();
?>
