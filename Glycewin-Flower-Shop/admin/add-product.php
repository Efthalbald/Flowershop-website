<?php

session_start();

if(!isset($_SESSION['admin_id'])){

    header("Location: login.php");
    exit();

}

include("../php/config.php");

if(isset($_POST['save'])){

    $product_name = trim($_POST['product_name']);
    $category = trim($_POST['category']);
    $description = trim($_POST['description']);
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $status = $_POST['status'];

    $image = $_FILES['image']['name'];

    $temp_name = $_FILES['image']['tmp_name'];

    $folder = "../images/products/" . $image;

    move_uploaded_file($temp_name, $folder);

    $sql = "INSERT INTO products
    (product_name, category, description, price, stock, image, status)
    VALUES
    (?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(

        $stmt,

        "sssdiss",

        $product_name,

        $category,

        $description,

        $price,

        $stock,

        $image,

        $status

    );

    mysqli_stmt_execute($stmt);

    header("Location: products.php");

    exit();

}

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Add Product</title>

<link rel="stylesheet"
href="../admin-css/admin.css">

</head>

<body>

<div class="page-header">

<h1>

Add New Product

</h1>

<a href="products.php" class="btn">

← Back

</a>

</div>

<form

method="POST"

enctype="multipart/form-data"

class="admin-form">

<label>

Product Name

</label>

<input

type="text"

name="product_name"

required>

<label>

Category

</label>

<select

name="category"

required>

<option>

Bouquet

</option>

<option>

Flower Box

</option>

<option>

Money Bouquet

</option>

<option>

Chocolate Bouquet

</option>

<option>

Customized

</option>

</select>

<label>

Description

</label>

<textarea

name="description"

rows="5"

required>

</textarea>

<label>

Price (₱)

</label>

<input

type="number"

name="price"

step="0.01"

min="0"

required>

<label>

Stock

</label>

<input

type="number"

name="stock"

min="0"

required>

<label>

Status

</label>

<select

name="status"

required>

<option value="Available">

Available

</option>

<option value="Unavailable">

Unavailable

</option>

</select>

<label>

Product Image

</label>

<input

type="file"

name="image"

accept="image/*"

required>

<br><br>

<button

type="submit"

name="save"

class="btn">

Save Product

</button>

<a

href="products.php"

class="btn">

Cancel

</a>

</form>

</body>

</html>