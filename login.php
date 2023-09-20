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
    <div class="card text-black my-5 pt-3" style="border-radius: 25px;width:500px;">
      <div class="card-body m-4 p-4">
        <div class="row justify-content-center">
            <p class="text-center h1 fw-bold mt-2 mb-4 mx-1">Sign in</p>

            <form class="mt-4" action="login.php" method="post">

              <div class="form-floating mb-4">
                <input type="email" name="email" class="form-control" id="floatingInput" placeholder="email" required>
                <label for="floatingInput">Email address</label>
              </div>

              <div class="form-floating my-5">
                <input type="password" name="password" class="form-control" id="floatingInput" placeholder="password" required>
                <label for="floatingInput">Password</label>
              </div>

              <?php
                if(isset($_POST['login'])){
                  $email = $_POST['email']; 
                  $password = $_POST['password'];
                  $connect = mysqli_connect('localhost','jack','amal','helo');

                  $sql = "SELECT * FROM `FORM` WHERE `EMAIL` =  '$email'";
                  $query = mysqli_query($connect,$sql);
                  $result = mysqli_fetch_assoc($query);
                  $amail = $result['EMAIL'];
                  $apass = $result['PASSWORD'];
                  
                  if(!empty($amail)){
                    if(password_verify($password,$apass)){
                      $_SESSION['aid'] = $result['ID']; 
                      header('Location:home.php');
                    }else{
                      echo "Incorrect Password";
                    }
                    
                  }else{
                    echo "Incorrect Username";
                  }
                  
                  mysqli_close($connect);

                }
              ?>

              <div class="form-check d-flex justify-content-center my-4">
                Don't have an account? <a href="registration.php" style="text-decoration:none">&nbsp; Sign up </a>
              </div>

              <div class="d-flex justify-content-center mx-4 mt-4 mb-2">
                <input type="submit" name="login"  value="Log in" class="btn btn-primary btn-lg">
              </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>
