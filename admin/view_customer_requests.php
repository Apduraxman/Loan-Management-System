<?php
session_start();
require_once 'class.php';
$db = new db_class();

// Haddii aad rabto macmiil gaar ah:
$customer_id = $_SESSION['customer_id'] ?? null;

if ($customer_id) {
    // Halkan waxaad ku qori kartaa query soo saaraya requests-ka macmiilkaas kaliya
    $requests = $db->conn->query("
      SELECT lr.*, lt.ltype_name, lp.lplan_month, lp.lplan_interest, lp.lplan_penalty 
        FROM loan_requests lr
        JOIN loan_type lt ON lr.loan_type_id = lt.ltype_id
        JOIN loan_plan lp ON lr.loan_plan = lp.lplan_id
        WHERE lr.customer_id = $customer_id
        ORDER BY lr.date_requested DESC

    ");
} else {
    // Ama dhammaan codsiyada (admin view)
    $requests = $db->conn->query("
        SELECT lr.*, lt.ltype_name, lp.lplan_month, lp.lplan_interest, lp.lplan_penalty, c.name as customer_name
        FROM loan_requests lr
        JOIN loan_type lt ON lr.loan_type_id = lt.ltype_id
        JOIN loan_plan lp ON lr.loan_plan_id = lp.lplan_id
        JOIN customer c ON lr.customer_id = c.id
        ORDER BY lr.created_at DESC
    ");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Loan Requests</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Loan Requests</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Customer</th>
                <th>Loan Type</th>
                <th>Loan Plan (months)</th>
                <th>Amount ($)</th>
                <th>Reason</th>
                <th>Date Needed</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Update Status</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $i = 1;
        while ($row = $requests->fetch_assoc()):
        ?>
            <tr>
                <td><?= $i++ ?></td>
                <td><?= isset($row['customer_name']) ? htmlspecialchars($row['customer_name']) : 'You' ?></td>
                <td><?= htmlspecialchars($row['ltype_name']) ?></td>
                <td><?= htmlspecialchars($row['lplan_month']) ?></td>
                <td><?= number_format($row['amount'], 2) ?></td>
                <td><?= htmlspecialchars($row['reason']) ?></td>
                <td><?= htmlspecialchars($row['date_needed']) ?></td>
                <td><?= htmlspecialchars($row['status']) ?></td>
                <td><?= htmlspecialchars($row['date_requested']) ?></td>
                <td>
                    <form method="POST" action="update_loan_status.php" style="display:inline;">
                        <input type="hidden" name="request_id" value="<?= $row['request_id'] ?>">
                        <select name="status" class="form-select form-select-sm" required>
                            <option value="Pending" <?= $row['status']=='Pending' ? 'selected' : '' ?>>Pending</option>
                            <option value="Approved" <?= $row['status']=='Approved' ? 'selected' : '' ?>>Approved</option>
                            <option value="Rejected" <?= $row['status']=='Rejected' ? 'selected' : '' ?>>Rejected</option>
                        </select>
                        <button type="submit" class="btn btn-sm btn-primary mt-1">Update</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>

    <a href="customer_dashboard.php" class="btn btn-secondary">Back</a>
</div>
</body>
</html>

