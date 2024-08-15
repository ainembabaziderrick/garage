<?php
include 'db.php';

$supplier_id = "";
$product_id = "";
$quantity = "";

$errorMessage = "";

$sucessMessage = "";
include 'initialize.php';

if (isset($_POST['add'])) {
    $supplier_id = $_POST['supplier_id'];
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    do {
        if (empty($product_id)) {
            $errorMessage = "All the fields are required";
            break;
        }
        // add new client to the database
        $sql = "INSERT INTO purchase (supplier_id,product_id,quantity)" .
            "VALUES ('$supplier_id,$product_id,$quantity')";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        if ($result) {
            $activityLog->setAction($_SESSION['login_id'], "added new purchase [ID#{$id}]");
            $sucessMessage = " Purchase Successfully added";
        }
        $supplier_id = "";
        $product_id = "";
        $quantity = "";

        header("location: /garage/purchase.php");
        exit;
    } while (false);
}



if (isset($_POST['edit'])) {

    $supplier_id = $_POST['supplier_id'];
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];


    $sql = "UPDATE purchase SET bname = '$bname'
where id = $id";
    $result = $connection->query($sql);
    if ($result) {
        $activityLog->setAction($_SESSION['login_id'], "edited brand [ID#{$id}]");
    }
}

$sql1 = "SELECT id, pname FROM product";
$result1 = $connection->query($sql1);

$sql2 = "SELECT id, supplier_name FROM ims_supplier";
$result2 = $connection->query($sql2);
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
                            <h1>PURCHASE</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/garage/dashboard.php">Home</a></li>
                                <li class="breadcrumb-item active">Purchase</li>
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
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add" data-whatever="@mdo">New Purchase</button>
                                    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Add Purchase</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="" method="post">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="product_id" class="col-form-label">Product Name</label>
                                                            <select name="product_id" id="product_id" required class="form-control" value="<?php echo $product_id; ?>">
                                                                <option value="" disabled selected>Select a product</option>
                                                                <?php
                                                                // Check if there are results
                                                                if ($result1->num_rows > 0) {
                                                                    // Output data of each row
                                                                    while ($row = $result1->fetch_assoc()) {
                                                                        echo "<option value='" . $row['id'] . "'>" . htmlspecialchars($row['pname']) . "</option>";
                                                                    }
                                                                } else {
                                                                    echo "<option value=''>No products available</option>";
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label">Product Quantity</label>
                                                            <input type="text" class="form-control" id="recipient-name" name="quantity" placeholder="" required value="<?php echo $quantity; ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="supplier_id" class="col-form-label">Supplier</label>
                                                            <select name="supplier_id" id="supplier_id" required class="form-control" value="<?php echo $supplier_id; ?>">
                                                                <option value="" disabled selected>Select a supplier</option>
                                                                <?php
                                                                // Check if there are results
                                                                if ($result2->num_rows > 0) {
                                                                    // Output data of each row
                                                                    while ($row = $result2->fetch_assoc()) {
                                                                        echo "<option value='" . $row['id'] . "'>" . htmlspecialchars($row['supplier_name']) . "</option>";
                                                                    }
                                                                } else {
                                                                    echo "<option value=''>No supplier available</option>";
                                                                }
                                                                ?>
                                                            </select>
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
                                                <th>Product</th>
                                                <th>Quantity</th>
                                                <th>Supplier</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php


                                            //read all row from database table
                                            $sql = "SELECT * FROM purchase";
                                            $result = $connection->query($sql);

                                            if (!$result) {
                                                die("Invalid query: " . $connection->error);
                                            }

                                            // read data of each row
                                            while ($row = $result->fetch_assoc()) : ?>

                                                <tr>
                                                    <td><?= $row['id'] ?></td>
                                                    <td><?= $row['product_id'] ?></td>
                                                    <td><?= $row['quantity'] ?></td>
                                                    <td><?= $row['supplier_id'] ?></td>
                                                    <td>
                                                        <button class="btn btn-primary btn-sm" type="button" onclick="openeditmodalss(<?= $row['id'] ?>, '<?= $row['bname'] ?>')">Edit</button>
                                                        <a class='btn btn-danger btn-sm' href='/garage/delete_brand.php?id=<?= $row['id'] ?>' onclick='return confirmDelete();'>Delete</a>
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
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="" method="post">
                                                    <div class="modal-body">
                                                        <input type="hidden" name="id" id="id" value="">
                                                        <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label"> Brand</label>
                                                            <input type="text" class="form-control" id="recipient_name" name="bname" required value="">
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
        const openeditmodalss = (id, bname) => {

            $('#editmodals').modal('show');
            document.getElementById('id').value = id;
            document.getElementById('recipient_name').value = bname;
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