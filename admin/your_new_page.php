<?php
include("session.php");
include("class.php");
include("inc/header.php");

// Example query (replace with your own)
$db = new db_class();
$data = $db->conn->query("SELECT * FROM your_table ORDER BY id DESC");
?>

<body id="page-top">
    <div id="wrapper">
        <?php include("inc/sidebar.php"); ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <?php include("inc/navbar.php"); ?>
                </nav>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h4 class="mb-0 text-gray-800 font-weight-bold">Your Page Title</h4>
                    </div>
                    <?php if (isset($_GET['msg'])): ?>
                        <div class="alert alert-success"><?= htmlspecialchars($_GET['msg']) ?></div>
                    <?php endif; ?>
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Column 1</th>
                                            <th>Column 2</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; while ($row = $data->fetch_assoc()): ?>
                                            <tr>
                                                <td><?= $i++ ?></td>
                                                <td><?= htmlspecialchars($row['column1']) ?></td>
                                                <td><?= htmlspecialchars($row['column2']) ?></td>
                                                <td>
                                                    <!-- Action buttons here -->
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Main Content -->

                <?php include("inc/footer.php"); ?>

            </div>
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/jquery.easing.js"></script>
    <script src="js/jquery.dataTables.js"></script>
    <script src="js/dataTables.bootstrap4.js"></script>
    <script src="js/sb-admin-2.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
</body>
</html>