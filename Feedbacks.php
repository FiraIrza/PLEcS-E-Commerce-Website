<?php
    
    session_start();
    
    include 'sidebar.php';
    include 'DatabaseConnection.php';

    // Function to fetch and display Feedbacks in a table
    function displayFeedbacks()
    {
        $conn = connectToDatabase();

        // Check if the admin is logged in
        //if (isset($_SESSION["Username"]))
        //{
            //$Username = $_SESSION["Username"];

            // SQL query to fetch Feedbacks data from database.
            $sql = "SELECT plecs_feedback.feedback_id, plecs_feedback.feedback_date, plecs_feedback.feedback_text, plecs_feedback.feedback_email
                    FROM plecs_feedback";


            $result = $conn->query($sql);

            // Check if Feedback were found
            if($result->num_rows > 0)
            {
                echo "<table border='1'>
                        <tr>
                            <th>No</th>
                            <th>Date</th>
                            <th>Text</th>
                            <th>Email</th>
                        </tr>";

                // Output data of each row
                while($row = $result->fetch_assoc())
                {
                    echo "<tr>
                            <td>" . $row["feedback_id"] . "</td>
                            <td>" . $row["feedback_date"] . "</td>
                            <td>" . $row["feedback_text"] . "</td>
                            <td>" . $row["feedback_email"] . "</td>
                        </tr> ";
                }

                echo "</table>";
            }
            else
            {
                echo "No Feedback found";
            }
            
            $conn->close();
        }
        
/*
        if(!isset($_SESSION["Username"]))
        {
            header("Location: login.php");    // HERE IS THE PROBLEM
            exit();
        }*/
    //}

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
    <h1>Feedbacks</h1>

    <?php
    // Call the function to display Feedbacks in a table
    displayFeedbacks();
    ?>
    
</body>