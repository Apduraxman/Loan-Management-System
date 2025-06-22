<?php
session_start();
if (!($_SESSION['user_id'])) {
	header('location:admin_log.php');
}
