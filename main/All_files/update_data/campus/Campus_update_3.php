<?php
session_start();
include("../../php_files/Database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve necessary data from POST
    $id = $_SESSION['campus_id'] ?? null;
    $name = $_POST['Campus_name'] ?? null;
    $address = $_POST['address'] ?? null;
    $route = $_POST['Bus_route'] ?? null;
    $distance = $_POST['distance'] ?? null;

    // Ensure that all required fields are not null
    if ($id && $name && $address && $route && $distance !== null) {

        // Use prepared statement to prevent SQL injection
        $update_sql = "UPDATE campus SET campus_name = ?, address = ?, distance_to_city_center = ?, bus_route = ? WHERE campus_id = ?";
        $update_stmt = mysqli_prepare($conn, $update_sql);
        
        // Bind parameters
        mysqli_stmt_bind_param($update_stmt, "ssssi", $name, $address, $distance, $route, $id);

        // Execute the update statement
        if (mysqli_stmt_execute($update_stmt)) {
            $_SESSION["status"] = "Success";
            $_SESSION["text"] = "Data successfully updated";
            unset($_SESSION['campus_id']);
            header("Location: Campus_update_1.php");
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
header("Location: Campus_update_1.php");
exit();
?>
