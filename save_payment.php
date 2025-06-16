<?php
date_default_timezone_set("Etc/GMT+8");
require_once 'class.php';

if (isset($_POST['save'])) {
    $db = new db_class();

    // Get input values from POST
    $loan_id = $_POST['loan_id'];
    $payee = $_POST['payee'];
    $penalty = $_POST['penalty'];
    $payable = str_replace(",", "", $_POST['payable']);
    $payment = $_POST['payment'];
    $month = $_POST['month'];
    $payment_date = $_POST['payment_date'];

    // Determine overdue status
    $overdue = ($penalty == 0) ? 0 : 1;

    // Check payment validity
    if ($payable != $payment) {
        echo "<script>alert('Please enter a correct amount to pay!')</script>";
        echo "<script>window.location='payment.php'</script>";
        exit();
    } else {
        // Save payment to database
        $stmt = $db->conn->prepare("INSERT INTO payment (loan_id, payee, pay_amount, penalty, overdue, payment_date) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssis", $loan_id, $payee, $payment, $penalty, $overdue, $payment_date);
        $stmt->execute();

        // Count how many payments are already made
        $count_pay_query = $db->conn->query("SELECT * FROM `payment` WHERE `loan_id` = '$loan_id'");
        if (!$count_pay_query) {
            die("Query Error: " . $db->conn->error);
        }

        $count_pay = $count_pay_query->num_rows;

        // If payments complete, update loan status to '3' (completed)
        if ($count_pay == $month) {
            $update = $db->conn->query("UPDATE `loan` SET `status` = '3' WHERE `loan_id` = '$loan_id'");
            if (!$update) {
                die("Update Error: " . $db->conn->error);
            }
        }

        // Optional: close connection here if you want
        $db->conn->close();

        // Redirect after success
        header("Location: payment.php");
        exit();
    }
}
