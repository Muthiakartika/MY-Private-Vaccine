<?php
    include '../connection.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require '../../vendor/autoload.php';

    $vaccinationID = $_POST['vaccinationID'];
    $batchNo = $_POST['batchNo'];
    $remarks = $_POST['remarks'];
    $email      = $_POST["email"];
    $fullname   = $_POST["fullname"];

    //Mengurangi jumlah stock vaccine
    mysqli_query($connect, "UPDATE vaccination SET status = 'Rejected' WHERE vaccinationID = '$vaccinationID'");

    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'nandaimehokagenaruto@gmail.com';
        $mail->Password = 'Uzumakinaruto1234';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        //Recipients
        $mail->setFrom('nandaimehokagenaruto@gmail.com', 'MSU Medical Centre');
        $mail->addAddress($email, $fullname);     // Add a recipient

        //Content
        $mail->isHTML(true);
        $mail->Subject = 'Rejected Vaccination Appointment Information';
        $mail->Body    = "Hello, Mr./Mrs. ".$fullname .",We regret to inform you that your Vaccination Appointment
        request has been rejected because the date you requested has reached its quota.If there are any further changes 
        toward the information,please wait for our response. Thank You.";

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
    header("location:../view-batch/view.php?message=success");
?>


