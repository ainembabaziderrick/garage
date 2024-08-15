<?php
include 'db.php';

// Handle the form submission
if (isset($_POST['pay'])) {
    $customer_id = intval($_POST['customer_id']);
    
    if ($customer_id <= 0) {
        die("Invalid customer ID");
    }

    // Mark the cart items as paid
    $sql = "UPDATE cart_items SET is_paid = 1 WHERE customer_id = $customer_id";
    $result = $connection->query($sql);

    if (!$result) {
        die("Invalid query: " . $connection->error);
    }

    // Redirect to invoice generation page
    header("Location: cashier_invoice.php?customer_id=$customer_id");
    exit();
}

// Fetch customers for selection
$sql = "SELECT id, name FROM customers";
$customersResult = $connection->query($sql);

if (!$customersResult) {
    die("Invalid query: " . $connection->error);
}
?>

<?php include 'includes/head.php'; ?>
<head>
    <title>Receive Payment</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { width: 50%; margin: auto; padding: 20px; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; }
        .form-group select, .form-group button { width: 100%; padding: 8px; }
        .form-group button { background-color: #28a745; color: white; border: none; }
    </style>
</head>
<body>
<?php include 'includes/header.php'; ?>
<?php include 'includes/cashier_sidebar.php'; ?>
<div class="container">
    <h1>Receive Payment</h1>
    <form action="" method="post">
        <div class="form-group">
            <label for="customer_id">Select Customer:</label>
            <select name="customer_id" id="customer_id" required>
                <option value="" disabled selected>Select a Customer</option>
                <?php while ($row = $customersResult->fetch_assoc()) : ?>
                    <option value="<?= htmlspecialchars($row['id']) ?>"><?= htmlspecialchars($row['name']) ?></option>
                <?php endwhile ?>
            </select>
        </div>
        <div class="form-group">
            <button type="submit" name="pay">Receive Payment</button>
        </div>
    </form>
</div>

</body>
</html>
