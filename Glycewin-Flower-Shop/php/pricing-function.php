<?php

include("config.php");

/*
|--------------------------------------------------------------------------
| Get the price of one option
|--------------------------------------------------------------------------
*/

function getPrice($category, $option){

    global $conn;

    $sql = "SELECT price
            FROM custom_pricing
            WHERE category = ?
            AND option_name = ?
            LIMIT 1";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "ss", $category, $option);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($result)){

        return (float)$row['price'];

    }

    return 0;

}

/*
|--------------------------------------------------------------------------
| Compute Custom Bouquet Price
|--------------------------------------------------------------------------
*/

function calculateCustomPrice(

    $flower,
    $size,
    $wrap,
    $color

){

    $total = 0;

    $total += getPrice("flower_type", $flower);

    $total += getPrice("bouquet_size", $size);

    $total += getPrice("wrapping_style", $wrap);

    $total += getPrice("color_theme", $color);

    return $total;

}

?>