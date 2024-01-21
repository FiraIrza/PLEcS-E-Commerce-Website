<?php
// Assuming you have a function to fetch products from the database
function getdrinksProducts() {
    global $conn; // Assuming $conn is your database connection

    // Modify the SQL query based on your criteria
    $sql = "SELECT * FROM plecs_product WHERE product_cat = 'Cold Beverages'";

    $result = $conn->query($sql);
    $products = [];

    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }

    return $products;
}
?>