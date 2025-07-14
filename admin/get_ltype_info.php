<?php
// filepath: c:\xampp\htdocs\loan-mng\admin\get_ltype_info.php
require_once 'class.php';
$db = new db_class();
if (isset($_POST['ltype_id'])) {
    $id = intval($_POST['ltype_id']);
    $row = $db->conn->query("SELECT min_amount, max_amount, loan_plan_id FROM loan_type WHERE ltype_id = $id")->fetch_assoc();
    echo json_encode($row);
}
?>