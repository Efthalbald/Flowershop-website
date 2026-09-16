<?php

include("php/config.php");


if(!isset($_GET['product_id'])){

    header("Location: products.php");
    exit();

}


$product_id = $_GET['product_id'];



$sql = "SELECT * FROM products WHERE product_id=?";


$stmt = mysqli_prepare($conn, $sql);


mysqli_stmt_bind_param($stmt, "i", $product_id);


mysqli_stmt_execute($stmt);


$result = mysqli_stmt_get_result($stmt);


$product = mysqli_fetch_assoc($result);



if(!$product){

    echo "Product not found.";
    exit();

}


?>


<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">


<title>
Place Order | Glycewin Handmade Flower Shop
</title>


<link rel="stylesheet" href="css/order.css">


<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">


</head>


<body>



<header>


<div class="logo">


<a href="index.html">

<img src="images/logo.png" alt="Glycewin Logo">

</a>


<span>
GLYCEWIN
</span>


</div>



<nav>


<a href="index.php">
Home
</a>


<a href="products.php">
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





<section class="hero">


<div class="hero-content">


<h1>
PLACE YOUR ORDER
</h1>


<p>

Complete your details and let us prepare your handcrafted bouquet.

</p>


</div>


</section>






<section class="order-container">



<div class="order-layout">





<div class="form-card">


<h2>
Customer Information
</h2>



<div class="input-group">


<label>
Full Name
</label>


<input 
type="text"
name="customer_name"
placeholder="Enter your full name">


</div>





<div class="input-group">


<label>
Email Address
</label>


<input 
type="email"
name="email"
placeholder="Enter your email">


</div>





<div class="input-group">


<label>
Contact Number
</label>


<input 
type="text"
name="contact"
placeholder="09XX XXX XXXX">


</div>





<div class="input-group">


<label>
Complete Address
</label>


<textarea
name="address"
placeholder="Enter your delivery address"></textarea>


</div>



</div>








<div class="summary-card">


<h2>
Order Summary
</h2>





<div class="product-summary">



<img 

src="images/products/<?php echo htmlspecialchars($product['image']); ?>"

alt="<?php echo htmlspecialchars($product['product_name']); ?>">





<div>


<h3>

<?php echo htmlspecialchars($product['product_name']); ?>

</h3>


<p>

<?php echo htmlspecialchars($product['description']); ?>

</p>



<span>

₱<?php echo number_format($product['price'],2); ?>

</span>


</div>



</div>







<div class="summary-line">


<p>
Quantity
</p>


<input 

type="number"

name="quantity"

value="1"

min="1">


</div>






<div class="summary-line">


<p>
Subtotal
</p>


<strong>

₱<?php echo number_format($product['price'],2); ?>

</strong>


</div>






<div class="summary-total">


<p>
Total
</p>


<strong>

₱<?php echo number_format($product['price'],2); ?>

</strong>


</div>



</div>




</div>



</section>







<section class="delivery-section">


<div class="delivery-card">



<h2>
Delivery Details
</h2>





<div class="input-group">


<label>
Recipient Name
</label>


<input

type="text"

name="recipient"

placeholder="Who will receive the flowers?">


</div>






<div class="delivery-row">


<div class="input-group">


<label>
Delivery Date
</label>


<input

type="date"

name="delivery_date">


</div>






<div class="input-group">


<label>
Delivery Time
</label>


<select name="delivery_time">


<option>
Select Time
</option>


<option>
Morning (8AM - 12PM)
</option>


<option>
Afternoon (1PM - 5PM)
</option>


<option>
Evening (5PM - 8PM)
</option>


</select>


</div>



</div>






<div class="input-group">


<label>
Special Message
</label>


<textarea

name="message"

placeholder="Example: Happy Birthday! I love you ❤️">

</textarea>


</div>





</div>


</section>







<section class="payment-section">


<div class="payment-card">



<h2>
Payment Method
</h2>





<div class="payment-options">





<label class="payment-option">


<input 

type="radio"

name="payment"

value="Cash on Delivery">


<span>

Cash on Delivery

</span>


</label>






<label class="payment-option">


<input 

type="radio"

name="payment"

value="GCash">


<span>

GCash

</span>


</label>







<label class="payment-option">


<input 

type="radio"

name="payment"

value="Bank Transfer">


<span>

Bank Transfer

</span>


</label>





</div>



</div>



</section>







<section class="confirm-section">


<a 

href="tracking.html"

class="place-order">

🌸 Place Order

</a>



</section>







<footer>


<p>

© 2026 Glycewin Handmade Flower Shop

</p>


</footer>



</body>

</html>