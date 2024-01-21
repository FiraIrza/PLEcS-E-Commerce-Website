<?php
// Function to remove a product
    function removeProduct($id)
    {
        global $conn;

        $stmt = $conn->prepare("DELETE FROM plecs_product WHERE product_id=?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) 
        {
            echo '<script>alert("Product removed successfully");</script>';
        } 
        else 
        {
            echo '<script>alert("Error removing product: ' . $stmt->error . '");</script>';
        }

        $stmt->close();
    }
?>