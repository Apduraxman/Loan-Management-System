<?php
require_once 'class.php';

if (isset($_GET['guarantor_id'])) {
    $db = new db_class();
    $guarantor_id = $_GET['guarantor_id'];

    // Delete documentation file if exists
    $conn = $db->conn;
    $stmt = $conn->prepare("SELECT documentation FROM guarantor WHERE guarantor_id = ?");
    $stmt->bind_param("i", $guarantor_id);
    $stmt->execute();
    $stmt->bind_result($documentation);
    if ($stmt->fetch() && $documentation) {
        $file_path = 'uploads/' . $documentation;
        if (file_exists($file_path)) {
            unlink($file_path);
        }
    }
    $stmt->close();

    // Delete the record
    $stmt = $conn->prepare("DELETE FROM guarantor WHERE guarantor_id = ?");
    $stmt->bind_param("i", $guarantor_id);
    $stmt->execute();
    $stmt->close();

    header("Location: guarantor.php?deleted=1");
    exit();
} else {
    header("Location: guarantor.php");
    exit();
}
