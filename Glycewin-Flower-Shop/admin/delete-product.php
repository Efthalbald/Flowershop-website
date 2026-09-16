<?php

session_start();

if(!isset($_SESSION['admin_id'])){

    header("Location: login.php");
    exit();

}

include("../php/config.php");

if(isset($_GET['id'])){

    $id = $_GET['id'];

    $sql = "SELECT image FROM products WHERE product_id=?";

    $stmt = mysqli_prepare($conn,$sql);

    mysqli_stmt_bind_param($stmt,"i",$id);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($result)){

        $image = "../images/products/" . $row['image'];

        if(file_exists($image)){

            unlink($image);

        }

    }

    $delete = "DELETE FROM products WHERE product_id=?";

    $stmt = mysqli_prepare($conn,$delete);

    mysqli_stmt_bind_param($stmt,"i",$id);

    mysqli_stmt_execute($stmt);

}

header("Location: products.php");

exit();

?>