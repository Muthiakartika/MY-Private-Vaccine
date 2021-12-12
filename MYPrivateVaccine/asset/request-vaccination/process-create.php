<?php
    include '../connection.php';

    $batchNo = $_POST['batchNo'];
    $appointmentDate = $_POST['appointmentDate'];
    $fullname = $_POST['fullname'];

    $validBatch = mysqli_num_rows(mysqli_query($connect, "SELECT batchNo FROM batch WHERE batchNo='$batchNo'"));
    $validDate = mysqli_query($connect, "SELECT expiryDate FROM batch WHERE batchNo = '$batchNo'");

    if($validBatch > 0)
    {
        if($validDate->num_rows>0)
        {
            while ($row = $validDate->fetch_assoc())
            {
                $expDate = $row['expiryDate'];
            }
        }
        if($appointmentDate < $expDate)
        {
            $vaccination = mysqli_query($connect, "INSERT INTO vaccination (batchNo, appointmentDate, fullname) VALUES ('$batchNo', '$appointmentDate','$fullname')");
            //Mengurangi jumlah stock vaccine
            $stock = mysqli_query($connect, "UPDATE batch SET quantityAvailable = quantityAvailable - 1 WHERE batchNo = '$batchNo'");

            if($vaccination)
            {
                header("location:../view-vaccination/view.php?message=success");
            }
            else
            {
                header("location:create.php?message=fail");
            }
        }
        else
        {
            header("location:create.php?message=invalidDate");
        }
    }
    else
    {
        header("location:create.php?message=invalidBatch");
    }
?>
