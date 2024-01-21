<?php 
    session_start();
    
    include 'sidebar.php';
    include 'DatabaseConnection.php';

// To make sure the session run when the admin logged in
//if(isset($_SESSION["Username"]))
//{
    //$Username = $_SESSION["Username"];

    // Fetch data from the database
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
}*/

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


<h1>Market Analysis</h1></br></br>
    <canvas id="myPieChart" width="5px" height="5px"></canvas>
    </br></br></br></br></br>
    <h1>Revenue Analysis</h1></br></br>
    <canvas id="revenueChart" width="10px" height="5px"></canvas>


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

    </body>

</html>