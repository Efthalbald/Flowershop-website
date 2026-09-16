<?php

session_start();

if(!isset($_SESSION['admin_id'])){

    header("Location: login.php");
    exit();

}

include("../php/config.php");

$id = $_GET['id'];

$sql = "SELECT * FROM products WHERE product_id = ?";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "i", $id);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$product = mysqli_fetch_assoc($result);

if(isset($_POST['update'])){

    $product_name = trim($_POST['product_name']);
    $category = trim($_POST['category']);
    $description = trim($_POST['description']);
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $status = $_POST['status'];

    $image = $product['image'];

    if(!empty($_FILES['image']['name'])){

        $image = $_FILES['image']['name'];

        $temp = $_FILES['image']['tmp_name'];

        move_uploaded_file($temp, "../images/products/".$image);

    }

    $update = "UPDATE products SET

    product_name=?,

    category=?,

    description=?,

    price=?,

    stock=?,

    image=?,

    status=?

    WHERE product_id=?";

    $stmt = mysqli_prepare($conn, $update);

    mysqli_stmt_bind_param(

        $stmt,

        "sssdissi",

        $product_name,

        $category,

        $description,

        $price,

        $stock,

        $image,

        $status,

        $id

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

<title>Edit Product</title>

<link rel="stylesheet"
href="../admin-css/admin.css">

</head>

<body>

<div class="page-header">

<h1>

Edit Product

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

value="<?php echo htmlspecialchars($product['product_name']); ?>"

required>

<label>

Category

</label>

<select name="category">

<option value="Bouquet"
<?php if($product['category']=="Bouquet") echo "selected"; ?>>

Bouquet

</option>

<option value="Flower Box"
<?php if($product['category']=="Flower Box") echo "selected"; ?>>

Flower Box

</option>

<option value="Money Bouquet"
<?php if($product['category']=="Money Bouquet") echo "selected"; ?>>

Money Bouquet

</option>

<option value="Chocolate Bouquet"
<?php if($product['category']=="Chocolate Bouquet") echo "selected"; ?>>

Chocolate Bouquet

</option>

<option value="Customized"
<?php if($product['category']=="Customized") echo "selected"; ?>>

Customized

</option>

</select>

<label>

Description

</label>

<textarea

name="description"

rows="5"

required><?php echo htmlspecialchars($product['description']); ?></textarea>

<label>

Price (₱)

</label>

<input

type="number"

name="price"

step="0.01"

min="0"

value="<?php echo $product['price']; ?>"

required>

<label>

Stock

</label>

<input

type="number"

name="stock"

min="0"

value="<?php echo $product['stock']; ?>"

required>

<label>

Status

</label>

<select

name="status">

<option

value="Available"

<?php if($product['status']=="Available") echo "selected"; ?>>

Available

</option>

<option

value="Unavailable"

<?php if($product['status']=="Unavailable") echo "selected"; ?>>

Unavailable

</option>

</select>

<label>

Current Product Image

</label>

<br><br>

<img

src="../images/products/<?php echo htmlspecialchars($product['image']); ?>"

width="180"

style="border-radius:10px; margin-bottom:20px;">

<label>

Upload New Image (Optional)

</label>

<input

type="file"

name="image"

accept="image/*">

<br><br>

<button

type="submit"

name="update"

class="btn">

Update Product

</button>

<a

href="products.php"

class="btn">

Cancel

</a>

</form>

</body>

</html>