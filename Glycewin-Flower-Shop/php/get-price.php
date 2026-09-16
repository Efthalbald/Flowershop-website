<?php

include(__DIR__ . "/pricing-function.php");
include(__DIR__ . "/config.php");

$flower = $_POST['flower'];
$size   = $_POST['size'];
$wrap   = $_POST['wrap'];
$color  = $_POST['color'];


$price = calculateCustomPrice(
    $flower,
    $size,
    $wrap,
    $color
);


echo number_format($price,2);

?>