<?php

include("php/config.php");

$sql = "SELECT * FROM products
WHERE status='Available'
ORDER BY product_id DESC";

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Shop Flowers | Glycewin Handmade Flower Shop</title>

<link rel="stylesheet" href="css/catalog.css">

<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

</head>

<body>

<header>

<div class="logo">

<a href="index.php">

<img src="images/logo.png" alt="Logo">

</a>

<span>GLYCEWIN</span>

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

<!-- ================= HERO ================= -->

<section class="hero">

<div class="hero-overlay">

<h1>

SHOP FLOWERS

</h1>

<p>

Browse our handmade flower arrangements crafted with love and creativity.

</p>

<div class="search-box">

<input
type="text"
placeholder="Search handmade flowers...">

<button>

Search

</button>

</div>

</div>

</section>

<!-- ================= CATALOG ================= -->

<section class="catalog-container">

<div class="sidebar">

<h2>

Categories

</h2>

<ul>

<li class="selected">🌸 All Flowers</li>

<li>🌹 Roses</li>

<li>🌻 Sunflowers</li>

<li>🌷 Tulips</li>

<li>💐 Bouquets</li>

<li>🎓 Graduation</li>

<li>🎂 Birthday</li>

<li>💍 Wedding</li>

<li>❤️ Anniversary</li>

</ul>

</div>

<div class="catalog-content">

<div class="catalog-header">

<h2>

Flower Collection

</h2>

<p>

Showing Available Handmade Bouquets

</p>

</div>

<div class="products-scroll">

<div class="products">

<?php

if(mysqli_num_rows($result) > 0){

    while($row = mysqli_fetch_assoc($result)){

?>

<div class="card">

<img

src="images/products/<?php echo htmlspecialchars($row['image']); ?>"

alt="<?php echo htmlspecialchars($row['product_name']); ?>">

<div class="card-info">

<h3>

<?php echo htmlspecialchars($row['product_name']); ?>

</h3>

<p>

<?php echo htmlspecialchars($row['description']); ?>

</p>

<span class="price">

₱<?php echo number_format($row['price'],2); ?>

</span>

<div class="buttons">

<a href="product-details.php?id=<?php echo $row['product_id']; ?>">

View Details

</a>

<a href="order.php?product_id=<?php echo $row['product_id']; ?>">

Order

</a>

</div>

</div>

</div>

<?php

    }

}else{

?>

<div class="card">

<div class="card-info">

<h3>

No Products Available

</h3>

<p>

There are currently no available handmade flowers.

Please check back later.

</p>

</div>

</div>

<?php

}

?>

</div>

</div>

</div>

</section>

<footer>

<p>

© 2026 Glycewin Handmade Flower Shop

</p>

</footer>

</body>

</html>