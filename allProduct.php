<?php
include 'getproduct.php';
include 'DatabaseConnection.php';
include 'header.php';


$conn = connectToDatabase();

$products = getProducts();

$sourcePage = 'allproduct';

$conn -> close();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Puff Lab All Products</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="./css/allProduct.css">
</head>

<body>

<section id="title">
        <div class="allproducts">
            <h3>ALL PRODUCTS</h3>
        </div>
</section>


<section id="products">
    <div class="row"> <!-- Start the first row -->
        <?php $counter = 0; ?>
        <?php foreach ($products as $product): ?>
            <div class="product">
                <img src="<?php echo $product['product_img']; ?>" alt="<?php echo $product['product_name']; ?>">
                <div class="details">
                    <h2><?php echo $product['product_cat']; ?></h2>
                    <p><?php echo $product['product_name']; ?>&emsp;&emsp;&emsp;&emsp;&nbsp;RM<?php echo $product['price']; ?></p>
                    <form action="cart.php" method="post">  
                    <input type="hidden" name="update_cart" value='1'>
                    <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                    <input type="hidden" name="source_page" value="<?php echo $sourcePage; ?>">
                    <button type="submit" name="add_to_cart">Add to Cart</button>
                    </form>
                </div>
            </div>
            <?php $counter++; ?>
            <?php if ($counter % 3 === 0): ?>
                </div><div class="row"> <!-- Close the current row and open a new row after every three products -->
            <?php endif; ?>
        <?php endforeach; ?>
    </div> <!-- Close the last row -->
</section>

</body>

<?php include 'footer.php'; ?>