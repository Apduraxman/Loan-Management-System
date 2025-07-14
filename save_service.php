<?php

require_once 'admin/class.php';
$db = new db_class();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $guarantor_full_name = $_POST['guarantor_full_name'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $job = $_POST['job'];
    $company_name = $_POST['company_name'];
    $national_id = $_POST['national_id'];
    $service_description = $_POST['service_description'];
    $documentation = '';

    // Handle file upload
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

    // Insert into database
    $stmt = $db->conn->prepare("INSERT INTO services 
        (guarantor_full_name, gender, address, contact, job, company_name, national_id, service_description, documentation) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param(
        "sssssssss",
        $guarantor_full_name,
        $gender,
        $address,
        $contact,
        $job,
        $company_name,
        $national_id,
        $service_description,
        $documentation
    );
    $stmt->execute();
    $stmt->close();

    echo "<script>alert('Service saved successfully!');window.location='services.php';</script>";
} else {
    echo "<script>alert('Invalid request!');window.location='services.php';</script>";
}
