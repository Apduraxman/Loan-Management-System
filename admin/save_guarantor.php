<?php
require_once 'class.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new db_class();

    $borrower_id = $_POST['borrower_id'];
    $full_name = $_POST['full_name'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $job = $_POST['job'];
    $company_name = $_POST['company_name'];
    $national_id = $_POST['national_id'];

    // Handle file upload
    $documentation = '';
    if (isset($_FILES['documentation']) && $_FILES['documentation']['error'] == UPLOAD_ERR_OK) {
        $upload_dir = 'uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        $file_name = time() . '_' . basename($_FILES['documentation']['name']);
        $target_file = $upload_dir . $file_name;
        if (move_uploaded_file($_FILES['documentation']['tmp_name'], $target_file)) {
            $documentation = $file_name;
        }
    }

    $conn = $db->conn;
    $stmt = $conn->prepare("INSERT INTO guarantor (borrower_id, full_name, gender, address, contact, job, company_name, national_id, documentation) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssssss", $borrower_id, $full_name, $gender, $address, $contact, $job, $company_name, $national_id, $documentation);

    if ($stmt->execute()) {
        $stmt->close();
        header("Location: guarantor.php?success=1");
        exit();
    } else {
        $stmt->close();
        header("Location: guarantor.php?error=1");
        exit();
    }
} else {
    header("Location: guarantor.php");
    exit();
}
