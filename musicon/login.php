<?php
//This script will handle login
session_start();

// check if the user is already logged in
if(isset($_SESSION['username']))
{
    header("location: welcome.php");
    exit;
}
require_once "config.php";

$username = $password = "";
$err = "";

// if request method is post
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    if(empty(trim($_POST['username'])) || empty(trim($_POST['password'])))
    {
        $err = "Please enter username + password";
    }
    else{
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
    }


if(empty($err))
{
    $sql = "SELECT id, username, password, name FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $param_username);
    $param_username = $username;
    
    
    
    // Try to execute this statement
    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password,$uname);
                    if(mysqli_stmt_fetch($stmt))
                    {
                        
                        if(password_verify($password, $hashed_password))
                        {
                            // this means the password is corrct. Allow user to login
                            session_start();
                            $_SESSION["username"] = $username;
                            $_SESSION["id"] = $id;
                            $_SESSION["name"] = $uname;
                            $_SESSION["loggedin"] = true;

                            //Redirect user to welcome page
                            header("location: welcome.php");
                            
                        }
                    }

                }

    }
}    


}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="1.png" type="image/icon type">
    <link rel="stylesheet" href="style_register.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

<div class="c1"></div>
<div class="c2"></div>
<div class="logoimg"><img src="1.png" alt=""></div>
<form action="" method="post">
<div class="container_form">
    <h1>SIGN-IN</h1>
        <input type="text" placeholder="Enter Username" name="username" >
        <input type="password" placeholder="Enter Password" name="password" >

        <div class="icon_fa">
            <img src="https://img-premium.flaticon.com/png/512/2374/premium/2374449.png?token=exp=1627123332~hmac=3cfc205ef64e02304e649ad8cfc2010a">
            <img src="https://image.flaticon.com/icons/png/512/2913/2913133.png">
        </div>
        <div class="sbtn">
            <button>Submit</button>
            <h3>Don't have an account?</h3><a href="register.php">Register</a>
        </div>
</div>
</form>
<div class="c3">
    <img src="https://img-premium.flaticon.com/png/512/3631/premium/3631620.png?token=exp=1626546792~hmac=24aef0c6d8adda28caa829f48e6b99bc" alt="">
</div>


</body>
</html>