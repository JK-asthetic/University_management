<?php
session_start();
include("../../php_files/Database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve necessary data from POST    
    $id = isset($_SESSION['result_id']) ? substr($_SESSION['result_id'], -4) : null;
    $year = $_POST['year'] ?? null;
    $term = $_POST['term'] ?? null;
    $grade = $_POST['grade'] ?? null;

    if ($id && $year && $term && $grade !== null) {

        $update_sql = "UPDATE course_result SET year = ?, term = ?, grade = ? WHERE SUBSTRING(result_id, -4) = ?;";
        $update_stmt = mysqli_prepare($conn, $update_sql);

        mysqli_stmt_bind_param($update_stmt, "sssi", $year, $term, $grade, $id);

        if (mysqli_stmt_execute($update_stmt)) {
            $_SESSION["status"] = "Success";
            $_SESSION["text"] = "Data successfully updated";
            unset($_SESSION['result_id']);
            header("Location: exam_update_1.php");
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
header("Location: exam_update_1.php");
exit();
?>
