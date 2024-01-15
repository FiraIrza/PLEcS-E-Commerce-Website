<?php

    //Function to connect to the database
    Function connectToDatabase()
    {
        $host = "localhost";
        $Username = "root";
        $Password = "";
        $dbname = "plecsdb";


        $conn = new mysqli($host, $Username, $Password, $dbname);

        // Check the connection
        if($conn->connect_error)
        {
            die("Connection Failed: ". $conn->connect_eror);
        }

        return $conn;
    }

?>