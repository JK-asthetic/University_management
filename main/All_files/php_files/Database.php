<?php
$conn = mysqli_connect("localhost", "root", "", "university", 3306);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>