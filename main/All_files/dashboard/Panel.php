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
            <li class="active"><a href="Panel.php"><i class='bx bxs-dashboard'></i>Dashboard</a></li>
            <li><a href="Campus.php"><i class='bx bx-store-alt'></i>Campus</a></li>
            <li><a href="Student.php"><i class='bx bx-group' ></i>Student</a></li>
            <li><a href="lecturer.php"><i class='bx bxs-user-voice' ></i>Lecturer</a></li>
            <li><a href="clubs.php"><i class='bx bx-cricket-ball' ></i>Clubs</a></li>
            <li><a href="committee.php"><i class='bx bx-chat' ></i>committee</a></li>
            <li><a href="programme.php"><i class='bx bxs-book' ></i>Programme</a></li>
            <li><a href="course.php"><i class='bx bx-book-open' ></i>Course</a></li>
            <li><a href="school.php"><i class='bx bxs-school' ></i>School</a></li>
            <li><a href="faculty.php"><i class='bx bxs-user-rectangle' ></i>Faculty</a></li>
            <li><a href="exam.php"><i class='bx bxs-user-rectangle' ></i>Exam</a></li>

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
                    <h1>Dashboard</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">
                                GLAUniv
                            </a></li>
                        /
                        <li><a href="#" class="active">Dashboard</a></li>
                    </ul>
                </div>
                <a href="#" class="report">
                    <i class='bx bx-cloud-download'></i>
                    <span>Download CSV</span>
                </a>
            </div>

            <!-- Insights -->
            <ul class="insights">
                <li>
                    <i class='bx bx-calendar-check'></i>
                    <span class="info">
                        <h3>
                            <?php
                                $Campus_count = "SELECT count(*) as count FROM Campus";
                                $Campus_count_run = mysqli_query($conn, $Campus_count);
                                if(mysqli_num_rows($Campus_count_run) > 0)
                                {
                                    $row = mysqli_fetch_array($Campus_count_run);
                                    echo $row['count'];
                                }
                            ?>
                        </h3>
                        <p>Total Campus</p>
                    </span>
                </li>
                <li><i class='bx bx-show-alt'></i>
                    <span class="info">
                        <h3>
                            <?php
                                $Campus_count = "SELECT count(*) as count FROM Student";
                                $Campus_count_run = mysqli_query($conn, $Campus_count);
                                if(mysqli_num_rows($Campus_count_run) > 0)
                                {
                                    $row = mysqli_fetch_array($Campus_count_run);
                                    echo $row['count'];
                                }
                            ?>
                        </h3>
                        <p>Total Student</p>
                    </span>
                </li>
                <li><i class='bx bx-line-chart'></i>
                    <span class="info">
                        <h3>
                            <?php
                                $Campus_count = "SELECT count(*) as count FROM club";
                                $Campus_count_run = mysqli_query($conn, $Campus_count);
                                if(mysqli_num_rows($Campus_count_run) > 0)
                                {
                                    $row = mysqli_fetch_array($Campus_count_run);
                                    echo $row['count'];
                                }
                            ?>
                        </h3>
                        <p>Total Clubs</p>
                    </span>
                </li>
                <li><i class='bx bx-dollar-circle'></i>
                    <span class="info">
                        <h3>
                            <?php
                                $Campus_count = "SELECT count(*) as count FROM Faculty";
                                $Campus_count_run = mysqli_query($conn, $Campus_count);
                                if(mysqli_num_rows($Campus_count_run) > 0)
                                {
                                    $row = mysqli_fetch_array($Campus_count_run);
                                    echo $row['count'];
                                }
                            ?>
                        </h3>
                        <p>Total Faculty</p>
                    </span>
                </li>
                <li><i class='bx bx-dollar-circle'></i>
                    <span class="info">
                        <h3>
                            <?php
                                $Campus_count = "SELECT count(*) as count FROM Course";
                                $Campus_count_run = mysqli_query($conn, $Campus_count);
                                if(mysqli_num_rows($Campus_count_run) > 0)
                                {
                                    $row = mysqli_fetch_array($Campus_count_run);
                                    echo $row['count'];
                                }
                            ?>
                        </h3>
                        <p>Total Courses</p>
                    </span>
                </li>

            </ul>
            <!-- End of Insights -->



            <div class="bottom-data">
                <div class="orders">
                    <div class="header">
                        <i class='bx bx-receipt'></i>
                        <h3>Recent Students</h3>
                        <i class='bx bx-filter'></i>
                        <i class='bx bx-search'></i>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Student Id</th>
                                <th>Student name</th>
                                <th>Programme Id</th>
                                <th>Admission date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $recent_student = "SELECT * FROM student ORDER BY enrolment_date DESC LIMIT 3"; // Assuming 'students' is your table name
                                $result = mysqli_query($conn, $recent_student);

                                if ($result) {
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo '<tr>';
                                            echo '<td>';
                                            echo '<img src="../../images/User.png">';
                                            echo '<p>' . $row['student_id'] . '</p>'; 
                                            echo '</td>';
                                            echo '<td>' . $row['student_name'] . '</td>'; 
                                            echo '<td>' . $row['programme_id'] . '</td>'; 
                                            echo '<td>' . $row['enrolment_date'] . '</td>'; 
                                            echo '</tr>'; 
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

            <div class="bottom-data">
                <div class="orders">
                    <div class="header">
                        <i class='bx bx-receipt'></i>
                        <h3>Recent Staff</h3>
                        <i class='bx bx-filter'></i>
                        <i class='bx bx-search'></i>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Lecturer ID</th>
                                <th>Lecturer Name</th>
                                <th>Title</th>
                                <th>Joining Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $recent_staff = "SELECT * FROM lecturer ORDER BY Joining_Date DESC LIMIT 3"; // Assuming 'students' is your table name
                                $result = mysqli_query($conn, $recent_staff);

                                if ($result) {
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo '<tr>';
                                            echo '<td>';
                                            echo '<img src="../../images/User.png">';
                                            echo '<p>' . $row['lecturer_id'] . '</p>'; 
                                            echo '</td>';
                                            echo '<td>' . $row['lecturer_name'] . '</td>'; 
                                            echo '<td>' . $row['title'] . '</td>'; 
                                            echo '<td>' . $row['Joining_Date'] . '</td>'; 
                                            echo '</tr>'; 
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


            <div class="bottom-data">
                <div class="orders">
                    <div class="header">
                        <i class='bx bx-receipt'></i>
                        <h3>Recent Clubs</h3>
                        <i class='bx bx-filter'></i>
                        <i class='bx bx-search'></i>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Club_Id</th>
                                <th>Club Name</th>
                                <th>Building Location</th>
                                <th>Day Created</th>
                            </tr>
                        </thead>
                        <tbody style="margin-right:50px">
                            <?php
                                $recent_club = "SELECT * FROM club ORDER BY Day_Created DESC LIMIT 3"; // Assuming 'students' is your table name
                                $result = mysqli_query($conn, $recent_club);

                                if ($result) {
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo '<tr>';
                                            echo '<td>';
                                            echo '<img src="../../images/User.png">';
                                            echo '<p>' . $row['club_id'] . '</p>'; 
                                            echo '</td>';
                                            echo '<td>' . $row['club_name'] . '</td>'; 
                                            echo '<td>' . $row['building_location'] . '</td>'; 
                                            echo '<td>' . $row['Day_Created'] . '</td>'; 
                                            echo '</tr>'; 
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
        </main>

    </div>
    <script src="../../Js_files/Slider.js"></script>

</body>

</html>


 