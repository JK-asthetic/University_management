<?php
session_start();
include("../php_files/database.php");


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//Load Composer's autoloader
require 'vendor/autoload.php';

function send_password_reset($get_name, $get_email, $password, $get_user_id)
{
    $mail = new PHPMailer(true);
    // $mail->SMTPDebug = 2;                                               // for checking the error

    $mail->isSMTP();     
    $mail->SMTPAuth   = true;                                                 //Send using SMTP


    $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
    $mail->Username   = "jatinkhetan05122005@gmail.com";        //SMTP username
    $mail->Password   = 'sdxirlrakkbtluef';                           //SMTP password

    $mail->SMTPSecure = "tls";            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //SMTP port for TLS

    //Recipients
    $mail->setFrom('jatinkhetan05122005@gmail.com', $get_name);
    $mail->addAddress($get_email);  

    $mail->isHTML(true);                                        //Set email format to HTML
    $mail->Subject = 'Your University Account Credentials';

    $email_template = "
    Dear $get_name,
    <br><br>
    We hope this email finds you well and excited for the upcoming academic term at Gla university. As part of our efforts to facilitate your access to various university resources, we are pleased to provide you with your university account credentials.
    <br><br>
    Your User ID: $get_user_id
    Your Password: $password";

    $mail->Body = $email_template;                            // Use double quotes to interpolate variables
    $mail->send();
    // echo 'Message has been sent';
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    function generateRandomPassword($length = 10) {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()';
        $chars_length = strlen($chars);
        $password = '';
        for ($i = 0; $i < $length; $i++) {
            $password .= $chars[rand(0, $chars_length - 1)];
        }

        return $password;
    }

    $password = generateRandomPassword();
    $name = $_POST['student_name'];
    $date = $_POST['date'];
    $programme_id = $_POST['programme_id'];
    $email = $_POST['email'];
    $sql_check_empty = "SELECT COUNT(*) as count FROM student";
    $result_check_empty = $conn->query($sql_check_empty);

    if ($result_check_empty) {
        $row = $result_check_empty->fetch_assoc();
        if ($row['count'] == 0) {
            // If table is empty, set initial student id
            $id = 20240001;
        } else {
            // If table has data, get the latest student id and increment it by 1
            $sql_get_latest_id = "SELECT MAX(student_id) as max_id FROM student";
            $result_get_latest_id = $conn->query($sql_get_latest_id);
            $row_latest_id = $result_get_latest_id->fetch_assoc();
            $id = $row_latest_id['max_id'] + 1;
        }
    }
    if (isset($id) && isset($password) && isset($name) && isset($date) && isset($programme_id)){

        $sql = "INSERT INTO student (`student_id`, `student_name`, `birthday`, `programme_id`, `password`) VALUES ('$id', '$name', '$date', '$programme_id', '$password')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $_SESSION["status"] = "Success";
            $_SESSION["text"] = "Data Successfully recorded";
            send_password_reset($name, $email, $password, $id); 
            header("Location:Student_add.php");

        } else {
            $_SESSION["status"] = "error";
            $_SESSION["text"] = "Error: " . mysqli_error($conn);
        }
    } else {
    $_SESSION["status"] = "error";
    $_SESSION["text"] = "Some error occurred";
    }
    }
?>