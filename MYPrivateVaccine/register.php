<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="img/assets/favicon.png" type="img/png">
    <title>MY Private Vaccine - SignUp</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        #hidden_div, #hidden_div2 {
            display: none;
        }
    </style>

</head>

<body class="bg-gradient-primary">

<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
                <div class="col-lg-12">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                        </div>
                        <?php
                        if(isset($_GET['message'])){
                            if($_GET['message'] == "fail"){
                                echo "<center><div class='alert alert-danger' role='alert'>Username have been used!</div><center>";
                            } else{
                                echo "<center><div class='alert alert-danger' role='alert'>Failed saving the data! Try again.</div><center>";
                            }
                        } ?>
                        <form class="user" action="asset/register-user.php" method="POST">
                            <div class="form-group">
                                <select type="text" class="form-control"  name="role" onchange="showDiv(this)">
                                    <option value="#" disabled selected>Position</option>
                                    <option value="administrator">Administrator</option>
                                    <option value="patient">Patient</option>
                                </select>
                            </div>
                            <div class="form-group ">
                                <input type="text" class="form-control form-control-user" id="exampleFirstName"
                                       placeholder="Username" name="username" required="required">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-user"
                                       id="exampleInputPassword" placeholder="Password" name="password" required="required">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control form-control-user" id="exampleInputEmail"
                                       placeholder="Email Address" name="email" required="required">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="exampleFirstName"
                                       placeholder="Full Name" name="fullname" required="required">
                            </div>
                            <div id="hidden_div" class="form-group">
                                <input id="ICPassport" type="text" class="form-control form-control-user" name="icpassport"
                                       placeholder="ICPassport" required="required">
                            </div>
                            <div id="hidden_div2" class="form-group">
                                <select name="centreName" class="form-control">
                                    <option disabled selected>--- Centre Name ---</option>
                                    <option value="MSU Medical Centre">MSU Medical Centre[Selangor]</option>
                                    <option value="Senawang Specialist Hospital">Senawang Specialist Hospital[Negri Sembilan]</option>
                                    <option value="Timberland Medical Centre">Timberland Medical Centre[Serawak]</option>
                                </select>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary btn-user btn-block">Register Account</button>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="login.php">Already have an account? Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<script type="text/javascript">
    function showDiv(select){
        if(select.value=='patient'){
            document.getElementById('hidden_div').style.display = "block";
        } else{
            document.getElementById('hidden_div').style.display = "none";
        }

        if(select.value=='administrator'){
            document.getElementById('hidden_div2').style.display = "block";
        } else{
            document.getElementById('hidden_div2').style.display = "none";
        }
    }
</script>
</body>

</html>
