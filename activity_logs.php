<?php 
   session_start();
   include 'db.php';
   
?>
 <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GSM | Activity Logs</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <?php include 'includes/header.php'; ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php include 'includes/sidebar.php' ?>
<h2 class="text-center text-muted">List of Activity Logs</h2>
<hr>
<div class="col-lg-8 col-md-6 col-sm-12 col-12 mx-auto">
    <div class="card rounded-0 shadow">
        <div class="card-body rounded-0">
            <div class="container-fluid">
                <div class="table-responsive">
                    <table class="table table-hover table-stripped table-bordered">
                        <colgroup>
                            <col width="20%">
                            <col width="25%">
                            <col width="50%">
                            <col width="20%">
                        </colgroup>
                        <thead>
                            <tr class="bg-gradient bg-primary">
                                <th class="text-center text-light bg-transparent">Date/Time</th>
                                <th class="text-center text-light bg-transparent">User</th>
                                <th class="text-center text-light bg-transparent">Action</th>
                                <th class="text-center text-light bg-transparent">URL</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Query to join the activity log table with the users table
                            $sql = "SELECT log.created_at, u.first_name, log.action, log.url
                                    FROM site_activity_log_automation_tbl log
                                    JOIN users u ON log.user_id = u.id";
                            $result = $connection->query($sql);

                            if (!$result) {
                                die("Invalid query: " . $connection->error);
                            }

                            // Read data of each row
                            while ($row = $result->fetch_assoc()) : ?>

                                <tr>
                                    <td><?= $row['created_at'] ?></td>
                                    <td><?= $row['first_name'] ?></td>
                                    <td><?= $row['action'] ?></td>
                                    <td><?= $row['url'] ?></td>
                                </tr>

                            <?php endwhile ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- /.content-wrapper -->
<?php include 'includes/footer.php'; ?>
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <!-- <script src="../dist/js/demo.js"></script> -->
     <script type="text/javascript" src="js/script.js"></script>
</body>

</html>
