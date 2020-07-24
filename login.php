<?php 
session_start();
include('server.php'); 
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login : RFID THESIS </title>
        <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="style.css">
        <link href="https://fonts.googleapis.com/css?family=Kanit|Playfair+Display|Prompt&display=swap" rel="stylesheet">
        <style>
        h1 { 
            font-family: 'Kanit', sans-serif;
            font-weight: bold;   
        }
        label { 
            font-family: 'Playfair Display', serif;
            font-weight: bold;
            
        }
        h3 { 
            font-family: 'Prompt', sans-serif;
            font-weight: bold;
        }
        div { 
            font-family: 'Playfair Display', sans-serif;
            font-weight: bold;
        }
        </style>

    </head>
    <body>   
        <form action="login_db.php" method = "post">
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
            <div class="container ">
                <div class="row">
                    <div class="col-md-8 mx-auto mt-5">
                            <div class = "card">
                            <form action="" method="POST" >
                            <div class = "card-header text-center "> Login to Your Account 
                            </div>
                        <div class = "card-body "> 
                            <div class = "form-group row">
                                <label for="username" class="col-sm-3 col-form-label" >Username</label>
                                <div class="col-sm-9" >
                                    <input type="text" class ="form-control" id = "username"  name="username" >
                                </div>
                            </div>
                        <div class = "form-group row">
                            <label for="password" class=" col-sm-3 col-form-label" >Password</label>
                                <div class="col-sm-9" > 
                                    <input type="password" class ="form-control" id = "password" name="password" >
                                </div>
                        </div>
                            <p class="text-center"> Not yet a member? <a href="register.php">Sign up </a></p>
                        <div class = "card-footer text-center ">
                            <input type = "submit" name="login_user" class = "btn btn-success" value = "Login" ></input>
                        </div>      
                    </div>
                </div>
            </div>       
    </form>
    <script src = "node_modules/jquery/dist/jquery.min.js" > </script>
    <script src = "node_modules/bootstrap/dist/js/bootstrap.min.js" > </script>
    <script src = "node_modules/popper.js/dist/umd/popper.min.js" > </script>

</body>
</html>