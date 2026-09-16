<?php

session_start();

include("../php/config.php");

$error = "";

if(isset($_POST['login'])){

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $sql = "SELECT * FROM admins WHERE username = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "s", $username);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if(mysqli_num_rows($result) == 1){

        $admin = mysqli_fetch_assoc($result);

        if($password == $admin['password']){

            $_SESSION['admin_id'] = $admin['admin_id'];

            $_SESSION['full_name'] = $admin['full_name'];

            $_SESSION['role'] = $admin['role'];

            header("Location: dashboard.php");

            exit();

        }else{

            $error = "Incorrect password.";

        }

    }else{

        $error = "Username not found.";

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

Admin Login | Glycewin

</title>

<link rel="stylesheet"
href="../admin-css/admin.css">

<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;700&family=Poppins:wght@300;400;500;600&display=swap"
rel="stylesheet">

</head>

<body>

<div class="login-page">

<div class="login-card">

<img
src="images/logo.png"
class="login-logo">

<h1>

GLYCEWIN

</h1>

<p>

Administration Panel

</p>

<?php

if($error!="")
{

echo "<div class='error'>$error</div>";

}

?>


<form method="POST">

<div class="input-group">

<label>

Username

</label>

<input
type="text"
name="username"
placeholder="username"
required>

</div>

<div class="input-group">

<label>

Password

</label>

<input
type="password"
name="password"
placeholder="password"
required>

</div>

<button
type="submit"
name="login"
class="btn">


Login

</button>

</form>

<div class="back-site">

<a href="../index.html">

← Return to Website

</a>

</div>

</div>

</div>

</body>

</html>