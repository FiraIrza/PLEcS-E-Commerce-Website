<?php

include 'DatabaseConnection.php';
include 'header.php';

$conn = connectToDatabase();

// Your PHP code here
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get form data
    $feedback = $conn->real_escape_string($_POST["feedback"]);
    $email = $conn->real_escape_string($_POST["email"]);

    // Insert data into the database
    $sql = "INSERT INTO plecs_feedback (feedback_text, feedback_email) VALUES ('$feedback', '$email')";

}

$conn -> close();

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="./css/contactus.css" />
</head>
    <body>
        <div class="contact-us">
            <div class="overlap">
                <div class="container">
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <label for="feedback">Your Feedback:</label>
                        <textarea id="feedback" name="feedback" rows="4" placeholder="Enter your feedback"></textarea>
                        <label for="email">Your Email:</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email">
                        <button type="submit">Submit Feedback</button>
                    </form>
                </div>
            </div>
            <div class="text-wrapper-3">Contact Us</div>
            <p class="feel-free-to-express">
                <span class="span">Feel </span>
                <span class="span">free to express your inquiry or feedback by contacting us.</span>
                <span class="span">&nbsp;</span>
            </p>
            <img class="quino-al" src="./img/phone.png" />
        </div>
    </body>
</html>