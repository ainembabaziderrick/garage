<?php
session_start();
include 'db.php';

include 'initialize.php';



?>

<?php include 'includes/head.php'; ?>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <?php include 'includes/header.php'; ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php include 'includes/sidebar.php'; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Customers</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/garage/dashboard.php">Home</a></li>
                                <li class="breadcrumb-item active">Customers</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">

                            <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Customer</th>
                                                <th>Contact</th>
                                            
                                                <th>Action</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php


                                            //read all row from database table
                                            $sql = "SELECT * FROM customers";
                                            $result = $connection->query($sql);

                                            if (!$result) {
                                                die("Invalid query: " . $connection->error);
                                            }

                                            // read data of each row
                                            while ($row = $result->fetch_assoc()) : ?>

                                                <tr>
                                                    <td><?= $row['id'] ?></td>
                                                    <td><?= $row['name'] ?></td>
                                                    <td><?= $row['contact'] ?></td>
                                                                                                        
                                                    <td>
                                                        <button class="btn btn-primary btn-sm" type="button" onclick="openeditmodalss(<?= $row['id'] ?>, '<?= $row['name'] ?>', '<?= $row['address'] ?>')">Edit</button>
                                                        <a class='btn btn-danger btn-sm' href='/garage/delete_garage.php?id=<?= $row['id'] ?>' onclick='return confirmDelete();'>Delete</a>
                                                    </td>
                                                </tr>


                                            <?php endwhile ?>


                                        </tbody>
                                    </table>

                                      <!--edit modal  -->


                                      <div class="modal fade" id="editmodals" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Garage</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="" method="post">
                                                    <div class="modal-body">
                                                        <input type="hidden" name="id" id="id" value="">
                                                        <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label"> Name</label>
                                                            <input type="text" class="form-control" id="recipient_name" name="name" required value="">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label">Address</label>
                                                            <input type="text" class="form-control" id="recipient_cost_price" name="address" required value="<?php echo $address; ?>">
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary" name="edit">Edit</button>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
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
    <?php include 'includes/scripts.php'; ?>

    <script type="text/javascript" src="js/script.js"></script>

    <!-- Page specific script -->
    

<script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this record?");
        }
    </script>
</body>

</html>