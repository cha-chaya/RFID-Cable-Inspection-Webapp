<?php 
    session_start();
include('server.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page : RFID THESIS </title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Kanit|Playfair+Display|Prompt&display=swap" rel="stylesheet">
    <style>
    h1 { font-family: 'Kanit', sans-serif}
	label { font-family: 'Playfair Display', serif;}
    h3 { font-family: 'Prompt', sans-serif;}
	div { font-family: 'Playfair Display', sans-serif;}

    </style>
</head>
<body>
    <form action="register_db.php" method="post" >
    <?php if (isset($_SESSION['error'])) : ?>
            <div class="error" >
                <h3>
                    <?php
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    ?>
        
                </h3>

            </div>
        <?php endif ?>
        <?php include('errors.php'); ?>
        <div class="container ">
        <div class="row">
                <div class="col-md-8 mx-auto mt-5">
                    <div class = "card">
                    <form action="" method="POST" >
                    <div class = "card-header text-center "> Register Your Account </div>
        <div class = "card-body "> 
            <div class = "form-group row">
                <label for="username" class="col-sm-3 col-form-label" >Username</label>
                    <div class="col-sm-9" > 
                    <input type="text" class ="form-control" id = "username"  name="username" >
                    </div>
                    </div>
            <div class = "form-group row">
                <label for="email" class="col-sm-3 col-form-label" >Email</label>
                    <div class="col-sm-9" > 
                    <input type="email" class ="form-control" id = "email" name="email" >
                    </div>
                     </div>
            <div class = "form-group row">
                <label for="password_1" class="col-sm-3 col-form-label" >Password</label>
                    <div class="col-sm-9" > 
                    <input type="password" class ="form-control" id = "password_1" name="password_1" >
                    </div>
                    </div>
            <div class = "form-group row">
            <label for="password_2" class="col-sm-3 col-form-label" >Confirm Password</label>
                <div class="col-sm-9" >
                <input type="password" class ="form-control" id = "password_2" name="password_2" >
                </div>
            </div>
            <p class="text-center"> Already a member? <a href="login.php">Sign in </a></p>
            </div>
            <div class = "card-footer text-center ">
            <input type = "submit" name="reg_user" class = "btn btn-success" value = "Register" >  
    </form>
    </div>
    </div>
    </div>  
    </form>
    <script src = "node_modules/jquery/dist/jquery.min.js" > </script>
    <script src = "node_modules/bootstrap/dist/js/bootstrap.min.js" > </script>
    <script src = "node_modules/popper.js/dist/umd/popper.min.js" > </script>
</body>
</html>