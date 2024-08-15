<?php
include 'db.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$categoryid = "";
$brandid = "";
$pname = "";
$model = "";
$description = "";
$quantity = "";
$unit = "";
$base_price = "";

$supplier = "";

$date = "";

$errorMessage = "";

$sucessMessage = "";
include 'initialize.php';

if (isset($_POST['add'])) {
    $categoryid = $_POST['categoryid'];
    $brandid = $_POST['brandid'];
    $pname = $_POST['pname'];
    $model = $_POST['model'];
    $description = $_POST['description'];
    $quantity = $_POST['quantity'];
    $unit = $_POST['unit'];
    $base_price = $_POST['base_price'];
  
    $supplier = $_POST['supplier'];
    
   
    do {
        if (empty($categoryid)) {
            $errorMessage = "All the fields are required";
            break;
        }
        // add new client to the database
        $sql = "INSERT INTO product (categoryid,brandid,pname,model,description,quantity,unit,base_price,supplier)" .
            "VALUES ('$categoryid,$brandid,$pname,$model,$description,$quantity,$unit,$base_price,$supplier')";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        if ($result) {
            $activityLog->setAction($_SESSION['login_id'], "added new product [ID#{$id}]");
            $sucessMessage = " Product Successfully added";
        }
        $categoryid = "";
        $brandid = "";
        $pname = "";
        $model = "";
        $description = "";
        $quantity = "";
        $unit = "";
        $base_price = "";
   
        $supplier = "";
        
        
    } while (false);
}



if (isset($_POST['edit'])) {

    $id = $_POST["id"];
    $categoryid = $_POST['categoryid'];
    $brandid = $_POST['brandid'];
    $pname = $_POST['pname'];
    $model = $_POST['model'];
    $description = $_POST['description'];
    $quantity = $_POST['quantity'];
    $unit = $_POST['unit'];
    $base_price = $_POST['base_price'];
    
    $supplier = $_POST['supplier'];
    
   


    $sql = "UPDATE product SET categoryid = '$categoryid', brandid = '$brandid', pname = '$pname', model = '$model', description = '$description', quantity = '$quantity', unit = '$unit', base_price = '$base_price', supplier = '$supplier' date = '$date'
where id = $id";
    $result = $connection->query($sql);
    if ($result) {
        $activityLog->setAction($_SESSION['login_id'], "edited product [ID#{$id}]");
    }
}

$sql3 = "SELECT id, name FROM category";
$result3 = $connection->query($sql3);

$sql1 = "SELECT id, bname FROM brand";
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
                            <h1>Product</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/garage/dashboard.php">Home</a></li>
                                <li class="breadcrumb-item active">Product</li>
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
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add" data-whatever="@mdo">New Product</button>
                                    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="" method="post">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="garage_id" class="col-form-label">Select Category:</label>
                                                            <select name="categoryid" id="categoryid" required class="form-control" value="<?php echo $categoryid; ?>">
                                                                <option value="" disabled selected>Select a category</option>
                                                                <?php
                                                                // Check if there are results
                                                                if ($result3->num_rows > 0) {
                                                                    // Output data of each row
                                                                    while ($row = $result3->fetch_assoc()) {
                                                                        echo "<option value='" . $row['id'] . "'>" . htmlspecialchars($row['name']) . "</option>";
                                                                    }
                                                                } else {
                                                                    echo "<option value=''>No categories available</option>";
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="garage_id" class="col-form-label">Select Brand:</label>
                                                            <select name="brandid" id="brandid" required class="form-control" value="<?php echo $brandid; ?>">
                                                                <option value="" disabled selected>Select a brand</option>
                                                                <?php
                                                                // Check if there are results
                                                                if ($result1->num_rows > 0) {
                                                                    // Output data of each row
                                                                    while ($row = $result1->fetch_assoc()) {
                                                                        echo "<option value='" . $row['id'] . "'>" . htmlspecialchars($row['bname']) . "</option>";
                                                                    }
                                                                } else {
                                                                    echo "<option value=''>No brandies available</option>";
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Product Name</label>
                                                            <input type="text" name="pname" id="pname" class="form-control rounded-0" required />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Product Model</label>
                                                            <input type="text" name="model" id="model" class="form-control rounded-0" required />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Product Description</label>
                                                            <textarea name="description" id="description" class="form-control rounded-0" rows="5" required></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Product Quantity</label>
                                                            <div class="input-group">
                                                                <input type="text" name="quantity" id="quantity" class="form-control rounded-0" required pattern="[+-]?([0-9]*[.])?[0-9]+" />
                                                                <select name="unit" class="form-select rounded-0" id="unit" required>
                                                                    <option value="">Select Unit</option>
                                                                    <option value="Bags">Bags</option>
                                                                    <option value="Bottles">Bottles</option>
                                                                    <option value="Box">Box</option>
                                                                    <option value="Dozens">Dozens</option>
                                                                    <option value="Feet">Feet</option>
                                                                    <option value="Gallon">Gallon</option>
                                                                    <option value="Grams">Grams</option>
                                                                    <option value="Inch">Inch</option>
                                                                    <option value="Kg">Kg</option>
                                                                    <option value="Liters">Liters</option>
                                                                    <option value="Meter">Meter</option>
                                                                    <option value="Nos">Nos</option>
                                                                    <option value="Packet">Packet</option>
                                                                    <option value="Rolls">Rolls</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Product Base Price</label>
                                                            <input type="text" name="base_price" id="base_price" class="form-control rounded-0" required pattern="[+-]?([0-9]*[.])?[0-9]+" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="garage_id" class="col-form-label">Select Supplier:</label>
                                                            <select name="supplier" id="supplier" required class="form-control" value="<?php echo $supplier; ?>">
                                                                <option value="" disabled selected>Select a supplier</option>
                                                                <?php
                                                                // Check if there are results
                                                                if ($result2->num_rows > 0) {
                                                                    // Output data of each row
                                                                    while ($row = $result2->fetch_assoc()) {
                                                                        echo "<option value='" . $row['id'] . "'>" . htmlspecialchars($row['supplier_name']) . "</option>";
                                                                    }
                                                                } else {
                                                                    echo "<option value=''>No Suppliers available</option>";
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
                                                <th>Category</th>
                                                <th>Brand Name</th>
                                                <th>Product Name</th>
                                                <th>Product Model</th>
                                                <th>Quantity</th>
                                                <th>Supplier Name</th>
                                                <th>Status</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php


                                            //read all row from database table
                                            $sql = "SELECT * FROM product";
                                            $result = $connection->query($sql);

                                            if (!$result) {
                                                die("Invalid query: " . $connection->error);
                                            }

                                            // read data of each row
                                            while ($row = $result->fetch_assoc()) : ?>

                                                <tr>
                                                    <td><?= $row['id'] ?></td>
                                                    <td><?= $row['categoryid'] ?></td>
                                                    <td><?= $row['brandid'] ?></td>
                                                    <td><?= $row['pname'] ?></td>
                                                    <td><?= $row['model'] ?></td>

                                                    <td><?= $row['quantity'] ?></td>
                                                    <td><?= $row['supplier'] ?></td>
                                                    <td><?= $row['status'] ?></td>
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