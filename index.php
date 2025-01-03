<?php

include 'header.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Puff Lab Home</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="index.css">

</head>

<body>
    <section id="details">
        <div class="box">
            <h1>Crusted Cream Puff Kuching</h1>
            <p>One Bite is Never Enough...</p>
            <a href="allProduct.php"><button class="viewdetails">View Details</button></a>
        </div>
    </section>

    <section id="bestsellings">
        <div class="caption">
            <h2>Best Sellings</h2>
            <h2>Best Sellings</h2>
        </div>
        <div class="show">
            <a href="creamPuff.php"><button class="showall">Show All</button></a>
        </div>
    </section>

    <section id="products">
        <div class="product">
            <img class="chocolate" src="img/chocolate.jpg">
            <div class="details">
                <h3>Regular Cream Puff</h3>
                <p>Chocolate&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;RM3.00</p>
            </div>
            <div class="hotproduct">HOT</div>
        </div>

        <div class="product">
            <img class="vanilla" src="img/vanilla.jpg">
            <div class="details">
                <h3>Regular Cream Puff</h3>
                <p>Vanilla &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;RM3.00</p>
            </div>
        </div>

        <div class="product">
            <img class="strawberry" src="img/strawberry.jpg">
            <div class="details">
                <h3>Regular Cream Puff</h3>
                <p>Strawberry&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;RM3.00</p>
            </div>
        </div>

        <div class="product">
            <img class="matcha" src="img/matcha.jpg">
            <div class="details">
                <h3>Premium Cream Puff</h3>
                <p>Matcha&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;&nbsp;RM3.00</p>
            </div>
        </div>
    </section>

    <section id="loyalty">
        <div class="loyaltyp">
            <h1>Loyalty Program</h1>
            <a href="login.php"><button class="loyalty">Become A Member</button></a>
        </div>
    </section>
</body>

<?php include 'footer.php'; ?>
