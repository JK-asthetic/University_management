<?php
session_start();
include("../../php_files/Database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve necessary data from POST    
    $id = isset($_SESSION['lecturer_id']) ? substr($_SESSION['lecturer_id'], -3) : null;
    $room = $_POST['room_no'] ?? null;
    $school_id = $_POST['school_id'] ?? null;
    $title = $_POST['title'] ?? null;
    $supervisor_id = $_POST['sup_id'] ?? null;

    // Ensure that all required fields are not null
    if ($id && $room && $school_id && $title !== null) {

        // Use prepared statement to prevent SQL injection
        $update_sql = "UPDATE lecturer SET title = ?, office_room = ?, school_id = ?, supervisor_id = ? WHERE SUBSTRING(lecturer_id, -3) = ?;";
        $update_stmt = mysqli_prepare($conn, $update_sql);
        
        // Bind parameters
        mysqli_stmt_bind_param($update_stmt, "ssssi", $title, $room, $school_id, $supervisor_id, $id);

        // Execute the update statement
        if (mysqli_stmt_execute($update_stmt)) {
            $_SESSION["status"] = "Success";
            $_SESSION["text"] = "Data successfully updated";
            unset($_SESSION['lecturer_id']);
            header("Location: lecturer_update_1.php");
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
header("Location: lecturer_update_1.php");
exit();
?>
