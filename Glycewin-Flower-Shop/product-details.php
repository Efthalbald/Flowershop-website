<?php

include("php/config.php");

if(!isset($_GET['id'])){

    header("Location: products.php");
    exit();

}

$product_id = $_GET['id'];

$sql = "SELECT * FROM products WHERE product_id = ?";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "i", $product_id);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if(mysqli_num_rows($result) == 0){

    header("Location: products.php");
    exit();

}

$product = mysqli_fetch_assoc($result);

?>
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>

<?php echo htmlspecialchars($product['product_name']); ?>

| Glycewin Handmade Flower Shop

</title>

<link rel="stylesheet" href="css/product.css">

<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

</head>

<body>

<header>

<div class="logo">

<a href="index.php">

<img src="images/logo.png" alt="Logo">

</a>

<span>

GLYCEWIN

</span>

</div>

<nav>

<a href="index.php">

Home

</a>

<a href="products.php" class="active">

Shop Flowers

</a>

<a href="custom-order.php">

Custom Orders

</a>

<a href="bulk-order.php">

Bulk Orders

</a>

<a href="tracking.php">

Track Order

</a>

</nav>

<div class="menu-btn">

☰

</div>

</header>

<!-- HERO -->

<section class="hero">

<div class="hero-content">

<h1>

PRODUCT DETAILS

</h1>

<p>

Discover every handcrafted bouquet made with elegance and love.

</p>

</div>

</section>

<!-- PRODUCT -->

<section class="product-container">

<div class="product-card">

<div class="gallery">

<img

src="images/products/<?php echo htmlspecialchars($product['image']); ?>"

class="main-image"

alt="<?php echo htmlspecialchars($product['product_name']); ?>">

</div>

<div class="product-info">

<span class="badge">

Best Seller

</span>

<h2>

<?php echo htmlspecialchars($product['product_name']); ?>

</h2>

<div class="rating">

★★★★★ (5.0)

</div>

<div class="price">

₱<?php echo number_format($product['price'],2); ?>

</div>

<p>

<?php echo nl2br(htmlspecialchars($product['description'])); ?>

</p>

<div class="details">

<div>

<strong>

Category

</strong>

<p>

<?php echo htmlspecialchars($product['category']); ?>

</p>

</div>

<div>

<strong>

Price

</strong>

<p>

₱<?php echo number_format($product['price'],2); ?>

</p>

</div>

<div>

<strong>

Stock

</strong>

<p>

<?php echo $product['stock']; ?> Available

</p>

</div>

<div>

<strong>

Availability

</strong>

<p class="stock">

<?php echo htmlspecialchars($product['status']); ?>

</p>

</div>

</div>

<div class="quantity">

<label>

Quantity

</label>

<div class="counter">

<button type="button">-</button>

<input

type="text"

value="1"

readonly>

<button type="button">+</button>

</div>

</div>

<div class="actions">

<a href="order.php?product_id=<?php echo $product['product_id']; ?>">

Order Now

</a>

<a href="products.php">

Back to Catalog

</a>

</div>

</div>

</div>

</section>

<!-- DESCRIPTION -->

<section class="description">

<h2>

Product Description

</h2>

<p>

<?php echo nl2br(htmlspecialchars($product['description'])); ?>

</p>

<h3>

Category

</h3>

<ul>

<li>

<?php echo htmlspecialchars($product['category']); ?>

</li>

<li>

Handmade Premium Design

</li>

<li>

Perfect for Gift Giving

</li>

<li>

Carefully Crafted with Quality Materials

</li>

<li>

Elegant Wrapping Included

</li>

<li>

Made by Glycewin Handmade Flower Shop

</li>

</ul>

</section>

<!-- RELATED PRODUCTS -->

<section class="related">

<h2>

You May Also Like

</h2>

<div class="related-products">

<?php

$related_sql = "SELECT * FROM products
WHERE status='Available'
AND product_id != ?
ORDER BY RAND()
LIMIT 3";

$related_stmt = mysqli_prepare($conn, $related_sql);

mysqli_stmt_bind_param($related_stmt, "i", $product_id);

mysqli_stmt_execute($related_stmt);

$related_result = mysqli_stmt_get_result($related_stmt);

while($related = mysqli_fetch_assoc($related_result)){

?>

<div class="related-card">

<a href="product-details.php?id=<?php echo $related['product_id']; ?>">

<img

src="images/products/<?php echo htmlspecialchars($related['image']); ?>"

alt="<?php echo htmlspecialchars($related['product_name']); ?>">

</a>

<h3>

<?php echo htmlspecialchars($related['product_name']); ?>

</h3>

<span>

₱<?php echo number_format($related['price'],2); ?>

</span>

<br><br>

<a

href="product-details.php?id=<?php echo $related['product_id']; ?>"

class="btn">

View Details

</a>

</div>

<?php

}

?>

</div>

</section>

<footer>

© 2026 Glycewin Handmade Flower Shop

</footer>

</body>

</html>