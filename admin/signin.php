<?php
  session_start();
  include_once "includes/config.php";
  include_once "includes/db.php";
  include_once "securimage/securimage.php";
  
  $securimage = new Securimage();
  
  if(isset($_POST['login'])){
	  
	 if ($securimage->check($_POST['captcha_code']) == false) {
		 header("Location:signin.php?err_msg=The security code entered was incorrect!!!");
		 exit();
	}
	   
    $email = mysqli_real_escape_string( $db , $_POST['email'] );
    $password = mysqli_real_escape_string( $db , $_POST['password'] );
    
	$result = $db->query("SELECT * FROM admin WHERE email = '$email'");
	$row = $result->fetch_assoc();
		
	$password_hash = $row['password'];

	if(password_verify($password, $password_hash)){
	  $_SESSION['email'] = $email;
      header("Location:index.php");
      exit();
	}
	else{
      header("Location:signin.php?err_msg=Wrong Email or Password!!!");
      exit();
    }
	
	}
	
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Signin</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">

  </head>

  <body>

    <div class="container">

      <form class="form-signin" method="POST">
        <?php if(isset($_GET['err_msg'])){
          echo "<div class='alert alert-danger'>$_GET[err_msg]</div>";
        } ?>
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
		
		<img id="captcha" src="securimage/securimage_show.php" alt="CAPTCHA Image" />
		<input type="text" name="captcha_code" size="15" maxlength="6" />
			<a href="#" onclick="document.getElementById('captcha').src = 'securimage/securimage_show.php?' + Math.random(); return false">[ Different Image ]</a>
     
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="login">Sign in</button>
      </form>

    </div> <!-- /container -->

  </body>
</html>
