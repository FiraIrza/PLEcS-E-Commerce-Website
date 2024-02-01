<?php
session_start();

require_once 'DatabaseConnection.php';
//include 'header.php';

$conn = connectToDatabase();



// Collect data from the form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['user_name'];
    $address = $_POST['address'];
    $zipcode = $_POST['zip_code'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $paymentdate = $_POST['payment_date'];
    $paymentmethod = $_POST['payment_method'];

    
    
    $amount = Payment::getPaymentAmount($cart->grandTotal);


    // Insert data into the database
    $sql = "INSERT INTO plecs_payments (payment_date, payment_method, amount, user_name) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $paymentdate, $paymentmethod, $amount, $username);
    $stmt->execute();

    // Check for errors
    if ($stmt->error) {
        echo "Error in payment insertion: " . $stmt->error;
    }

    // Insert shipping information
    $sql = "INSERT INTO plecs_shipping (address, zip_code, city, state, country, user_name) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $address, $zipcode, $city, $state, $country, $username);
    $stmt->execute();

    // Check for errors
    if ($stmt->error) {
        echo "Error in shipping insertion: " . $stmt->error;
    }

    // Redirect or perform other actions after successful submission
    header("Location: ordersummary.php");
    exit();
}


$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Payment-Page</title>
    <link rel="stylesheet" href="./css/paymentstyle.css">
</head>

<body>
    <div class="container">
        <form id="paymentForm" action="ordersummary.php" method="POST">
            <div class="row">
                <div class="col">
                    <h3 class="title">
                        Shipping Address
                    </h3>

                    <div class="inputBox">
                        <label for="username">
                            Username:
                        </label>
                        <input type="text" name="username" placeholder="Enter your user name" required>
                    </div>

                    <div class="inputBox">
                        <label for="address">
                            Address:
                        </label>
                        <input type="text" id="address" name="address" placeholder="Enter your address" required>
                    </div>

                    <div class="flex">
                        <div class="inputBox">
                            <label for="zipcode">
                                Zip Code:
                            </label>
                            <input type="number" id="zip" name="zipcode" placeholder="XXXXX" required>
                        </div>

                        <div class="inputBox">
                            <label for="city">
                                City:
                            </label>
                            <input type="text" id="city" name="city" placeholder="Enter City" required>
                        </div>
                    </div>

                    <div class="flex">
                        <div class="inputBox">
                            <label for="state">
                                State:
                            </label>
                            <input type="text" id="state" name="state" placeholder="Enter state" required>
                        </div>

                        <div class="inputBox">
                            <label for="country">
                                Country:
                            </label>
                            <input type="text" id="country" name="country" placeholder="Enter Country" required>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <h3 class="title">Payment</h3>

                    <div class="inputBox">
                        <label for="name">
                            Card Accepted:
                        </label>
                        <img src="./img/visa.png" alt="credit/debit card image">
                    </div>


                    <div class="inputBox">
                        <label for="paymentmethod">Payment Method:</label>
                        <select id="paymentMethod" name="payment_method" required>
                            <option value="" disabled selected>Select payment method</option>
                            <option value="Credit Card">VISA</option>
                            <option value="QR CODE">QR CODE</option>
                            
                        </select>
                    </div>

                    <div class="inputBox">
                        <label for="paymentDate">Date:</label>
                        <input type="date" name="paymentdate" id="payment_date" value="<?php echo date('Y-m-d'); ?>" required>
                    </div>

                    <input type="submit" value="Make Payment" class="submit_btn" id="submit_btn">
                </div>
            </div>
        </form>
    </div>
</body>

</html>
