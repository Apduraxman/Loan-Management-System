<?php
require_once 'class.php';
if (isset($_POST['update'])) {
    $db = new db_class();
    $ltype_id = $_POST['ltype_id'];
    $ltype_name = $_POST['ltype_name'];
    $ltype_desc = $_POST['ltype_desc'];
    $min_amount = $_POST['min_amount'];
    $max_amount = $_POST['max_amount'];
    $loan_plan_id = $_POST['loan_plan_id'];

    $stmt = $db->conn->prepare("UPDATE loan_type SET ltype_name=?, ltype_desc=?, min_amount=?, max_amount=?, loan_plan_id=? WHERE ltype_id=?");
    $stmt->bind_param("ssdiii", $ltype_name, $ltype_desc, $min_amount, $max_amount, $loan_plan_id, $ltype_id);
    $stmt->execute();
    $stmt->close();

    header("location: loan_type.php");
    exit;
}
?>