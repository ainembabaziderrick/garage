<?php
include 'db.php';

// Get the customer_id from the URL
$customer_id = intval($_GET['customer_id']);

if ($customer_id <= 0) {
    die("Invalid customer ID");
}

// Fetch customer details
$sql = "SELECT * FROM customers WHERE id = $customer_id";
$customerResult = $connection->query($sql);

if (!$customerResult || $customerResult->num_rows == 0) {
    die("Customer not found");
}

$customer = $customerResult->fetch_assoc();

// Fetch cart items
$sql = "SELECT s.name AS service_name, ci.quantity, ci.unit_price, ci.total_amount
        FROM cart_items ci
        JOIN services s ON ci.service_id = s.id
        WHERE ci.customer_id = $customer_id AND ci.is_paid = 1";
$cartResult = $connection->query($sql);

if (!$cartResult) {
    die("Invalid query: " . $connection->error);
}

$totalAmount = 0;
?>

<?php include 'includes/head.php'; ?>
<head>
    <title>Invoice</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; }
        .wrapper { display: flex; flex-direction: column; min-height: 100vh; }
        .header { width: 100%; }
        .sidebar { width: 250px; }
        .content-wrapper { flex: 1; padding: 20px; }
        .invoice { width: 100%; max-width: 800px; margin: auto; border: 1px solid #ddd; padding: 20px; box-sizing: border-box; }
        .invoice h1 { text-align: center; }
        .invoice table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        .invoice table, .invoice th, .invoice td { border: 1px solid #ddd; }
        .invoice th, .invoice td { padding: 8px; text-align: left; }
        .invoice .total { text-align: right; font-weight: bold; }
    </style>
</head>
<body>
<div class="wrapper">
    <?php include 'includes/header.php'; ?>
    
    <div class="wrapper-content">
        <?php include 'includes/cashier_sidebar.php'; ?>

        <div class="content-wrapper">
            <div class="invoice">
                <h1>Invoice</h1>
                <p><strong>Customer Name:</strong> <?= htmlspecialchars($customer['name']) ?></p>
                <p><strong>Number Plate:</strong> <?= htmlspecialchars($customer['number_plate']) ?></p>
                <p><strong>Contact:</strong> <?= htmlspecialchars($customer['contact']) ?></p>

                <table>
                    <thead>
                        <tr>
                            <th>Service</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $cartResult->fetch_assoc()) : ?>
                            <?php $totalAmount += $row['total_amount']; ?>
                            <tr>
                                <td><?= htmlspecialchars($row['service_name']) ?></td>
                                <td><?= htmlspecialchars($row['quantity']) ?></td>
                                <td><?= number_format($row['unit_price'], 0) ?></td>
                                <td><?= number_format($row['total_amount'], 0) ?></td>
                            </tr>
                        <?php endwhile ?>
                        <tr class="total">
                            <td colspan="3">Total Amount</td>
                            <td><?= number_format($totalAmount, 0) ?></td>
                        </tr>
                    </tbody>
                </table>

                <p><strong>Thank you for your business!</strong></p>
            </div>
        </div>
    </div>
</div>

<script>
    window.print();
</script>

</body>
</html>
