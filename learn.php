<?php
include 'db.php';
include 'initialize.php';

if (isset($_POST['add'])) {
    $customer_id = $_POST['customer_id'];
    $service_id = $_POST['service_id'];
    $quantity = $_POST['quantity'];

    do {
        if (empty($customer_id) || empty($service_id) || empty($quantity)) {
            $errorMessage = "All fields are required";
            break;
        }

        // Get the unit price from the services table
        $sql = "SELECT cost_price FROM services WHERE id = $service_id";
        $serviceResult = $connection->query($sql);

        if ($serviceResult && $serviceRow = $serviceResult->fetch_assoc()) {
            $unit_price = $serviceRow['cost_price'];
            $total_amount = $unit_price * $quantity;

            // Insert into cart_items table
            $sql = "INSERT INTO cart_items (customer_id, service_id, quantity, unit_price, total_amount)
                    VALUES ('$customer_id', '$service_id', '$quantity', '$unit_price', '$total_amount')";
            $result = $connection->query($sql);

            if (!$result) {
                $errorMessage = "Invalid query: " . $connection->error;
                break;
            }

            $activityLog->setAction($_SESSION['login_id'], "added service to cart for customer [ID#{$customer_id}]");
            $sucessMessage = "Service successfully added to cart";
        } else {
            $errorMessage = "Service not found";
            break;
        }

    } while (false);
}

$sql = "SELECT id, name FROM services";
$servicesResult = $connection->query($sql);

$sql = "SELECT id, name FROM customers";
$customersResult = $connection->query($sql);
?>

<?php include 'includes/head.php'; ?>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php include 'includes/header.php'; ?>
        <?php include 'includes/sidebar.php'; ?>

        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>CUSTOMERS</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/garage/dashboard.php">Home</a></li>
                                <li class="breadcrumb-item active">Customers</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <?php
            if (!empty($errorMessage)) {
                echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                        <strong>$errorMessage</strong>
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                      </div>";
            }

            if (!empty($sucessMessage)) {
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                        <strong>$sucessMessage</strong>
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                      </div>";
            }
            ?>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- Add to Cart Column -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Add Customer to Cart</h3>
                                </div>
                                <div class="card-body">
                                    <form action="" method="post">
                                        <div class="form-group">
                                            <label for="customer_id">Select Customer:</label>
                                            <select name="customer_id" id="customer_id" required class="form-control">
                                                <option value="" disabled selected>Select a Customer</option>
                                                <?php
                                                if ($customersResult->num_rows > 0) {
                                                    while ($row = $customersResult->fetch_assoc()) {
                                                        echo "<option value='" . $row['id'] . "'>" . htmlspecialchars($row['name']) . "</option>";
                                                    }
                                                } else {
                                                    echo "<option value=''>No customers available</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="service_id">Select Service:</label>
                                            <select name="service_id" id="service_id" required class="form-control">
                                                <option value="" disabled selected>Select a Service</option>
                                                <?php
                                                if ($servicesResult->num_rows > 0) {
                                                    while ($row = $servicesResult->fetch_assoc()) {
                                                        echo "<option value='" . $row['id'] . "'>" . htmlspecialchars($row['name']) . "</option>";
                                                    }
                                                } else {
                                                    echo "<option value=''>No services available</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="quantity">Quantity</label>
                                            <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Enter Quantity" required>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary" name="add">Add</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Services Added Column -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Services Added</h3>
                                </div>
                                <div class="card-body">
                                    <form action="submit_cart.php" method="post">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Service</th>
                                                    <th>Quantity</th>
                                                    <th>Unit Price</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $totalAmount = 0;

                                                $sql = "SELECT c.id, s.name AS service_name, c.quantity, c.unit_price, c.total_amount, cu.name AS customer_name
                                                        FROM cart_items c 
                                                        JOIN services s ON c.service_id = s.id
                                                        JOIN customers cu ON c.customer_id = cu.id";
                                                $result = $connection->query($sql);

                                                if (!$result) {
                                                    die("Invalid query: " . $connection->error);
                                                }

                                                while ($row = $result->fetch_assoc()) : 
                                                    $totalAmount += $row['total_amount'];
                                                ?>
                                                    <tr>
                                                        <td><?= $row['service_name'] ?></td>
                                                        <td><?= $row['quantity'] ?></td>
                                                        <td><?= number_format($row['unit_price'], 2) ?></td>
                                                        <td><?= number_format($row['total_amount'], 2) ?></td>
                                                    </tr>
                                                <?php endwhile ?>
                                                <tr>
                                                    <td colspan="3"><strong>Total Amount</strong></td>
                                                    <td><strong><?= number_format($totalAmount, 2) ?></strong></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success">Submit Cart</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <?php include 'includes/footer.php'; ?>
    </div>

    <?php include 'includes/scripts.php'; ?>

    <script>
        const openeditcustomers = (id, name, number_plate, contact) => {
            $('#editmodalc').modal('show');
            document.getElementById('id').value = id;
            document.getElementById('name').value = name;
            document.getElementById('number_plate').value = number_plate;
            document.getElementById('contact').value = contact;
        }
    </script>
</body>
</html>
