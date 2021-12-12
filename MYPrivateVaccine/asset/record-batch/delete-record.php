<?php
    include'../connection.php';
    $batchNo = $_GET['batchNo'];

    $sql = mysqli_query($connect, "DELETE FROM batch WHERE batchNo = '$batchNo'");

    if($sql)
    {
        header("location:view.php?message=delete-success");
    }
    else
    {
        header("location:view:php?message=delete-fail");;
    }


?>
