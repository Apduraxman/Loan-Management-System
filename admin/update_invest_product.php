<?php
require_once 'class.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new db_class();

    $product_id = $_POST['product_id'];
    $borrower_id = $_POST['borrower_id'];
    $product_name = $_POST['product_name'];
    $price_estimate = $_POST['price_estimate'];
    $job = $_POST['job'];
    $income = $_POST['income'];
    $date_created = date('Y-m-d');

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
        $stmt = $conn->prepare("UPDATE invest_product SET borrower_id=?, product_name=?, price_estimate=?, job=?, income=?, documentation=?, date_created=? WHERE product_id=?");
        $stmt->bind_param("isdsdssi", $borrower_id, $product_name, $price_estimate, $job, $income, $documentation, $date_created, $product_id);
    } else {
        $stmt = $conn->prepare("UPDATE invest_product SET borrower_id=?, product_name=?, price_estimate=?, job=?, income=?, date_created=? WHERE product_id=?");
        $stmt->bind_param("isdsdsi", $borrower_id, $product_name, $price_estimate, $job, $income, $date_created, $product_id);
    }

    if ($stmt->execute()) {
        $stmt->close();
        header("Location: Invest_product.php?updated=1");
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
