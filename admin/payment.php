<?php
date_default_timezone_set("Etc/GMT+8");
require_once 'session.php';
require_once 'class.php';
$db = new db_class();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
        }
    </style>


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Loan Management System</title>

    <link href="fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">


    <link href="css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="css/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="css/select2.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php include("inc/sidebar.php"); ?>

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

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $db->user_acc($_SESSION['user_id']) ?></span>
                                <img class="img-profile rounded-circle"
                                    src="image/admin_profile.svg">
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
                        <h1 class="h3 mb-0 text-gray-800">Payment List</h1>
                    </div>
                    <div class="row">
                        <button class="ml-3 mb-3 btn btn-lg btn-primary" href="#" data-toggle="modal" data-target="#addModal"><span class="fa fa-plus"></span> New Payment</button>
                    </div>

                    <!-- Add Payment Report Filter & Print Button -->
                    <div class="row mb-3">
                        <form method="get" class="form-inline">
                            <label for="payee_id" class="mr-2">Filter by Payee:</label>
                            <select name="payee_id" id="payee_id" class="form-control mr-2" style="width:auto;">
                                <option value="">All</option>
                                <?php
                                $payees = $db->conn->query("SELECT DISTINCT payee FROM payment");
                                while ($row = $payees->fetch_assoc()) {
                                    $selected = (isset($_GET['payee_id']) && $_GET['payee_id'] == $row['payee']) ? 'selected' : '';
                                    echo '<option value="' . htmlspecialchars($row['payee']) . '" ' . $selected . '>' . htmlspecialchars($row['payee']) . '</option>';
                                }
                                ?>
                            </select>
                            <button type="submit" class="btn btn-info mr-2">Filter</button>
                            <button type="button" class="btn btn-primary" onclick="window.print();"><i class="fas fa-print"></i> Print</button>
                        </form>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Loan Reference No.</th>
                                            <th>Payee</th>
                                            <th>Amount</th>
                                            <th>Penalty</th>
                                            <th>Payment Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $where = "";
                                        if (isset($_GET['payee_id']) && $_GET['payee_id'] != "") {
                                            $payee = $db->conn->real_escape_string($_GET['payee_id']);
                                            $where = " WHERE payment.payee = '$payee' ";
                                        }
                                        $tbl_payment = $db->conn->query("SELECT payment.*, borrower.firstname, borrower.middlename, borrower.lastname, loan.ref_no, payment.pay_amount, payment.penalty, payment.payment_date FROM payment INNER JOIN loan ON payment.loan_id=loan.loan_id INNER JOIN borrower ON loan.borrower_id=borrower.borrower_id $where");
                                        $i = 1;
                                        while ($fetch = $tbl_payment->fetch_array()) {
                                        ?>
                                            <tr>
                                                <td><?php echo $i++ ?></td>
                                                <td><?php echo $fetch['ref_no'] ?></td>
                                                <td>
                                                    <?php
                                                    echo isset($fetch['firstname']) ? htmlspecialchars($fetch['firstname']) : '';
                                                    if (!empty($fetch['middlename'])) {
                                                        echo ' ' . htmlspecialchars($fetch['middlename']);
                                                    }
                                                    echo isset($fetch['lastname']) ? ' ' . htmlspecialchars($fetch['lastname']) : '';
                                                    ?>
                                                </td>
                                                <td><?php echo "&#36; " . number_format($fetch['pay_amount'], 2) ?></td>
                                                <td><?php echo "&#36; " . number_format($fetch['penalty'], 2) ?></td>
                                                <td><?php echo htmlspecialchars($fetch['payment_date']); ?></td>
                                            </tr>

                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <footer class="stocky-footer">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; Loan Management System <?php echo date("Y") ?></span>
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


        <!-- Add Loan Modal-->
        <div class="modal fade" id="addModal" aria-hidden="true">
            <div class="modal-dialog">
                <form method="POST" action="save_payment.php">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title text-white">Payment Form</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-row">
                                <div class="form-group col-xl-5 col-md-5">
                                    <label>Reference no</label>
                                    <br />
                                    <select name="loan_id" class="ref_no" id="ref_no" required="required" style="width:100%;">
                                        <option value=""></option>
                                        <?php
                                        $tbl_loan = $db->display_loan();
                                        while ($fetch = $tbl_loan->fetch_array()) {
                                            if ($fetch['status'] == 2) {
                                        ?>
                                                <option value="<?php echo $fetch['loan_id'] ?>"><?php echo $fetch['ref_no'] ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-xl-5 col-md-5">
                                <label>Payment Date</label>
                                <input type="date" name="payment_date" class="form-control" required="required" value="<?php echo date('Y-m-d'); ?>" />
                            </div>
                            <div id="formField"></div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <button type="submit" name="save" class="btn btn-primary">Save</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h5 class="modal-title text-white">System Information</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Are you sure you want to logout?</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-danger" href="logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.bundle.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="js/jquery.easing.js"></script>
        <script src="js/select2.js"></script>


        <!-- Page level plugins -->
        <script src="js/jquery.dataTables.js"></script>
        <script src="js/dataTables.bootstrap4.js"></script>


        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.js"></script>

        <script>
            $(document).ready(function() {

                $('#dataTable').DataTable();

                $('.ref_no').select2({
                    placeholder: 'Select an option'
                });

                $('#ref_no').on('change', function() {
                    if ($('#ref_no').val() == "") {
                        $('#formField').empty();
                    } else {
                        $('#formField').empty();
                        $('#formField').load("get_field.php?loan_id=" + $(this).val());
                    }
                });
            });
        </script>

</body>

</html>