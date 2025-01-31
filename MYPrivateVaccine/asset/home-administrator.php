<?php
session_start();

if($_SESSION['role']=="" or $_SESSION['role']!="administrator"){
    header("location:../login.php?message=fail");
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
    <link rel="icon" href="../img/assets/favicon.png" type="img/png">
    <title>MY Private Vaccine - Administrator Home Page</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="home-administrator.php">
            <div class="sidebar-brand-icon">
                <i class="fas fa-hospital-symbol"></i>
            </div>
            <div class="sidebar-brand-text mx-3">MY Private Vaccine</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="home-administrator.php">
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
            <a class="nav-link" href="record-batch/view.php">
                <i class="fas fa-file-medical"></i>
                <span>Record Vaccine Batch</span></a>
        </li>

        <!-- Nav Item -->
        <li class="nav-item">
            <a class="nav-link" href="view-batch/view.php">
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
                    </li>

                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['fullname'];?></span>
                            <img class="img-profile rounded-circle"
                                 src="../img/undraw_profile.svg">
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

                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800"> <?php echo $_SESSION['centreName'];?> Dashboard</h1>
                </div>

                <!-- Content Row -->
                <div class="row">

                    <!-- Pending Count -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            Pending </div>
                                        <?php
                                        include 'connection.php';
                                        $pending_Num = 0;
                                        $pendingNum = mysqli_query($connect, "SELECT * FROM vaccination
                                                                    INNER JOIN batch
                                                                    ON vaccination.batchNo = batch.batchNo
                                                                    INNER JOIN healthcarecentre
                                                                    ON healthcarecentre.centreName = batch.centreName
                                                                    WHERE vaccination.status = 'Pending' AND
                                                                    healthcarecentre.centreName = '".$_SESSION['centreName']."'");
                                        while($dataLoop = mysqli_fetch_array($pendingNum))
                                        {
                                            $pending_Num++;
                                        }
                                        ?>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $pending_Num?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa fa-history fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Administered Count -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Administered </div>
                                        <?php
                                        include 'connection.php';
                                        $administered_Num = 0;
                                        $administeredNum = mysqli_query($connect, "SELECT * FROM vaccination
                                                                    INNER JOIN batch
                                                                    ON vaccination.batchNo = batch.batchNo
                                                                    INNER JOIN healthcarecentre
                                                                    ON healthcarecentre.centreName = batch.centreName
                                                                    WHERE vaccination.status = 'Administered' AND
                                                                    healthcarecentre.centreName = '".$_SESSION['centreName']."'");
                                        while($dataLoop = mysqli_fetch_array($administeredNum))
                                        {
                                            $administered_Num++;
                                        }
                                        ?>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $administered_Num?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-redo fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- confirm count-->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Confirm</div>
                                        <?php
                                        include 'connection.php';
                                        $confirm_Num = 0;
                                        $confirmNum = mysqli_query($connect, "SELECT * FROM vaccination
                                                                    INNER JOIN batch
                                                                    ON vaccination.batchNo = batch.batchNo
                                                                    INNER JOIN healthcarecentre
                                                                    ON healthcarecentre.centreName = batch.centreName
                                                                    WHERE vaccination.status = 'Confirm' AND
                                                                    healthcarecentre.centreName = '".$_SESSION['centreName']."'");
                                        while($dataLoop = mysqli_fetch_array($confirmNum))
                                        {
                                            $confirm_Num++;
                                        }
                                        ?>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $confirm_Num?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa fa-check fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Rejected count -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-danger shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                            Rejected</div>
                                        <?php
                                        include 'connection.php';
                                        $reject_Num = 0;
                                        $rejectNum = mysqli_query($connect, "SELECT * FROM vaccination
                                                                    INNER JOIN batch
                                                                    ON vaccination.batchNo = batch.batchNo
                                                                    INNER JOIN healthcarecentre
                                                                    ON healthcarecentre.centreName = batch.centreName
                                                                    WHERE vaccination.status = 'Rejected' AND
                                                                    healthcarecentre.centreName = '".$_SESSION['centreName']."'");
                                        while($dataLoop = mysqli_fetch_array($rejectNum))
                                        {
                                            $reject_Num++;
                                        }
                                        ?>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $reject_Num?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa fa-times fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
            <div class="modal-body">Select "Logout" below if you are ready to .</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="logout.php">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="../js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="../vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="../js/demo/chart-area-demo.js"></script>
<script src="../js/demo/chart-pie-demo.js"></script>

</body>

</html>
