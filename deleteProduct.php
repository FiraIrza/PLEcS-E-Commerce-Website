<?php
include 'DatabaseConnection.php';
$conn = connectToDatabase();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_product'])) {
    $product_id = $_POST['delete_product'];
    $delete_sql = "DELETE FROM plecs_cart WHERE product_id = '$product_id'";
    $result = $conn->query($delete_sql);

    header('Location: cart.php');
    exit();
}
?>
