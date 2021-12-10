<?php
session_start();

include "connection.php";

$username = $_POST["username"];
$password = $_POST['password'];

//SESSION USER
$userData = mysqli_query($connect, "SELECT * FROM user WHERE username='$username'");
while ($d = mysqli_fetch_array($userData)){
    $_SESSION['id']         = $d['id'];
    $_SESSION['ICPassport'] = $d['icpassport'];
    $_SESSION['centreName'] = $d['centreName'];
    $_SESSION['username']   = $d['username'];
    $_SESSION['email']      = $d['email'];
    $_SESSION['fullname']   = $d['fullname'];
    $_SESSION['role']       = $d['role'];
}

//LOGIN
$login = mysqli_query($connect, "SELECT * FROM user WHERE username='$username' and password='$password'");
$checkUser   = mysqli_num_rows($login);

if($checkUser > 0){
    $dataUser = mysqli_fetch_assoc($login);

    if($dataUser['role'] == "administrator"){
        header("location:home-administrator.php");
    }else{
        header("location:home-patient.php");
    }
}else{
    header("location:../login.php?message=fail");
}
?>
