

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>file upld</title>
</head>
<body>
   <form method="POST" enctype="multipart/form-data">
   <input type="text" name="t1" placeholder="Enter name"/>
   <label>Img</label>
   <input type="file" name="img" /> 
   <label>Song</label>
   <input type="file" name="audio" />
   <input type="submit" name="submit" value="Upload to DB"/>
   </form>

   <?php
   include 'config.php';

if(isset($_POST['submit'])){
    $title=mysqli_real_escape_string( $conn, $_POST['t1']);
    $img=$_FILES['img']['name'];
    $tempname=$_FILES['img']['tmp_name'];

    $audio = $_FILES['audio']['name'];
    $tempaudio = $_FILES['audio']['tmp_name'];

    $insertquery = "INSERT into tbl_blog(name,photo,song) values('$title','$img','$audio')";
    $iquery = mysqli_query($conn, $insertquery);

    move_uploaded_file($tempname,"photo/".$img);
    move_uploaded_file($tempaudio,"song/".$audio);
}


?>