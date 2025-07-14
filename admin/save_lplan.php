<?php
	require_once 'class.php';
	if(ISSET($_POST['save'])){
		$db = new db_class();
		$lplan_month = $_POST['lplan_month'];
		$lplan_interest = $_POST['lplan_interest'];
		$lplan_penalty = $_POST['lplan_penalty'];
		$ltype_id = $_POST['ltype_id'];
		$min_amount = $_POST['min_amount'];
		$max_amount = $_POST['max_amount'];

		$db->save_lplan($lplan_month, $lplan_interest, $lplan_penalty, $ltype_id, $min_amount, $max_amount);

		header("location: loan_plan.php");
	}
?>