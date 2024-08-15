<?php
include 'db.php';

// Fetch all sales from the cart_items table
$sql = "SELECT c.id AS customer_id, c.name AS customer_name, c.number_plate, c.contact, 
               s.name AS service_name, ci.quantity, ci.unit_price, ci.total_amount, ci.is_paid
        FROM cart_items ci
        JOIN customers c ON ci.customer_id = c.id
        JOIN services s ON ci.service_id = s.id
        ORDER BY ci.id DESC";
$salesResult = $connection->query($sql);

if (!$salesResult) {
    die("Invalid query: " . $connection->error);
}

$totalSales = 0;
?>

<?php include 'includes/head.php'; ?>
<head>
    <title>Track Sales</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; }
        .wrapper { display: flex; flex-direction: column; min-height: 100vh; }
        .header { width: 100%; }
        .sidebar { width: 250px; }
        .content-wrapper { flex: 1; padding: 20px; }
        .sales-table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        .sales-table, .sales-table th, .sales-table td { border: 1px solid #ddd; }
        .sales-table th, .sales-table td { padding: 8px; text-align: left; }
        .sales-table .total { text-align: right; font-weight: bold; }
        .print-button { margin-top: 20px; text-align: center; }
        .print-button button { padding: 10px 20px; font-size: 16px; cursor: pointer; }
    </style>
</head>
<body>
<div class="wrapper">
    <?php include 'includes/header.php'; ?>
    
    <div class="wrapper-content">
        <?php include 'includes/sidebar.php'; ?>

        <div class="content-wrapper">
            <h1>Sales </h1>
            
            <table class="sales-table">
                <thead>
                    <tr>
                        <th>Customer Name</th>
                        <th>Number Plate</th>
                        <th>Contact</th>
                        <th>Service</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Total Amount</th>
                        <th>Paid</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $salesResult->fetch_assoc()) : ?>
                        <?php $totalSales += $row['total_amount']; ?>
                        <tr>
                            <td><?= htmlspecialchars($row['customer_name']) ?></td>
                            <td><?= htmlspecialchars($row['number_plate']) ?></td>
                            <td><?= htmlspecialchars($row['contact']) ?></td>
                            <td><?= htmlspecialchars($row['service_name']) ?></td>
                            <td><?= htmlspecialchars($row['quantity']) ?></td>
                            <td><?= number_format($row['unit_price'], 0) ?></td>
                            <td><?= number_format($row['total_amount'], 0) ?></td>
                            <td><?= $row['is_paid'] ? 'Yes' : 'No' ?></td>
                        </tr>
                    <?php endwhile ?>
                    <tr class="total">
                        <td colspan="7">Total Sales Amount</td>
                        <td><?= number_format($totalSales, 0) ?></td>
                    </tr>
                </tbody>
            </table>

            <!-- Print Button -->
            <div class="print-button">
                <button onclick="window.print()">Print Sales Report</button>
            </div>

        </div>
    </div>
</div>

</body>
</html>
