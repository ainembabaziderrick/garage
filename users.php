<?php
include 'db.php';

$garage_id = "";
$first_name = "";
$last_name = "";
$email = "";
$phone = "";
$password = "";
$role = "";

$errorMessage = "";

$sucessMessage = "";
include 'initialize.php';

if (isset($_POST['add'])) {
    $garage_id = $_POST['garage_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    do {
        if (empty($garage_id) || empty($first_name) || empty($last_name) || empty($email) || empty($phone) || empty($password) || empty($role)) {
            $errorMessage = "All the fields are required";
            break;
        }
        // add new client to the database
        $sql = "INSERT INTO users (garage_id, first_name,last_name,email,phone,password,role)" .
            "VALUES ('$garage_id','$first_name','$last_name','$email','$phone','$password','$role')";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        if ($result) {
            $activityLog->setAction($_SESSION['login_id'], "added new users [ID#{$id}]");
            $sucessMessage = " Service Successfully added";
        }
        $garage_id = "";
        $first_name = "";
        $last_name = "";
        $email = "";
        $phone = "";
        $password = "";
        $role = "";

        header("location: /garage/users.php");
        exit;
    } while (false);
}



if (isset($_POST['edit'])) {

    $id = $_POST["id"];
    $garage_id = $_POST["garage_id"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $role = $_POST["role"];

    $sql = "UPDATE users SET garage_id = '$garage_id', first_name = '$first_name', last_name = '$last_name', email = '$email', phone = '$phone', role = '$role'
where id = $id";
    $result = $connection->query($sql);
    if ($result) {
        $activityLog->setAction($_SESSION['login_id'], "edited user [ID#{$id}]");
    }
}

$sql = "SELECT id, name FROM garages";
$result = $connection->query($sql);
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
                            <h1>USERS</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/garage/dashboard.php">Home</a></li>
                                <li class="breadcrumb-item active">Users</li>
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
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add" data-whatever="@mdo">New User</button>
                                    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="" method="post">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="garage_id" class="col-form-label">Select Garage:</label>
                                                            <select name="garage_id" id="garage_id" required class="form-control" value="<?php echo $garage_id; ?>">
                                                                <option value="" disabled selected>Select a Garage</option>
                                                                <?php
                                                                $sql = "SELECT id, name FROM garages";
                                                                $result = $connection->query($sql);
                                                                // Check if there are results
                                                                if ($result->num_rows > 0) {
                                                                    // Output data of each row
                                                                    while ($row = $result->fetch_assoc()) {
                                                                        echo "<option value='" . $row['id'] . "'>" . htmlspecialchars($row['name']) . "</option>";
                                                                    }
                                                                } else {
                                                                    echo "<option value=''>No garages available</option>";
                                                                }
                                                                ?>
                                                            </select>
                                                            <div class="form-group">
                                                                <label for="recipient-name" class="col-form-label">First Name</label>
                                                                <input type="text" class="form-control" id="recipient-name" name="first_name" placeholder="Enter First Name" required value="<?php echo $first_name; ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="recipient-name" class="col-form-label">Last Name</label>
                                                                <input type="text" class="form-control" id="recipient-name" name="last_name" placeholder="Enter Last Name" required value="<?php echo $last_name; ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="recipient-name" class="col-form-label">Email</label>
                                                                <input type="text" class="form-control" id="recipient-name" name="email" placeholder="Enter Email" required value="<?php echo $email; ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="recipient-name" class="col-form-label">Phone</label>
                                                                <input type="text" class="form-control" id="recipient-name" name="phone" placeholder="Enter Phone" required value="<?php echo $phone; ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="recipient-name" class="col-form-label">Password</label>
                                                                <input type="text" class="form-control" id="recipient-name" name="password" placeholder="Enter Password" required value="<?php echo $password; ?>">
                                                            </div>
                                                            <label for="cars" class="col-form-label">Choose a role:</label>

                                                            <select name="role" class="form-control" id="role" value="<?php echo $role; ?>">
                                                                <option value="" disabled selected>Select a role</option>
                                                                <option value="admin">Admin</option>
                                                                <option value="cashier">Cashier</option>
                                                                <option value="client">Mechanic</option>

                                                            </select>


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
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Role</th>
                                                <th>Created At</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php


                                            //read all row from database table
                                            $sql = "SELECT * FROM users";
                                            $result = $connection->query($sql);

                                            if (!$result) {
                                                die("Invalid query: " . $connection->error);
                                            }

                                            // read data of each row
                                            while ($row = $result->fetch_assoc()) : ?>

                                                <tr>
                                                    <td><?= $row['id'] ?></td>
                                                    <td><?= $row['first_name'] ?></td>
                                                    <td><?= $row['last_name'] ?></td>
                                                    <td><?= $row['email'] ?></td>
                                                    <td><?= $row['phone'] ?></td>
                                                    <td><?= $row['role'] ?></td>

                                                    <td><?= $row['created_at'] ?></td>
                                                    <td>
                                                        <button class="btn btn-primary btn-sm" type="button" onclick="openeditmodalw(<?= $row['id'] ?>, '<?= $row['garage_id'] ?>','<?= $row['first_name'] ?>', '<?= $row['last_name'] ?>','<?= $row['email'] ?>','<?= $row['phone'] ?>','<?= $row['role'] ?>')">Edit</button>
                                                        <a class='btn btn-danger btn-sm' href='/garage/delete_service.php?id=<?= $row['id'] ?>' onclick='return confirmDelete();'>Delete</a>
                                                    </td>
                                                </tr>


                                            <?php endwhile ?>


                                        </tbody>
                                    </table>

                                    <!-- edit-->
                                    <div class="modal fade" id="editmodalw" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="" method="post">
                                                    <div class="modal-body">
                                                    <input type="hidden" name="id" id="id" value="">
                                                        <div class="form-group">
                                                            <label for="garage_id" class="col-form-label">Select Garage:</label>
                                                            <select name="garage_id" id="garage_id" required class="form-control" value="<?php echo $garage_id; ?>">
                                                                <option value="" disabled selected>Select a Garage</option>
                                                                <?php
                                                                // Check if there are results
                                                                if ($result->num_rows > 0) {
                                                                    // Output data of each row
                                                                    while ($row = $result->fetch_assoc()) {
                                                                        echo "<option value='" . $row['id'] . "'>" . htmlspecialchars($row['name']) . "</option>";
                                                                    }
                                                                } else {
                                                                    echo "<option value=''>No garages available</option>";
                                                                }
                                                                ?>
                                                            </select>
                                                            <div class="form-group">
                                                                <label for="recipient-name" class="col-form-label">First Name</label>
                                                                <input type="text" class="form-control" id="recipient-name" name="first_name" placeholder="Enter First Name" required value="<?php echo $first_name; ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="recipient-name" class="col-form-label">Last Name</label>
                                                                <input type="text" class="form-control" id="recipient-last" name="last_name" placeholder="Enter Last Name" required value="<?php echo $last_name; ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="recipient-name" class="col-form-label">Email</label>
                                                                <input type="text" class="form-control" id="recipient-email" name="email" placeholder="Enter Email" required value="<?php echo $email; ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="recipient-name" class="col-form-label">Phone</label>
                                                                <input type="text" class="form-control" id="recipient-phone" name="phone" placeholder="Enter Phone" required value="<?php echo $phone; ?>">
                                                            </div>

                                                            <label for="cars" class="col-form-label">Choose a role:</label>

                                                            <select name="role" class="form-control" id="role" value="<?php echo $role; ?>">
                                                                <option value="" disabled selected>Select a role</option>
                                                                <option value="admin">Admin</option>
                                                                <option value="cashier">Cashier</option>
                                                                <option value="mechanic">Mechanic</option>

                                                            </select>


                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary" name="edit">Edit</button>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                </form>
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
    <script type="text/javascript" src="../js/script.js"></script>
    <!-- Page specific script -->
    <script>
        const openeditmodalw = (id, garage_id, first_name, last_name, email, phone, role) => {

            $('#editmodalw').modal('show');
            document.getElementById('id').value = id;
            document.getElementById('garage_id').value = garage_id;
            document.getElementById('recipient-name').value = first_name;
            document.getElementById('recipient-last').value = last_name;
            document.getElementById('recipient-email').value = email;
            document.getElementById('recipient-phone').value = phone;
            document.getElementById('role').value = role;

        }
    
        function confirmDelete() {
            return confirm("Are you sure you want to delete this record?");
        }
    </script>
</body>

</html>