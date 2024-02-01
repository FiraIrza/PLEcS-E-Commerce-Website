<?php

session_start();

include 'DatabaseConnection.php';

$conn = connectToDatabase();



    $sql = "SELECT 
        plecs_order.order_id,
        plecs_order.total_price,
        plecs_order.user_name,
        plecs_payments.payment_id,
        plecs_payments.payment_date,
        plecs_payments.payment_method,
        plecs_payments.amount,
        plecs_shipping.shipping_id,
        plecs_shipping.address,
        plecs_shipping.zip_code,
        plecs_shipping.city,
        plecs_shipping.state,
        plecs_shipping.country
    FROM
        plecs_order
    JOIN
        plecs_payments ON plecs_order.payment_id = plecs_payments.payment_id
    JOIN
        plecs_shipping ON plecs_order.shipping_id = plecs_shipping.shipping_id";

$result = $conn->query($sql);

// Error Handling
if (!$result) 
{
    die("Error: " . $conn->error);
}

if($result->num_rows > 0)
{
    
    $row = $result->fetch_assoc();
    $orderNumber = $row['order_id'];
    $contactName = $row['user_name'];
    $contactPhone = '0178526528';
    $contactAddress  = $row['address'];
    $paymentMethod = $row['payment_method'];
    $grandTotal = $row['total_price'];
}

function DisplayItems()
{ 
    $conn = connectToDatabase();

    $sql = "SELECT product_id,
                    product_cat,
                    product_name
            FROM
                plecs_product";

    $result = $conn->query($sql);

    $sql1 = "SELECT amount

            FROM
                plecs_payments";

    $result1 = $conn->query($sql1);

    // Error Handling
    if (!$result && !$result1) 
    {
        die("Error: " . $conn->error);
    }

    $totalAmount = 0; // Initialize total amount variable

    if($result->num_rows > 0 && $result1->num_rows > 0)
    {
        
        while(($row = $result->fetch_assoc()) && ($row1 = $result1->fetch_assoc()))
        {
            echo "<tr>
                    <td>" . $row["product_cat"] . "</td>
                    <td>" . $row["product_name"] . "</td>
                    <td>RM" . number_format($row1["amount"], 2) . "</td>
                </tr>";
        }
    }

    

    $conn->close();

    
}

function getamount()
{
    $conn = connectToDatabase();

    $sql1 = "SELECT amount

            FROM
                plecs_payments";

    $result1 = $conn->query($sql1);

    // Error Handling
    if (!$result1) 
    {
        die("Error: " . $conn->error);
    }

    $totalAmount = 0; // Initialize total amount variable
    while($row1 = $result1->fetch_assoc())
        {
            // Accumulate amount for total
            $totalAmount += $row1["amount"];
        }

        return $totalAmount; // Return total amount
}


// Call the function and store the returned total amount
$totalAmount = getamount();

$conn->close();


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
                    <th>Category</th>
                    <th>Item</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                DisplayItems();
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2">Grand Total</td>
                    <td>RM<?php echo number_format($totalAmount, 2); ?></td>
                </tr>
            </tfoot>
        </table>
        <a href="index.php"><button>Continue Shoppingg</button></a>
    </div>

</body>

</html>
