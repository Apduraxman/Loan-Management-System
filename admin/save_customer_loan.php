<?php
session_start();
require_once 'class.php';

if (!isset($_SESSION['customer_id'])) {
    header("Location: customer_login.php");
    exit();
}

$db = new db_class();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_id = $_SESSION['customer_id'];
    $loan_type_id = $_POST['loan_type'];
    $loan_plan_id = $_POST['loan_plan'];
    $amount = $_POST['amount'];
    $reason = $_POST['reason'];
    $date_needed = $_POST['date_needed'];

    // Hubi in id-yada la soo diray ay jiraan
    if ($db->loan_type_exists($loan_type_id) && $db->loan_plan_exists($loan_plan_id)) {
        $success = $db->add_loan_request($customer_id, $loan_type_id, $loan_plan_id, $amount, $reason, $date_needed);
        if ($success) {
            echo "<script>alert('Loan request submitted successfully.'); window.location='customer_dashboard.php';</script>";
        } else {
            echo "<script>alert('Failed to submit loan request.'); window.location='request_loan.php';</script>";
        }
    } else {
        echo "<script>alert('Invalid loan type or loan plan selected.'); window.location='request_loan.php';</script>";
    }
} else {
    header("Location: request_loan.php");
}
?>
