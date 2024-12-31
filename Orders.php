<?php 

    session_start();
    
    include 'sidebar.php';
    include 'DatabaseConnection.php';

    //function to fetch and display Orders in a table
    function DisplayOrders()
    {
        $conn = connectToDatabase();

            // Query to fetch data from the Table orders from the database.
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


            // Check if Order exist
            if($result->num_rows > 0)
            {
                echo "<table border='1'>
                        <tr>
                            <th>Order No</th>
                            <th>Total Price</th>
                            <th>Username</th>
                            <th>Payment No</th>
                            <th>Payment Date</th>
                            <th>Payment Method</th>
                            <th>Amount</th>
                            <th>Shipping No</th>
                            <th>Address</th>
                            <th>Zip Code</th>
                            <th>City</th>
                            <th>State</th>
                            <th>Country</th>
                        </tr>";

                // Output data of each row
                while($row = $result->fetch_assoc())
                {
                    echo "<tr>
                            <td>" . $row["order_id"] . "</td>
                            <td>" . $row["total_price"] . "</td>
                            <td>" . $row["user_name"] . "</td>
                            <td>" . $row["payment_id"] . "</td>
                            <td>" . $row["payment_date"] . "</td>
                            <td>" . $row["payment_method"] . "</td>
                            <td>" . $row["amount"] . "</td>
                            <td>" . $row["shipping_id"] . "</td>
                            <td>" . $row["address"] . "</td>
                            <td>" . $row["zip_code"] . "</td>
                            <td>" . $row["city"] . "</td>
                            <td>" . $row["state"] . "</td>
                            <td>" . $row["country"] . "</td>  
                        </tr>";
                }

                echo "</table>";
            }
            else
            {
                echo "No Orders found😒";
            }  
            $conn->close(); 
        }


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Puff Lab Admin</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="admin.css">
</head>

<body>
    <h1>Orders</h1>

    <?php
        // Call the function to display Feedbacks in a table
        DisplayOrders();
    
    ?>
</body>
