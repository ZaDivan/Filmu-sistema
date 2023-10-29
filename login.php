<?php

require("db.php");

session_start();

if(isset($_POST['submit'])){

    $email = $_POST['email'];
    $pass = $_POST['password'];

    $result = $db->query(" SELECT * FROM users WHERE email = '$email' && password = '$pass' ");
    if($result->rowCount() > 0){

        $row = $result->fetch();

        if($row['role'] == '2'){

            $_SESSION['admin_name'] = $row['name'];
            header('location:admin_page.php');

        }elseif($row['role'] == '1'){

            $_SESSION['user_name'] = $row['name'];
            header('location:user_page.php');

        }

    }else{
        $error[] = 'incorrect email or password!';
    }

};
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login form</title>

    <!-- custom css file link  -->
    <link rel="stylesheet" href="style.css">

</head>
<body>

<div class="form-container">

    <form action="" method="post">
        <h3 id="login">Login now</h3>
        <?php
        if(isset($error)){
            foreach($error as $error){
                echo '<span class="error-msg">'.$error.'</span>';
            };
        };
        ?>
        <input type="email" name="email" required placeholder="enter your email">
        <input type="password" name="password" required placeholder="enter your password">
        <input type="submit" name="submit" value="login now" class="form-btn">
        <p>don't have an account? <a href="register.php">register now</a></p>
    </form>

</div>

</body>
</html>