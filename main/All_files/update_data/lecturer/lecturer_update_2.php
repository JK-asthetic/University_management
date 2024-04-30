<?php
session_start();
if(!isset($_SESSION["loggedin"])){
    header("Location:../../Admin_login/Login_page.html");
    exit();

}

$_SESSION['lecturer_id'] = $_POST['lecturer_id'];
include("../../php_files/Database.php");

$lecturer_id = $_POST['lecturer_id'];
$trimmed_id = substr($lecturer_id, -3); // Extract the last three characters of the ID

$query = "SELECT `lecturer_name`, `title`, `office_room`, `school_id`, `supervisor_id` FROM `lecturer` WHERE RIGHT(`lecturer_id`, 3) = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $trimmed_id); // Bind the trimmed ID
$stmt->execute();
$stmt->store_result(); // Store the result for later use

if ($stmt->num_rows > 0) { 
    $stmt->bind_result($lecturer_name, $title, $room, $school_id, $super_id);
    $stmt->fetch();
} else {
    $_SESSION["status"] = "error";
    $_SESSION["text"] = "Lecturer not found";
    header("Location: lecturer_update_1.php");
}
$stmt->close(); 


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../../../css files/Panel.css">

    <link rel='stylesheet' href='https://cdn.jsdelivr.net/gh/alphardex/aqua.css@master/dist/aqua.min.css'>

    <title>Administration Panel</title>

    <style>
        .btn {
            padding: 8px 20px;
            border-radius: 0;
            height: 50px;
            font-size: 20px;
            overflow: hidden;
        }

        .btn::before {
            position: absolute;
            content: "";
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(120deg, transparent, var(--primary-color), transparent);
            transform: translateX(-100%);
            transition: 0.6s;
        }

        .btn:hover {
            background: transparent;
            box-shadow: 0 0 20px 10px rgba(51, 152, 219, 0.5);
        }

        .btn:hover::before {
            transform: translateX(100%);
        }



        .flex-container {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-direction: row;


        }

        .form-input-material {
            --input-default-border-color: white;
            --input-border-bottom-color: white;
            width: 50%;
            margin-right: 50px;
        }

        .form-input-material input {
            color: white;
            margin: -8px 15px 8px 5px;
            font-size: 20px;


        }

        .address {
            margin: 50px 15px 15px 5px;
            font-size: 18px;
            width: 100%;
        }

        .address .form-input-material {
            width: 89%;
        }

        .form-input-material label {
            font-size: 18px;
            width: 500px;
            cursor: pointer;

        }

        .login-form {
            margin: 30px auto;
            padding: 50px 40px;
            width: 1200px;
            height: 600px;
            color: white;
            background: #181a1e;
            border-radius: 10px;
            /* box-shadow: 0 0.4px 0.4px rgba(128, 128, 128, 0.109), 0 1px 1px rgba(128, 128, 128, 0.155), 0 2.1px 2.1px rgba(128, 128, 128, 0.195), 0 4.4px 4.4px rgba(128, 128, 128, 0.241), 0 12px 12px rgba(128, 128, 128, 0.35); */
        }

        .login-form h1 {
            margin: -20px 0 40px 0;

        }

        .login-form .form-input-material {
            margin: 5px 100px 15px 5px;
        }

        .login-form .btn {
            width: 30%;
            margin: 100px 0 9px 400px;
        }





        /* ---------------------------------------   Drop down ----------------------------------------  */


        .option-bars {
            margin-top: 1px;
            display: flex;
            margin-bottom:  30px;
            justify-content: space-between;
            align-items: center;
            /* height: 100vh */
            flex-wrap: wrap;

        }

        .dropdown {
            min-width: 400px;
            position: relative;
            margin: 10px;
        }

        .dropdown * {
            box-sizing: border-box;
            width: 300px;
        }

        .select {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5em 1em;
            /* background-color: #2a2f3b; */
            background-color: #181a1e;
            color: #fff;
            width: 100%;
            /* width: 480px; */
            border: 2px #2a2f3b solid;
            border-radius: 0.5em;
            padding: 1em;
            cursor: pointer;
            user-select: none;
            transition: background 0.3s;
            z-index:2;

        }

        .select-clicked {
            border: 1px #26489a solid;
            box-shadow: 0 0 0 2px #26489a;

        }

        .select:hover {
            background-color: #323741;
        }

        .caret {
            width: 0;
            height: 0;
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;
            border-top: 6px solid #fff;
            transition: 0.3s;

        }

        .caret-rotate {
            transform: rotate(180deg);
        }

        .menu {
            list-style: none;
            padding: 0.2em 0.5em;
            background: #323741;
            border: 1px #2a2f3b solid;
            border-radius: 0.5em;
            box-shadow: 0 0.5em 1em rgba(0, 0, 0, 0.2);
            color: #9fa5b5;
            position: absolute;
            top: 3em;
            left: 50%;
            transform: translateX(-50%);
            opacity: 0;
            width: 400px;
            display: none;
            transition: 0.2s;
            z-index: 1;
        }

        .menu li {
            padding: 0.7em 0.5em;
            margin: 0.3em 0;
            font-size: 18px;
            width: 400px;
            border-radius: 0.5em;
            cursor: pointer;
            z-index: 1;
        }

        .menu li:hover {
            background-color: #2a2d35;
            width: 380px;
        }

        .active {
            background-color: #23242a;
            color: #fff;
            width: 400px;
        }

        .menu-open {
            display: block;
            opacity: 1;
        }
    </style>
</head>

<body class="dark">

    <!-- Sidebar -->
    <div class="sidebar">
        <a href="#" class="logo">
            <i class='bx bxs-graduation'></i>
            <div class="logo-name"><span>GLA</span>Univ</div>
        </a>
        <ul class="side-menu">
            <li><a href="../../dashboard/Panel.php"><i class='bx bxs-dashboard'></i>Dashboard</a></li>
            <li><a href="../../dashboard/Campus.php"><i class='bx bx-store-alt'></i>Campus</a></li>
            <li><a href="../../dashboard/Student.php"><i class='bx bx-group'></i>Student</a></li>
            <li class="active"><a href="../../dashboard/lecturer.php"><i class='bx bxs-user-voice'></i>Lecturer</a></li>
            <li><a href="../../dashboard/clubs.php"><i class='bx bx-cricket-ball'></i>Clubs</a></li>
            <li><a href="../../dashboard/committee.php"><i class='bx bx-chat'></i>committee</a></li>
            <li><a href="../../dashboard/programme.php"><i class='bx bxs-book'></i>Programme</a></li>
            <li><a href="../../dashboard/course.php"><i class='bx bx-book-open'></i>Course</a></li>
            <li><a href="../../dashboard/school.php"><i class='bx bxs-school'></i>School</a></li>
            <li><a href="../../dashboard/faculty.php"><i class='bx bxs-user-rectangle'></i>Faculty</a></li>
            <li><a href="../../dashboard/exam.php"><i class='bx bxs-user-rectangle' ></i>Exam</a></li>


        </ul>
        <ul class="side-menu">
            <li>
                <a href="../../dashboard/Logout.php" class="logout">
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
                    <h1>Lecturer</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">
                                GLAUniv
                            </a></li>
                        /
                        <li><a href="#">Lecturer</a></li>
                        /
                        <li><a href="#" class="active">Update Detail</a></li>
                    </ul>
                </div>
            </div>

            <!-- Form start -->

            <form class="login-form" action="lecturer_update_3.php" method="post">
                <h1><i class='bx bx-user'></i>Update Lecturer</h1>

                <div class="flex-container">
                    <div class="form-input-material">
                        <input type="text" id="username1" value =  "<?php echo $lecturer_id; ?>" 
                        class="form-control-material"/>
                        <label for="username1">Lecturer ID</label>
                    </div>

                    <div class="form-input-material">
                        <input type="text" id="username5" value =  "<?php echo $lecturer_name; ?>"
                        class="form-control-material"/>
                        <label for="username5">Lecturer Name</label>
                    </div>
                    
                </div>

                <div class="flex-container">
                    <div class="form-input-material">
                        <input type="text" name = "school_id" id="username6" value = "<?php echo $school_id; ?>" placeholder=" " autocomplete="off"
                        class="form-control-material" required />
                        <label for="username6">School ID</label>
                    </div>

                    <div class="form-input-material">
                        <input type="text" name="sup_id" id="username7" value = "<?php echo $super_id; ?>" placeholder=" " autocomplete="off"
                        class="form-control-material" required/>
                        <label for="username7">Supervisor ID <span style="font-size:12px"> (If No Supervisor fill NULL)<span></label>
                    </div>
                    
                </div>

                <div class="flex-container">
                         
                    <div class="form-input-material">
                        <input type="text" name="title" id="user2" value = "<?php echo $title; ?>" placeholder=" " autocomplete="off"
                            class="form-control-material" required />
                        <label for="user2">Title (Subject)</label>
                    </div>
                    <div class="form-input-material">
                        <input type="text" name="room_no" id="user1" value = "<?php echo $room; ?>" placeholder=" " autocomplete="off"
                            class="form-control-material" required />
                        <label for="user1">room_no</label>
                    </div>
                    
                </div>

                <button type="submit" class="btn btn-primary btn-ghost">Update</button>
            </form>
            <!-- Form end -->
        </main>
    </div>
    <script src="../../Js_files/Slider.js"></script>
    <script src="../../Js_files/form.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById("username1").readOnly = true;
        document.getElementById("username5").readOnly = true;
    </script>

    
</body>

</html>

