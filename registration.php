<?php
session_start();
if(isset($_SESSION['aid'])){
  header("Location:home.php");
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
    <div class="card text-black my-5" style="border-radius: 25px;width:550px;">
      <div class="card-body p-5">
        <div class="row justify-content-center">
            <p class="text-center h1 fw-bold mt-2 mb-4 mx-1">Sign up</p>
            
            <form class="mx-3 mt-4" action="registration.php" method="post">

              <div class="form-floating mb-4">
                <input type="text" class="form-control" name="username" id="floatingInput" placeholder="name" required>
                <label for="floatingInput">Your name</label>
              </div>

              <div class="form-floating mb-4">
                <input type="email" class="form-control" name="email" id="floatingInput" placeholder="email" required>
                <label for="floatingInput">Email address</label>
              </div>

              <div class="form-floating mb-4">
                <input type="password" class="form-control" name="password" id="floatingInput" placeholder="password" required>
                <label for="floatingInput">Password</label>
              </div>

              <div class="form-floating mb-4">
                <input type="password" class="form-control" name="repassword" id="floatingInput" placeholder="password" required>
                <label for="floatingInput">Repeat your password</label>
              </div>

              <?php
                if(isset($_POST['register'])){
                  $username = $_POST['username'];
                  $email = $_POST['email'];
                  $password = $_POST['password'];
                  $repassword = $_POST['repassword'];
                  $connect = mysqli_connect('localhost','jack','amal','helo');
                  $sqli = "SELECT * FROM `FORM` WHERE `EMAIL` =  '$email'";
                  $query = mysqli_query($connect,$sqli);
                  $result = mysqli_fetch_assoc($query);
                  $amail = $result['EMAIL'];
                  if(empty($amail)){
                    if($password===$repassword){
                      header('Location:login.php');
                      $hash = password_hash($password, PASSWORD_BCRYPT);
                      $connect = mysqli_connect('localhost','jack','amal','helo') or die("connection failed " .mysqli_connect_error());
                      $sql = "INSERT INTO `FORM` (`NAME`,`EMAIL`,`PASSWORD`) VALUES ('$username','$email','$hash')";
                      $query = mysqli_query($connect,$sql);
                    }else{
                    echo "<h3 class=\"text-warning\">Password didn't match</h3>";
                    }
                  }else{
                    echo "<h3 class=\"text-warning\">Email already exists</h3>";
                  }
                }
              ?>

              <div class="form-check d-flex justify-content-center mb-5">
                <input class="form-check-input me-2" type="checkbox" value="" id="formex" required>
                <label class="form-check-label" for="formex">
                  I agree all statements in <a href="" style="text-decoration:none">Terms of service</a>
                </label>
              </div>

              <div class="d-flex justify-content-center mx-4 mb-2">
                <input type="submit" name="register" value="Register" class="btn btn-primary btn-lg">
              </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>


