<?php
// Database Connection
$host = 'localhost';
$dbname = 'order_summary';
$username = '';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}

// Dummy Data
$orderNumber = '123';
$orderUpdate = 'ORDER PICKING: We will notify you once the order is ready and will deliver to your house on time!';
$contactName = 'Emily Elisa';
$contactPhone = '0105146418';
$contactAddress = 'Unijaya, Kota Samarahan, Sarawak.';
$paymentMethod = 'Online Banking';
$itemName1 = 'Regular Creampuff';
$itemFlavor1 = 'Vanilla';
$itemPrice1 = 6.00;
$itemName2 = 'Regular Creampuff';
$itemFlavor2 = 'Strawberry';
$itemPrice2 = 3.00;
$subtotal = 9.00;
$discount = -1.00;
$shipping = 0.00;
$grandTotal = 8.00;

// Insert Data into Database
$stmt = $pdo->prepare("INSERT INTO orders (order_number, order_update, contact_name, contact_phone, contact_address, payment_method, item_name, item_flavor, item_price, subtotal, discount, shipping, grand_total) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->execute([$orderNumber, $orderUpdate, $contactName, $contactPhone, $contactAddress, $paymentMethod, $itemName1, $itemFlavor1, $itemPrice1, $subtotal, $discount, $shipping, $grandTotal]);
$stmt->execute([$orderNumber, $orderUpdate, $contactName, $contactPhone, $contactAddress, $paymentMethod, $itemName2, $itemFlavor2, $itemPrice2, $subtotal, $discount, $shipping, $grandTotal]);

// HTML Output
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Summary</title>
    <link rel="stylesheet" href="orders.css">
</head>

<body>

    <div class="order-summary">
        <h2>Order #<?php echo $orderNumber; ?></h2>
        <p>Thank you for supporting us!</p>
        <h3>Order Updates</h3>
        <img src="./box.png" alt="box" width="200" height="200">
        <p class="pick-update"><?php echo $orderUpdate; ?></p>
        <h3>Contact</h3>
        <p><?php echo $contactName; ?></p>
        <p><?php echo $contactPhone; ?></p>
        <p><?php echo $contactAddress; ?></p>
        <h3>Payment</h3>
        <p><?php echo $paymentMethod; ?></p>
        <h3>Order Summary</h3>
        <table>
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Flavor</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $itemName1; ?></td>
                    <td><?php echo $itemFlavor1; ?></td>
                    <td>RM<?php echo number_format($itemPrice1, 2); ?></td>
                </tr>
                <tr>
                    <td><?php echo $itemName2; ?></td>
                    <td><?php echo $itemFlavor2; ?></td>
                    <td>RM<?php echo number_format($itemPrice2, 2); ?></td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2">Subtotal</td>
                    <td>RM<?php echo number_format($subtotal, 2); ?></td>
                </tr>
                <tr>
                    <td colspan="2">Discount</td>
                    <td>RM<?php echo number_format($discount, 2); ?></td>
                </tr>
                <tr>
                    <td colspan="2">Shipping</td>
                    <td>RM<?php echo number_format($shipping, 2); ?></td>
                </tr>
                <tr>
                    <td colspan="2">Grand Total</td>
                    <td>RM<?php echo number_format($grandTotal, 2); ?></td>
                </tr>
            </tfoot>
        </table>
        <button>Continue Shopping</button>
    </div>

</body>

</html>
