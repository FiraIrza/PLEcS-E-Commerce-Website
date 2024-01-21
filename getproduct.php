<?php
// Assuming you have a function to fetch products from the database
    function getProducts() {
        global $conn; // Assuming $conn is your database connection

        $result = $conn->query("SELECT * FROM plecs_product");
        $products = [];

        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }

        return $products;
    }
?>