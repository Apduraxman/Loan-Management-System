<?php
session_start();
require_once 'class.php';
$db = new db_class();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Make sure the POST variables exist
    if (!isset($_POST['loan_request_id'], $_POST['status'])) {
        die("Invalid request.");
    }

    $loan_request_id = intval($_POST['loan_request_id']);
    $status = $_POST['status'];

    // Update status in loan_requests table
    $stmt = $db->conn->prepare("UPDATE loan_requests SET status = ? WHERE loan_request_id = ?");
    $stmt->bind_param("si", $status, $loan_request_id);
    $stmt->execute();

    if ($stmt->affected_rows === 0) {
        die("No loan request found with that ID.");
    }

    // If approved, insert into loan and borrowers tables
    if ($status === 'Approved') {
        // Fetch loan request details
        $query = $db->conn->prepare("SELECT * FROM loan_requests WHERE loan_request_id = ?");
        $query->bind_param("i", $loan_request_id);
        $query->execute();
        $result = $query->get_result();
        $loan = $result->fetch_assoc();

        if (!$loan) {
            die("Loan request not found.");
        }

        $customer_id = $loan['customer_id'];
        $loan_type_id = $loan['loan_type_id'];
        $loan_plan_id = $loan['loan_plan_id'];
        $amount = $loan['amount'];
        $monthly_pay = $loan['monthly_pay'];
        $months = $loan['months'];
        $start_date = date("Y-m-d");

        // Insert into loan table
        $stmt2 = $db->conn->prepare("INSERT INTO loan (customer_id, loan_type_id, loan_plan_id, amount, monthly_pay, months, start_date) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt2->bind_param("iiiddis", $customer_id, $loan_type_id, $loan_plan_id, $amount, $monthly_pay, $months, $start_date);
        $stmt2->execute();

        // Check if customer exists in borrowers table
        $check = $db->conn->prepare("SELECT 1 FROM borrowers WHERE customer_id = ?");
        $check->bind_param("i", $customer_id);
        $check->execute();
        $res = $check->get_result();

        if ($res->num_rows === 0) {
            // Insert customer into borrowers table
            $stmt3 = $db->conn->prepare("INSERT INTO borrowers (customer_id) VALUES (?)");
            $stmt3->bind_param("i", $customer_id);
            $stmt3->execute();
        }
    }

    header("Location: view_customer_loan.php");
    exit();
} else {
    // If accessed without POST, redirect or error
    header("Location: view_customer_requests.php");
    exit();
}
