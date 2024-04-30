<?php
session_start();
include("../../php_files/Database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve necessary data from POST    
    $id = $_SESSION['school_id'] ?? null;
    $location = $_POST['location'] ?? null;
    $name = $_POST['name'] ?? null;

    // Ensure that all required fields are not null
    if ($id && $location && $name !== null) {

        // Use prepared statement to prevent SQL injection
        $update_sql = "UPDATE school SET school_name = ?, building_location = ? WHERE school_id = ?;";
        $update_stmt = mysqli_prepare($conn, $update_sql);
        
        // Bind parameters
        mysqli_stmt_bind_param($update_stmt, "ssi", $name, $location, $id);

        // Execute the update statement
        if (mysqli_stmt_execute($update_stmt)) {
            $_SESSION["status"] = "Success";
            $_SESSION["text"] = "Data successfully updated";
            unset($_SESSION['school_id']);
            header("Location: school_update_1.php");
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
header("Location: school_update_1.php");
exit();
?>
