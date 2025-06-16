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
    <title>Guarantors</title>
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
                        <h1 class="h3 mb-0 text-gray-800">Guarantors</h1>
                    </div>
                    <button class="mb-2 btn btn-lg btn-success" href="#" data-toggle="modal" data-target="#addModal"><span class="fa fa-plus"></span> Add Guarantor</button>
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Borrower</th>
                                            <th>Full Name</th>
                                            <th>Gender</th>
                                            <th>Address</th>
                                            <th>Contact</th>
                                            <th>Job</th>
                                            <th>Company Name</th>
                                            <th>National ID</th>
                                            <th>Documentation</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $guarantors = $db->display_guarantors();
                                        while ($row = $guarantors->fetch_array()) {
                                            $borrower = $db->get_borrower($row['borrower_id']);
                                        ?>
                                            <tr>
                                                <td><?php echo $borrower['firstname'] . ' ' . $borrower['lastname']; ?></td>
                                                <td><?php echo htmlspecialchars($row['full_name']); ?></td>
                                                <td><?php echo htmlspecialchars($row['gender']); ?></td>
                                                <td><?php echo htmlspecialchars($row['address']); ?></td>
                                                <td><?php echo htmlspecialchars($row['contact']); ?></td>
                                                <td><?php echo htmlspecialchars($row['job']); ?></td>
                                                <td><?php echo htmlspecialchars($row['company_name']); ?></td>
                                                <td><?php echo htmlspecialchars($row['national_id']); ?></td>
                                                <td>
                                                    <?php if ($row['documentation']) { ?>
                                                        <a href="uploads/<?php echo htmlspecialchars($row['documentation']); ?>" target="_blank">View</a>
                                                    <?php } else {
                                                        echo 'No file';
                                                    } ?>
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton<?php echo $row['guarantor_id']; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            Action
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton<?php echo $row['guarantor_id']; ?>">
                                                            <a class="dropdown-item bg-warning text-white" href="#" data-toggle="modal" data-target="#updateGuarantor<?php echo $row['guarantor_id']; ?>">Edit</a>
                                                            <a class="dropdown-item bg-danger text-white" href="#" data-toggle="modal" data-target="#deleteGuarantor<?php echo $row['guarantor_id']; ?>">Delete</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- Update Modal -->
                                            <div class="modal fade" id="updateGuarantor<?php echo $row['guarantor_id']; ?>" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <form method="POST" action="update_guarantor.php" enctype="multipart/form-data">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-warning">
                                                                <h5 class="modal-title text-white">Edit Guarantor</h5>
                                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <input type="hidden" name="guarantor_id" value="<?php echo $row['guarantor_id']; ?>" />
                                                                <div class="form-group">
                                                                    <label>Borrower</label>
                                                                    <select name="borrower_id" class="form-control" required>
                                                                        <?php
                                                                        $borrowers = $db->display_borrower();
                                                                        while ($b = $borrowers->fetch_array()) {
                                                                            $selected = $b['borrower_id'] == $row['borrower_id'] ? 'selected' : '';
                                                                            echo "<option value='{$b['borrower_id']}' $selected>{$b['firstname']} {$b['lastname']}</option>";
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Full Name</label>
                                                                    <input type="text" name="full_name" value="<?php echo htmlspecialchars($row['full_name']); ?>" class="form-control" required />
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Gender</label>
                                                                    <select name="gender" class="form-control" required>
                                                                        <option value="Male" <?php if ($row['gender'] == 'Male') echo 'selected'; ?>>Male</option>
                                                                        <option value="Female" <?php if ($row['gender'] == 'Female') echo 'selected'; ?>>Female</option>
                                                                        <option value="Other" <?php if ($row['gender'] == 'Other') echo 'selected'; ?>>Other</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Address</label>
                                                                    <input type="text" name="address" value="<?php echo htmlspecialchars($row['address']); ?>" class="form-control" required />
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Contact</label>
                                                                    <input type="text" name="contact" value="<?php echo htmlspecialchars($row['contact']); ?>" class="form-control"
                                                                        placeholder="Eg.[0634345678]" pattern="[0-9]{10}"
                                                                        required />
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Job</label>
                                                                    <input type="text" name="job" value="<?php echo htmlspecialchars($row['job']); ?>" class="form-control" required />
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Company Name</label>
                                                                    <input type="text" name="company_name" value="<?php echo htmlspecialchars($row['company_name']); ?>" class="form-control" required />
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>National ID</label>
                                                                    <input type="text" name="national_id" value="<?php echo htmlspecialchars($row['national_id']); ?>" class="form-control" required />
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
                                            <div class="modal fade" id="deleteGuarantor<?php echo $row['guarantor_id']; ?>" tabindex="-1" aria-hidden="true">
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
                                                            <a class="btn btn-danger" href="delete_guarantor.php?guarantor_id=<?php echo $row['guarantor_id']; ?>">Delete</a>
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
                <footer class="stocky-footer">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; Loan Management System <?php echo date("Y") ?></span>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Add Modal-->
        <div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <form method="POST" action="save_guarantor.php" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title text-white">Add Guarantor</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Borrower</label>
                                <select name="borrower_id" class="form-control" required="required">
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
                                <label>Full Name</label>
                                <input type="text" name="full_name" class="form-control" required="required" />
                            </div>
                            <div class="form-group">
                                <label>Gender</label>
                                <select name="gender" class="form-control" required="required">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" name="address" class="form-control" required="required" />
                            </div>
                            <div class="form-group">
                                <label>Contact</label>
                                <input type="text" name="contact" class="form-control" placeholder="Eg.[0634345678]" pattern="[0-9]{10}" required="required" />
                            </div>
                            <div class="form-group">
                                <label>Job</label>
                                <input type="text" name="job" class="form-control" required="required" />
                            </div>
                            <div class="form-group">
                                <label>Company Name</label>
                                <input type="text" name="company_name" class="form-control" required="required" />
                            </div>
                            <div class="form-group">
                                <label>National ID</label>
                                <input type="text" name="national_id" class="form-control" required="required" />
                            </div>
                            <div class="form-group">
                                <label>Documentation</label>
                                <input type="file" name="documentation" class="form-control" required="required" />
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