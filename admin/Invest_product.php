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
    <title>Invest Products</title>
    <link href="fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <link href="css/dataTables.bootstrap4.css" rel="stylesheet">
</head>

<body id="page-top">
    <div id="wrapper">
        <?php include("inc/sidebar.php"); ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $db->user_acc($_SESSION['user_id']) ?></span>
                                <img class="img-profile rounded-circle"
                                    src="image/admin_profile.svg">
                            </a>
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
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Invest Products</h1>
                    </div>
                    <button class="mb-2 btn btn-lg btn-success" href="#" data-toggle="modal" data-target="#addModal"><span class="fa fa-plus"></span> Add Invest Product</button>
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Borrower</th>
                                            <th>Product Name</th>
                                            <th>Price Estimate</th>
                                            <th>Job</th>
                                            <th>Income</th>
                                            <th>Documentation</th>
                                            <th>Date Created</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $tbl_products = $db->display_invest_product();
                                        while ($fetch = $tbl_products->fetch_array()) {
                                            // Get borrower name
                                            $borrower = $db->get_borrower($fetch['borrower_id']);
                                        ?>
                                            <tr>
                                                <td><?php echo $borrower['firstname'] . ' ' . $borrower['lastname']; ?></td>
                                                <td><?php echo $fetch['product_name']; ?></td>
                                                <td><?php echo number_format($fetch['price_estimate'], 2); ?></td>
                                                <td><?php echo $fetch['job']; ?></td>
                                                <td><?php echo number_format($fetch['income'], 2); ?></td>
                                                <td>
                                                    <?php if ($fetch['documentation']) { ?>
                                                        <a href="uploads/<?php echo htmlspecialchars($fetch['documentation']); ?>" target="_blank">View</a>
                                                    <?php } else {
                                                        echo 'No file';
                                                    } ?>
                                                </td>
                                                <td><?php echo $fetch['date_created']; ?></td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            Action
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item bg-warning text-white" href="#" data-toggle="modal" data-target="#updateProduct<?php echo $fetch['product_id'] ?>">Edit</a>
                                                            <a class="dropdown-item bg-danger text-white" href="#" data-toggle="modal" data-target="#deleteProduct<?php echo $fetch['product_id'] ?>">Delete</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- Update Modal -->
                                            <div class="modal fade" id="updateProduct<?php echo $fetch['product_id'] ?>" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <form method="POST" action="update_invest_product.php" enctype="multipart/form-data">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-warning">
                                                                <h5 class="modal-title text-white">Edit Invest Product</h5>
                                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <input type="hidden" name="product_id" value="<?php echo $fetch['product_id'] ?>" />
                                                                <div class="form-group">
                                                                    <label>Borrower</label>
                                                                    <select name="borrower_id" class="form-control" required>
                                                                        <?php
                                                                        $borrowers = $db->display_borrower();
                                                                        while ($b = $borrowers->fetch_array()) {
                                                                            $selected = $b['borrower_id'] == $fetch['borrower_id'] ? 'selected' : '';
                                                                            echo "<option value='{$b['borrower_id']}' $selected>{$b['firstname']} {$b['lastname']}</option>";
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Product Name</label>
                                                                    <input type="text" name="product_name" value="<?php echo $fetch['product_name'] ?>" class="form-control" required />
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Price Estimate</label>
                                                                    <input type="number" name="price_estimate" value="<?php echo $fetch['price_estimate'] ?>" class="form-control" step="0.01" min="0" required />
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Job</label>
                                                                    <input type="text" name="job" value="<?php echo $fetch['job'] ?>" class="form-control" required />
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Income</label>
                                                                    <input type="number" name="income" value="<?php echo $fetch['income'] ?>" class="form-control" step="0.01" min="0" required />
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Documentation (leave blank to keep current)</label>
                                                                    <input type="file" name="documentation" class="form-control" />
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                                <button type="submit" name="update" class="btn btn-warning">Update</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="deleteProduct<?php echo $fetch['product_id'] ?>" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-danger">
                                                            <h5 class="modal-title text-white">System Information</h5>
                                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">Are you sure you want to delete this record?</div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                            <a class="btn btn-danger" href="delete_invest_Product.php?product_id=<?php echo $fetch['product_id'] ?>">Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Footer -->
                <footer class="stocky-footer">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; Loan Management System <?php echo date("Y") ?></span>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Add Modal-->
        <div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <form method="POST" action="save_invest_product.php" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title text-white">Add Invest Product</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Borrower</label>
                                <select name="borrower_id" class="form-control" required>
                                    <option value="">Select Borrower</option>
                                    <?php
                                    $borrowers = $db->display_borrower();
                                    while ($b = $borrowers->fetch_array()) {
                                        echo "<option value='{$b['borrower_id']}'>{$b['firstname']} {$b['lastname']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Product Name</label>
                                <input type="text" name="product_name" class="form-control" required />
                            </div>
                            <div class="form-group">
                                <label>Price Estimate</label>
                                <input type="number" name="price_estimate" class="form-control" step="0.01" min="0" required />
                            </div>
                            <div class="form-group">
                                <label>Job</label>
                                <input type="text" name="job" class="form-control" required />
                            </div>
                            <div class="form-group">
                                <label>Income</label>
                                <input type="number" name="income" class="form-control" step="0.01" min="0" required />
                            </div>
                            <div class="form-group">
                                <label>Documentation</label>
                                <input type="file" name="documentation" class="form-control" required />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <button type="submit" name="save" class="btn btn-primary">Save</button>
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
        <script src="js/jquery.easing.js"></script>
        <script src="js/jquery.dataTables.js"></script>
        <script src="js/dataTables.bootstrap4.js"></script>
        <script src="js/sb-admin-2.js"></script>
        <script>
            $(document).ready(function() {
                $('#dataTable').DataTable({
                    "order": [
                        [1, "asc"]
                    ]
                });
            });
        </script>
</body>

</html>