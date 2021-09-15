<?php
require_once "config.php";

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST"){
    $fname=trim($_POST['uname']);
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Username cannot be blank";
    }
    else{
        $sql = "SELECT id FROM users WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if($stmt)
        {
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set the value of param username
            $param_username = trim($_POST['username']);

            // Try to execute this statement
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    $username_err = "This username is already taken"; 
                }
                else{
                    $username = trim($_POST['username']);
                }
            }
            else{
                echo "Something went wrong";
            }
        }
    }

    mysqli_stmt_close($stmt);


// Check for password
if(empty(trim($_POST['password']))){
    $password_err = "Password cannot be blank";
}
elseif(strlen(trim($_POST['password'])) < 5){
    $password_err = "Password cannot be less than 5 characters";
}
else{
    $password = trim($_POST['password']);
}

// Check for confirm password field
if(trim($_POST['password']) !=  trim($_POST['confirm_password'])){
    $password_err = "Passwords should match";
}


// If there were no errors, go ahead and insert into the database
if(empty($username_err) && empty($password_err) && empty($confirm_password_err))
{
    $sql = "INSERT INTO users (name,username, password) VALUES (?,?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt)
    {
        mysqli_stmt_bind_param($stmt, "sss",$param_uname, $param_username, $param_password);

        // Set these parameters
        $param_uname = $fname;
        $param_username = $username;
        $param_password = password_hash($password, PASSWORD_DEFAULT);

        // Try to execute the query
        if (mysqli_stmt_execute($stmt))
        {
            header("location: login.php");
        }
        else{
            echo "Something went wrong... cannot redirect!";
        }
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
}

?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
    <h1>SIGN-UP</h1>
        <input type="text" placeholder="Enter Name" name="uname" required>
        <input type="text" placeholder="Create Username" name="username" required>
        <input type="password" placeholder="Enter Password" name="password" required>
        <input type="password" placeholder="Confirm Password" name="confirm_password" required>
        <div class="icon_fa">
            <img src="https://img-premium.flaticon.com/png/512/1144/premium/1144709.png?token=exp=1627123512~hmac=2379b775828cec5c043972d501713410">
            <img src="https://img-premium.flaticon.com/png/512/2374/premium/2374449.png?token=exp=1627123332~hmac=3cfc205ef64e02304e649ad8cfc2010a">
            <img src="https://image.flaticon.com/icons/png/512/2913/2913133.png">
            <img src="https://image.flaticon.com/icons/png/512/2913/2913133.png">
        </div>
        <div class="sbtn">
            <button>Submit</button>
            <h3>Already have an account?</h3><a href="login.php">Login</a>
        </div>
</div>
</form>
<div class="c3">
    <img src="https://img-premium.flaticon.com/png/512/3631/premium/3631620.png?token=exp=1626546792~hmac=24aef0c6d8adda28caa829f48e6b99bc" alt="">
</div>









</body>
</html>