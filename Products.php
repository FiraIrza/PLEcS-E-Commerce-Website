<?php 

    session_start();
    
    include 'sidebar.php';
    include 'DatabaseConnection.php';
    include 'addproduct.php';
    include 'getproduct.php';
    include 'removeproduct.php';

    $conn = connectToDatabase();

    // Fetch products from the database
    $products = getProducts();
    
    // Check if the form was submitted
    if($_SERVER["REQUEST_METHOD"] == "POST")  
    {
        // Check which button was pressed
        if (isset($_POST['addproduct'])) 
        {
            // Add product
            addProduct($_POST['product_cat'], $_POST['product_name'], $_POST['price'], $_FILES['product_img']);

            // Redirect to page asal
            header("Location: Products.php");
            exit(); // Ensure that no further code is executed after the redirect
        
        }
        elseif (isset($_POST['removeproduct'])) 
        {
            // Remove product
            removeProduct($_POST['product_id']);
            // Redirect to page asal
            header("Location: Products.php");
            exit(); // Ensure that no further code is executed after the redirect
        }

    }

    // Close the database connection
    $conn->close();


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Puff Lab All Products</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="allProduct.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<body>

</br></br></br></br></br>
<section id="title">
        <div class="allproducts">
            <h3>PRODUCTS</h3>
        </div>
    </section>

    <section id="products">
        <div class="product">

            <!-- Add Product Form -->
            <form action="Products.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="addproduct" value="1">
                <label for="product_cat">Category: </label>
                <input type="text" name="product_cat" required><br>

                <label for="product_name">Product Name: </label>
                <input type="text" name="product_name" required><br>

                <label for="price">Price: </label>
                <input type="number" name="price" step="0.01" required><br>

                <label for="product_img">Image Upload: </label>
                <input type="file" name="product_img" accept="image/*" required><br>

                <button type="submit">Add Product</button>
            </form>
        </div>
    </section>

<!-- Product Display -->
<section id="products">
    <div class="row"> <!-- Start the first row -->
        <?php $counter = 0; ?>
        <?php foreach ($products as $product): ?>
            <div class="product">
                <img src="<?php echo $product['product_img']; ?>" alt="<?php echo $product['product_name']; ?>">
                <div class="details">
                    <h2><?php echo $product['product_cat']; ?></h2>
                    <p><?php echo $product['product_name']; ?>&emsp;&emsp;&emsp;&emsp;&nbsp;RM<?php echo $product['price']; ?></p>
                    <form action="Products.php" method="POST">
                        <input type="hidden" name="removeproduct" value="1">
                        <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                        <button type="submit">Remove</button>
                    </form>

                    <!-- Trigger button to edit product -->
                    <button onclick="editProduct(
                         <?php echo $product['product_id']; ?>,
                        '<?php echo $product['product_cat']; ?>',
                        '<?php echo $product['product_name']; ?>',
                         <?php echo $product['price']; ?>,
                        '<?php echo $product['product_img']; ?>'
                    )">
                        Edit Product
                    </button>

                    <!-- Modal for editing product -->
                    <div id="editModal<?php echo $product['product_id']; ?>" class="modal">
                        <h2>Edit Product</h2>
                        <form id="editForm" action="editproduct.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" id="product_id" name="product_id">

                            <label for="product_cat">Category:</label>
                            <input type="text" id="product_cat" name="product_cat">

                            <label for="product_name">Product Name:</label>
                            <input type="text" id="product_name" name="product_name">

                            <label for="price">Price:</label>
                            <input type="number" id="price" name="price" step="0.01">

                            <label for="product_img">Product Image:</label>
                            <input type="file" id="product_img" name="product_img">

                            
                            <button type="submit" onclick="saveChanges()">Save Changes</button>
                            <button type="button" onclick="closeModal(<?php echo $product['product_id']; ?>)">Close</button>
                        </form>
                    </div>
                </div>
            </div>

            <?php $counter++; ?>
            <?php if ($counter % 3 === 0): ?>
                </div><div class="row"> <!-- Close the current row and open a new row after every three products -->
            <?php endif; ?>
        <?php endforeach; ?>
    </div> <!-- Close the last row -->
</section>

<script>
    function editProduct(product_id, product_cat, product_name, price, product_img) {
    // Populate the editing form with the product details
    document.getElementById('product_cat').value = product_cat;
    document.getElementById('product_name').value = product_name;
    document.getElementById('price').value = price;
    document.getElementById('product_id').value = product_id;

    // Close any open modals
    closeModal();

    // Display the modal
    var modalId = 'editModal' + product_id;

// Close any previously open modals
var allModals = document.querySelectorAll('.edit-modal');
allModals.forEach(function (modal) {
    modal.style.display = 'none';
});

document.getElementById(modalId).style.display = 'block';
}


function saveChanges() {
    // Get the values from the form
    var productCat = document.getElementById('product_cat').value;
    var productName = document.getElementById('product_name').value;
    var productPrice = document.getElementById('price').value;
    var productImg = document.getElementById('product_img').files[0];
    var productId = document.getElementById('product_id').value;
    
    // Create FormData object to send form data
    var formData = new FormData();
    formData.append('product_cat', productCat);
    formData.append('product_name', productName);
    formData.append('price', productPrice);
    formData.append('product_id', productId); // Add product ID to the form data
    if (productImg) {
        formData.append('product_img', productImg);
    }
    // AJAX request
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'editproduct.php', true);

    // Handle the response from the server
    xhr.onload = function () {
        if (xhr.status >= 200 && xhr.status < 300) {
            // Successful response, handle as needed
            alert("Product updated successfully");
        } else {
            // Error response from the server
            alert("Error updating product: " + xhr.responseText);
        }

        closeModal();
    };

    // Send the form data to the server
    xhr.send(formData);

}


function closeModal() {
    // Close any open modal
    var modals = document.querySelectorAll('.modal');
    modals.forEach(function (modal) {
        modal.style.display = 'none';
    });
}

</script>

</body>