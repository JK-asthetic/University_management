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
            <li class="active"><a href="programme.php"><i class='bx bxs-book'></i>Programme</a></li>
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
                        <li><a href="#" class="active">Programme</a></li>
                    </ul>
                </div>
            </div>


            <div class="bottom-data">
                <div class="orders">  
                    <div class="header" style="margin-bottom:0px;">
                        <div class="header" style="margin-bottom:0px;">
                            <i class='bx bx-receipt'></i>
                            <h3>Programme Details</h3>
                        </div>
                    </div>
                    <img src="../../images/back.png" style="height:200px; border-radius:50px; margin:20px 0;">
                    <table style="font-size:20px;">
                        <tbody>
                        <?php
                            $id = $_SESSION["programme"];
                            $student = "SELECT * FROM programme where programme_id = '$id' LIMIT 1"; // Assuming 'students' is your table name
                            $result = mysqli_query($conn, $student);

                            if ($result) {
                                if (mysqli_num_rows($result) == 1) {
                                    $row = mysqli_fetch_assoc($result); // Fetching only one row
                                    echo '<tr>';
                                    echo '<td>';
                                    echo 'Programme ID  : ' . $row['programme_id'] . '</td>';
                                    echo '<td>';
                                    echo 'Programme Title  : ' . $row['programme_title'] . '</td>';
                                    echo '</tr>';
                                    echo '<tr>';
                                    echo '<td>';
                                    echo 'Duration  :  ' . $row['duration'] . '</td>';
                                    echo '<td>';
                                    echo 'Programme Code  : ' . $row['programme_code'] . '</td>';
                                    echo '</tr>';
                                    echo '<tr>';
                                    // echo '<td>';
                                    // echo 'School Code: ' . $row['school_code'] . '</td>';
                                    // echo '</tr>';
                                } else {
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
                        <h3>Course Details</h3>
                        <i class='bx bx-filter'></i>
                        <i class='bx bx-search'></i>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Course ID</th>
                                <th>Course Name</th>
                                <th>Course Code</th>
                                <th>Prerequisite Course Id</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $id = $_SESSION["programme"];
                                $student = "SELECT * FROM course where programme_id = '$id'"; // Assuming 'students' is your table name
                                $result = mysqli_query($conn, $student);

                                if ($result) {
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo '<tr>';
                                            echo '<td>';
                                            echo '<img src="../../images/User.png">';
                                            echo '<p>' . $row['course_id'] . '</p>'; 
                                            echo '</td>';
                                            echo '<td>' . $row['course_code'] . '</td>'; 
                                            echo '<td>' . $row['course_title'] . '</td>'; 
                                            echo '<td>' . $row['prerequisite_course_id'] . '</td>'; 
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>




 