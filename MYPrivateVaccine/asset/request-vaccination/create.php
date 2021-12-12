<?php
session_start();

include '../connection.php';

if($_SESSION['role']=="" or $_SESSION['role'] != "patient"){
    header("location:../../login.php?message=fail");
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

    <title>MY Private Vaccine - Request Vaccination</title>

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
            <a class="nav-link" href="../home-patient.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Patient Menu
        </div>

        <!-- Nav Item -->
        <li class="nav-item">
            <a class="nav-link" href="create.php">
                <i class="fas fa-file-medical"></i>
                <span>Request Vaccination Appointment</span></a>
        </li>

        <!-- Nav Item -->
        <li class="nav-item">
            <a class="nav-link" href="../view-vaccination/view.php">
                <i class="fas fa-file-alt"></i>
                <span>View Vaccination</span></a>
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
                <h1 class="h3 mb-2 text-gray-800">Form</h1>
                <p class="mb-4">To allow a patient to request a vaccination appointment.</p>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Available Vaccine Table</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Batch</th>
                                    <th>Centre Name</th>
                                    <th>Address</th>
                                    <th>Manufacturer</th>
                                    <th>Vaccine</th>
                                    <th>Exp Date</th>
                                    <th>Qty</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                include '../connection.php';


                                $listVaccine = mysqli_query($connect,
                                    "SELECT * FROM vaccine 
                                                            INNER JOIN batch 
                                                            ON batch.vaccineID = vaccine.vaccineID
                                                            INNER JOIN healthcarecentre
                                                            ON healthcarecentre.centreName =  batch.centreName
                                                            WHERE batch.quantityAvailable > 0 AND batch.expiryDate > NOW() ");
                                while ($row = mysqli_fetch_assoc($listVaccine)){
                                    ?>
                                    <tr>
                                        <td><?php echo $row['batchNo'] ?></td>
                                        <td><?php echo $row['centreName'] ?></td>
                                        <td><?php echo $row['address'] ?></td>
                                        <td><?php echo $row['manufacturer'] ?></td>
                                        <td><?php echo $row['vaccineName'] ?></td>
                                        <td><?php echo $row['expiryDate'] ?></td>
                                        <td><?php echo $row['quantityAvailable'] ?></td>
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
                            if($_GET['message'] == "fail"){
                                echo "<div class='alert alert-danger' role='alert'>The data could not be saved!</div>";
                            } else if($_GET['message'] == "invalidBatch"){
                                echo "<div class='alert alert-danger' role='alert'>Batch have not been found!</div>";
                            } else if($_GET['message'] == "invalidDate"){
                                echo "<div class='alert alert-danger' role='alert'>Date is past the expiration date!</div>";
                            }
                        }
                        ?>
                        <form method="POST" action="process-create.php">
                            <input class="form-control" type="hidden" name="fullname" value="<?php echo $_SESSION['fullname'] ?>">
                            <div class="form-group">
                                <label>Batch No</label>
                                <input class="form-control" type="text" name="batchNo">
                            </div>
                            <div class="form-group">
                                <label>Appointment Date</label>
                                <input class="form-control" type="date" name="appointmentDate">
                            </div>
                            <div class="form-group">
                                <a class="btn btn-primary" href="../view-vaccination/view.php">Back</a>
                                <input class="btn btn-success" type="submit" value="Submit">
                            </div>
                        </form>
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

<script>
    var today = new Date().toISOString().split('T')[0];
    document.getElementsByName("appointmentDate")[0].setAttribute('min', today);
</script>

</body>

</html>