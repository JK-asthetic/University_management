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
            <li class="active"><a href="main.php"><i class='bx bxs-dashboard'></i>Dashboard</a></li>
            <li><a href="programme.php"><i class='bx bxs-book'></i>Programme</a></li>
            <li><a href="result.php"><i class='bx bx-dock-right'></i>Result</a></li>
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
                        <li><a href="#" class="active">Dashboard</a></li>
                    </ul>
                </div>
            </div>



            <div class="container">
            <div class="bottom-data">
                <div class="orders">  
                    <div class="header" style="margin-bottom:0px;">
                        <div class="header" style="margin-bottom:0px;">
                            <i class='bx bx-receipt'></i>
                            <h3>Student Details</h3>
                        </div>
                    </div>
                <div class="row">
                <div class="col-lg-12">
                    <div class="page-content">

                    <!-- ***** Banner Start ***** -->
                    <div class="row">
                        <div class="col-lg-12">
                        <div class="main-profile ">
                            <div class="row">
                            <div class="col-lg-4">
                                <img src="../../images/User2.png" alt="" style="border-radius: 23px;">
                            </div>
                            <div class="col-lg-4 align-self-center">
                                <div class="main-info header-text">
                                <h4>
                                    <?php
                                    $id = $_SESSION["User_id"];
                                    $student = "SELECT student_name FROM student where student_id = '$id' LIMIT 1"; // Assuming 'students' is your table name
                                    $result = mysqli_query($conn, $student);
                                    
                                    if ($result) {
                                        if (mysqli_num_rows($result) == 1) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo $row['student_name'];
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
                                </h4>
                                <p>Welcome To Our University</p>
                                <div class="main-border-button">
                                    <a href="#">See Your Result </a>
                                </div>
                                </div>
                            </div>
                            <div class="col-lg-4 align-self-center">
                                <ul>
                                <?php
                                    $id = $_SESSION["User_id"];
                                    $student = "SELECT student_id, birthday, enrolment_date, programme_id FROM student where student_id = '$id' LIMIT 1"; // Assuming 'students' is your table name
                                    $result = mysqli_query($conn, $student);
                                    
                                    if ($result) {
                                        if (mysqli_num_rows($result) == 1) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $_SESSION['programme'] = $row['programme_id'];
                                                echo '<li> Student Id: ';
                                                echo '<span>'. $row['student_id'] .'</span>';
                                                echo '</li>';
                                                echo '<li> BirthDay: ';
                                                echo '<span>'. $row['birthday'] .'</span>';
                                                echo '</li>';
                                                echo '<li> Enrolment Date: ';
                                                echo '<span>'. $row['enrolment_date'] .'</span>';
                                                echo '</li>';
                                                echo '<li> Programme Id: ';
                                                echo '<span>'. $row['programme_id'] .'</span>';
                                                echo '</li>';
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
                                </ul>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                </div>
            </div>
            </div>


        </main>

    </div>
    <script src="../../Js_files/Slider.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>


 