<?php
include '../db.php';

$name = "";
$cost_price = "";
$price = "";


$errorMessage = "";

$sucessMessage = "";
include '../initialize.php';

if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $cost_price = str_replace("," , '', $_POST['cost_price']);
    $price = str_replace("," , '', $_POST['price']);




    do {
        if (empty($name) || empty($cost_price) || empty($price)) {
            $errorMessage = "All the fields are required";
            break;
        }
        // add new client to the database
        $sql = "INSERT INTO services (name, cost_price, price)" .
            "VALUES ('$name','$cost_price','$price')";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        if ($result) {
            $activityLog->setAction($_SESSION['login_id'], "added new service [ID#{$id}]");
            $sucessMessage = " Service Successfully added";
        }
        $name = "";
        $cost_price = "";
        $price = "";

        
    } while (false);
}



if (isset($_POST['edit'])) {

    $id = $_POST["id"];
    $name = $_POST["name"];
    $cost_price = str_replace("," , '', $_POST['cost_price']);
    $price = str_replace("," , '', $_POST['price']);


    $sql = "UPDATE services SET name = '$name', cost_price = '$cost_price', price = '$price'
where id = $id";
    $result = $connection->query($sql);
    if ($result) {
        $activityLog->setAction($_SESSION['login_id'], "edited service [ID#{$id}]");
        $sucessMessage = " Service Successfully edited";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GSM | Services</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <?php include '../includes/header.php'; ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php include '../includes/sidebar.php' ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Services</h1>
                        </div>
                        <?php
                                    if (!empty($sucessMessage)) {
                                        echo
                                        "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>$sucessMessage</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
                                    }
                                    ?>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Services</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                            if (!empty($errorMessage)) {
                                echo
                                "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>$errorMessage</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
                            }
                            ?>
                            <!-- /.card -->
                             <?php
                             echo '
                             <script>
                             function addCommas(x) {
                             //remove commas
                             retVal = x ? parseFloat(x.replace(/,/g, \'\')) : 0;
                             //apply formatting
                             return retVal.toString().replace(/\\B(?=(\\d{3})+(?!\\d))/g, ",");
                             }
                             </script>';
                             ?>

                            <div class="card">
                                <div class="card-header">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add" data-whatever="@mdo">New Service</button>
                                    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Add Service</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="" method="post">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label">Service Name</label>
                                                            <input type="text" class="form-control" id="recipient-name" name="name" placeholder="Enter Service Name" required value="<?php echo $name; ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label">Cost Price</label>
                                                            <input type="text" class="form-control" id="recipient-name" name="cost_price" placeholder="Enter Cost Price" required value="<?php echo $cost_price; ?>" min="0"
                                                            onkeyup="this.value=addCommas(this.value);">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label">Service Price</label>
                                                            <input type="text" class="form-control" id="recipient-name" name="price" placeholder="Enter Service Price" required value="<?php echo $price; ?>" min="0"
                                                            onkeyup="this.value=addCommas(this.value);">
                                                        </div>


                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary" name="add">Add</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                   
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Service Name</th>
                                                <th>Cost Price</th>
                                                <th>Service Price</th>

                                                <th>Created At</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php


                                            //read all row from database table
                                            $sql = "SELECT * FROM services";
                                            $result = $connection->query($sql);

                                            if (!$result) {
                                                die("Invalid query: " . $connection->error);
                                            }

                                            // read data of each row
                                            while ($row = $result->fetch_assoc()) : ?>

                                                <tr>
                                                    <td><?= $row['id'] ?></td>
                                                    <td><?= $row['name'] ?></td>
                                                    <td><?= number_format($row['cost_price']) ?></td>
                                                    <td><?= number_format($row['price']) ?></td>

                                                    <td><?= $row['created_at'] ?></td>
                                                    <td>
                                                        <button class="btn btn-primary btn-sm" type="button" onclick="openeditmodal(<?= $row['id'] ?>, '<?= $row['name'] ?>', '<?= $row['cost_price'] ?>','<?= $row['price'] ?>')">Edit</button>
                                                        <a class='btn btn-danger btn-sm' href='/garage/delete_service.php?id=<?= $row['id'] ?>' onclick='return confirmDelete();'>Delete</a>
                                                    </td>
                                                </tr>


                                            <?php endwhile ?>


                                        </tbody>
                                    </table>

                                    <!--edit modal  -->


                                    <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Service</h5>
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
                                                            <label for="recipient-name" class="col-form-label">Cost Price</label>
                                                            <input type="text" class="form-control" id="recipient_cost_price" name="cost_price" placeholder="Enter Cost Price" required value="<?php echo $cost_price; ?>"  min="0"
                                                            onkeyup="this.value=addCommas(this.value);">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label">Service Price</label>
                                                            <input type="text" class="form-control" id="recipient_price" name="price" placeholder="Enter Service Price" required value="<?php echo $price; ?>"  min="0"
                                                            onkeyup="this.value=addCommas(this.value);">
                                                        </div>


                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary" name="edit">Edit</button>
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



                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>


        <!-- /.content-wrapper -->
        <?php include '../includes/footer.php'; ?>
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <!-- <script src="../dist/js/demo.js"></script> -->
    <script type="text/javascript" src="../js/script.js"></script>

    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this record?");
        }
    </script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>