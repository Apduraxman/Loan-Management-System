<?php
require_once 'class.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new db_class();

    $guarantor_id = $_POST['guarantor_id'];
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
    $update_doc = false;
    if (isset($_FILES['documentation']) && $_FILES['documentation']['error'] == UPLOAD_ERR_OK) {
        $upload_dir = 'uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        $file_name = time() . '_' . basename($_FILES['documentation']['name']);
        $target_file = $upload_dir . $file_name;
        if (move_uploaded_file($_FILES['documentation']['tmp_name'], $target_file)) {
            $documentation = $file_name;
            $update_doc = true;
        }
    }

    $conn = $db->conn;
    if ($update_doc) {
        $stmt = $conn->prepare("UPDATE guarantor SET borrower_id=?, full_name=?, gender=?, address=?, contact=?, job=?, company_name=?, national_id=?, documentation=? WHERE guarantor_id=?");
        $stmt->bind_param("issssssssi", $borrower_id, $full_name, $gender, $address, $contact, $job, $company_name, $national_id, $documentation, $guarantor_id);
    } else {
        $stmt = $conn->prepare("UPDATE guarantor SET borrower_id=?, full_name=?, gender=?, address=?, contact=?, job=?, company_name=?, national_id=? WHERE guarantor_id=?");
        $stmt->bind_param("isssssssi", $borrower_id, $full_name, $gender, $address, $contact, $job, $company_name, $national_id, $guarantor_id);
    }

    if ($stmt->execute()) {
        $stmt->close();
        header("Location: guarantor.php?updated=1");
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
