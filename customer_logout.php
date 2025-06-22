<?php
session_start();
session_unset();  // Tirtir dhammaan session variables
session_destroy(); // Burburi session-ka

// Dib ugu celi page-ka login-ka
header("Location: index.php");
exit();
?>
