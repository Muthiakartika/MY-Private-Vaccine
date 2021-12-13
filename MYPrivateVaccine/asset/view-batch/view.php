<?php
session_start();
include '../connection.php';

if($_SESSION['role']=="" or $_SESSION['role'] != "administrator"){
    header("location:../../login.php?message=fail");
}

if(isset($_POST['submit'])){
    $batchNo = $_POST['batchNo'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../img/assets/favicon.png" type="img/png">
    <title>MY Private Vaccine - View Vaccine Batch</title>

    <!-- Custom fonts for this template-->
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="../../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">
<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../home-administrator.php">
            <div class="sidebar-brand-icon">
                <i class="fas fa-hospital-symbol"></i>
            </div>
            <div class="sidebar-brand-text mx-3">MY Private Vaccine</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="../home-administrator.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Admin Menu
        </div>

        <!-- Nav Item -->
        <li class="nav-item">
            <a class="nav-link" href="../record-batch/view.php">
                <i class="fas fa-file-medical"></i>
                <span>Record Vaccine Batch</span></a>
        </li>

        <!-- Nav Item -->
        <li class="nav-item active">
            <a class="nav-link" href="view.php">
                <i class="fas fa-file-alt"></i>
                <span>View Vaccination Information</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>


                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                    <li class="nav-item dropdown no-arrow d-sm-none">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-search fa-fw"></i>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                             aria-labelledby="searchDropdown">
                            <form class="form-inline mr-auto w-100 navbar-search">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light border-0 small"
                                           placeholder="Search for..." aria-label="Search"
                                           aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>

                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['fullname'];?></span>
                            <img class="img-profile rounded-circle"
                                 src="../../img/undraw_profile.svg">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                             aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800">View Batch Vaccination Information </h1>
                <p class="mb-4">To view vaccination appointments status</p>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Batch Tables</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Batch No</th>
                                    <th>Vaccine Name</th>
                                    <th>Manufacturer</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Batch No</th>
                                    <th>Vaccine Name</th>
                                    <th>Manufacturer</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                <?php
                                include '../connection.php';
                                $listVaccine = mysqli_query($connect,
                                    "SELECT * FROM vaccine 
                                                            INNER JOIN batch 
                                                            ON batch.vaccineID = vaccine.vaccineID
                                                            INNER JOIN healthcarecentre
                                                            ON healthcarecentre.centreName = batch.centreName
                                                            WHERE healthcarecentre.centreName = '".$_SESSION['centreName']."'
                                                                                                  
                                                            ");
                                while ($row = mysqli_fetch_array($listVaccine)){
                                    ?>
                                    <tr>
                                        <td><?php echo $row['batchNo'] ?></td>
                                        <td><?php echo $row['vaccineName'] ?></td>
                                        <td><?php echo $row['manufacturer'] ?></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Form Input</h6>
                    </div>
                    <div class="card-body">
                        <?php
                        if(isset($_GET['message'])){
                            if($_GET['message'] == "message"){
                                echo "<div class='alert alert-danger' role='alert'>The data can not be saved!</div>";
                            }else if($_GET['message'] == "invalidVaccine"){
                                echo "<div class='alert alert-danger' role='alert'>Vaccine can not be identified!</div>";
                            }
                        }
                        ?>
                        <form method="POST" action="">
                            <div class="form-group">
                                <label>Batch No</label>
                                <input class="form-control" type="text" name="batchNo">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-success" type="submit" name="submit" value="Submit">
                            </div>
                        </form>
                    </div>
                </div>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">DataTables</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <?php
                            if(isset($_GET['message'])){
                                if($_GET['message'] == "success"){
                                    echo "<div class='alert alert-success' role='alert'>Data has successfully saved!</div>";
                                }else if($_GET['message'] == "delete-success"){
                                    echo "<div class='alert alert-success' role='alert'>Data has successfully removed!</div>";
                                }else if($_GET['message'] == "delete-fail"){
                                    echo "<div class='alert alert-danger' role='alert'>The data can not be removed!</div>";
                                }
                            }
                            ?>
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Batch No</th>
                                    <th>Vaccination ID</th>
                                    <th>Appointment Date</th>
                                    <th>Patient Name</th>
                                    <th>Centre Name</th>
                                    <th>Vaccine Name</th>
                                    <th>Pending Appointment</th>
                                    <th>Exp Date</th>
                                    <th>Quantity Available</th>
                                    <th>Quantity Administered</th>
                                    <th>Status</th>
                                    <th>Option</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Batch No</th>
                                    <th>Vaccination ID</th>
                                    <th>Appointment Date</th>
                                    <th>Patient Name</th>
                                    <th>Centre Name</th>
                                    <th>Vaccine Name</th>
                                    <th>Pending Appointment</th>
                                    <th>Exp Date</th>
                                    <th>Quantity Available</th>
                                    <th>Quantity Administered</th>
                                    <th>Status</th>
                                    <th>Option</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                <?php
                                include '../connection.php';
                                error_reporting(E_ERROR | E_PARSE);

                                $countVaccinePending = mysqli_query($connect, "SELECT * FROM vaccination 
                                                                                   INNER JOIN batch
                                                                                   ON vaccination.batchNo = batch.batchNo
                                                                                   INNER JOIN vaccine
                                                                                   ON vaccine.vaccineID = batch.vaccineID
                                                                                   WHERE status = 'Pending' 
                                                                                   AND batch.batchNo = '$batchNo'
                                                                                   ");
                                $totalPending = mysqli_num_rows($countVaccinePending);

                                $countVaccineConfirm = mysqli_query($connect, "SELECT * FROM vaccination 
                                                                                   INNER JOIN batch
                                                                                   ON vaccination.batchNo = batch.batchNo
                                                                                   INNER JOIN vaccine
                                                                                   ON vaccine.vaccineID = batch.vaccineID
                                                                                   WHERE status = 'Confirm' 
                                                                                   AND batch.batchNo = '$batchNo'
                                                                                   ");
                                $totalConfirm = mysqli_num_rows($countVaccineConfirm);

                                $countVaccineReject = mysqli_query($connect, "SELECT * FROM vaccination 
                                                                                   INNER JOIN batch
                                                                                   ON vaccination.batchNo = batch.batchNo
                                                                                   INNER JOIN vaccine
                                                                                   ON vaccine.vaccineID = batch.vaccineID
                                                                                   WHERE status = 'Rejected' 
                                                                                   AND batch.batchNo = '$batchNo'
                                                                                   ");
                                $totalRejected = mysqli_num_rows($countVaccineReject);

                                $countVaccineAdministered = mysqli_query($connect, "SELECT * FROM vaccination 
                                                                                   INNER JOIN batch
                                                                                   ON vaccination.batchNo = batch.batchNo
                                                                                   INNER JOIN vaccine
                                                                                   ON vaccine.vaccineID = batch.vaccineID
                                                                                   WHERE status = 'Administered' 
                                                                                   AND batch.batchNo = '$batchNo'
                                                                                   ");
                                $totalAdministered = mysqli_num_rows($countVaccineAdministered);

                                $listVaccine = mysqli_query($connect,
                                    "SELECT * FROM vaccine 
                                                            INNER JOIN batch 
                                                            ON batch.vaccineID = vaccine.vaccineID
                                                            INNER JOIN vaccination  
                                                            ON vaccination.batchNo = batch.batchNo
                                                            INNER JOIN healthcarecentre
                                                            ON healthcarecentre.centreName = batch.centreName
                                                            WHERE healthcarecentre.centreName = '".$_SESSION['centreName']."'
                                                            AND batch.batchNo = '$batchNo'                                                    
                                                            ");
                                while ($row = mysqli_fetch_array($listVaccine)){
                                    ?>
                                    <tr>
                                        <td><?php echo $row['batchNo'] ?></td>
                                        <td><?php echo $row['vaccinationID'] ?></td>
                                        <td><?php echo $row['appointmentDate'] ?></td>
                                        <td><?php echo $row['fullname'] ?></td>
                                        <td><?php echo $row['centreName'] ?></td>
                                        <td><?php echo $row['vaccineName'] ?></td>
                                        <td><?php echo $totalPending ?></td>
                                        <td><?php echo $row['expiryDate'] ?></td>
                                        <td><?php echo $row['quantityAvailable'] ?></td>
                                        <td><?php echo $row['quantityAdministered'] ?></td>
                                        <?php if($totalPending){ ?>
                                            <td><p class="btn btn-warning btn-sm"><?php echo $row['status'] ?></p></td>
                                        <?php } else if ($totalConfirm) {?>
                                            <td><p class="btn btn-info btn-sm"><?php echo $row['status'] ?></p></td>
                                        <?php }else if ($totalRejected) {?>
                                            <td><p class="btn btn-danger btn-sm"><?php echo $row['status'] ?></p></td>
                                        <?php }else if ($totalAdministered) {?>
                                            <td><p class="btn btn-success btn-sm"><?php echo $row['status'] ?></p></td>
                                        <?php }?>

                                        <td>
                                            <a href="../confirm-vaccination/create.php?vaccinationID=<?php echo $row['vaccinationID']; ?>" class="btn btn-info btn-sm">Confirm</a>
                                            <br>
                                            <br>
                                            <a href="../record-vaccination-admin/create.php?vaccinationID=<?php echo $row['vaccinationID']; ?>" class="btn btn-success btn-sm">Record</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; MYPrivateVaccine 2021</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="../logout.php">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="../../vendor/jquery/jquery.min.js"></script>
<script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="../../js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="../../vendor/datatables/jquery.dataTables.min.js"></script>
<script src="../../vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="../../js/demo/datatables-demo.js"></script>

</body>

</html>
