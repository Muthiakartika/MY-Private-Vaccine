<?php
    include '../connection.php';

    $vaccinationID = $_POST['vaccinationID'];
    $batchNo = $_POST['batchNo'];
    $remarks = $_POST['remarks'];

    //Mengurangi jumlah stock vaccine
    mysqli_query($connect, "UPDATE batch SET quantityAdministered = quantityAdministered + 1 WHERE batchNo = '$batchNo'");
    mysqli_query($connect, "UPDATE vaccination SET status = 'Administered', remarks = '$remarks' WHERE vaccinationID = '$vaccinationID'");
    header("location:../view-batch/view.php?message=success");


?>
