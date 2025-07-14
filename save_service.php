<?php
require_once 'admin/class.php';
$db = new db_class();

if (isset($_POST['save'])) {
    $guarantor_full_name = $_POST['guarantor_full_name'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $job = $_POST['job'];
    $company_name = $_POST['company_name'];
    $national_id = $_POST['national_id'];
    $service_description = $_POST['service_description'];
    $customer_id = isset($_POST['customer_id']) ? intval($_POST['customer_id']) : 0; // Add this line

    if ($customer_id == 0) {
        die("Invalid customer. Please login again.");
    }

    // Handle file upload
    $documentation = '';
    if (isset($_FILES['documentation']) && $_FILES['documentation']['error'] == UPLOAD_ERR_OK) {
        $ext = pathinfo($_FILES['documentation']['name'], PATHINFO_EXTENSION);
        $filename = uniqid() . '.' . $ext;
        move_uploaded_file($_FILES['documentation']['tmp_name'], 'uploads/' . $filename);
        $documentation = $filename;
    }

    // Add customer_id to the query and binding
    $stmt = $db->conn->prepare("INSERT INTO services (guarantor_full_name, gender, address, contact, job, company_name, national_id, service_description, documentation, customer_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param(
        "sssssssssi",
        $guarantor_full_name,
        $gender,
        $address,
        $contact,
        $job,
        $company_name,
        $national_id,
        $service_description,
        $documentation,
        $customer_id
    );
    $stmt->execute();
    $stmt->close();

    header("Location: services.php?msg=Service added successfully");
    exit;
}
?>
