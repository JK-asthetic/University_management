<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
session_start();
include("../php_files/Database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $exam_prefix = "EXAM";
    $starting_number = 1001;

    $sql_check_empty = "SELECT COUNT(*) as count FROM course_result";
    $result_check_empty = $conn->query($sql_check_empty);

    if ($result_check_empty) {
        $row = $result_check_empty->fetch_assoc();
        if ($row['count'] == 0) {
            $exam_id = $exam_prefix . $starting_number;
        } else {
            $sql_get_latest_id = "SELECT MAX(result_id) as max_id FROM course_result";
            $result_get_latest_id = $conn->query($sql_get_latest_id);
            $row_latest_id = $result_get_latest_id->fetch_assoc();
            $latest_id = $row_latest_id['max_id'];
            $latest_number = intval(substr($latest_id, strlen($exam_prefix)));
            $next_number = $latest_number + 1;
            $exam_id = $exam_prefix . $next_number;
        }
    }

    $year = $_SESSION['year'];
    $term = $_SESSION['term'];
    $grade = $_POST['grade'];
    $student_id = $_SESSION["student_id"];
    $course_id = $_POST["course_id"];


    if (isset($year) && isset($grade) && isset($term) && isset($student_id) && isset($course_id) && isset($exam_id)){
        $sql = "INSERT INTO course_result (`result_id`, `student_id`, `course_id`, `year`, `term`, `grade`) VALUES ('$exam_id', '$student_id', '$course_id', '$year', '$term', '$grade')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $_SESSION["status"] = "Success";
            $_SESSION["text"] = "Data Successfully recorded";

            unset($_SESSION['year']);
            unset($_SESSION['term']);
            unset($_SESSION['student_id']);
            header("Location:exam_add.php");

        } else {
            $_SESSION["status"] = "error";
            $_SESSION["text"] = "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Error";
        $_SESSION["status"] = "error";
        $_SESSION["text"] = "Some error occurred";
    }
}


?>