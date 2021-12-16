<?php
error_reporting(E_ERROR | E_PARSE);

include "../connection.php";

$centreName = $_POST["centreName"];
$address    = $_POST["address"];

$sqlHealth  = "insert into healthcarecentre (centreName, address) values
            ('$centreName', '$address')";

$dataSQL = mysqli_query($connect,$sqlHealth);
header("location:../../register.php?message=success-add");

?>
