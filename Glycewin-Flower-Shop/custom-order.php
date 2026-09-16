<?php

include("php/config.php");
include("php/pricing-function.php");

$message = "";

/*====================================================
HANDLE FORM SUBMISSION
====================================================*/

if($_SERVER["REQUEST_METHOD"] == "POST"){

    /*==============================
    CUSTOMER INFORMATION
    ==============================*/

    $customer_name = trim($_POST['customer_name']);
    $email         = trim($_POST['email']);
    $contact       = trim($_POST['contact']);
    $address       = trim($_POST['address']);

    /*==============================
    CUSTOM ORDER DETAILS
    ==============================*/

    $flower_type    = trim($_POST['flower_type']);
    $bouquet_size   = trim($_POST['bouquet_size']);
    $flower_color   = trim($_POST['color_theme']);
    $wrapping_style = trim($_POST['wrapping_style']);

    $occasion       = trim($_POST['occasion']);
    $delivery_date  = $_POST['delivery_date'];
    $instructions   = trim($_POST['instructions']);

    $status = "Pending";

    /*==============================
    AUTOMATIC PRICE CALCULATION
    ==============================*/

    $estimated_price = calculateCustomPrice(

        $flower_type,

        $bouquet_size,

        $wrapping_style,

        $flower_color

    );

    /*==============================
    VALIDATION
    ==============================*/

    if(

        empty($customer_name) ||

        empty($email) ||

        empty($contact) ||

        empty($address) ||

        empty($flower_type) ||

        empty($bouquet_size) ||

        empty($flower_color) ||

        empty($wrapping_style) ||

        empty($occasion) ||

        empty($delivery_date)

    ){

        $message = "Please complete all required fields.";

    }

    elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){

        $message = "Please enter a valid email address.";

    }

    else{

        /*==============================
        CHECK CUSTOMER
        ==============================*/

        $check = mysqli_prepare(

            $conn,

            "SELECT customer_id
             FROM customers
             WHERE email=?"

        );

        mysqli_stmt_bind_param(

            $check,

            "s",

            $email

        );

        mysqli_stmt_execute($check);

        $result = mysqli_stmt_get_result($check);

        if(mysqli_num_rows($result)>0){

            $customer = mysqli_fetch_assoc($result);

            $customer_id = $customer['customer_id'];

        }

        else{

            /*==============================
            CREATE CUSTOMER
            ==============================*/

            $insertCustomer = mysqli_prepare(

                $conn,

                "INSERT INTO customers
                (
                    full_name,
                    email,
                    phone,
                    address
                )

                VALUES

                (?,?,?,?)"

            );

            mysqli_stmt_bind_param(

                $insertCustomer,

                "ssss",

                $customer_name,

                $email,

                $contact,

                $address

            );

            mysqli_stmt_execute($insertCustomer);

            $customer_id = mysqli_insert_id($conn);

        }

        /*==============================
        IMAGE UPLOAD
        ==============================*/

        $reference_image = "";

        if(

            isset($_FILES['reference_image'])

            &&

            $_FILES['reference_image']['error']==0

        ){

            $allowed = [

                "jpg",

                "jpeg",

                "png",

                "webp"

            ];

            $extension = strtolower(

                pathinfo(

                    $_FILES['reference_image']['name'],

                    PATHINFO_EXTENSION

                )

            );

            if(in_array($extension,$allowed)){

                if($_FILES['reference_image']['size']<=5242880){

                    $folder = "images/custom-orders/";

                    if(!is_dir($folder)){

                        mkdir($folder,0777,true);

                    }

                    $reference_image =

                        uniqid("custom_")

                        .".".$extension;

                    move_uploaded_file(

                        $_FILES['reference_image']['tmp_name'],

                        $folder.$reference_image

                    );

                }

                else{

                    $message = "Image must not exceed 5MB.";

                }

            }

            else{

                $message = "Only JPG, JPEG, PNG and WEBP are allowed.";

            }

        }

                /*====================================
        INSERT CUSTOM ORDER
        ====================================*/

        if(empty($message)){

            $insertOrder = mysqli_prepare(

                $conn,

                "INSERT INTO custom_orders
                (
                    customer_id,
                    occasion,
                    delivery_date,
                    flower_type,
                    bouquet_size,
                    flower_color,
                    wrapping_style,
                    estimated_price,
                    instructions,
                    reference_image,
                    status
                )

                VALUES

                (?,?,?,?,?,?,?,?,?,?,?)"

            );

            mysqli_stmt_bind_param(

                $insertOrder,

                "issssssdsss",

                $customer_id,

                $occasion,

                $delivery_date,

                $flower_type,

                $bouquet_size,

                $flower_color,

                $wrapping_style,

                $estimated_price,

                $instructions,

                $reference_image,

                $status

            );

            if(mysqli_stmt_execute($insertOrder)){

                header("Location: custom-order.php?success=1");

                exit();

            }

            else{

                $message = "Unable to submit your custom order.";

            }

        }

    }

}

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>

Custom Order | Glycewin Handmade Flower Shop

</title>

<link rel="stylesheet"
href="css/custom-order.css">

<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;700&family=Poppins:wght@300;400;500;600;700&display=swap"
rel="stylesheet">

</head>

<body>

<?php

if(isset($_GET['success'])){

?>

<div class="success-message">

🌸 Your custom bouquet request has been submitted successfully!

</div>

<?php

}

?>

<?php

if($message!=""){

?>

<div class="error-message">

<?php echo htmlspecialchars($message); ?>

</div>

<?php

}

?>

<!-- =====================================
HEADER
===================================== -->

<header class="header">

<div class="navbar">

<a href="index.php" class="logo">

<img src="images/logo.png" alt="Glycewin Logo">

<span>

GLYCEWIN

</span>

</a>

<nav>

<a href="index.php">

Home

</a>

<a href="products.php">

Flowers

</a>

<a href="custom-order.php" class="active">

Custom

</a>

<a href="bulk-order.php">

Bulk

</a>

<a href="tracking.php">

Track

</a>

</nav>

<div class="menu-btn">

☰

</div>

</div>

</header>

<!-- =====================================
HERO
===================================== -->

<section class="hero">

<div class="hero-box">

<p class="mini-title">

CUSTOM FLOWERS

</p>

<h1>

Design Your Dream Bouquet

</h1>

<p>

Create a unique handmade bouquet crafted especially for your memorable occasion.

</p>

</div>

</section>

<!-- =====================================
CUSTOM ORDER FORM
===================================== -->

<section class="custom-section">

<div class="custom-container">

<form

method="POST"

enctype="multipart/form-data">

<!-- =====================================
CUSTOMER INFORMATION
===================================== -->

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
required>

</div>

<div class="input-group">

<label>

Email Address

</label>

<input
type="email"
name="email"
required>

</div>

<div class="input-group">

<label>

Contact Number

</label>

<input
type="text"
name="contact"
required>

</div>

<div class="input-group">

<label>

Delivery Address

</label>

<input
type="text"
name="address"
required>

</div>

</div>

</div>

<!-- =====================================
FLOWER SELECTION
===================================== -->

<div class="form-card">

<h2>
🌹 Choose Your Flowers
</h2>

<div class="option-grid">


<?php

$flowers=mysqli_query(
$conn,
"SELECT option_name
FROM custom_pricing
WHERE category='flower_type'
ORDER BY option_name"
);


while($flower=mysqli_fetch_assoc($flowers)){


$emoji="💐";


switch($flower['option_name']){

case "Roses":
$emoji="🌹";
break;

case "Tulips":
$emoji="🌷";
break;

case "Sunflowers":
$emoji="🌻";
break;

case "Mixed Flowers":
$emoji="💐";
break;

}


?>

<label class="option">

<input 
type="radio"
name="flower_type"
value="<?= htmlspecialchars($flower['option_name']); ?>"
required>


<span>

<?= $emoji; ?>

<br>

<?= htmlspecialchars($flower['option_name']); ?>


</span>

</label>


<?php } ?>


</div>

</div>




<!-- =====================================
BOUQUET SIZE
===================================== -->


<div class="form-card">


<h2>
🌸 Select Bouquet Size
</h2>


<div class="option-grid">


<?php


$sizes=mysqli_query(
$conn,
"SELECT option_name
FROM custom_pricing
WHERE category='bouquet_size'
ORDER BY price"
);


while($size=mysqli_fetch_assoc($sizes)){


$emoji="💐";


switch($size['option_name']){

case "Small":
$emoji="🌸";
break;


case "Medium":
$emoji="🌺";
break;


case "Large":
$emoji="💐";
break;


}


?>


<label class="option">


<input

type="radio"

name="bouquet_size"

value="<?= htmlspecialchars($size['option_name']); ?>"

required>


<span>

<?= $emoji; ?>

<br>

<?= htmlspecialchars($size['option_name']); ?>


</span>


</label>


<?php } ?>


</div>


</div>






<!-- =====================================
COLOR THEME
===================================== -->


<div class="form-card">


<h2>
🎨 Choose Color Theme
</h2>


<div class="option-grid">


<?php


$colors=mysqli_query(

$conn,

"SELECT option_name
FROM custom_pricing
WHERE category='color_theme'
ORDER BY option_name"

);



while($color=mysqli_fetch_assoc($colors)){


$emoji="🎨";


switch($color['option_name']){


case "Pink":
$emoji="💗";
break;


case "Red":
$emoji="❤️";
break;


case "White":
$emoji="🤍";
break;


case "Pastel":
$emoji="🌷";
break;


}



?>


<label class="option">


<input

type="radio"

name="color_theme"

value="<?= htmlspecialchars($color['option_name']); ?>"

required>



<span>


<?= $emoji; ?>

<br>


<?= htmlspecialchars($color['option_name']); ?>


</span>


</label>


<?php } ?>


</div>


</div>







<!-- =====================================
WRAPPING STYLE
===================================== -->


<div class="form-card">


<h2>
🎀 Select Wrapping Style
</h2>



<div class="option-grid">



<?php


$wraps=mysqli_query(

$conn,

"SELECT option_name
FROM custom_pricing
WHERE category='wrapping_style'
ORDER BY price"

);



while($wrap=mysqli_fetch_assoc($wraps)){



$emoji="🎀";



switch($wrap['option_name']){


case "Kraft Paper":

$emoji="🤎";

break;



case "Satin Wrap":

$emoji="🎀";

break;



case "Luxury Wrap":

$emoji="✨";

break;



case "Korean Style":

$emoji="🌸";

break;


}



?>



<label class="option">


<input

type="radio"

name="wrapping_style"

value="<?= htmlspecialchars($wrap['option_name']); ?>"

required>



<span>


<?= $emoji; ?>

<br>


<?= htmlspecialchars($wrap['option_name']); ?>


</span>


</label>


<?php } ?>


</div>


</div>







<!-- =====================================
OCCASION DETAILS
===================================== -->


<div class="form-card">


<h2>
💌 Occasion Details
</h2>


<div class="form-grid">


<div class="input-group">


<label>
Occasion
</label>


<select name="occasion" required>


<option value="">
Select Occasion
</option>


<option>
Birthday
</option>


<option>
Anniversary
</option>


<option>
Graduation
</option>


<option>
Wedding
</option>


<option>
Mother's Day
</option>


<option>
Valentine's Day
</option>


<option>
Sympathy
</option>


<option>
Other
</option>


</select>


</div>



<div class="input-group">


<label>
Preferred Delivery Date
</label>


<input

type="date"

name="delivery_date"

required>


</div>


</div>



<div class="input-group">


<label>
Special Instructions
</label>


<textarea

name="instructions"

rows="5"

placeholder="Write your dedication or special requests...">

</textarea>


</div>


</div>






<!-- =====================================
REFERENCE IMAGE
===================================== -->


<div class="form-card">


<h2>
📸 Reference Design
</h2>


<p class="description">

Upload an inspiration photo if you have one.

</p>



<div class="upload-box">


<input

type="file"

name="reference_image"

accept=".jpg,.jpeg,.png,.webp">


</div>


</div>







<!-- =====================================
ORDER SUMMARY
===================================== -->


<div class="summary-card">


<h2>
🌸 Your Bouquet Preview
</h2>



<div class="summary-row">

<span>
🌹 Flower
</span>

<strong id="summary_flower">
-
</strong>


</div>



<div class="summary-row">

<span>
🌺 Size
</span>

<strong id="summary_size">
-
</strong>


</div>




<div class="summary-row">

<span>
🎀 Wrapping
</span>


<strong id="summary_wrap">
-
</strong>


</div>




<div class="summary-row">

<span>
🎨 Color
</span>


<strong id="summary_color">
-
</strong>


</div>





<div class="summary-row total">


<span>
✨ Estimated Price
</span>


<strong id="estimated_price">

₱0.00

</strong>


</div>



</div>







<!-- =====================================
SUBMIT
===================================== -->


<div class="submit-area">


<label class="terms">


<input

type="checkbox"

required>


<span>

I confirm that all information provided is correct.

</span>


</label>



<button

type="submit"

class="submit-btn">


🌸 Create My Bouquet


</button>


</div>

</section>

<script>

function selectedValue(name){

    const radio=document.querySelector('input[name="'+name+'"]:checked');

    return radio ? radio.value : "";

}

function updateSummary(){

    const flower=selectedValue("flower_type");
    const size=selectedValue("bouquet_size");
    const wrap=selectedValue("wrapping_style");
    const color=selectedValue("color_theme");

    document.getElementById("summary_flower").innerHTML=flower || "-";
    document.getElementById("summary_size").innerHTML=size || "-";
    document.getElementById("summary_wrap").innerHTML=wrap || "-";
    document.getElementById("summary_color").innerHTML=color || "-";

    if(flower=="" || size=="" || wrap=="" || color==""){

        document.getElementById("estimated_price").innerHTML="₱0.00";

        return;

    }

    const formData=new FormData();

    formData.append("flower",flower);
    formData.append("size",size);
    formData.append("wrap",wrap);
    formData.append("color",color);

    fetch("php/get-price.php",{

        method:"POST",

        body:formData

    })

    .then(response=>response.text())

    .then(price=>{

        document.getElementById("estimated_price").innerHTML="₱"+price;

        document.getElementById("estimated_price_input").value=price;

    });

}

document.querySelectorAll(

'input[type=radio]'

).forEach(function(item){

    item.addEventListener("change",updateSummary);

});

</script>

<!-- =====================================
WHY CHOOSE GLYCEWIN
===================================== -->

<section class="benefits">

<div class="benefit-container">

<div class="benefit-card">

<div class="icon">

🌸

</div>

<h3>

Handcrafted with Love

</h3>

<p>

Every bouquet is carefully handcrafted by our florists using premium flowers and creative designs.

</p>

</div>

<div class="benefit-card">

<div class="icon">

🎨

</div>

<h3>

Fully Customized

</h3>

<p>

Choose your preferred flowers, bouquet size, wrapping style, and color theme.

</p>

</div>

<div class="benefit-card">

<div class="icon">

🚚

</div>

<h3>

Reliable Delivery

</h3>

<p>

Your bouquet is carefully prepared and delivered on your selected date.

</p>

</div>

<div class="benefit-card">

<div class="icon">

💗

</div>

<h3>

Customer Satisfaction

</h3>

<p>

We strive to create beautiful bouquets that make every celebration memorable.

</p>

</div>

</div>

</section>

<!-- =====================================
FOOTER
===================================== -->

<footer>

<div class="footer-content">

<img

src="images/logo.png"

alt="Glycewin Logo"

class="footer-logo">

<h3>

Glycewin Handmade Flower Shop

</h3>

<p>

Creating handcrafted bouquets with love, creativity, and elegance for every special occasion.

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

<a href="bulk-order.php">

Bulk Orders

</a>

<a href="tracking.php">

Track Order

</a>

</div>

<p class="copyright">

© 2026 Glycewin Handmade Flower Shop. All Rights Reserved.

</p>

</div>

</footer>

<script src="js/main.js"></script>

</body>

</html>