<?php
include 'db.php';

$supplier_name = "";
$mobile = "";
$address = "";
$status = "";

$errorMessage = "";

$sucessMessage = "";
include 'initialize.php';

if (isset($_POST['add'])) {
    $supplier_name = $_POST['supplier_name'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];
    $status = $_POST['status'];

    do {
        if (empty($supplier_name) || empty($address)) {
            $errorMessage = "All the fields are required";
            break;
        }
        // add new client to the database
        $sql = "INSERT INTO ims_supplier (supplier_name, mobile,address)" .
            "VALUES ('$supplier_name','$mobile', '$address')";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        if ($result) {
            $activityLog->setAction($_SESSION['login_id'], "added new Supplier [ID#{$id}]");
            $sucessMessage = " Supplier Successfully added";
        }
        $supplier_name = "";
        $mobile = "";
        $address = "";
        $status = "";
        header("location: /garage/supplier.php");
        exit;
    } while (false);
}



if (isset($_POST['edit'])) {

    $id = $_POST["id"];
    $supplier_name = $_POST["supplier_name"];
    $mobile = $_POST["mobile"];
    $address = $_POST["address"];



    $sql = "UPDATE ims_supplier SET supplier_name = '$supplier_name', mobile = '$mobile', address = '$address'
where id = $id";
    $result = $connection->query($sql);
    if ($result) {
        $activityLog->setAction($_SESSION['login_id'], "edited supplier [ID#{$id}]");
    }
}

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
                            <h1>SUPPLIERS</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/garage/dashboard.php">Home</a></li>
                                <li class="breadcrumb-item active">Suppliers</li>
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

                            <div class="card">
                                <div class="card-header">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add" data-whatever="@mdo">New Supplier</button>
                                    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Add Supplier</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="" method="post">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label">Name</label>
                                                            <input type="text" class="form-control" id="recipient-name" name="supplier_name" placeholder="Enter supplier name" required value="<?php echo $name; ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label">Mobile</label>
                                                            <input type="text" class="form-control" id="recipient-name" name="mobile" placeholder="Enter mobile" required value="<?php echo $name; ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label">Address</label>
                                                            <input type="text" class="form-control" id="recipient-name" name="address" placeholder="Enter Address" required value="<?php echo $address; ?>">
                                                        </div>



                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary" name="add">Add</button>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Supplier Name</th>
                                                <th>Mobile</th>
                                                <th>Address</th>
                                                <th>Status</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php


                                            //read all row from database table
                                            $sql = "SELECT * FROM ims_supplier";
                                            $result = $connection->query($sql);

                                            if (!$result) {
                                                die("Invalid query: " . $connection->error);
                                            }

                                            // read data of each row
                                            while ($row = $result->fetch_assoc()) : ?>

                                                <tr>
                                                    <td><?= $row['id'] ?></td>
                                                    <td><?= $row['supplier_name'] ?></td>
                                                    <td><?= $row['mobile'] ?></td>
                                                    <td><?= $row['address'] ?></td>
                                                    <td><?= $row['status'] ?></td>
                                                    <td>
                                                        <button class="btn btn-primary btn-sm" type="button" onclick="openeditmodalss(<?= $row['id'] ?>, '<?= $row['supplier_name'] ?>','<?= $row['mobile'] ?>', '<?= $row['address'] ?>')">Edit</button>
                                                        <a class='btn btn-danger btn-sm' href='/garage/delete_supplier.php?id=<?= $row['id'] ?>' onclick='return confirmDelete();'>Delete</a>
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
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Supplier</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="" method="post">
                                                    <div class="modal-body">
                                                        <input type="hidden" name="id" id="id" value="">
                                                        <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label"> Name</label>
                                                            <input type="text" class="form-control" id="recipient_name" name="supplier_name" required value="">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label"> Mobile</label>
                                                            <input type="text" class="form-control" id="recipient_mobile" name="mobile" required value="">
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

    <script>
        const openeditmodalss = (id, supplier_name,mobile, address) => {

            $('#editmodals').modal('show');
            document.getElementById('id').value = id;
            document.getElementById('recipient_name').value = supplier_name;
            document.getElementById('recipient_mobile').value = mobile;
            document.getElementById('recipient_cost_price').value = address;

        }
    </script>

    <!-- Page specific script -->
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>

    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this record?");
        }
    </script>
</body>

</html>