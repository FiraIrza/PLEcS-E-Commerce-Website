<?php

include 'DatabaseConnection.php';

$conn = connectToDatabase();


// HTML Output
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Summary</title>
    <link rel="stylesheet" href="./css/orders.css">
</head>

<body>

    <div class="order-summary">
        <h2>Order #<?php echo $orderNumber; ?></h2>
        <p>Thank you for supporting us!</p>
        <h3>Order Updates</h3>
        <img src="./img/box.png" alt="box" width="200" height="200">
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
                    <td colspan="2">Grand Total</td>
                    <td>RM<?php echo number_format($grandTotal, 2); ?></td>
                </tr>
            </tfoot>
        </table>
        <a href="index.php"><button>Continue Shoppingg</button></a>
    </div>

</body>

</html>
