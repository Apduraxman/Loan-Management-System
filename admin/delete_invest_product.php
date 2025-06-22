<?php
require_once 'class.php';

if (isset($_GET['product_id'])) {
    $db = new db_class();
    $product_id = $_GET['product_id'];

    // Optionally, delete the documentation file from uploads
    $conn = $db->conn;
    $stmt = $conn->prepare("SELECT documentation FROM invest_product WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $stmt->bind_result($documentation);
    if ($stmt->fetch() && $documentation) {
        $file_path = 'uploads/' . $documentation;
        if (file_exists($file_path)) {
            unlink($file_path);
        }
    }
    $stmt->close();

    // Delete the product
    $stmt = $conn->prepare("DELETE FROM invest_product WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $stmt->close();

    header("Location: Invest_product.php?deleted=1");
    exit();
} else {
    header("Location: Invest_product.php");
    exit();
}
