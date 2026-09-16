<?php

include("php/config.php");

?>


<!DOCTYPE html>

<html lang="en">


<head>


<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">


<title>
Bulk Orders | Glycewin Handmade Flower Shop
</title>



<link rel="stylesheet" href="css/bulk-order.css">



<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">


</head>



<body>






<header class="header">


<div class="navbar">





<div class="logo">



<a href="index.php">


<img src="images/logo.png">


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




<a href="bulk-order.php" class="active">

Bulk Orders

</a>




<a href="tracking.html">

Track Order

</a>




</nav>






<div class="menu-btn">

☰

</div>





</div>


</header>









<section class="hero">


<div class="hero-box">


<p class="mini-title">

EVENT FLOWERS

</p>





<h1>

Bulk Flower Orders

</h1>





<p>

Create beautiful flower arrangements
for weddings, events, celebrations,
and corporate occasions.

</p>





<a href="#bulk-form" class="hero-btn">

Start Your Order

</a>




</div>


</section>









<section class="intro">


<div class="intro-card">



<h2>

Flowers For Every Big Moment

</h2>




<p>

Whether you need flowers for a wedding,
graduation ceremony, company event,
or special celebration, Glycewin creates
handcrafted arrangements designed
to impress.

</p>



</div>


</section>









<section class="bulk-section" id="bulk-form">


<div class="bulk-container">





<form action="" method="POST" enctype="multipart/form-data">







<div class="form-card">



<h2>

Customer Information

</h2>






<div class="form-grid">





<div class="input-group">


<label>

Full Name

</label>


<input 

type="text"

name="customer_name"

placeholder="Enter your name"

required>



</div>









<div class="input-group">


<label>

Email Address

</label>



<input 

type="email"

name="email"

placeholder="Enter your email"

required>


</div>









<div class="input-group">


<label>

Contact Number

</label>



<input 

type="text"

name="contact"

placeholder="09XX XXX XXXX"

required>


</div>









<div class="input-group">


<label>

Company / Organization

</label>



<input 

type="text"

name="company"

placeholder="Optional">


</div>





</div>



</div>









<!-- EVENT DETAILS -->


<div class="form-card">



<h2>

Event Details

</h2>







<div class="form-grid">






<div class="input-group">


<label>

Event Type

</label>





<select name="event_type">



<option>

Select Occasion

</option>



<option>

Wedding

</option>



<option>

Graduation

</option>



<option>

Corporate Event

</option>



<option>

Birthday Celebration

</option>



<option>

Funeral / Sympathy

</option>



<option>

Other

</option>



</select>



</div>








<div class="input-group">


<label>

Event Date

</label>




<input 

type="date"

name="event_date">



</div>







<div class="input-group">


<label>

Venue / Delivery Location

</label>



<input 

type="text"

name="location"

placeholder="Enter location">



</div>







<div class="input-group">


<label>

Number of Guests

</label>



<input 

type="number"

name="guests"

placeholder="Estimated guests">



</div>






</div>



</div>

<!-- =========================
FLOWER TYPE
========================= -->


<div class="form-card">


<h2>

Choose Flower Arrangement

</h2>




<p class="description">

Select the flowers you want included
in your bulk order.

</p>





<div class="option-grid">





<label class="option">


<input 

type="checkbox"

name="flowers[]"

value="Roses">



<span>

🌹

<br>

Roses

</span>


</label>







<label class="option">


<input 

type="checkbox"

name="flowers[]"

value="Tulips">



<span>

🌷

<br>

Tulips

</span>


</label>







<label class="option">


<input 

type="checkbox"

name="flowers[]"

value="Sunflowers">



<span>

🌻

<br>

Sunflowers

</span>


</label>







<label class="option">


<input 

type="checkbox"

name="flowers[]"

value="Mixed Bouquet">



<span>

💐

<br>

Mixed Bouquet

</span>


</label>





</div>


</div>









<!-- =========================
QUANTITY DETAILS
========================= -->


<div class="form-card">



<h2>

Order Quantity

</h2>






<div class="form-grid">





<div class="input-group">


<label>

Number of Bouquets

</label>



<input

type="number"

name="quantity"

placeholder="Example: 50">


</div>







<div class="input-group">


<label>

Arrangement Size

</label>



<select name="size">



<option>

Small

</option>



<option>

Medium

</option>



<option>

Large

</option>



<option>

Premium

</option>



</select>


</div>





</div>



</div>









<!-- =========================
BUDGET & NOTES
========================= -->


<div class="form-card">



<h2>

Budget & Additional Details

</h2>






<div class="form-grid">






<div class="input-group">


<label>

Estimated Budget

</label>



<select name="budget">



<option>

Select Budget Range

</option>



<option>

₱5,000 - ₱10,000

</option>



<option>

₱10,000 - ₱20,000

</option>



<option>

₱20,000 - ₱50,000

</option>



<option>

₱50,000+

</option>



</select>


</div>







<div class="input-group">


<label>

Preferred Delivery Time

</label>




<input

type="time"

name="delivery_time">


</div>






</div>








<h3>

Special Instructions

</h3>





<div class="input-group">


<textarea

name="notes"

rows="5"

placeholder="Tell us about your preferred design, colors, theme, or special requests..."></textarea>



</div>




</div>









<!-- =========================
REFERENCE IMAGE
========================= -->


<div class="form-card">


<h2>

Reference Design

</h2>





<p class="description">

Upload an inspiration photo so our team
can understand your preferred style.

</p>







<div class="upload-box">



<input

type="file"

name="reference_image"

accept="image/*">





<p>

Upload bouquet inspiration

</p>



</div>



</div>









<!-- =========================
SUMMARY
========================= -->


<div class="summary-card">



<h2>

Bulk Order Summary

</h2>







<div class="summary-row">


<span>

Customer

</span>



<strong>

Your Name

</strong>


</div>







<div class="summary-row">


<span>

Arrangement

</span>



<strong>

Selected Flowers

</strong>


</div>







<div class="summary-row">


<span>

Quantity

</span>



<strong>

0 Bouquets

</strong>


</div>







<div class="summary-row">


<span>

Estimated Budget

</span>



<strong>

₱0

</strong>


</div>








<div class="summary-row total">


<span>

Total Estimate

</span>



<strong>

₱0

</strong>


</div>





</div>









<!-- =========================
SUBMIT
========================= -->


<div class="submit-area">



<button 

type="submit"

class="place-order">


🌸 Submit Order Request


</button>




</div>







</form>





</div>


</section>









<!-- =========================
BENEFITS
========================= -->


<section class="benefits">



<div class="benefit-grid">






<div class="benefit-card">


<div class="benefit-icon">

🌹

</div>



<h3>

Handcrafted Quality

</h3>



<p>

Every arrangement is carefully created
with attention to detail.

</p>



</div>








<div class="benefit-card">


<div class="benefit-icon">

🚚

</div>



<h3>

Reliable Delivery

</h3>



<p>

Perfect for events and large celebrations.

</p>



</div>








<div class="benefit-card">


<div class="benefit-icon">

💗

</div>



<h3>

Personalized Service

</h3>



<p>

We help design flowers that match
your special occasion.

</p>



</div>





</div>



</section>









<!-- =========================
FOOTER
========================= -->


<footer>




<img 

src="images/logo.png"

class="footer-logo">





<p>

Glycewin Handmade Flower Shop

</p>








<div class="footer-links">





<a href="index.php">

Home

</a>





<a href="products.php">

Flowers

</a>





<a href="custom-order.php">

Custom Orders

</a>





<a href="tracking.html">

Track Order

</a>





</div>








<div class="footer-bottom">


© 2026 Glycewin Handmade Flower Shop


</div>





</footer>







<script src="js/main.js"></script>



</body>

</html>