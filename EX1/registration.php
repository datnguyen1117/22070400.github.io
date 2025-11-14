<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

$con = mysqli_connect('localhost', 'root', '');
if (!$con) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

mysqli_select_db($con, 'login_demo');

$name = $_POST['user'];
$pass = $_POST['password'];

$s = "select * from users where name='$name'";  

$result = mysqli_query($con, $s);
if (!$result) {
    die("Lỗi: " . mysqli_error($con));
}

$num = mysqli_num_rows($result);
if ($num == 1) {
    header('location:login.php?reg_error=1');
    exit();
} else {
    $reg = "insert into users(name,password) values ('$name','$pass')";  
    if (mysqli_query($con, $reg)) {
        header('location:login.php?reg_success=1');
    } else {
        die("Lỗi insert: " . mysqli_error($con));
    }
    exit();
}
?>
