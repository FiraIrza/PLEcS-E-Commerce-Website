<?php

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
    
?>