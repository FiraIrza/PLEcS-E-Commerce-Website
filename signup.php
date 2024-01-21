<?php
session_start();

include "DatabaseConnection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $conn = connectToDatabase();

    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];

    // Make password store in hash
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    if($password == $confirmpassword)
    {
        //Sql query to store user info in user_account table in database.
        $sql = "INSERT INTO user_account (user_name, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $username, $email, $hashedPassword);
        $stmt->execute();

        if ($stmt->affected_rows > 0) 
        {
            // Insert was successful
            $_SESSION["username"] = $username;
            header("Location: index.php");
            exit;
        } 
        else 
        {
            // Insert failed
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }
    else
    {
        echo "The password is not the same. Please reenter!";
    }

    

    // Close the connection
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="./css/signup.css">
    <title>Puff Lab</title>
</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-up">
            <form action = "signup.php" method = "POST">
                <h1>SIGN UP</h1>

                <label for="username"><b>Username</b></label>
                <input type="text" placeholder="Username" name = "username" required>

                <label for="email"><b>Email</b></label>
                <input type="email" placeholder="Email" name="email" required>

                <label for="password"><b>Password</b></label>
                <input type="password" placeholder="Password" name="password" required>

                <label for="confirm"><b>Confirm Password</b></label>
                <input type="password" placeholder="Confirm Password" name="confirmpassword" required>

                <button type = "submit">Register</button>
                <p class="signup">Already have an account? <a href="login.php">Login</a></p>
            </form>

            <img src="img/signup.jpg" alt="Signup Image">
        </div>
    </div>

</body>

</html>


