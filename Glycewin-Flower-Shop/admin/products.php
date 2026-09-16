<?php

session_start();

if(!isset($_SESSION['admin_id'])){

    header("Location: login.php");
    exit();

}

include("../php/config.php");

$result = mysqli_query($conn, "SELECT * FROM products ORDER BY product_id DESC");

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Products | Glycewin Admin</title>

<link rel="stylesheet"
href="../admin-css/admin.css">

</head>

<body>

<div class="page-header">

<h1>

Product Management

</h1>

<a href="add-product.php" class="btn">

+ Add Product

</a>

</div>

<table class="admin-table">

<thead>

<tr>

<th>ID</th>

<th>Image</th>

<th>Name</th>

<th>Category</th>

<th>Price</th>

<th>Stock</th>

<th>Status</th>

<th>Action</th>

</tr>

</thead>

<tbody>

<?php

while($row = mysqli_fetch_assoc($result)){

?>

<tr>

<td>

<?php echo $row['product_id']; ?>

</td>

<td>

<img
src="../images/products/<?php echo $row['image']; ?>"
width="70">

</td>

<td>

<?php echo $row['product_name']; ?>

</td>

<td>

<?php echo $row['category']; ?>

</td>

<td>

₱<?php echo number_format($row['price'],2); ?>

</td>

<td>

<?php echo $row['stock']; ?>

</td>

<td>

<?php echo $row['status']; ?>

</td>

<td>

<a href="edit-product.php?id=<?php echo $row['product_id']; ?>">

Edit

</a>

|

<a
href="delete-product.php?id=<?php echo $row['product_id']; ?>"

onclick="return confirm('Delete this product?')">

Delete

</a>

</td>

</tr>

<?php

}

?>

</tbody>

</table>

</body>

</html>