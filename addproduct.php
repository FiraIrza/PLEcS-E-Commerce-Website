<?php
// Function to add a new product
    function addProduct($cat, $name, $price, $img)
    {
        global $conn;

        // Validate and handle file upload
        $uploadDir = 'img/';

        // Create the directory if it doesn't exist
        if (!file_exists($uploadDir)) 
        {
            mkdir($uploadDir, 0777, true);
        }

        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif']; // Add more if needed

        $imgFileName = basename($img['name']);
        $imgFileExtension = strtolower(pathinfo($imgFileName, PATHINFO_EXTENSION));

        if (!in_array($imgFileExtension, $allowedExtensions)) {
            die("Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.");
        }
    
        $imgFilePath = $uploadDir . uniqid() . '.' . $imgFileExtension;
    
        if (!move_uploaded_file($img['tmp_name'], $imgFilePath)) 
        {
            die("Error uploading file.");
        }
    
        // Insert product data into the database
        $stmt = $conn->prepare("INSERT INTO plecs_product (product_cat, product_name, price, product_img) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssds", $cat, $name, $price, $imgFilePath);

        if ($stmt->execute()) 
        {
            echo '<script>alert("Product added successfully");</script>';
        } 
        else 
        {
            echo '<script>alert("Error adding product: ' . $stmt->error . '");</script>';
        }

        $stmt->close();
    }

?>