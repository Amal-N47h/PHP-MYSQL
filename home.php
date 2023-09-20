<?php
session_start();
if(!isset($_SESSION['aid'])){
  header("Location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<body style="background-color: #eee;">
<section>
  <div class="container d-flex justify-content-center">
    <div class="card text-black my-5 pt-3" style="border-radius: 25px;width:500px;">
      <div class="card-body m-4 p-4">
        <div class="row justify-content-center">
          
          <?php
            $aid = $_SESSION['aid'];
            $connect = mysqli_connect('localhost','jack','amal','helo');
            $sql = "SELECT * FROM FORM WHERE ID = '$aid'";  
            $query = mysqli_query($connect,$sql);
            $result = mysqli_fetch_assoc($query);
            $username = $result['NAME'];
            echo "<h2 class=\"fw-bold mx-1 text-center text-danger\">Welcome {$username}</h2>"; 
          ?>

          <form class="mt-4" action="home.php" method="post">

            <div class="form-floating mb-4">
              <input type="text" name="search" class="form-control" id="floatingInput" placeholder="search">
              <label for="floatingInput">Search</label>
            </div>

          <?php
            if(isset($_POST['submit']) && !empty($_POST['search'])){
              $text = $_POST['search'];
              echo "<h3 class=\"text-warning\">You searched for " . htmlspecialchars($text) . " </h3>";
            }
          ?>

            <div class="d-flex justify-content-center mx-4 mt-4 mb-2">
              <input type="submit" name="submit" value="Search" class="btn btn-info">
            </div>
          </form>

          <form class="mt-4" action="home.php" method="post">

          <div class="form-floating mb-4">
            <input type="text" name="image" class="form-control" id="floatingInput" placeholder="search">
            <label for="floatingInput">Search for Image</label>
          </div>

          <?php
            if (isset($_POST['submit']) && !empty($_POST['image'])) {
              $image = $_POST['image'];
              if (filter_var($image, FILTER_VALIDATE_URL)) {
                  echo "<img style='width:300px' src='$image' alt='Image'>";
              } else {
                  echo "Invalid Image URL. Please enter a valid URL";
              }
            }
            if(isset($_POST['logout'])){
              header("Location:login.php");
              session_destroy();
            }
          ?>

          <div class="d-flex justify-content-center mx-4 mt-4 mb-4">
            <input type="submit" name="submit" value="Search" class="btn btn-info">
          </div>
          <div class="d-flex justify-content-center mx-4 mt-5 mb-2">
              <input type="submit" name="logout" value="Log out" class="btn btn-warning">
          </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>
