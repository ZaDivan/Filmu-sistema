<?php

require("db.php");
$roles = $db->query("SELECT * FROM roles")->fetchAll(2);

if(isset($_POST['submit'])) {
    $name = $_POST["name"];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $cpass = $_POST['cpassword'];
    $role = $_POST['role'];

    $result = $db->query("SELECT * FROM users WHERE email = '$email' && password = '$pass' ");

    if ($result->fetchColumn() > 0) {

        $error[] = 'user already exist!';

    } else {

        if ($pass != $cpass) {
            $error[] = 'password not matched!';
        } else {
            $insert = "INSERT INTO users(name, email, password, role) VALUES('$name','$email','$pass','$role')";
            $db->query($insert);
            header('location:login.php');
        }
    }
}

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Register ">
    <title>Register</title>

    <!-- Bootstrap core CSS -->
<link href="css/bootstrap.css" rel="stylesheet" crossorigin="anonymous">


<meta name="theme-color" content="#7952b3">    
    <!-- Custom styles for this template -->

  </head>
  <body class="text-center">
	
<div class="modal modal-sheet position-static d-block bg-body-secondary p-4 py-md-5" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content rounded-4 shadow">
      <div class="modal-header p-5 pb-4 border-bottom-0">
        <h1 class="fw-bold mb-0 fs-2">Register now</h1>
      </div>
				<?php
        if(isset($error)){
						foreach($error as $error){
									echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
						};
					};
				?>

      <div class="modal-body p-5 pt-0">
         <form action="" method="post">
          <div class="form-floating mb-3">
            <input type="text" name="name" class="form-control rounded-3" id="floatingInputname" placeholder="Enter your name">
            <label for="floatingInputname">Enter your name</label>
          </div>
          <div class="form-floating mb-3">
            <input type="email" name="email" class="form-control rounded-3" id="floatingInput" placeholder="Enter your email">
            <label for="floatingInput">Enter your email</label>
          </div>
          <div class="form-floating mb-3">
            <input type="password" name="password" class="form-control rounded-3" id="floatingPassword" placeholder="Enter your password">
            <label for="floatingPassword">Enter your password</label>
          </div>
          <div class="form-floating mb-3">
            <input type="password" name="cpassword" class="form-control rounded-3" id="floatingPasswords" placeholder="Confirm your password">
            <label for="floatingPasswords">Confirm your password</label>
          </div>
          <select class="form-select form-select-lg mb-3" name="role" id="" >
						 <?php foreach($roles as $role): ?>
                <option value="<?php echo $role['id'];?>">
                    <?php echo $role['name'] ?>
                </option>
            <?php endforeach;?>
					</select>
					
          <button class="w-100 mb-2 btn btn-lg rounded-3 btn-primary" name="submit" type="submit">Register now</button>
					<hr class="my-4">
        </form>
					<p>already have an account? <a href="login.php">Login now</a></p>
      </div>
    </div>
  </div>
</div>


    
  </body>
</html>