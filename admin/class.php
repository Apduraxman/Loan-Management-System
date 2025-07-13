<?php
require_once 'config.php';

class db_class extends db_connect
{

	public function __construct()
	{
		$this->connect();
	}


	/* User Function */

	public function add_user($username, $password, $firstname, $lastname)
	{
		$query = $this->conn->prepare("INSERT INTO `user` (`username`, `password`, `firstname`, `lastname`) VALUES(?, ?, ?, ?)") or die($this->conn->error);
		$query->bind_param("ssss", $username, $password, $firstname, $lastname);

		if ($query->execute()) {
			$query->close();
			$this->conn->close();
			return true;
		}
	}

	public function update_user($user_id, $username, $password, $firstname, $lastname)
	{
		$query = $this->conn->prepare("UPDATE `user` SET `username`=?, `password`=?, `firstname`=?, `lastname`=? WHERE `user_id`=?") or die($this->conn->error);
		$query->bind_param("ssssi", $username, $password, $firstname, $lastname, $user_id);

		if ($query->execute()) {
			$query->close();
			$this->conn->close();
			return true;
		}
	}

	public function login($username, $password)
	{
		$query = $this->conn->prepare("SELECT * FROM `user` WHERE `username`='$username' && `password`='$password'") or die($this->conn->error);
		if ($query->execute()) {

			$result = $query->get_result();

			$valid = $result->num_rows;

			$fetch = $result->fetch_array();

			return array(
				'user_id' => isset($fetch['user_id']) ? $fetch['user_id'] : 0,
				'count' => isset($valid) ? $valid : 0
			);
		}
	}

	public function user_acc($user_id)
	{
		$query = $this->conn->prepare("SELECT * FROM `user` WHERE `user_id`='$user_id'") or die($this->conn->error);
		if ($query->execute()) {
			$result = $query->get_result();

			$valid = $result->num_rows;

			$fetch = $result->fetch_array();

			return $fetch['firstname'] . " " . $fetch['lastname'];
		}
	}

	function hide_pass($str)
	{
		$len = strlen($str);

		return str_repeat('*', $len);
	}

	public function display_user()
	{
		$query = $this->conn->prepare("SELECT * FROM `user`") or die($this->conn->error);
		if ($query->execute()) {
			$result = $query->get_result();
			return $result;
		}
	}


	public function delete_user($user_id)
	{
		$query = $this->conn->prepare("DELETE FROM `user` WHERE `user_id` = '$user_id'") or die($this->conn->error);
		if ($query->execute()) {
			$query->close();
			$this->conn->close();
			return true;
		}
	}


	/* Loan Type Function */

	public function save_ltype($ltype_name, $ltype_desc)
	{
		$query = $this->conn->prepare("INSERT INTO `loan_type` (`ltype_name`, `ltype_desc`) VALUES(?, ?)") or die($this->conn->error);
		$query->bind_param("ss", $ltype_name, $ltype_desc);

		if ($query->execute()) {
			$query->close();
			$this->conn->close();
			return true;
		}
	}

	public function display_ltype()
	{
		$query = $this->conn->prepare("SELECT * FROM `loan_type`") or die($this->conn->error);
		if ($query->execute()) {
			$result = $query->get_result();
			return $result;
		}
	}

	public function delete_ltype($ltype_id)
	{
		$query = $this->conn->prepare("DELETE FROM `loan_type` WHERE `ltype_id` = '$ltype_id'") or die($this->conn->error);
		if ($query->execute()) {
			$query->close();
			$this->conn->close();
			return true;
		}
	}

	public function update_ltype($ltype_id, $ltype_name, $ltype_desc)
	{
		$query = $this->conn->prepare("UPDATE `loan_type` SET `ltype_name`=?, `ltype_desc`=? WHERE `ltype_id`=?") or die($this->conn->error);
		$query->bind_param("ssi", $ltype_name, $ltype_desc, $ltype_id);

		if ($query->execute()) {
			$query->close();
			$this->conn->close();
			return true;
		}
	}


	/* Loan Plan Function */

	public function save_lplan($lplan_month, $lplan_interest, $lplan_penalty)
	{
		$query = $this->conn->prepare("INSERT INTO `loan_plan` (`lplan_month`, `lplan_interest`, `lplan_penalty`) VALUES(?, ?, ?)") or die($this->conn->error);
		$query->bind_param("sss", $lplan_month, $lplan_interest, $lplan_penalty);

		if ($query->execute()) {
			$query->close();
			$this->conn->close();
			return true;
		}
	}


	public function display_lplan()
	{
		$query = $this->conn->prepare("SELECT * FROM `loan_plan`") or die($this->conn->error);
		if ($query->execute()) {
			$result = $query->get_result();
			return $result;
		}
	}

	public function delete_lplan($lplan_id)
	{
		$query = $this->conn->prepare("DELETE FROM `loan_plan` WHERE `lplan_id` = '$lplan_id'") or die($this->conn->error);
		if ($query->execute()) {
			$query->close();
			$this->conn->close();
			return true;
		}
	}

	public function update_lplan($lplan_id, $lplan_month, $lplan_interest, $lplan_penalty)
	{
		$query = $this->conn->prepare("UPDATE `loan_plan` SET `lplan_month`=?, `lplan_interest`=?, `lplan_penalty`=? WHERE `lplan_id`=?") or die($this->conn->error);
		$query->bind_param("idii", $lplan_month, $lplan_interest, $lplan_penalty, $lplan_id);

		if ($query->execute()) {
			$query->close();
			$this->conn->close();
			return true;
		}
	}

	/* Borrower Function */

	public function save_borrower($firstname, $middlename, $lastname, $contact_no, $address, $email, $tax_id)
	{
		$query = $this->conn->prepare("INSERT INTO `borrower` (`firstname`, `middlename`, `lastname`, `contact_no`, `address`, `email`, `tax_id`) VALUES(?, ?, ?, ?, ?, ?, ?)") or die($this->conn->error);
		$query->bind_param("ssssssi", $firstname, $middlename, $lastname, $contact_no, $address, $email, $tax_id);

		if ($query->execute()) {
			$query->close();
			$this->conn->close();
			return true;
		}
	}

	public function display_borrower()
	{
		$query = $this->conn->prepare("SELECT * FROM `borrower`") or die($this->conn->error);
		if ($query->execute()) {
			$result = $query->get_result();
			return $result;
		}
	}

	//  delete all guarantors for this borrower

	public function delete_borrower($borrower_id)
	{
		// First, delete all invest_product records for this borrower
		$this->conn->query("DELETE FROM invest_product WHERE borrower_id = '$borrower_id'");

		// Then, delete all guarantors for this borrower
		$this->conn->query("DELETE FROM guarantor WHERE borrower_id = '$borrower_id'");

		$query = $this->conn->prepare("DELETE FROM `borrower` WHERE `borrower_id` = '$borrower_id'") or die($this->conn->error);
		if ($query->execute()) {
			$query->close();
			$this->conn->close();
			return true;
		}
	}

	public function update_borrower($borrower_id, $firstname, $middlename, $lastname, $contact_no, $address, $email, $tax_id)
	{
		$query = $this->conn->prepare("UPDATE `borrower` SET `firstname`=?, `middlename`=?, `lastname`=?, `contact_no`=?, `address`=?, `email`=?, `tax_id`=? WHERE `borrower_id`=?") or die($this->conn->error);
		$query->bind_param("ssssssii", $firstname, $middlename, $lastname, $contact_no, $address, $email, $tax_id, $borrower_id);

		if ($query->execute()) {
			$query->close();
			$this->conn->close();
			return true;
		}
	}

	/* Loan Function */

	public function save_loan($borrower, $ltype, $lplan, $loan_amount, $purpose, $date_created)
	{
		// Hel contact_no ee borrower ka
		$get_contact = $this->conn->prepare("SELECT contact_no FROM borrower WHERE borrower_id = ?");
		$get_contact->bind_param("i", $borrower);
		$get_contact->execute();
		$contact_no = null;
		$get_contact->bind_result($contact_no);
		$found = $get_contact->fetch();
		$get_contact->close();

		if (!$found || empty($contact_no)) {
			// Borrower not found or contact_no is empty
			return false;
		}

		// Hubi in contact_no hore loogu isticmaalin ref_no
		$check_ref = $this->conn->prepare("SELECT loan_id FROM loan WHERE ref_no = ?");
		$check_ref->bind_param("s", $contact_no);
		$check_ref->execute();
		$check_ref->store_result();

		if ($check_ref->num_rows > 0) {
			// Haddii contact_no hore loo isticmaalay, ha samaynin
			$check_ref->close();
			return false;
		}
		$check_ref->close();

		// Save loan using contact_no as ref_no
		$query = $this->conn->prepare("INSERT INTO `loan` (`ref_no`, `ltype_id`, `borrower_id`, `purpose`, `amount`, `lplan_id`, `date_created`) VALUES(?, ?, ?, ?, ?, ?, ?)") or die($this->conn->error);
		$query->bind_param("siisiis", $contact_no, $ltype, $borrower, $purpose, $loan_amount, $lplan, $date_created);

		if ($query->execute()) {
			$query->close();
			$this->conn->close();
			return true;
		}

		return false;
	}

	public function display_loan()
	{
		$query = $this->conn->prepare("SELECT * FROM `loan` INNER JOIN `borrower` ON loan.borrower_id=borrower.borrower_id INNER JOIN `loan_type` ON loan.ltype_id=loan_type.ltype_id INNER JOIN `loan_plan` ON loan.lplan_id=loan_plan.lplan_id") or die($this->conn->error);
		if ($query->execute()) {
			$result = $query->get_result();
			return $result;
		}
	}

	public function delete_loan($loan_id)
	{
		$query = $this->conn->prepare("DELETE FROM `loan` WHERE `loan_id` = '$loan_id'") or die($this->conn->error);
		if ($query->execute()) {
			$query->close();
			$this->conn->close();
			return true;
		}
	}


	public function update_loan($loan_id, $borrower, $ltype, $lplan, $loan_amount, $purpose, $status, $date_released)
	{
		$query = $this->conn->prepare("UPDATE `loan` SET `ltype_id`=?, `borrower_id`=?, `purpose`=?, `amount`=?, `lplan_id`=?, `status`=?, `date_released`=? WHERE `loan_id`=?") or die($this->conn->error);
		$query->bind_param("iisiiisi", $ltype, $borrower, $purpose, $loan_amount, $lplan, $status, $date_released, $loan_id);

		if ($query->execute()) {
			$query->close();
			$this->conn->close();
			return true;
		}
	}

	public function check_loan($loan_id)
	{
		$query = $this->conn->prepare("SELECT * FROM `loan` WHERE `loan_id`='$loan_id'") or die($this->conn->error);
		if ($query->execute()) {
			$result = $query->get_result();
			return $result;
		}
	}

	public function check_lplan($lplan)
	{
		$query = $this->conn->prepare("SELECT * FROM `loan_plan` WHERE `lplan_id`='$lplan'") or die($this->conn->error);
		if ($query->execute()) {
			$result = $query->get_result();
			return $result;
		}
	}

	/* Loan Schedule Function */

	public function save_date_sched($loan_id, $date_schedule)
	{
		$query = $this->conn->prepare("INSERT INTO `loan_schedule` (`loan_id`, `due_date`) VALUES(?, ?)") or die($this->conn->error);
		$query->bind_param("is", $loan_id, $date_schedule);

		if ($query->execute()) {
			return true;
		}
	}

	/* Payment Function */

	public function display_payment()
	{
		$query = $this->conn->prepare("SELECT * FROM `payment`") or die($this->conn->error);
		if ($query->execute()) {
			$result = $query->get_result();
			return $result;
		}
	}

	public function save_payment($loan_id, $payee, $pay_amount, $penalty, $overdue, $payment_date)
	{
		$query = $this->conn->prepare("INSERT INTO `payment` (`loan_id`, `payee`, `pay_amount`, `penalty`, `overdue`, `payment_date`) VALUES (?, ?, ?, ?, ?, ?)") or die($this->conn->error);
		$query->bind_param("isssis", $loan_id, $payee, $pay_amount, $penalty, $overdue, $payment_date);

		if ($query->execute()) {
			$query->close();
			return true;
		}
	}

	/* invest_product function */

	public function save_invest_product($product_name, $product_desc, $product_interest, $product_minimum)
	{
		$query = $this->conn->prepare("INSERT INTO invest_product (product_name, product_desc, product_interest, product_minimum) VALUES(?, ?, ?, ?)") or die($this->conn->error);
		$query->bind_param("ssdi", $product_name, $product_desc, $product_interest, $product_minimum);

		if ($query->execute()) {
			$query->close();
			$this->conn->close();
			return true;
		}
	}

	public function display_invest_product()
	{
		$query = $this->conn->query("SELECT * FROM invest_product") or die($this->conn->error);
		return $query;
	}
	// Delete an investment product by ID
	public function delete_invest_product($product_id)
	{
		$query = $this->conn->prepare("DELETE FROM invest_product WHERE product_id = ?") or die($this->conn->error);
		$query->bind_param("i", $product_id);
		if ($query->execute()) {
			$query->close();
			$this->conn->close();
			return true;
		}
	}


	// Update an existing investment product
	public function update_invest_product($product_id, $product_name, $product_desc, $product_interest, $product_minimum)
	{
		$query = $this->conn->prepare("UPDATE invest_product SET product_name=?, product_desc=?, product_interest=?, product_minimum=? WHERE product_id=?") or die($this->conn->error);
		$query->bind_param("ssdii", $product_name, $product_desc, $product_interest, $product_minimum, $product_id);

		if ($query->execute()) {
			$query->close();
			$this->conn->close();
			return true;
		}
	}


	// Fetch a single borrower by ID
	public function get_borrower($borrower_id)
	{
		$conn = $this->conn;
		$stmt = $conn->prepare("SELECT * FROM borrower WHERE borrower_id = ?");
		$stmt->bind_param("i", $borrower_id);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result->fetch_assoc();
	}


	/* Customer function */
	public function add_customer($firstname, $middlename, $lastname, $email, $password, $phone, $address, $tax_id)
	{
		$query = $this->conn->prepare("INSERT INTO `customer` (`firstname`, `middlename`, `lastname`, `email`, `password`, `phone`, `address` , `tax_id`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)") or die($this->conn->error);
		$query->bind_param("ssssssss", $firstname, $middlename, $lastname, $email, $password, $phone, $address, $tax_id);

		if ($query->execute()) {
			$query->close();
			$this->conn->close();
			return true;
		}
	}

	/* Customer_login function */
	public function customer_login($email, $password)
	{
		$query = $this->conn->prepare("SELECT * FROM `customer` WHERE `email` = ?") or die($this->conn->error);
		$query->bind_param("s", $email);
		$query->execute();
		$result = $query->get_result();

		if ($result->num_rows == 1) {
			$fetch = $result->fetch_assoc();

			if (password_verify($password, $fetch['password'])) {
				return array(
					'id' => $fetch['id'],
					'name' => $fetch['name'],
					'email' => $fetch['email']
				);
			} else {
				return false; // password invalid
			}
		} else {
			return false; // user not found
		}
	}

	/* Customer_loan_request function */
	public function add_customer_loan_request($customer_id, $loan_type_id, $loan_plan_id, $amount, $reason, $date_needed)
	{
		$stmt = $this->conn->prepare("INSERT INTO loan_requests (customer_id, loan_type_id, loan_plan_id, amount, reason, date_needed, status, created_at) VALUES (?, ?, ?, ?, ?, ?, 'Pending', NOW())");
		$stmt->bind_param("iiisss", $customer_id, $loan_type_id, $loan_plan_id, $amount, $reason, $date_needed);
		$stmt->execute();
		$stmt->close();
	}


	public function update_loan_request_status($loan_request_id, $new_status)
	{
		$stmt = $this->conn->prepare("UPDATE loan_requests SET status = ? WHERE id = ?");
		$stmt->bind_param("si", $new_status, $loan_request_id);
		$stmt->execute();
		$stmt->close();
	}

	public function loan_type_exists($loan_type_id)
	{
		$stmt = $this->conn->prepare("SELECT COUNT(*) FROM loan_type WHERE ltype_id = ?");
		$stmt->bind_param("i", $loan_type_id);
		$stmt->execute();
		$count = 0;
		$stmt->bind_result($count);
		$stmt->fetch();
		$stmt->close();
		return $count > 0;
	}

	public function loan_plan_exists($loan_plan_id)
	{
		$stmt = $this->conn->prepare("SELECT COUNT(*) FROM loan_plan WHERE lplan_id = ?");
		$stmt->bind_param("i", $loan_plan_id);
		$stmt->execute();
		$count = 0;
		$stmt->bind_result($count);
		$stmt->fetch();
		$stmt->close();
		return $count > 0;
	}

	public function add_loan_request($customer_id, $loan_type_id, $loan_plan_id, $amount, $reason, $date_needed)
	{
		$stmt = $this->conn->prepare("INSERT INTO loan_requests (customer_id, loan_type_id, loan_plan, amount, reason, date_needed, status, date_requested) VALUES (?, ?, ?, ?, ?, ?, 'Pending', NOW())");
		$stmt->bind_param("iiidss", $customer_id, $loan_type_id, $loan_plan_id, $amount, $reason, $date_needed);
		$result = $stmt->execute();
		$stmt->close();
		return $result;
	}

	/* Guarantor  Function */

	// Add a new guarantor
	public function add_guarantor($borrower_id, $full_name, $gender, $address, $contact, $job, $company_name, $national_id, $documentation)
	{
		$query = $this->conn->prepare("INSERT INTO guarantor (borrower_id, full_name, gender, address, contact, job, company_name, national_id, documentation) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)") or die($this->conn->error);
		$query->bind_param("issssssss", $borrower_id, $full_name, $gender, $address, $contact, $job, $company_name, $national_id, $documentation);

		if ($query->execute()) {
			$query->close();
			return true;
		}
	}

	// Fetch all guarantors from the database
	public function display_guarantors()
	{
		$query = $this->conn->query("SELECT * FROM guarantor") or die($this->conn->error);
		return $query;
	}

	// Delete a guarantor by ID
	public function delete_guarantor($guarantor_id)
	{
		$query = $this->conn->prepare("DELETE FROM guarantor WHERE guarantor_id = ?") or die($this->conn->error);
		$query->bind_param("i", $guarantor_id);
		if ($query->execute()) {
			$query->close();
			return true;
		}
	}

	// Update an existing guarantor
	public function update_guarantor($guarantor_id, $borrower_id, $full_name, $gender, $address, $contact, $job, $company_name, $national_id, $documentation = null)
	{
		if ($documentation !== null) {
			$query = $this->conn->prepare("UPDATE guarantor SET borrower_id=?, full_name=?, gender=?, address=?, contact=?, job=?, company_name=?, national_id=?, documentation=? WHERE guarantor_id=?") or die($this->conn->error);
			$query->bind_param("issssssssi", $borrower_id, $full_name, $gender, $address, $contact, $job, $company_name, $national_id, $documentation, $guarantor_id);
		} else {
			$query = $this->conn->prepare("UPDATE guarantor SET borrower_id=?, full_name=?, gender=?, address=?, contact=?, job=?, company_name=?, national_id=? WHERE guarantor_id=?") or die($this->conn->error);
			$query->bind_param("isssssssi", $borrower_id, $full_name, $gender, $address, $contact, $job, $company_name, $national_id, $guarantor_id);
		}

		if ($query->execute()) {
			$query->close();
			return true;
		}
	}

	// Fetch a single guarantor by ID
	public function get_guarantor($guarantor_id)
	{
		$conn = $this->conn;
		$stmt = $conn->prepare("SELECT * FROM guarantor WHERE guarantor_id = ?");
		$stmt->bind_param("i", $guarantor_id);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result->fetch_assoc();
	}

	// // Fetch all loan requests for a specific customer
	// public function get_loan_requests_by_customer($customer_id)
	// {
	// 	$stmt = $this->conn->prepare("SELECT * FROM loan_requests WHERE customer_id = ?");
	// 	$stmt->bind_param("i", $customer_id);
	// 	$stmt->execute();
	// 	$result = $stmt->get_result();
	// 	return $result;
	// }

	public function get_customer_by_id($id)
	{
		$stmt = $this->conn->prepare("SELECT * FROM customer WHERE id = ?");
		$stmt->bind_param("i", $id);
		$stmt->execute();
		$result = $stmt->get_result();
		$customer = $result->fetch_assoc();
		$stmt->close();
		return $customer;
	}

	public function get_loan_requests_by_customer($customer_id)
	{
		$stmt = $this->conn->prepare("SELECT * FROM loan_requests WHERE customer_id = ?");
		$stmt->bind_param("i", $customer_id);
		$stmt->execute();
		$result = $stmt->get_result();
		$stmt->close();
		return $result;
	}
}
