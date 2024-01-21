<?php
// Start the session
session_start();

include 'DatabaseConnection.php';


// Function to handle user login
function login($username, $password) 
{
    $conn = connectToDatabase();

    // SQL query to check the username and retrieve hashed password
    $sql = "SELECT * FROM user_account WHERE user_name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a matching user is found
    if ($result->num_rows > 0) 
    {
        $row = $result->fetch_assoc();
        $dbHashedPassword = $row["password"];

        // Verify the entered password with the hashed password from the database
        if (password_verify($password, $dbHashedPassword)) 
        {
            $_SESSION["username"] = $username;
            header("Location: index.php");
            exit;
        } 
        else 
        {
            echo "Invalid Password";
        }
    } 
    else 
    {
        echo "Invalid Username";
    }

    $stmt->close();

    // SQL query to check the username and retrieve hashed password
    $sql = "SELECT * FROM admin_account WHERE admin_username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a matching user is found
    if ($result->num_rows > 0) 
    {
        $row = $result->fetch_assoc();
        $dbHashedPassword = $row["password"];

        // Verify the entered password with the hashed password from the database
        if (password_verify($password, $dbHashedPassword)) 
        {
            $_SESSION["username"] = $username;
            header("Location: Dashboard.php");
            exit;
        } 
        else 
        {
            echo "Invalid Password";
        }
    } 
    else 
    {
        echo "Invalid Username";
    }

    $stmt->close();
    $conn->close();
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Call the login function
    login($username, $password);
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="./css/login.css">
    <title>Puff Lab</title>
</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-up">
            
            <form action="login.php" method = "POST">
            <h1>LOGIN</h1>
                <label for="username"><b>Username</b></label>
                <input type="text" placeholder="Username" name="username" required>

                <label for="password"><b>Password</b></label>
                <input type="password" placeholder="Password" name="password" required>
                
                <button type = "submit">Login</button>

                <p class="register"> What don't have an account yet? <a href="signup.php">Register for free</a></p>
            </form>

            <img src="img/signup.jpg" alt="Signup Image">
        </div>
    </div>

</body>

</html>