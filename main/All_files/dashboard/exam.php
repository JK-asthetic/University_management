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
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../../css files/Panel.css">

    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

    <title>Administration Panel</title>

    <!--=============== CSS Search ===============-->
    <link rel="stylesheet" href="../../css files/search.css">
</head>

<body class="dark">

    <!-- Sidebar -->
    <div class="sidebar">
        <a href="#" class="logo">
            <i class='bx bxs-graduation'></i>
            <div class="logo-name"><span>GLA</span>Univ</div>
        </a>
        <ul class="side-menu">
            <li><a href="Panel.php"><i class='bx bxs-dashboard'></i>Dashboard</a></li>
            <li ><a href="Campus.php"><i class='bx bx-store-alt'></i>Campus</a></li>
            <li><a href="Student.php"><i class='bx bx-group' ></i>Student</a></li>
            <li><a href="lecturer.php"><i class='bx bxs-user-voice' ></i>Lecturer</a></li>
            <li><a href="clubs.php"><i class='bx bx-cricket-ball' ></i>Clubs</a></li>
            <li><a href="committee.php"><i class='bx bx-chat' ></i>committee</a></li>
            <li><a href="programme.php"><i class='bx bxs-book' ></i>Programme</a></li>
            <li><a href="course.php"><i class='bx bx-book-open' ></i>Course</a></li>
            <li><a href="school.php"><i class='bx bxs-school' ></i>School</a></li>
            <li><a href="faculty.php"><i class='bx bxs-user-rectangle' ></i>Faculty</a></li>
            <li class="active"><a href="exam.php"><i class='bx bxs-user-rectangle' ></i>Exam</a></li>


        </ul>
        <ul class="side-menu">
            <li>
                <a href="Logout.php" class="logout">
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
                    <h1>Clubs</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">
                                GLAUniv
                            </a></li>
                        /
                        <li><a href="#" class="active">Exam Result</a></li>
                    </ul>
                </div>
            </div>

            <!--    cards     -->
            <ul class="insights">
                <li>
                    <a href="../Add_data/exam_add.php">
                        <i class='bx bx-user-plus' style="width:350px" ></i>
                        <span class="info" style="font-size:30px;">
                            <p style="padding:10px 10px">Add Exam result</p>
                        </span>
                    </a>
                </li>
                <li>
                    <a href="../update_data/exam/exam_update_1.php">
                        <i class='bx bx-duplicate' style="width:350px"></i>
                        <span class="info" style="font-size:30px;">
                            <p style="padding:10px 10px">Update Exam result</p>
                        </span>
                    </a>
                </li>
                <li>
                    <a href="../View/exam_view.php">
                        <i class='bx bx-show-alt' style="width:350px"></i>
                        <span class="info" style="font-size:30px;">
                            <p style="padding:10px 10px">View Exam result</p>
                        </span>
                    </a>
                </li>
            </ul>


            <div class="bottom-data">
                <div class="orders">
                    <div class="header">
                        <i class='bx bx-receipt'></i>
                        <h3>All Exam Entry Details</h3>
                        <form action="https://www.google.com/search" class="search" id="search-bar">
                            <input type="search" placeholder="Type something..." name="q" class="search__input">
                
                            <div class="search__button" id="search-button">
                                <i class="ri-search-2-line search__icon"></i>
                                <i class="ri-close-line search__close"></i>
                            </div>
                        </form>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Result ID</th>
                                <th>Student ID</th>
                                <th>Course ID</th>
                                <th>Grade</th>
                            </tr>
                        </thead>
                        <tbody style="margin-right:50px">
                            <?php
                                $recent_club = "SELECT * FROM course_result LIMIT 3"; // Assuming 'students' is your table name
                                $result = mysqli_query($conn, $recent_club);

                                if ($result) {
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo '<tr>';
                                            echo '<td>';
                                            echo '<img src="../../images/User.png">';
                                            echo '<p>' . $row['result_id'] . '</p>'; 
                                            echo '</td>';
                                            echo '<td>' . $row['student_id'] . '</td>'; 
                                            echo '<td>' . $row['course_id'] . '</td>'; 
                                            echo '<td>' . $row['grade'] . '</td>'; 
                                            echo '</tr>'; 
                                        }
                                    }
                                     else {
                                        echo '<tr><td colspan="3">No Exam Records found.</td></tr>';
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

        </main>

    </div>
    <script src="../../Js_files/Slider.js"></script>
    <script src="../../Js_files/search.js"></script>

</body>

</html>

