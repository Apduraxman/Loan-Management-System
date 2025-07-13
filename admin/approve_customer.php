<?php
require_once 'class.php';
require_once 'session.php'; // Use your session management file

$db = new db_class();

if (isset($_POST['approve'])) {
    $customer_id = $_POST['customer_id'];
    // Get customer info
    $stmt = $db->conn->prepare("SELECT * FROM customer WHERE id = ?");
    $stmt->bind_param("i", $customer_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $customer = $result->fetch_assoc();
    $stmt->close();

    if ($customer) {
        // Insert into borrower table
        $stmt2 = $db->conn->prepare("INSERT INTO borrower (firstname, middlename, lastname, email, contact_no, address, national_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt2->bind_param(
            "sssssss",
            $customer['firstname'],
            $customer['middlename'],
            $customer['lastname'],
            $customer['email'],
            $customer['phone'],
            $customer['address'],
            $customer['tax_id']
        );
        $stmt2->execute();
        $stmt2->close();
        // Optionally update loan_requests status to Approved
        $db->conn->query("UPDATE loan_requests SET status='Approved' WHERE customer_id='$customer_id'");
        header("Location: costumerBorrowerView.php?approved=1");
        exit();
    }
} elseif (isset($_POST['reject'])) {
    $customer_id = $_POST['customer_id'];
    // Optionally update loan_requests status to Rejected
    $db->conn->query("UPDATE loan_requests SET status='Rejected' WHERE customer_id='$customer_id'");
    header("Location: costumerBorrowerView.php?rejected=1");
    exit();
}
header("Location: costumerBorrowerView.php ");
exit();
