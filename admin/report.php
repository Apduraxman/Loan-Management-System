<?php
date_default_timezone_set("Etc/GMT+8");
include("session.php");
include("class.php");
include("inc/header.php");
$db = new db_class();

$type = isset($_GET['type']) ? $_GET['type'] : 'borrower';
$title = ucfirst($type) . ' Report';

// Get selected ID from GET
$selected_id = isset($_GET['selected_id']) ? $_GET['selected_id'] : '';
?>


<body id="page-top">
    <div id="wrapper">
        <?php include("inc/sidebar.php"); ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- Topbar Navbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow noprint">
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
                <div class="container-fluid">
                    <div class="d-flex justify-content-between align-items-center mb-4 noprint">
                        <h1 class="h3 mb-0 text-gray-800"><?php echo $title; ?></h1>
                        <button onclick="window.print()" class="btn btn-primary"><i class="fas fa-print"></i> Print</button>
                    </div>
                    <!-- Filter Form -->
                    <form method="get" class="mb-3">
                        <input type="hidden" name="type" value="<?php echo htmlspecialchars($type); ?>">
                        <label for="selected_id">Select <?php echo $type; ?> by Number:</label>
                        <select name="selected_id" id="selected_id" class="form-control" style="width:auto;display:inline-block;">
                            <option value="">All</option>
                            <?php
                            if ($type == 'borrower') {
                                $tbl_borrower = $db->display_borrower();
                                $i = 1;
                                while ($row = $tbl_borrower->fetch_array()) {
                                    echo '<option value="' . $row['borrower_id'] . '" ' . ($selected_id == $row['borrower_id'] ? 'selected' : '') . '>' . $i++ . ' - ' . htmlspecialchars($row['firstname'] . ' ' . $row['lastname']) . '</option>';
                                }
                            } elseif ($type == 'loan') {
                                $tbl_loan = $db->display_loan();
                                $i = 1;
                                while ($row = $tbl_loan->fetch_array()) {
                                    echo '<option value="' . $row['loan_id'] . '" ' . ($selected_id == $row['loan_id'] ? 'selected' : '') . '>' . $i++ . ' - ' . htmlspecialchars($row['ref_no']) . '</option>';
                                }
                            }
                            // Add more types if needed
                            ?>
                        </select>
                        <button type="submit" class="btn btn-info">Filter</button>
                    </form>
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <?php if ($type == 'borrower'): ?>
                                    <table class="table table-bordered" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Firstname</th>
                                                <th>Middlename</th>
                                                <th>Lastname</th>
                                                <th>Contact</th>
                                                <th>Address</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $tbl_borrower = $db->display_borrower();
                                            $i = 1;
                                            while ($row = $tbl_borrower->fetch_array()) {
                                                if ($selected_id && $row['borrower_id'] != $selected_id) continue;
                                                echo '<tr>';
                                                echo '<td>' . $i++ . '</td>';
                                                echo '<td>' . htmlspecialchars($row['firstname']) . '</td>';
                                                echo '<td>' . htmlspecialchars($row['middlename']) . '</td>';
                                                echo '<td>' . htmlspecialchars($row['lastname']) . '</td>';
                                                echo '<td>' . htmlspecialchars($row['contact_no']) . '</td>';
                                                echo '<td>' . htmlspecialchars($row['address']) . '</td>';
                                                echo '</tr>';
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                <?php elseif ($type == 'loan'): ?>
                                    <table class="table table-bordered" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Ref No</th>
                                                <th>Borrower</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $tbl_loan = $db->display_loan();
                                            $i = 1;
                                            while ($row = $tbl_loan->fetch_array()) {
                                                if ($selected_id && $row['loan_id'] != $selected_id) continue;
                                                echo '<tr>';
                                                echo '<td>' . $i++ . '</td>';
                                                echo '<td>' . htmlspecialchars($row['ref_no']) . '</td>';
                                                echo '<td>' . htmlspecialchars($row['lastname'] . ', ' . $row['firstname'] . ' ' . substr($row['middlename'], 0, 1) . '.') . '</td>';
                                                echo '<td>' . htmlspecialchars($row['amount']) . '</td>';
                                                echo '<td>';
                                                switch ($row['status']) {
                                                    case 0:
                                                        echo 'For Approval';
                                                        break;
                                                    case 1:
                                                        echo 'Approved';
                                                        break;
                                                    case 2:
                                                        echo 'Released';
                                                        break;
                                                    case 3:
                                                        echo 'Completed';
                                                        break;
                                                    case 4:
                                                        echo 'Denied';
                                                        break;
                                                    default:
                                                        echo 'Unknown';
                                                }
                                                echo '</td>';
                                                echo '</tr>';
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                <?php elseif ($type == 'invest_product'): ?>
                                    <table class="table table-bordered" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Borrower</th>
                                                <th>Product Name</th>
                                                <th>Price Estimate</th>
                                                <th>Job</th>
                                                <th>Income</th>
                                                <th>Date Created</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $tbl_products = $db->display_invest_product();
                                            $i = 1;
                                            while ($row = $tbl_products->fetch_array()) {
                                                echo '<tr>';
                                                echo '<td>' . $i++ . '</td>';
                                                echo '<td>' . htmlspecialchars($row['borrower_id']) . '</td>';
                                                echo '<td>' . htmlspecialchars($row['product_name']) . '</td>';
                                                echo '<td>' . htmlspecialchars($row['price_estimate']) . '</td>';
                                                echo '<td>' . htmlspecialchars($row['job']) . '</td>';
                                                echo '<td>' . htmlspecialchars($row['income']) . '</td>';
                                                echo '<td>' . htmlspecialchars($row['date_created']) . '</td>';
                                                echo '</tr>';
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                <?php else: ?>
                                    <div class="alert alert-danger">Invalid report type.</div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <footer class="footer bg-white noprint">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>&copy; Loan Management System <?php echo date("Y"); ?></span>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/jquery.easing.js"></script>
    <script src="js/jquery.dataTables.js"></script>
    <script src="js/dataTables.bootstrap4.js"></script>
    <script src="js/sb-admin-2.js"></script>
</body>

</html>