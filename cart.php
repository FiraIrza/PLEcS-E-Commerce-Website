<?php
include 'DatabaseConnection.php';
include 'header.php';

$conn = connectToDatabase();

$sourcePage = 'allproduct';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $user_name = 'user_name';

    // Retrieve the source page value
    if (isset($_POST['source_page'])) {
        $sourcePage = $_POST['source_page'];
    }

    $sql = "INSERT INTO plecs_cart (product_id, quantity, user_name) VALUES ('$product_id', 1, '$user_name')";
    $result = $conn->query($sql);
    header("Location: $sourcePage.php?product_id=$product_id");
    exit();
}


$sql = "SELECT * FROM plecs_cart";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = [
            'cart_id' => $row['cart_id'],
            'quantity' => $row['quantity'],
            'user_name' => $row['user_name'],
            'product_id' => $row['product_id']
        ];
    }
}

$total = 0;

if (!empty($products)) {
    $total = array_reduce($products, function ($carry, $product) use ($conn) {
        $productSql = "SELECT * FROM plecs_product WHERE product_id = " . $product['product_id'];
        $productResult = $conn->query($productSql);

        if ($productResult->num_rows > 0) {
            $productData = $productResult->fetch_assoc();
            $carry += $productData['price'] * $product['quantity'];
        }

        return $carry;
    }, 0);

    //$grandTotal = $total;
}
//$grandTotal1 = $grandTotal;


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="./css/cart.css">
    <script>
        function updateQuantity(cartId, productId) {
    var quantity = document.getElementById('quantity_' + cartId).value;
    var price = parseFloat(document.getElementById('price_' + cartId).innerText.replace('RM', ''));
    var subtotalElement = document.getElementById('subtotal_' + cartId);
    var totalElement = document.getElementById('total');

    // Get the previous subtotal
    var previousSubtotal = parseFloat(subtotalElement.innerText.replace('RM', ''));

    // Update subtotal
    var subtotal = quantity * price;
    subtotalElement.innerText = 'RM' + subtotal.toFixed(2);

    // Update total by subtracting the previous subtotal and adding the new subtotal
    var total = parseFloat(totalElement.innerText.replace('RM', '')) - previousSubtotal + subtotal;
    totalElement.innerText = 'RM' + total.toFixed(2);

}
    </script>
</head>

<body>
    <section id="first">
        <h2>Your Cart</h2>
    </section>

    <section id="table">
        <form method='POST' action='deleteProduct.php'>
            <table>
                <tr>
                    <th><pre>                  Item                  </pre></th>
                    <th><pre>            Price            </pre></th>
                    <th><pre>          Quantity          </pre></th>
                    <th><pre>        Subtotal        </pre></th>
                    <th><pre>     Action     </pre></th>
                </tr>

                <?php
                if (!empty($products)) {
                    foreach ($products as $product) {
                        $productDetailsSql = "SELECT * FROM plecs_product WHERE product_id = " . $product['product_id'];
                        $productDetailsResult = $conn->query($productDetailsSql);

                        if ($productDetailsResult->num_rows > 0) {
                            $productDetails = $productDetailsResult->fetch_assoc();

                            echo "<tr>
                                    <td>
                                        <div class='info'>
                                            <img src='" . $productDetails['product_img'] . "'>
                                            <div>
                                                <p>" . $productDetails['product_cat'] . "</p>
                                                <small>" . $productDetails['product_name'] . "</small><br><br>
                                            </div>
                                        </div>
                                    </td>
                                    <td id='price_" . $product['cart_id'] . "'>RM" . number_format($productDetails['price'], 2) . "</td>
                                    <td>
                                        <input type='number' id='quantity_" . $product['cart_id'] . "' value='" . $product['quantity'] . "' onchange='updateQuantity(" . $product['cart_id'] . ", " . $product['product_id'] . ")'>
                                    </td>
                                    <td id='subtotal_" . $product['cart_id'] . "'>RM" . number_format($productDetails['price'] * $product['quantity'], 2) . "</td>
                                    <td>
                                        <button type='submit' name='delete_product' value='" . $product['product_id'] . "'>
                                            <i class='fas fa-trash'></i> Delete
                                        </button>
                                    </td>
                                </tr>";
                        }
                    }
                }
                $conn->close();
                ?>
            </table>
        </form>

        <div class="total">
            <table>
                <tr>
                    <td>Total</td>
                    <td id='total'>RM<?= number_format($total, 2) ?></td>
                </tr>
            </table>
        </div>

        <div class="checkout">
            <a href="payment.php"><button>Checkout</button></a>
        </div>
    </section>
</body>

</html>

<?php include 'footer.php'; ?>