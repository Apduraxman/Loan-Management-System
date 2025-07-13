<?php
session_start();
require_once 'class.php';
include("inc/header.php");
$db = new db_class();

// Get customer list
$customers = $db->conn->query("SELECT id, firstname, middlename, lastname FROM customer");

// For displaying sent messages (optional)
$messages = $db->conn->query("
    SELECT m.*, c.firstname, c.middlename, c.lastname 
    FROM messages m 
    JOIN customer c ON m.customer_id = c.id 
    ORDER BY m.created_at DESC
");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_id = $_POST['customer_id'];
    $start_month = (int) $_POST['start_month'];
    $end_month = (int) $_POST['end_month'];
    $message = trim($_POST['message']);

    for ($month = $start_month; $month <= $end_month; $month++) {
        $month_name = date("F", mktime(0, 0, 0, $month, 10));
        $full_message = "[$month_name]: $message";
        $stmt = $db->conn->prepare("INSERT INTO messages (customer_id, message, is_read) VALUES (?, ?, 0)");
        $stmt->bind_param("is", $customer_id, $full_message);
        $stmt->execute();
    }

    $success = "Messages sent successfully for selected months!";
    // Refresh customer list for form after POST
    $customers = $db->conn->query("SELECT id, firstname, middlename, lastname FROM customer");
}
?>

<body id="page-top">
    <div id="wrapper">
        <?php include("inc/sidebar.php"); ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <?php include("inc/navbar.php"); ?>
                </nav>

                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h4 class="mb-0 text-gray-800 font-weight-bold">Send Message by Month</h4>
                    </div>
                    <?php if (!empty($success)): ?>
                        <div class="alert alert-success"><?= $success ?></div>
                    <?php endif; ?>

                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <form method="POST">
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="customer_id" class="form-label">Select Customer:</label>
                                        <select class="form-control" name="customer_id" required>
                                            <option value="">-- Select Customer --</option>
                                            <?php while ($row = $customers->fetch_assoc()): ?>
                                                <option value="<?= $row['id'] ?>">
                                                    <?= htmlspecialchars($row['firstname'] . ' ' . $row['middlename'] . ' ' . $row['lastname']) ?>
                                                </option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="start_month" class="form-label">Start Month:</label>
                                        <select class="form-control" name="start_month" required>
                                            <?php for ($i = 1; $i <= 12; $i++): ?>
                                                <option value="<?= $i ?>"><?= date("F", mktime(0, 0, 0, $i, 10)) ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="end_month" class="form-label">End Month:</label>
                                        <select class="form-control" name="end_month" required>
                                            <?php for ($i = 1; $i <= 12; $i++): ?>
                                                <option value="<?= $i ?>"><?= date("F", mktime(0, 0, 0, $i, 10)) ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="message" class="form-label">Message Content:</label>
                                    <textarea name="message" class="form-control" rows="3" required placeholder="Write your message here..."></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Send Messages</button>
                            </form>
                        </div>
                    </div>

                    <!-- Sent Messages Table -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Sent Messages</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Customer</th>
                                            <th>Message</th>
                                            <th>Read</th>
                                            <th>Sent At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        while ($msg = $messages->fetch_assoc()): ?>
                                            <tr>
                                                <td><?= $i++ ?></td>
                                                <td><?= htmlspecialchars($msg['firstname'] . ' ' . $msg['middlename'] . ' ' . $msg['lastname']) ?></td>
                                                <td><?= htmlspecialchars($msg['message']) ?></td>
                                                <td>
                                                    <?php if ($msg['is_read']): ?>
                                                        <span class="badge badge-success">Read</span>
                                                    <?php else: ?>
                                                        <span class="badge badge-secondary">Unread</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td><?= htmlspecialchars($msg['created_at']) ?></td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
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