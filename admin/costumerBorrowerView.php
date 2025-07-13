<?php
include("session.php");
include("class.php");
include("inc/header.php");

$db = new db_class();

$requests = $db->conn->query("
    SELECT lr.*, lt.ltype_name, lp.lplan_month, lp.lplan_interest, lp.lplan_penalty, c.*
    FROM loan_requests lr
    JOIN loan_type lt ON lr.loan_type_id = lt.ltype_id
    JOIN loan_plan lp ON lr.loan_plan = lp.lplan_id
    JOIN customer c ON lr.customer_id = c.id
    ORDER BY lr.date_requested DESC
");
?>

<body id="page-top">
    <div id="wrapper">
        <?php include("inc/sidebar.php"); ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <?php include("inc/navbar.php"); ?>
                </nav>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h4 class="mb-0 text-gray-800 font-weight-bold">Loan Requests</h4>
                    </div>
                    <?php if (isset($_GET['msg'])): ?>
                        <div class="alert alert-success"><?= htmlspecialchars($_GET['msg']) ?></div>
                    <?php endif; ?>
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Customer</th>
                                            <th>Loan Type</th>
                                            <th>Loan Plan</th>
                                            <th>Amount ($)</th>
                                            <th>Details</th>
                                            <th>Status</th>
                                            <th>Date Needed</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        while ($row = $requests->fetch_assoc()): ?>
                                            <tr>
                                                <td><?= $i++ ?></td>
                                                <td><?= htmlspecialchars($row['firstname'] . ' ' . $row['middlename'] . ' ' . $row['lastname']) ?></td>
                                                <td><?= htmlspecialchars($row['ltype_name']) ?></td>
                                                <td><?= htmlspecialchars($row['lplan_month']) ?> months</td>
                                                <td><?= number_format($row['amount'], 2) ?></td>
                                                <td>
                                                    <a href="#" class="btn btn-sm btn-info" data-toggle="modal" data-target="#detailsModal<?= $row['request_id'] ?>">View</a>
                                                    <div class="modal fade" id="detailsModal<?= $row['request_id'] ?>" tabindex="-1" aria-labelledby="detailsModalLabel<?= $row['request_id'] ?>" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-scrollable modal-sm">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="detailsModalLabel<?= $row['request_id'] ?>">Loan Details</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <strong>Reason:</strong><br>
                                                                    <?= nl2br(htmlspecialchars($row['reason'])) ?><br><br>
                                                                    <strong>Phone:</strong> <?= htmlspecialchars($row['phone']) ?><br>
                                                                    <strong>Email:</strong> <?= htmlspecialchars($row['email']) ?><br>
                                                                    <strong>Address:</strong> <?= htmlspecialchars($row['address']) ?><br>
                                                                    <strong>Loan ID:</strong> <?= $row['request_id'] ?><br>
                                                                    <strong>Interest:</strong> <?= $row['lplan_interest'] ?>%<br>
                                                                    <strong>Penalty:</strong> <?= $row['lplan_penalty'] ?>%
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><?= htmlspecialchars($row['status']) ?></td>
                                                <td><?= htmlspecialchars($row['date_needed']) ?></td>
                                                <td><?= htmlspecialchars($row['date_requested']) ?></td>
                                                <td>
                                                    <?php if ($row['status'] == 'Pending'): ?>
                                                        <form action="update_loan_status.php" method="POST">
                                                            <input type="hidden" name="request_id" value="<?= $row['request_id'] ?>">
                                                            <input type="hidden" name="customer_id" value="<?= $row['id'] ?>">
                                                            <select name="status" class="form-control form-control-sm">
                                                                <option value="Pending" <?= $row['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
                                                                <option value="Approved">Approve</option>
                                                                <option value="Rejected">Reject</option>
                                                            </select>
                                                            <button type="submit" class="btn btn-primary btn-sm mt-1">Submit</button>
                                                        </form>
                                                    <?php else: ?>
                                                        <span class="badge badge-<?= $row['status'] == 'Approved' ? 'success' : 'danger' ?>">
                                                            <?= $row['status'] ?>
                                                        </span>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Main Content -->

                <?php include("inc/footer.php"); ?>

            </div>
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/jquery.easing.js"></script>
    <script src="js/jquery.dataTables.js"></script>
    <script src="js/dataTables.bootstrap4.js"></script>
    <script src="js/sb-admin-2.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
</body>

</html>