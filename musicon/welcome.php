<?php include 'config.php' ?>
 <?php

session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
{
    header("location: login.php");
}


?> 


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="icon" href="1.png" type="image/icon type">
    <link rel="stylesheet" href="stylewel.css">
	<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    <title>Enjoy the Songs</title>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-light">
  <div class="container-fluid">
  <img src="1.png">
   <h1>MusicOn</h1>
   <p><?php echo "Welcome ". $_SESSION['name']?></p>
   <form method="POST" action="welcome.php">
   <div class="searchBox">

<input class="searchInput"type="text" name="search" placeholder="Search">
<button type="submit" name="submit" class="searchButton" href="#">
<i class="fas fa-search"></i>
</button>
</form>
</div>
<div class="log_btn" style="position: absolute;left:90%; ">
<a href="logout.php"><i class="fas fa-sign-out-alt" style="color: #FFD700;"></i></a>
</div>
</div>
</nav>

<!-- <div class="bodycontainer">
         <div class="col-md-2">
              <div class="card " style="margin-top: 28px; background-color:rgba(0,0,0,0.5); border-radius :10px; font-family: 'Righteous', cursive;">
                    <img src="1.png" class="card-img-top"  alt="...">
                    <div class="card-body">
                    <p class="card-text" style="color: white; border-bottom: 2px solid yellow;">Kabira</p>
                    <audio controls class="audio-control" style="height:30px;width:100%;font-size:10px;">
                    <source src="" type="audio/mpeg">
                    </audio>
                    </div>
              </div>
            </div>

</div> -->


<?php 

if(isset($_POST['submit'])){
  
  $search = $_POST['search'];
  $sql = "SELECT * FROM tbl_blog WHERE name LIKE '%".$search."%'"; 
 $r_query = mysqli_query($conn, $sql); 
 
 while ($row = mysqli_fetch_assoc($r_query)){
   ?>
     <div class="card-group" style="justify-content: center; align-items:center" >
     <div class="col-md-3">
          <div class="card " style="margin-top: 8px; background-color:rgba(0,0,0,0.5); border-radius :10px;">
                <img src="photo/<?php echo $row['photo']; ?>" class="card-img-top"  alt="...">
                    <div class="card-body">
                      <p class="card-text" style="color: white; border-bottom: 2px solid yellow;"><?php echo $row['name']; ?></p>
                      <audio controls class="audio-control" >
                      <source src="song/<?php echo $row['song']?>" type="audio/mpeg">
                      </audio>
                  </div>
            </div>
     </div>
     </div>
<?php
 }


}
?>
<div class="bodycontainer">
<div class="card-group" >
    <?php
        $dis = "SELECT * FROM tbl_blog";
        $qu = mysqli_query($conn, $dis);
        if(mysqli_num_rows($qu)>0){
        while($row=mysqli_fetch_array($qu)){
            ?>
            <div class="col-md-2">
              <div class="card " style="margin-top: 28px; background-color:rgba(0,0,0,0.5); border-radius :10px; font-family: 'Righteous', cursive;">
                    <img src="photo/<?php echo $row['photo']; ?>" class="card-img-top"  alt="..." >
                    <div class="card-body">
                    <p class="card-text" style="color: white; border-bottom: 2px solid yellow;"><?php echo $row['name']; ?></p>
                    <audio controls class="audio-control" style="height:30px;width:100%;font-size:10px;" >
                    <source src="song/<?php echo $row['song']?>" type="audio/mpeg">
                    </audio>
                    </div>
              </div>
            </div>
              <?php 
        }
    }

        ?>
        </div>
</div>





    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>

<script>

function onlyPlayOneIn(container) {
  container.addEventListener("play", function(event) {
  audio_elements = container.getElementsByTagName("audio")
    for(i=0; i < audio_elements.length; i++) {
      audio_element = audio_elements[i];
      if (audio_element !== event.target) {
        audio_element.pause();
      }
    }
  }, true);
}

document.addEventListener("DOMContentLoaded", function() {
  onlyPlayOneIn(document.body);
});

</script>
