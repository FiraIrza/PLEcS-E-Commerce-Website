<?php
// Start the session if not already started
session_start();

$host = 'localhost';
$dbname = 'payment_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];
    $cardName = $_POST['cardName'];
    $cardNum = $_POST['cardNum'];
    $expMonth = $_POST['expMonth'];
    $expYear = $_POST['expYear'];
    $cvv = $_POST['cvv'];

    // Check if the record already exists based on email
    $stmt = $pdo->prepare("SELECT * FROM payments WHERE email = ?");
    $stmt->execute([$email]);
    $existingRecord = $stmt->fetch();

    if ($existingRecord) {
        // Update the existing record
        $stmt = $pdo->prepare("UPDATE payments SET name=?, address=?, city=?, state=?, zip=?, card_num=?, card_number=?, exp_month=?, exp_year=?, cvv=? WHERE email=?");
        $stmt->execute([$name, $address, $city, $state, $zip, $cardNum, $expMonth, $expYear, $cvv, $email]);
    } else {
        // Insert data into the database
        $stmt = $pdo->prepare("INSERT INTO payments (name, email, address, city, state, zip, card_num, card_number, exp_month, exp_year, cvv) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$name, $email, $address, $city, $state, $zip, $cardNum, $expMonth, $expYear, $cvv]);
    }

    // Redirect or perform other actions after successful submission
    header("Location: ordersummary.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Payment-Page</title>
    <link rel="stylesheet" href="paymentstyle.css">
</head>

<body>
    <div class="container">

        <form id="paymentForm" action="#" method="post">

            <div class="row">

                <div class="col">
                    <h3 class="title">
                        Billing Address
                    </h3>

                    <div class="inputBox">
                        <label for="name">
                            Full Name:
                        </label>
                        <input type="text" id="name" name="name" placeholder="Enter your full name" required>
                    </div>

                    <div class="inputBox">
                        <label for="email">
                            Email:
                        </label>
                        <input type="text" id="email" name="email" placeholder="Enter email address" required>
                    </div>

                    <div class="inputBox"> 
                        <label for="address"> 
                              Address: 
                          </label> 
                        <input type="text" id="address" 
                               placeholder="Enter address" 
                               required> 
                    </div> 
  
                    <div class="inputBox"> 
                        <label for="city"> 
                              City: 
                          </label> 
                        <input type="text" id="city" 
                               placeholder="Enter city" 
                               required> 
                    </div> 
  
                    <div class="flex"> 
  
                        <div class="inputBox"> 
                            <label for="state"> 
                                  State: 
                              </label> 
                            <input type="text" id="state" 
                                   placeholder="Enter state" 
                                   required> 
                        </div> 
  
                        <div class="inputBox"> 
                            <label for="zip"> 
                                  Zip Code: 
                              </label> 
                            <input type="number" id="zip" 
                                   placeholder="123 456" 
                                   required> 
                        </div> 
  
                    </div> 

                </div>

                <div class="col">
                    <h3 class="title">Payment</h3>

                    <div class="inputBox">
                        <label for="name">
                            Card Accepted:
                        </label>
                        <img src="./images/card_img.png" alt="credit/debit card image">
                    </div>

                    <div class="inputBox">
                        <label for="cardName">
                            Name On Card:
                        </label>
                        <input type="text" id="cardName" name="cardName" placeholder="Enter card name" required>
                    </div>

                    <div class="inputBox"> 
                        <label for="cardNum"> 
                              Credit Card Number: 
                          </label> 
                        <input type="text" id="cardNum" 
                               placeholder="1111-2222-3333-4444" 
                               maxlength="19" required> 
                    </div> 
  
                    <div class="inputBox"> 
                        <label for="">Exp Month:</label> 
                        <select name="" id=""> 
                            <option value="">Choose month</option> 
                            <option value="January">January</option> 
                            <option value="February">February</option> 
                            <option value="March">March</option> 
                            <option value="April">April</option> 
                            <option value="May">May</option> 
                            <option value="June">June</option> 
                            <option value="July">July</option> 
                            <option value="August">August</option> 
                            <option value="September">September</option> 
                            <option value="October">October</option> 
                            <option value="November">November</option> 
                            <option value="December">December</option> 
                        </select> 
                    </div> 
  
  
                    <div class="flex"> 
                        <div class="inputBox"> 
                            <label for="">Exp Year:</label> 
                            <select name="" id=""> 
                                <option value="">Choose Year</option> 
                                <option value="2023">2023</option> 
                                <option value="2024">2024</option> 
                                <option value="2025">2025</option> 
                                <option value="2026">2026</option> 
                                <option value="2027">2027</option> 
                            </select> 
                        </div> 
  
                        <div class="inputBox"> 
                            <label for="cvv">CVV</label> 
                            <input type="number" id="cvv" 
                                   placeholder="1234" required> 
                        </div>                

                </div>

            </div>

            <input type="submit" value="Make Payment" class="submit_btn" id="submit_btn">
        </form>
    </div>

    <script type="text/javascript" src="./payment.js"></script>
</body>

</html>
