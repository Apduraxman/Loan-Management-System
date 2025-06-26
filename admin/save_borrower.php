<?php
    require_once 'class.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])) {
        $db = new db_class();

        // Sanitize input
        $firstname   = trim($_POST['firstname']);
        $middlename  = trim($_POST['middlename']);
        $lastname    = trim($_POST['lastname']);
        $contact_no  = trim($_POST['contact_no']);
        $address     = trim($_POST['address']);
        $email       = trim($_POST['email']);
        $tax_id      = trim($_POST['tax_id']);

        // Check if contact number already exists
        $check = $db->conn->prepare("SELECT * FROM borrower WHERE contact_no = ?");
        $check->bind_param("s", $contact_no);
        $check->execute();
        $result = $check->get_result();

        if ($result->num_rows > 0) {
            echo "<script>
                alert('This contact number already exists!');
                window.history.back();
            </script>";
            exit();
        }

        // Save borrower if no duplicate
        $db->save_borrower($firstname, $middlename, $lastname, $contact_no, $address, $email, $tax_id);
        header("Location: borrower.php");
        exit();
    }
?>