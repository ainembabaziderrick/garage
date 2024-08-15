<?php
include 'db.php';
include 'initialize.php';

if (isset($_POST['add'])) {
    $service_id = $_POST['service_id'];
    $name = $_POST['name'];
    $number_plate = $_POST['number_plate'];
    $contact = $_POST['contact'];
    $quantity = $_POST['quantity'];

    do {
        if (empty($service_id) || empty($name) || empty($number_plate) || empty($contact) || empty($quantity)) {
            $errorMessage = "All fields are required";
            break;
        }

        // Add new customer to the database
        $sql = "INSERT INTO customers (name, number_plate, contact, quantity)
                VALUES ('$name', '$number_plate', '$contact', '$quantity')";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $customer_id = $connection->insert_id;

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
        } else {
            $errorMessage = "Service not found";
            break;
        }

        $activityLog->setAction($_SESSION['login_id'], "added new customer [ID#{$customer_id}]");
        $successMessage = "Customer successfully added";

    } while (false);
}

if (isset($_POST['submit_cart'])) {
    // Handle the submission of cart details if needed
    $successMessage = "Cart submitted successfully";
}

// Get the latest customer ID
$latestCustomerQuery = "SELECT MAX(id) AS last_customer_id FROM customers";
$latestCustomerResult = $connection->query($latestCustomerQuery);
$latestCustomer = $latestCustomerResult->fetch_assoc();
$lastCustomerId = $latestCustomer['last_customer_id'];

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

            if (!empty($successMessage)) {
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                        <strong>$successMessage</strong>
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
                                            <label for="service_id">Select Service:</label>
                                            <select name="service_id" id="service_id" required class="form-control">
                                                <option value="" disabled selected>Select a Service</option>
                                                <?php
                                                $serviceQuery = "SELECT id, name FROM services";
                                                $serviceResult = $connection->query($serviceQuery);

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
                                        <div class="form-group">
                                            <label for="name">Customer Name</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Customer Name" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="number_plate">Number Plate</label>
                                            <input type="text" class="form-control" id="number_plate" name="number_plate" placeholder="Enter Number Plate" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="contact">Contact</label>
                                            <input type="text" class="form-control" id="contact" name="contact" placeholder="Enter Contact" required>
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
                                    <form action="" method="post">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Customer</th>
                                                    <th>Service</th>
                                                    <th>Quantity</th>
                                                    <th>Unit Price</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $totalAmount = 0;

                                                // Fetch details of the last added customer
                                                $cartQuery = "SELECT c.name AS customer_name, s.name AS service_name, ci.quantity, ci.unit_price, ci.total_amount
                                                              FROM cart_items ci 
                                                              JOIN services s ON ci.service_id = s.id
                                                              JOIN customers c ON ci.customer_id = c.id
                                                              WHERE ci.customer_id = $lastCustomerId";
                                                $cartResult = $connection->query($cartQuery);

                                                if (!$cartResult) {
                                                    die("Invalid query: " . $connection->error);
                                                }

                                                while ($row = $cartResult->fetch_assoc()) : 
                                                    $totalAmount += $row['total_amount'];
                                                ?>
                                                    <tr>
                                                        <td><?= htmlspecialchars($row['customer_name']) ?></td>
                                                        <td><?= htmlspecialchars($row['service_name']) ?></td>
                                                        <td><?= htmlspecialchars($row['quantity']) ?></td>
                                                        <td><?= number_format($row['unit_price'], 0) ?></td>
                                                        <td><?= number_format($row['total_amount'], 0) ?></td>
                                                    </tr>
                                                <?php endwhile ?>
                                                <tr>
                                                    <td colspan="4"><strong>Total Amount</strong></td>
                                                    <td><strong><?= number_format($totalAmount, 0) ?></strong></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success" name="submit_cart">Submit Cart</button>
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
