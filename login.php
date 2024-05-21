<?php
session_start();
require("db.php");
if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $result = $db->query(" SELECT * FROM users WHERE email = '$email' && password = '$pass' ");
    setcookie("email",$email, time() + 60*60*24*30);
    setcookie("pass",$pass, time() + 60*60*24*30);
    if($result->rowCount() > 0){
        $row = $result->fetch();




        if($row['role'] == '2'){

            $_SESSION['id'] = $row['id'];
            $_SESSION['role'] = $row['role'];
            $_SESSION['user_name'] = $row['name'];
            header('location:admin_page.php');

        }elseif($row['role'] == '1'){

            $_SESSION['id'] = $row['id'];
            $_SESSION['role'] = $row['role'];
            $_SESSION['user_name'] = $row['name'];
            header('location:user_page.php');

        }

    }else{
        $error[] = 'nepareizs epasts vai parole!';
    }
		
};
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="login">
    <title>login</title>


    <!-- Bootstrap core CSS -->
<link href="css/bootstrap.css" rel="stylesheet" crossorigin="anonymous">


<meta name="theme-color" content="#7952b3">


    <style>
			html,
body {
  height: 100%;
}

body {
  display: flex;
  align-items: center;

  background-color: #f5f5f5;
}


</style>

    
    <!-- Custom styles for this template -->

  </head>
  <body class="text-center">
	
<div class="modal modal-sheet position-static d-block bg-body-secondary p-4 py-md-5" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content rounded-4 shadow">
      <div class="modal-header p-5 pb-4 border-bottom-0">
        <h1 class="fw-bold mb-0 fs-2">Autorizēties</h1>
      </div>

			 
      <div class="modal-body p-5 pt-0">
        <form  action="" method="post">
          <div class="form-floating mb-3">
            <input type="email" name="email" class="form-control rounded-3" id="floatingInput" placeholder="Enter your email">
            <label for="floatingInput">Ievadiet epastu</label>
          </div>
          <div class="form-floating mb-3">
            <input type="password" name="password" class="form-control rounded-3" id="floatingPassword" placeholder="Enter your password">
            <label for="floatingPassword">Ievadiet paroli</label>
          </div>
					
          <button class="w-100 mb-2 btn btn-lg rounded-3 btn-primary" name="submit" type="submit">Login</button>
					<hr class="my-4">
        </form>
							<?php
				if(isset($error)){
						foreach($error as $error){
								echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
						};
				};
		?>
		<p>Vai jums nav konta? <a href="register.php">registrēties</a></p>
      </div>
    </div>
  </div>
</div>


  </body>
</html>
