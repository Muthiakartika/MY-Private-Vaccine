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
        #hidden_div, #hidden_div2, #hidden_div3, #hidden_div4 {
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
                            } elseif ($_GET['message'] == "success-add") {
                                echo "<center><div class='alert alert-success' role='alert'>Success Add New Healthcare</div><center>";
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
                                       name="username" placeholder="Username"  required="required">
                            </div>

                            <div class="form-group">
                                <input type="password" class="form-control form-control-user"
                                       id="exampleInputPassword" name="password" placeholder="Password"  required="required">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control form-control-user" id="exampleInputEmail"
                                       name="email" placeholder="Email Address"  required="required">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="exampleFirstName"
                                       name="fullname" placeholder="Full Name"  required="required">
                            </div>
                            <div id="hidden_div" class="form-group">
                                <input id="ICPassport" type="text" class="form-control form-control-user" name="icpassport"
                                       placeholder="ICPassport">
                            </div>
								<div id="hidden_div2" class="form-group">
								<select name="centreName" class="form-control" onchange="showDiv2(this)">
                                    <option value="#" disabled selected>--- Centre Name ---</option>
									<?php
										include "asset/connection.php";  // Using database connection file here
										$records = mysqli_query($connect, "SELECT * FROM healthcarecentre ");  // Use select query here
										while($data = mysqli_fetch_array($records))
										{
											echo "<option value='". $data['centreName'] ."'>" .$data['centreName'] ."
                                            <a>/</a>".$data['address'] ."</option>";  // displaying data in option menu
										}?>
                                    <option value="other">Other</option>
								</select>
                            </div>
							<div id="hidden_div3">
                                <div class="form-group">
                                    <a class="btn btn-primary" href="asset/new-healthcare/create.php">Add Healthcare</a>
                                </div>
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
	
	function showDiv2(select){
        if(select.value=='other'){
            document.getElementById('hidden_div3').style.display = "block";
        } else{
            document.getElementById('hidden_div3').style.display = "none";
        }
    }
</script>
</body>

</html>
