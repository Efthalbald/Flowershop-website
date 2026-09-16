<?php

session_start();

if(!isset($_SESSION['admin_id'])){

    header("Location: login.php");

    exit();

}

include("../php/config.php");

/* ===========================
   SAVE UPDATED PRICES
=========================== */

if(isset($_POST['save_prices'])){

    foreach($_POST['price'] as $pricing_id => $price){

        $price = floatval($price);

        $update = mysqli_prepare($conn,
            "UPDATE custom_pricing
             SET price=?
             WHERE pricing_id=?");

        mysqli_stmt_bind_param(
            $update,
            "di",
            $price,
            $pricing_id
        );

        mysqli_stmt_execute($update);

    }

    $success = "Pricing updated successfully.";

}

/* ===========================
   LOAD ALL PRICES
=========================== */

$sql = "SELECT *
        FROM custom_pricing
        ORDER BY category, option_name";

$result = mysqli_query($conn,$sql);

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>

Pricing Management

</title>

<link rel="stylesheet"
href="css/admin.css">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap"
rel="stylesheet">

<style>

body{

    font-family:Poppins,sans-serif;

    background:#f8f8f8;

    padding:40px;

}

.container{

    max-width:900px;

    margin:auto;

}

.card{

    background:#fff;

    padding:25px;

    border-radius:12px;

    box-shadow:0 5px 15px rgba(0,0,0,.08);

}

table{

    width:100%;

    border-collapse:collapse;

    margin-top:20px;

}

table th,
table td{

    padding:14px;

    border-bottom:1px solid #eee;

    text-align:left;

}

input[type=number]{

    width:120px;

    padding:8px;

}

button{

    margin-top:25px;

    background:#d96b87;

    color:white;

    border:none;

    padding:12px 25px;

    border-radius:8px;

    cursor:pointer;

}

.success{

    background:#e7ffe7;

    color:#2d7a2d;

    padding:10px;

    border-radius:8px;

    margin-bottom:20px;

}

.category{

    background:#ffeaf0;

    font-weight:bold;

}

</style>

</head>

<body>

<div class="container">

<div class="card">

<h2>

🌸 Pricing Management

</h2>

<p>

Update bouquet pricing used by the Custom Order calculator.

</p>

<?php if(isset($success)){ ?>

<div class="success">

<?php echo $success; ?>

</div>

<?php } ?>

<form method="POST">

<table>

<tr>

<th>

Category

</th>

<th>

Option

</th>

<th>

Price (₱)

</th>

</tr>
<?php

$current_category = "";

while($row = mysqli_fetch_assoc($result)){

    if($current_category != $row['category']){

        $current_category = $row['category'];

?>

<tr class="category">

<td colspan="3">

<?php

echo ucwords(str_replace("_"," ",$current_category));

?>

</td>

</tr>

<?php

    }

?>

<tr>

<td>

</td>

<td>

<?php echo htmlspecialchars($row['option_name']); ?>

</td>

<td>

<input

type="number"

step="0.01"

min="0"

name="price[<?php echo $row['pricing_id']; ?>]"

value="<?php echo $row['price']; ?>"

required>

</td>

</tr>

<?php

}

?>

</table>

<button

type="submit"

name="save_prices">

💾 Save All Prices

</button>

</form>

</div>

</div>

</body>

</html>