<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Replace these with your actual database credentials
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "pufflab_db";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get form data
    $feedback = $conn->real_escape_string($_POST["feedback"]);
    $email = $conn->real_escape_string($_POST["email"]);

    // Insert data into the database
    $sql = "INSERT INTO feedback_table (feedback, email) VALUES ('$feedback', '$email')";

    if ($conn->query($sql) === TRUE) {
        echo "Form data successfully stored in the database.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close connection
    $conn->close();
}
?>