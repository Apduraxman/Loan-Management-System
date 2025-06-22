<?php
require_once 'class.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new db_class();

    $borrower_id = $_POST['borrower_id'];
    $product_name = $_POST['product_name'];
    $price_estimate = $_POST['price_estimate'];
    $job = $_POST['job'];
    $income = $_POST['income'];
    $date_created = date('Y-m-d');

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

    // Prepare and execute insert
    $conn = $db->conn;
    $stmt = $conn->prepare("INSERT INTO invest_product (borrower_id, product_name, price_estimate, job, income, documentation, date_created) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isdsdss", $borrower_id, $product_name, $price_estimate, $job, $income, $documentation, $date_created);

    if ($stmt->execute()) {
        $stmt->close();
        header("Location: Invest_product.php?success=1");
        exit();
    } else {
        $stmt->close();
        header("Location: Invest_product.php?error=1");
        exit();
    }
} else {
    header("Location: Invest_product.php");
    exit();
}
