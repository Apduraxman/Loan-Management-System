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
            // Insert into borrower table
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
            $borrower_id = $db->conn->insert_id;
            $stmt->close();
        } else {
            $borrower = $check->fetch_assoc();
            $borrower_id = $borrower['borrower_id'];
        }

        // Get loan request info
        $loan_req = $db->conn->query("SELECT * FROM loan_requests WHERE request_id = $request_id")->fetch_assoc();

        // Insert new loan into loan table
        $date_created = !empty($loan_req['created_at']) ? $loan_req['created_at'] : date('Y-m-d H:i:s');

        $loan_stmt = $db->conn->prepare("
            INSERT INTO loan (borrower_id, lplan_id, ltype_id, amount, purpose, date_created, status, ref_no)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $loan_stmt->bind_param(
            "iiidssss",
            $borrower_id,
            $loan_req['loan_plan'],
            $loan_req['loan_type_id'],
            $loan_req['amount'],
            $loan_req['reason'],
            $date_created,
            $status,
            $cust['phone'] // ref_no will be set to phone
        );
        $loan_stmt->execute();
        $loan_stmt->close();
    }

    header("Location: customerBorrowerView.php?msg=Status updated successfully!");
    exit;
}
