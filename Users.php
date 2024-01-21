<?php 

    session_start();
    
    include 'sidebar.php';
    include 'DatabaseConnection.php';

    // Function to fetch and display data from Users table.
    Function DisplayUsers()
    {
        $conn = connectToDatabase();
        
        // Continue the session if admin is logged in
        //if(isset($_SESSION["Username"]))
        //{
            //$Username = $_SESSION["Username"];

            // Check if a specific user removal request is made
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["remove_user"])) 
            {
                $userIdToRemove = $_POST["remove_user"];

                // Remove the user with the specified ID
                $deleteSql = "DELETE FROM user_account WHERE user_name = ?";
                $stmt = $conn->prepare($deleteSql);
                $stmt->bind_param("s", $userIdToRemove);
                $stmt->execute();
                $stmt->close();

                // Redirect to this page after removing to avoid browser re-submitting the form
                header("Location: ".$_SERVER['PHP_SELF']);
                exit();
            }
            

            // sql query to fetch data from the database
            $sql = "SELECT * FROM user_account";

            $result = $conn->query($sql);

            // Check if User table exist
            if($result->num_rows > 0)
            {
                echo "<table border='1'>
                        <tr>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Action</th>
                        </tr>";

                //Output the data in row
                while($row = $result->fetch_assoc())
                {
                    echo "<tr>
                            <td>" . $row["user_name"] . "</td>
                            <td>" . $row["email"] . "</td>
                            <td>" . $row["password"] . "</td>
                            <td>
                                <form method='post'>
                                <input type='hidden' name='remove_user' value='" . $row["user_name"] . "'>
                                <input type='submit' value='Remove'>
                                </form>
                            </td>
                        </tr>";
                }

                echo "</table>";
            }
            else
            {
                echo "No Users Found😭";
            }

            $conn->close();
            
        }

        /*
        if(!isset($_SESSION["Username"]))
        {
            header("Location:  ");  // Here is the problem
            exit();
        }
        
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
</head>

<body>
    <h1>Users</h1>

    <?php
    // Call the function to display Users in a table
    DisplayUsers();
    
    ?>
</body>