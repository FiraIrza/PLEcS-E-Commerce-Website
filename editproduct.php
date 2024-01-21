<?php

include 'DatabaseConnection.php';

$conn = connectToDatabase();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the data from the POST request
    $productId = isset($_POST['product_id']) ? $_POST['product_id'] : '';
    $productCat = isset($_POST['product_cat']) ? $_POST['product_cat'] : '';
    $productName = isset($_POST['product_name']) ? $_POST['product_name'] : '';
    $productPrice = isset($_POST['price']) ? $_POST['price'] : '';

    // Handle image upload
    $productImg = handleImageUpload();

    // Update the product in the database
    $stmt = $conn->prepare("UPDATE plecs_product SET product_cat=?, product_name=?, price=?, product_img=? WHERE product_id=?");
    $stmt->bind_param("ssdsi", $productCat, $productName, $productPrice, $productImg, $productId);

    if ($stmt->execute()) {

        header("Location: Products.php");
        exit(); // Ensure that no further code is executed after the redirect

    } 
    else 
    {
        // Error updating product
        echo "Error updating product: " . $stmt->error;
    }

    $stmt->close();
}

// Function to handle image upload (you need to customize this based on your requirements)
function handleImageUpload()
{
    $targetDir = 'img/'; // Set your target directory for image uploads
    $targetFile = $targetDir . basename($_FILES["product_img"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["product_img"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($targetFile)) {
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["product_img"]["size"] > 500000) {
        $uploadOk = 0;
    }

    // Allow only certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        $uploadOk = 0;
    }

    // If $uploadOk is set to 0, there was an error uploading the file
    if ($uploadOk == 0) {
        // Handle the error or return a default image path
        return "default_image.jpg";
    } else {
        // If everything is ok, try to upload the file
        if (move_uploaded_file($_FILES["product_img"]["tmp_name"], $targetFile)) {
            return $targetFile; // Return the path to the uploaded image
        } else {
            // Handle the error or return a default image path
            return "default_image.jpg";
        }
    }
    
}
// Close the database connection
$conn->close();

?>


