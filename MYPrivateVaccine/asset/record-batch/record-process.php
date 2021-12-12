<?php
    include '../connection.php';

    $batchNo = $_POST['batchNo'];
    $expiryDate = $_POST['expiryDate'];
    $quantityAvailable = $_POST['quantityAvailable'];
    $vaccineID = $_POST['vaccineID'];
    $centreName = $_POST['centreName'];

    $validVaccine = mysqli_num_rows(mysqli_query($connect, "SELECT vaccineID FROM vaccine WHERE vaccineID='$vaccineID'"));

    if($validVaccine > 0)
    {
        $sql = mysqli_query($connect, "INSERT INTO batch(batchNo, expiryDate, quantityAvailable, vaccineID, centreName)
        VALUES ('$batchNo', '$expiryDate','$quantityAvailable','$vaccineID','$centreName')");
        if($sql)
        {
            header("location:view.php?message=success");
        }
        else
        {
            header("location:form-create.php?message=fail");
        }
    }else{
        header("location:form-create.php?message=invalidVaccine");
    }

?>
