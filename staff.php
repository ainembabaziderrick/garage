<?php

include 'db.php';

$service_id = "";
$name = "";
$age = "";
$contact = "";
$address = "";
$email = "";
$errorMessage = "";
$sucessMessage = "";

include 'initialize.php';

if (isset($_POST['add'])) {
    $service_id = $_POST['service_id'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $email = $_POST['email'];

    do {
        if (empty($name) || empty($address)) {
            $errorMessage = "All the fields are required";
            break;
        }
        // add new client to the database
        $sql = "INSERT INTO staff (service_id, name, age, contact, address, email)" .
            "VALUES ('$service_id', '$name', '$age', '$contact', '$address', '$email')";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        if ($result) {
            $activityLog->setAction($_SESSION['login_id'], "added new Staff [ID#{$id}]");
            $sucessMessage = "Staff Successfully added";
        }
        $service_id = "";
        $name = "";
        $age = "";
        $contact = "";
        $address = "";
        $email = "";
        $errorMessage = "";
        $sucessMessage = "";

        header("location: /garage/staff.php");
        exit;
    } while (false);
}

if (isset($_POST['edit'])) {
    $id = $_POST["id"];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $email = $_POST['email'];

    $sql = "UPDATE staff SET name = '$name', age = '$age', contact = '$contact', address = '$address', email = '$email' WHERE id = $id";
    $result = $connection->query($sql);
    if ($result === true) {
        $activityLog->setAction($_SESSION['login_id'], "edited staff [ID#{$id}]");
        $sucessMessage = "Staff Successfully edited";
    }
}

$sql = "SELECT staff.id, staff.name, staff.age, staff.contact, staff.address, staff.email, services.name AS service_name 
        FROM staff 
        LEFT JOIN services ON staff.service_id = services.id";
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
                            <h1>STAFF</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/garage/dashboard.php">Home</a></li>
                                <li class="breadcrumb-item active">Staff</li>
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
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add" data-whatever="@mdo">New Staff</button>
                                    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Add Staff</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="" method="post">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label">Name</label>
                                                            <input type="text" class="form-control" id="recipient-name" name="name" placeholder="Enter Name" required value="<?php echo $name; ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label">Age</label>
                                                            <input type="text" class="form-control" id="recipient-name" name="age" placeholder="Enter Age" required value="<?php echo $age; ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label">Contact</label>
                                                            <input type="text" class="form-control" id="recipient-name" name="contact" placeholder="Enter contact" required value="<?php echo $contact; ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label">Address</label>
                                                            <input type="text" class="form-control" id="recipient-name" name="address" placeholder="Enter Garage Address" required value="<?php echo $address; ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label">Email</label>
                                                            <input type="email" class="form-control" id="recipient-name" name="email" placeholder="Enter email" required value="<?php echo $email; ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="garage_id" class="col-form-label">Select Service:</label>
                                                            <select name="service_id" id="service_id" required class="form-control" value="<?php echo $service_id; ?>">
                                                                <option value="" disabled selected>Select a Service</option>
                                                                <?php
                                                                // Check if there are results
                                                                $serviceResult = $connection->query("SELECT id, name FROM services");
                                                                if ($serviceResult->num_rows > 0) {
                                                                    while ($row = $serviceResult->fetch_assoc()) {
                                                                        echo "<option value='" . $row['id'] . "'>" . htmlspecialchars($row['name']) . "</option>";
                                                                    }
                                                                } else {
                                                                    echo "<option value=''>No services available</option>";
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
                                                <th>Name</th>
                                                <th>Age</th>
                                                <th>Contact</th>
                                                <th>Address</th>
                                                <th>Email</th>
                                                <th>Service</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // Check if there are results
                                            if ($result->num_rows > 0) {
                                                // Fetch data for each row
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<tr>
                                                            <td>{$row['id']}</td>
                                                            <td>{$row['name']}</td>
                                                            <td>{$row['age']}</td>
                                                            <td>{$row['contact']}</td>
                                                            <td>{$row['address']}</td>
                                                            <td>{$row['email']}</td>
                                                            <td>{$row['service_name']}</td>
                                                            <td>
                                                                <button class='btn btn-primary btn-sm' type='button' onclick='openeditmodalstaff({$row['id']}, \"{$row['name']}\", \"{$row['age']}\", \"{$row['contact']}\", \"{$row['address']}\", \"{$row['email']}\")'>Edit</button>
                                                                <a class='btn btn-danger btn-sm' href='deletestaff.php?id={$row['id']}'>Delete</a>
                                                            </td>
                                                        </tr>";
                                                }
                                            } else {
                                                echo "<tr><td colspan='8'>No staff available</td></tr>";
                                            }
                                            ?>
                                        </tbody>
                                       
                                    </table>
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
    </div>
    <!-- ./wrapper -->
    <?php include 'includes/scripts.php'; ?>

    <script>
        function openeditmodalstaff(id, name, age, contact, address, email) {
            $('#edit').modal('show');
            $('#id').val(id);
            $('#name').val(name);
            $('#age').val(age);
            $('#contact').val(contact);
            $('#address').val(address);
            $('#email').val(email);
        }
    </script>
</body>

</html>
