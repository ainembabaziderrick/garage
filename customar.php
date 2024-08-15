<?php
include 'db.php';
include 'initialize.php';

if (isset($_POST['submit_cart'])) {
    $name = $_POST['name'];
    $number_plate = $_POST['number_plate'];
    $contact = $_POST['contact'];
    $services = json_decode($_POST['services'], true);

    if (empty($name) || empty($number_plate) || empty($contact) || empty($services)) {
        $errorMessage = "All fields are required";
    } else {
        // Add new customer to the database
        $sql = "INSERT INTO customers (name, number_plate, contact) VALUES (?, ?, ?)";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param('sss', $name, $number_plate, $contact);
        if ($stmt->execute()) {
            $customer_id = $stmt->insert_id;

            // Insert multiple services into cart_items table
            $inserted = true;
            foreach ($services as $service) {
                $service_id = $service['service_id'];
                $quantity = $service['quantity'];
                
                // Get the unit price from the services table
                $sql = "SELECT cost_price FROM services WHERE id = ?";
                $stmt = $connection->prepare($sql);
                $stmt->bind_param('i', $service_id);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($serviceRow = $result->fetch_assoc()) {
                    $unit_price = $serviceRow['cost_price'];
                    $total_amount = $unit_price * $quantity;

                    // Insert into cart_items table
                    $sql = "INSERT INTO cart_items (customer_id, service_id, quantity, unit_price, total_amount)
                            VALUES (?, ?, ?, ?, ?)";
                    $stmt = $connection->prepare($sql);
                    $stmt->bind_param('iiidd', $customer_id, $service_id, $quantity, $unit_price, $total_amount);
                    if (!$stmt->execute()) {
                        $inserted = false;
                        $errorMessage = "Error inserting service: " . $connection->error;
                        break;
                    }
                } else {
                    $inserted = false;
                    $errorMessage = "Service not found";
                    break;
                }
            }

            if ($inserted) {
                $activityLog->setAction($_SESSION['login_id'], "added new customer [ID#{$customer_id}] with multiple services");
                $successMessage = "Customer and services successfully added";
                // Clear the cart after successful submission
                $services = [];
            }
        } else {
            $errorMessage = "Error adding customer: " . $connection->error;
        }
    }
}

// Get services for the dropdown
$serviceQuery = "SELECT id, name FROM services";
$serviceResult = $connection->query($serviceQuery);
?>


<?php include 'includes/head.php'; ?>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <?php include 'includes/header.php'; ?>
    <?php include 'includes/cashier_sidebar.php'; ?>

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

        <?php if (!empty($errorMessage)): ?>
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong><?= $errorMessage ?></strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
        <?php endif; ?>

        <?php if (!empty($successMessage)): ?>
            <div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong><?= $successMessage ?></strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
        <?php endif; ?>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- Add to Cart Column -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Add Service</h3>
                            </div>
                            <div class="card-body">
                                <form id="addServiceForm">
                                    <div class="form-group">
                                        <label for="service_id">Select Service:</label>
                                        <select name="service_id" id="service_id" required class="form-control">
                                            <option value="" disabled selected>Select a Service</option>
                                            <?php while ($row = $serviceResult->fetch_assoc()): ?>
                                                <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['name']) ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="quantity">Quantity</label>
                                        <input type="number" class="form-control" id="quantity" name="quantity" required>
                                    </div>
                                    <button type="button" class="btn btn-primary" id="addServiceButton">Add Service</button>
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
                                <form action="" method="post" id="cartForm">
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
                                    <table class="table table-bordered table-striped" id="servicesTable">
                                        <thead>
                                            <tr>
                                                <th>Service</th>
                                                <th>Quantity</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success" name="submit_cart">Submit Cart</button>
                                    </div>
                                    <input type="hidden" name="services" id="servicesInput">
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
document.addEventListener('DOMContentLoaded', () => {
    let services = [];

    document.getElementById('addServiceButton').addEventListener('click', () => {
        const serviceId = document.getElementById('service_id').value;
        const serviceName = document.querySelector(`#service_id option[value='${serviceId}']`).textContent;
        const quantity = document.getElementById('quantity').value;

        if (serviceId && quantity) {
            services.push({ service_id: serviceId, service_name: serviceName, quantity: quantity });
            updateServicesTable();
            document.getElementById('addServiceForm').reset();
        } else {
            alert("Please select a service and enter a valid quantity.");
        }
    });

    function updateServicesTable() {
        const tbody = document.querySelector('#servicesTable tbody');
        tbody.innerHTML = '';
        services.forEach((service, index) => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>${service.service_name}</td>
                <td>${service.quantity}</td>
                <td>
                    <button type="button" class="btn btn-danger" onclick="removeService(${index})">Remove</button>
                </td>`;
            tbody.appendChild(tr);
        });
        document.getElementById('servicesInput').value = JSON.stringify(services);
    }

    window.removeService = (index) => {
        services.splice(index, 1);
        updateServicesTable();
    };
});
</script>
</body>
</html>
