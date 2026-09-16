<?php

session_start();

if(!isset($_SESSION['admin_id'])){

    header("Location: login.php");

    exit();

}

?>
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>

Dashboard | Glycewin Admin

</title>

<link rel="stylesheet"
href="../admin-css/admin.css">

<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;700&family=Poppins:wght@300;400;500;600&display=swap"
rel="stylesheet">

</head>

<body>

<div class="admin-layout">

<!-- ================= SIDEBAR ================= -->

<aside class="sidebar">

<div class="sidebar-logo">

<img src="../images/logo.png">

<h2>

GLYCEWIN

</h2>

<p>

Admin Panel

</p>

</div>

<ul class="sidebar-menu">

<li class="active">

<a href="dashboard.php">

🏠 Dashboard

</a>

</li>

<li>

<a href="products.php">

🌸 Products

</a>

</li>

<li>

<a href="orders.php">

🛒 Orders

</a>

</li>

<li>

<a href="customers.php">

👥 Customers

</a>

</li>

<li>

<a href="custom-orders.php">

🎨 Custom Orders

</a>

</li>

<li>

<a href="bulk-orders.php">

🏢 Bulk Orders

</a>

</li>

<li>

<a href="reports.php">

📊 Reports

</a>

</li>

<li>

<a href="logout.php" class="btn">

Logout

</a>

</li>

</ul>

</aside>

<!-- ================= MAIN ================= -->

<main class="main-content">

<header class="topbar">

<div>

<h1>

Dashboard

</h1>

<p>
<p>

Role:

<strong>

<?php echo $_SESSION['role']; ?>

</strong>

</p>
<strong>
Welcome,

<?php echo $_SESSION['full_name']; ?>
</strong>

</p>

</div>

<div class="admin-profile">

<img
src="../images/logo.png">

</div>

</header>

<!-- ================= CARDS ================= -->

<section class="dashboard-cards">

<div class="card">

<h3>

🌸 Products

</h3>

<h2>

18

</h2>

<p>

Available Bouquets

</p>

</div>

<div class="card">

<h3>

🛒 Orders

</h3>

<h2>

52

</h2>

<p>

Customer Orders

</p>

</div>

<div class="card">

<h3>

🎨 Custom

</h3>

<h2>

10

</h2>

<p>

Pending Requests

</p>

</div>

<div class="card">

<h3>

🏢 Bulk

</h3>

<h2>

7

</h2>

<p>

Business Orders

</p>

</div>

</section>

<!-- ================= RECENT ORDERS ================= -->

<section class="table-card">

<div class="table-header">

<h2>

Recent Orders

</h2>

</div>

<table>

<thead>

<tr>

<th>Order ID</th>

<th>Customer</th>

<th>Product</th>

<th>Status</th>

<th>Total</th>

</tr>

</thead>

<tbody>

<tr>

<td>#1001</td>

<td>Maria Santos</td>

<td>Rose Bouquet</td>

<td>

<span class="pending">

Pending

</span>

</td>

<td>

₱850

</td>

</tr>

<tr>

<td>#1002</td>

<td>John Reyes</td>

<td>Tulip Bouquet</td>

<td>

<span class="preparing">

Preparing

</span>

</td>

<td>

₱950

</td>

</tr>

<tr>

<td>#1003</td>

<td>Princess Anne</td>

<td>Sunflower Bouquet</td>

<td>

<span class="completed">

Completed

</span>

</td>

<td>

₱750

</td>

</tr>

</tbody>

</table>

</section>

</main>

</div>

</body>

</html>