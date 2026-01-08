<?php
$host = "localhost";
$user = "root";
$pass = "P@ssw0rd";
$db   = "lab_db";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("DB Error");
}
