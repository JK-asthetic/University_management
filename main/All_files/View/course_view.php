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
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    
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
            <li><a href="../dashboard/Panel.php"><i class='bx bxs-dashboard'></i>Dashboard</a></li>
            <li><a href="../dashboard/Campus.php"><i class='bx bx-store-alt'></i>Campus</a></li>
            <li><a href="../dashboard/Student.php"><i class='bx bx-group' ></i>Student</a></li>
            <li><a href="../dashboard/lecturer.php"><i class='bx bxs-user-voice' ></i>Lecturer</a></li>
            <li><a href="../dashboard/clubs.php"><i class='bx bx-cricket-ball' ></i>Clubs</a></li>
            <li><a href="../dashboard/committee.php"><i class='bx bx-chat' ></i>committee</a></li>
            <li><a href="../dashboard/programme.php"><i class='bx bxs-book' ></i>Programme</a></li>
            <li   class="active"><a href="../dashboard/course.php"><i class='bx bx-book-open' ></i>Course</a></li>
            <li><a href="../dashboard/school.php"><i class='bx bxs-school' ></i>School</a></li>
            <li><a href="../dashboard/faculty.php"><i class='bx bxs-user-rectangle' ></i>Faculty</a></li>
            <li><a href="../dashboard/exam.php"><i class='bx bxs-user-rectangle' ></i>Exam</a></li>


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
                    <h1>Course</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">
                                GLAUniv
                            </a></li>
                        /
                        <li><a href="#"">Course</a></li>
                        /
                        <li><a href="#" class="active">View Detail</a></li>
                    </ul>
                </div>
            </div>

            

            <div class="bottom-data">
                <div class="orders">
                    <div class="header">
                        <i class='bx bx-receipt'></i>
                        <h3>All Course</h3>
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
                                <th>Course Id</th>
                                <th>Course Title</th>
                                <th>Course Code</th>
                            </tr>
                        </thead>
                        <tbody style="margin-right:50px">
                            <?php
                                $recent_club = "SELECT * FROM course"; // Assuming 'students' is your table name
                                $result = mysqli_query($conn, $recent_club);

                                if ($result) {
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo '<tr>';
                                            echo '<td>';
                                            echo '<img src="../../images/User.png">';
                                            echo '<p>' . $row['course_id'] . '</p>'; 
                                            echo '</td>';
                                            echo '<td>' . $row['course_title'] . '</td>'; 
                                            echo '<td>' . $row['course_code'] . '</td>'; 
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
    <script src="../../Js_files/search.js"></script>


</body>

</html>

