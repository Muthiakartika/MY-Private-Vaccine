<!-- Created By Ni Putu Zara Athifa-->
<?php
error_reporting(E_ERROR | E_PARSE);

include "connection.php";

$ICPassport = $_POST["icpassport"];
$centreName = $_POST["centreName"];
$username   = $_POST["username"];
$password   = $_POST["password"];
$email      = $_POST["email"];
$fullname   = $_POST["fullname"];
$role       = $_POST["role"];

$checkUser = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM user WHERE username='$username'"));

if($checkUser > 0){
    header("location:../register.php?message=fail");
}else{

    $sql   = "insert into user (icpassport, centreName,username,password,email,fullname,role) values
            ('$ICPassport','$centreName','$username','$password','$email','$fullname','$role')";

    $dataSQL = mysqli_query($connect,$sql);

    if ($dataSQL) {
        header("location:../login.php?message=success");
    }
    else {
        header("location:../register.php?message=fail");
    }
}
?>
