<?php 
    session_start();
    
    include 'sidebar.php';
    include 'DatabaseConnection.php';

// To make sure the session run when the admin logged in
//if(isset($_SESSION["Username"]))
//{
    //$Username = $_SESSION["Username"];

    //function to fetch and display total users, total orders, feedbacks and total incomes.
    function displaySummary()
    {
        $conn = connectToDatabase();

        // Fetch total users
        $userQuery = "SELECT COUNT(*) AS totalUsers FROM user_account";
        $userResult = $conn->query($userQuery);
        $totalUsers = $userResult->fetch_assoc()['totalUsers'];

        // Fetch total orders
        $orderQuery = "SELECT COUNT(*) AS totalOrders FROM plecs_order";
        $orderResult = $conn->query($orderQuery);
        $totalOrders = $orderResult->fetch_assoc()['totalOrders'];

        // Fetch total feedbacks
        $feedbackQuery = "SELECT COUNT(*) AS totalFeedbacks FROM plecs_feedback";
        $feedbackResult = $conn->query($feedbackQuery);
        $totalFeedbacks = $feedbackResult->fetch_assoc()['totalFeedbacks'];

        // Fetch total incomes
        $incomeQuery = "SELECT SUM(amount) AS totalIncomes FROM plecs_payments";
        $incomeResult = $conn->query($incomeQuery);
        $totalIncomes = $incomeResult->fetch_assoc()['totalIncomes'];

        $conn->close();

        // Display the results
        echo '<div class="result-container">';
        echo "<h1>$totalUsers</h1><p>Users</p>";
        echo '</div>';

        echo '<div class="result-container">';
        echo "<h1>$totalOrders</h1><p>Orders</p>";
        echo '</div>';

        echo '<div class="result-container">';
        echo "<h1>$totalFeedbacks</h1><p>Feedbacks</p>";
        echo '</div>';

        echo '<div class="result-container">';
        echo "<p>RM</p><h1>$totalIncomes</h1><p>Income</p>";
        echo '</div>';

    }

    
    
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

    // Code for Analytics Chart
    $conn = connectToDatabase();

    $revenueData = array();
    $productData = array();

    // Fetch revenue data
    $revenueQuery = "SELECT payment_date, amount FROM plecs_payments";
    $revenueResult = $conn->query($revenueQuery);

    if ($revenueResult->num_rows > 0) {

        $revenueData['datasets'][] = array(
            'label' => 'Revenue', // Set the dataset label here
            'data' => array(),
            'borderColor' => 'rgba(75, 192, 192, 1)',
            'borderWidth' => 2,
            'fill' => false,
        );

        while ($row = $revenueResult->fetch_assoc()) {
            // Extract month from the date (assuming date is in Y-m-d format)
            $month = date('M', strtotime($row['payment_date']));

            $revenueData['labels'][] = $month;
            $revenueData['datasets'][0]['data'][] = $row['amount'];
        }
    }

    // Fetch product data
    $productQuery = "SELECT product_name, popularity FROM plecs_product";
    $productResult = $conn->query($productQuery);

    if ($productResult->num_rows > 0) {
        while ($row = $productResult->fetch_assoc()) {
            $productData['labels'][] = $row['product_name'];
            $productData['datasets'][0]['data'][] = $row['popularity'];
        }
    }

    $conn->close();
//}  

/*
if(!isset($_SESSION["Username"]))
{
    header("Location: login.php");  // Here is the problem
    exit();
} */

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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

<div class="page-content">
</br></br></br>
    <!-- Example content for page1.php -->
    <h1>Main Dashboard</h1>
    <?php
    // Call the function to display Summary.
    displaySummary();
    ?>
    </br></br></br></br></br>

    <h2>Market Analysis</h2></br></br>
    <canvas id="myPieChart" width="50" height="50"></canvas>
    </br></br></br></br></br>
    <h2>Revenue Analysis</h2></br></br>
    <canvas id="revenueChart" width="100" height="50"></canvas>

<script>
window.onload = function() 
{
  // Use PHP-generated data
  const revenueData = <?php echo json_encode($revenueData); ?>;
  const productData = <?php echo json_encode($productData); ?>;

  // Get the context of the canvas element
  const ctex = document.getElementById('revenueChart').getContext('2d');

  // Create the line chart with dynamic data
  const revenueChart = new Chart(ctex, 
  {
      type: 'line',
      data: revenueData,
      options: {
          scales: {
              y: {
                  beginAtZero: true,
              },
          },
      },
  });

  // Get the context of the canvas element
  const ctx = document.getElementById('myPieChart').getContext('2d');

  // Create the pie chart with dynamic data
  const myPieChart = new Chart(ctx, 
  {
    type: 'pie',
    data: productData,
  }); 
};

</script>
</br></br></br></br>
<h2>Orders</h2></br>
    <?php
    // Call the function to display Summary.
    DisplayOrders();
    ?>
</div>

    

    

    
</body>