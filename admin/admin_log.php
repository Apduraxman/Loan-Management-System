<?php date_default_timezone_set("Etc/GMT+8"); ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Loan Management System</title>

    <link href="css/all.css" rel="stylesheet" type="text/css">
    <link href="css/sb-admin-2.css" rel="stylesheet">

</head>

<body>
    <!-- <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="">Loan Management System</a>
    </nav> -->

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block"><img src="image/A.jpg" height="100%" width="100%" /></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <!-- <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">USER LOGIN</h1>
                                    </div> -->

                                    <!-- Admin Login -->
                                    <form method="POST" class="user" action="login.php">
                                        <h5>Admin Login</h5>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" name="username" placeholder="Enter Admin Username" required="required">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" name="password" placeholder="Enter Admin Password" required="required">
                                        </div>
                                        <?php
                                        session_start();
                                        if (isset($_SESSION['message'])) {
                                            echo "<center><label class='text-danger'>" . $_SESSION['message'] . "</label></center>";
                                        }
                                        ?>
                                        <button type="submit" class="btn btn-primary btn-user btn-block" name="login">Admin Login</button>
                                    </form>

                                    <hr>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <nav class="navbar fixed-bottom navbar-dark bg-primary">
        <label style="color:#ffffff;">&copy; Copyright Loan Management System</label>
        <label style="color:#ffffff;">All Rights Reserved <?php echo date("Y") ?> </label>
    </nav>

</body>

</html>