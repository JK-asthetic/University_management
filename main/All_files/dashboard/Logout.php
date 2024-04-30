<?php
session_start();
if($_SESSION['loggedin'] == true){
    unset($_SESSION['loggedin']); 
    header("Location:../../index.html");
    exit();
}

if(issset($_SESSION['User_id'])){
    unset($_SESSION['User_id']);
    unset($_SESSION['programme']);
    header("Location:../../index.html");
    exit();
}
?>