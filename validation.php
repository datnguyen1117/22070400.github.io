<?php
session_start();


error_reporting(E_ALL);
ini_set('display_errors', 1);

$con = mysqli_connect('localhost', 'root', '');  
if (!$con) {
    die("Kết nối database thất bại: " . mysqli_connect_error());
}

mysqli_select_db($con, 'login_demo');

$name = $_POST['user'];  
$pass = $_POST['password'];

$s = "select * from users where name='$name' && password='$pass'";  

$result = mysqli_query($con, $s);
if (!$result) {
    die("Lỗi truy vấn SQL: " . mysqli_error($con));  
}

$num = mysqli_num_rows($result);
if ($num == 1) {
    $_SESSION['username'] = $name;
    header('location:home.php');
    exit();  // Dừng script sau redirect
} else {
    header('location:login.php?error=1');
    exit();
}
?>