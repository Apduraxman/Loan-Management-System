<?php
require_once 'class.php';
$db = new db_class();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $request_id = $_POST['request_id'];
    $status = $_POST['status'];
    $customer_id = $_POST['customer_id'];

    // Update loan_requests status
    $db->conn->query("UPDATE loan_requests SET status = '$status' WHERE request_id = $request_id");

    if ($status === 'Approved') {
        // Get customer data
        $cust = $db->conn->query("SELECT * FROM customer WHERE id = $customer_id")->fetch_assoc();

        // Check if already in borrower table by email
        $check = $db->conn->query("SELECT * FROM borrower WHERE email = '" . $db->conn->real_escape_string($cust['email']) . "'");
        if ($check->num_rows == 0) {
            // Insert into borrower table (adjust columns as needed)
            $stmt = $db->conn->prepare("
                INSERT INTO borrower (firstname, middlename, lastname, email, contact_no, address, tax_id)
                VALUES (?, ?, ?, ?, ?, ?, ?)
            ");
            $stmt->bind_param(
                "sssssss",
                $cust['firstname'],
                $cust['middlename'],
                $cust['lastname'],
                $cust['email'],
                $cust['phone'],
                $cust['address'],
                $cust['tax_id']
            );
            $stmt->execute();
            $stmt->close();
        }
    }

    header("Location: view_loan_requests.php?msg=Status updated successfully!");
    exit;
}
