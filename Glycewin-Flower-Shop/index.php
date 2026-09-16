<?php

include("php/config.php");


$featured_sql = "SELECT * FROM products 
WHERE status='Available'
ORDER BY product_id DESC
LIMIT 3";


$featured_result = mysqli_query($conn,$featured_sql);


?>


<!DOCTYPE html>

<html lang="en">


<head>


<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">


<title>
Glycewin Handmade Flower Shop
</title>


<link rel="preconnect" href="https://fonts.googleapis.com">

<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>


<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">


<link rel="stylesheet" href="css/layout.css">

<link rel="stylesheet" href="css/style.css">


</head>



<body>



<header class="header">


<div class="container">


<nav class="navbar">



<a href="index.php" class="logo">


<img src="images/logo.png" alt="Logo">


<span>
GLYCEWIN HANDMADE FLOWER SHOP
</span>


</a>




<ul class="nav-links">


<li>
<a href="index.php" class="active">
Home
</a>
</li>


<li>
<a href="products.php">
Flowers
</a>
</li>


<li>
<a href="custom-order.php">
Custom
</a>
</li>


<li>
<a href="bulk-order.php">
Bulk
</a>
</li>


<li>
<a href="tracking.php">
Track
</a>
</li>


</ul>




<div class="menu-toggle">


<span></span>

<span></span>

<span></span>


</div>


</nav>


</div>


</header>






<section class="hero">


<div class="container">


<div class="hero-wrapper">


<div class="hero-logo">


<img src="images/logo.png" alt="Glycewin Logo">


</div>



<p class="welcome">

WELCOME TO

</p>



<h1>

GLYCEWIN

</h1>



<h3>

Handmade Flower Boutique

</h3>



<p class="hero-description">

Flowers crafted with elegance,
made for every unforgettable moment.

Fresh.
Handmade.
Beautiful.

</p>




<div class="hero-buttons">


<a href="products.php"

class="btn btn-primary">

Shop Flowers

</a>



<a href="custom-order.php"

class="btn btn-outline">

Customize Bouquet

</a>



</div>





<div class="hero-preview">



<?php


mysqli_data_seek($featured_result,0);


while($preview=mysqli_fetch_assoc($featured_result)){


?>


<div class="preview-card">


<img 

src="images/products/<?php echo htmlspecialchars($preview['image']); ?>">



<h4>

<?php echo htmlspecialchars($preview['product_name']); ?>

</h4>


</div>



<?php

}

?>


</div>






<div class="scroll-indicator">


<span></span>


<p>
Explore Collection
</p>


</div>




</div>


</div>


</section>








<section class="featured">


<div class="container">


<div class="section-heading">


<p>
OUR COLLECTION
</p>


<h2>
Featured Bouquets
</h2>


</div>




<div class="featured-grid">



<?php


mysqli_data_seek($featured_result,0);



while($product=mysqli_fetch_assoc($featured_result)){


?>



<div class="featured-card">



<div class="featured-image">


<img

src="images/products/<?php echo htmlspecialchars($product['image']); ?>"


alt="<?php echo htmlspecialchars($product['product_name']); ?>">


</div>





<div class="featured-content">



<span class="tag">

Featured

</span>




<h3>

<?php echo htmlspecialchars($product['product_name']); ?>

</h3>




<p>

<?php echo htmlspecialchars($product['description']); ?>

</p>




<div class="price">

₱<?php echo number_format($product['price'],2); ?>

</div>





<a href="product-details.php?id=<?php echo $product['product_id']; ?>"

class="btn btn-primary">


View Details


</a>



</div>



</div>




<?php

}

?>



</div>


</div>


</section>

<!-- =====================================
FLOWER CATEGORIES
===================================== -->

<section class="categories">

<div class="container">


<div class="section-heading">

<p>
SHOP BY OCCASION
</p>


<h2>
Find Flowers For Every Moment
</h2>


</div>



<div class="category-grid">



<div class="category-card">

<div class="category-icon">
🎂
</div>

<h3>
Birthday
</h3>

<p>
Celebrate another beautiful year.
</p>

</div>




<div class="category-card">

<div class="category-icon">
❤️
</div>

<h3>
Anniversary
</h3>

<p>
Express your everlasting love.
</p>

</div>





<div class="category-card">

<div class="category-icon">
🎓
</div>

<h3>
Graduation
</h3>

<p>
Celebrate milestones with flowers.
</p>

</div>





<div class="category-card">

<div class="category-icon">
💐
</div>

<h3>
Wedding
</h3>

<p>
Elegant flowers for your special day.
</p>

</div>





<div class="category-card">

<div class="category-icon">
👶
</div>

<h3>
Baby Shower
</h3>

<p>
Welcome a new bundle of joy.
</p>

</div>





<div class="category-card">

<div class="category-icon">
🙏
</div>

<h3>
Sympathy
</h3>

<p>
Offer comfort through beautiful flowers.
</p>

</div>



</div>


</div>

</section>







<!-- =====================================
ABOUT PREVIEW
===================================== -->


<section class="about-preview">


<div class="container">


<div class="about-grid">



<div class="about-image">


<img src="images/gless.png" alt="Flower Shop">


</div>





<div class="about-content">


<p class="mini-title">

ABOUT GLYCEWIN

</p>




<h2>

Every Bouquet Tells A Story

</h2>




<p>

At Glycewin Handmade Flower Shop,
every arrangement is carefully handcrafted
using fresh flowers and artistic creativity.

We believe flowers are more than gifts—
they are heartfelt messages that create
lasting memories.

</p>




<a href="about.html"

class="btn btn-primary">

Learn More

</a>



</div>



</div>


</div>


</section>








<!-- =====================================
CUSTOM ORDER CTA
===================================== -->


<section class="custom-cta">


<div class="container">



<div class="custom-box">





<div class="custom-text">


<p class="mini-title">

CUSTOM FLOWERS

</p>




<h2>

Design Your Dream Bouquet

</h2>




<p>

Create a bouquet that's uniquely yours.
Choose your favorite flowers, wrapping,
colors, and message, and let our florists
handcraft something unforgettable.

</p>




<a href="custom-order.php"

class="btn btn-primary">

Start Custom Order

</a>



</div>





<div class="custom-image">


<img src="images/products/custom.jpg"

alt="Custom Bouquet">


</div>



</div>


</div>


</section>









<!-- =====================================
TESTIMONIALS
===================================== -->


<section class="testimonials">


<div class="container">


<div class="section-heading">


<p>

CUSTOMER REVIEWS

</p>



<h2>

Loved By Our Customers

</h2>



</div>





<div class="testimonial-grid">





<div class="testimonial-card">


<div class="stars">

★★★★★

</div>


<p>

"The bouquet was absolutely beautiful.
Fresh flowers and excellent service!"

</p>



<h4>

— Maria Santos

</h4>


</div>






<div class="testimonial-card">


<div class="stars">

★★★★★

</div>


<p>

"I ordered for my girlfriend's birthday.
She cried because the flowers were so beautiful."

</p>



<h4>

— John Reyes

</h4>


</div>






<div class="testimonial-card">


<div class="stars">

★★★★★

</div>


<p>

"Highly recommended.
Very accommodating and fast delivery."

</p>



<h4>

— Princess Anne

</h4>


</div>



</div>



</div>


</section>









<!-- =====================================
FLOWER GALLERY
===================================== -->


<section class="gallery">


<div class="container">



<div class="section-heading">


<p>

OUR GALLERY

</p>



<h2>

Fresh Flowers Everyday

</h2>



</div>





<div class="gallery-grid">


<img src="images/gallery/gallery1.jpg">


<img src="images/gallery/gallery2.jpg">


<img src="images/gallery/gallery3.jpg">


<img src="images/gallery/gallery4.jpg">


<img src="images/gallery/gallery5.jpg">


<img src="images/gallery/gallery6.jpg">



</div>



</div>


</section>









<!-- =====================================
FOOTER
===================================== -->


<footer>


<div class="container">


<div class="footer-grid">





<div>


<img src="images/logo.png"

class="footer-logo">



<p>

Creating handcrafted bouquets with love,
care, and creativity for every celebration.

</p>


</div>







<div>


<h3>

Quick Links

</h3>


<a href="index.php">
Home
</a>


<a href="products.php">
Flowers
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



</div>







<div>


<h3>

Customer Service

</h3>



<p>

📞 0912-345-6789

</p>



<p>

📧 glessbercilla@gmail.com

</p>



<p>

📍 Cavite, General Trias City

</p>



</div>








<div>


<h3>

Business Hours

</h3>



<p>

Monday - Saturday

</p>


<p>

8:00 AM - 6:00 PM

</p>



<p>

Sunday

<br>

By Appointment

</p>



</div>






</div>





<div class="footer-bottom">


<p>

© 2026 Glycewin Handmade Flower Shop

All Rights Reserved.

</p>


</div>



</div>


</footer>







<!-- =====================================
BACK TO TOP
===================================== -->


<button class="back-top">

↑

</button>





<script src="js/main.js"></script>



</body>

</html>