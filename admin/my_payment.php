<?php
session_start();
require_once 'class.php';
$db = new db_class();

// Hubi haddii customer-ka uu login galay
if (!isset($_SESSION['customer_id'])) {
    header("Location: customer_login.php");
    exit();
}

$customer_id = $_SESSION['customer_id'];

// Haddii table-kaaga uu leeyahay borrower_id halkii uu ka ahaan lahaa customer_id
$loans = $db->conn->query("SELECT loan_id FROM loan WHERE borrower_id = $customer_id");

$loan_ids = [];
while ($row = $loans->fetch_assoc()) {
    $loan_ids[] = $row['loan_id'];
}

$payment_results = [];

if (count($loan_ids) > 0) {
    $loan_ids_str = implode(",", $loan_ids);
    $payments = $db->conn->query("
        SELECT p.*, l.ref_no 
        FROM payment p 
        JOIN loan l ON p.loan_id = l.loan_id 
        WHERE p.loan_id IN ($loan_ids_str)
    ");

    while ($fetch = $payments->fetch_assoc()) {
        $payment_results[] = $fetch;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Payments</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>My Payments</h2>

    <?php if (empty($payment_results)): ?>
        <div class="alert alert-info">You have no payments yet.</div>
    <?php else: ?>
        <table class="table table-bordered">
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
                <?php $i=1; foreach ($payment_results as $payment): ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= htmlspecialchars($payment['ref_no']) ?></td>
                        <td><?= htmlspecialchars($payment['payee']) ?></td>
                        <td>$<?= number_format($payment['pay_amount'], 2) ?></td>
                        <td>$<?= number_format($payment['penalty'], 2) ?></td>
                        <td><?= htmlspecialchars($payment['date_created']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <a href="customer_dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
</div>

</body>
</html>
