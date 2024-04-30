<?php
session_start();
if(!isset($_SESSION["loggedin"])){
    header("Location:../Admin_login/Login_page.html");
    exit();
}

include("../php_files/Database.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="../../css files/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css files/Panel.css">
    <link rel="stylesheet" href="../../css files/Student_box.css">

    <title>Administration Panel</title>
</head>

<body class="dark">

    <!-- Sidebar -->
    <div class="sidebar">
        <a href="#" class="logo">
            <i class='bx bxs-graduation'></i>
            <div class="logo-name"><span>GLA</span>Univ</div>
        </a>
        <ul class="side-menu">
            <li><a href="main.php"><i class='bx bxs-dashboard'></i>Dashboard</a></li>
            <li><a href="programme.php"><i class='bx bxs-book'></i>Programme</a></li>
            <li class="active"><a href="result.php"><i class='bx bx-dock-right'></i>Result</a></li>
        </ul>
        <ul class="side-menu">
            <li>
                <a href="../dashboard/Logout.php" class="logout">
                    <i class='bx bx-log-out-circle'></i>
                    Logout
                </a>
            </li>
        </ul>
    </div>
    <!-- End of Sidebar -->

    <!-- Main Content -->
    <div class="content">
        <!-- Navbar -->
        <nav>
            <i class='bx bx-menu'></i>
            <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Search...">
                    <button class="search-btn" type="submit"><i class='bx bx-search'></i></button>
                </div>
            </form>
            
        </nav>

        <!-- End of Navbar -->

        <main>
            <div class="header">
                <div class="left">
                    <h1>Dashboard</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">
                                GLAUniv
                            </a></li>
                        /
                        <li><a href="#" class="active">Result</a></li>
                    </ul>
                </div>
            </div>

            
            

            <div class="bottom-data" style="margin-left:10px;">
                <div class="orders">
                    <div class="header">
                        <i class='bx bx-receipt'></i>
                        <h3>Result Details</h3>
                        <i class='bx bx-filter'></i>
                        <i class='bx bx-search'></i>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Result ID</th>
                                <th>Course ID</th>
                                <th>Term</th>
                                <th>Grade</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $id = $_SESSION["User_id"];
                                $student = "SELECT * FROM course_result WHERE student_id = '$id' ORDER BY term";// Assuming 'students' is your table name
                                $result = mysqli_query($conn, $student);
                                $grade_array = array();
                                if ($result) {
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo '<tr>';
                                            echo '<td>';
                                            echo '<img src="../../images/User.png">';
                                            echo '<p>' . $row['result_id'] . '</p>'; 
                                            echo '</td>';
                                            echo '<td>' . $row['course_id'] . '</td>'; 
                                            echo '<td>' . $row['term'] . '</td>'; 
                                            echo '<td>' . $row['grade'] . '</td>'; 
                                            echo '</tr>'; 

                                            $gradeArray[] = $row['grade'];
                                        }
                                    }
                                     else {
                                        echo '<tr><td colspan="3">No recent students found.</td></tr>';
                                    }
                                    mysqli_free_result($result);
                                } else {
                                    echo 'Error: ' . mysqli_error($connection);
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <ul class="insights">
                <li>
                    <i class='bx bx-calendar-check'></i>
                    <span class="info">
                        <h3>
                            <?php
                                
                                // Function to calculate overall grade
                                function calculateOverallGrade($gradeArray) {
                                    // Define grade points for each grade
                                    $gradePoints = array(
                                        'A' => 4.0,
                                        'B' => 3.0,
                                        'C' => 2.0,
                                        'D' => 1.0,
                                        'F' => 0.0
                                    );

                                    $totalGradePoints = 0;
                                    $totalCourses = count($gradeArray);

                                    // Calculate total grade points
                                    foreach ($gradeArray as $grade) {
                                        if (isset($gradePoints[$grade])) {
                                            $totalGradePoints += $gradePoints[$grade];
                                        } else {
                                            // Handle invalid grades if needed
                                            // For simplicity, consider it as F grade
                                            $totalGradePoints += $gradePoints['F'];
                                        }
                                    }

                                    // Calculate overall GPA
                                    $overallGPA = $totalGradePoints / $totalCourses;

                                    // Determine overall grade based on GPA
                                    if ($overallGPA >= 3.5) {
                                        return 'A';
                                    } elseif ($overallGPA >= 2.5) {
                                        return 'B';
                                    } elseif ($overallGPA >= 1.5) {
                                        return 'C';
                                    } elseif ($overallGPA >= 0.5) {
                                        return 'D';
                                    } else {
                                        return 'F';
                                    }
                                }

                                // Example usage with $gradeArray
                                $overallGrade = calculateOverallGrade($gradeArray);
                                echo $overallGrade;

                            ?>
                        </h3>
                        <p>Overall Grade</p>
                    </span>
                </li>
                <li><i class='bx bx-show-alt'></i>
                    <span class="info">
                        <h3>
                            <?php

                                function determinePassOrFail($overallGrade) {
                                    $passingGrade = 'D'; // Change this if needed
                                
                                    if ($overallGrade <= $passingGrade) {
                                        return 'Pass';
                                    } else {
                                        return 'Fail';
                                    }
                                }
                                
                                $result = determinePassOrFail($overallGrade);
                                echo $result;
                            ?>
                        </h3>
                        <p>Overall Status</p>
                    </span>
                </li>
                <li><i class='bx bx-line-chart'></i>
                    <span class="info">
                        <h3>
                            <?php
                                // Function to determine performance
                                function determinePerformance($overallGrade) {
                                    // Define performance descriptors based on grades
                                    $performanceDescriptors = array(
                                        'A' => 'Excellent',
                                        'B' => 'Good',
                                        'C' => 'Satisfactory',
                                        'D' => 'Needs Improvement',
                                        'F' => 'Poor'
                                    );

                                    // Check if overall grade has a corresponding performance descriptor
                                    if (isset($performanceDescriptors[$overallGrade])) {
                                        return $performanceDescriptors[$overallGrade];
                                    } else {
                                        return 'Unknown'; // Handle unknown grades if needed
                                    }
                                }

                                // Example usage with $overallGrade
                                $performance = determinePerformance($overallGrade);
                                echo $performance;

                            ?>
                        </h3>
                        <p>Performance</p>
                    </span>
                </li>

            </ul>

        </main>

    </div>
    <script src="../../Js_files/Slider.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>




 