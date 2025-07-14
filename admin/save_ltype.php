<?php
	require_once 'class.php';
	if(ISSET($_POST['save'])){
		$db = new db_class();
		$ltype_name = $_POST['ltype_name'];
		$ltype_desc = $_POST['ltype_desc'];
		$min_amount = $_POST['min_amount'];
		$max_amount = $_POST['max_amount'];
		$loan_plan_id = $_POST['loan_plan_id'];

		$db->save_ltype($ltype_name, $ltype_desc, $min_amount, $max_amount, $loan_plan_id);

		header("location: loan_type.php");
	}
?>