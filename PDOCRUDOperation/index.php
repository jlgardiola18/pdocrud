<?php 

session_start();

try {
    require_once("dbconfig.php");
    if(isset($_POST['login'])){

        if(empty($_POST['username']) || empty($_POST['password'])){
            $message = "All fields are required";
        }else{
            $sql = "SELECT * FROM tbladmin WHERE username =:username AND password =:password";
            $userrow=$dbh->prepare($sql);
            $userrow->execute(
                array(
                    'username' => $_POST['username'],
                    'password' => $_POST['password']
                )
            );
            $count = $userrow->rowCount();
            if($count > 0 ){
                foreach($userrow as $result);
                $_SESSION['userid'] = $result['ID'];
                header('location: dashboard.php');
            }else{
                $message = "Wrong Username or Password!";
            }
        }

    }
}catch(\Throwable $error){
    $message->$error->getMessage();
}

?>



<!DOCTYPE html>
<html lang="en">
<head>

    <title>Login Form</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">

</head>
<body class="hold-transition login-page">

    <div class="login-box">
    
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="#" class="h1">Admin Login</a>
            </div>
        <div class="card-body">
            
        <p class="login-box-msg">Sign in to start your session</p>

        <form method="POST">

            <div class="input-group mb-3">
                <input type="text" class="form-control" name="username" placeholder="Username">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
            </div>

            <div class="input-group mb-3">
                <input type="password" class="form-control" name="password" placeholder="Password">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>

            <div class="row">

            <div class="col-8">
                <div class="icheck-primary">
                <input type="checkbox" id="remember">
                    <label for="remember">
                        Remember Me
                    </label>
                </div>
            </div>
           
            <div class="col-4">
                <button type="submit" name="login" class="btn btn-primary btn-block">Sign In</button>
            </div>
            
            </div>
        </form>

            <div class="social-auth-links text-center mt-2 mb-3">
                <a href="#" class="btn btn-block btn-primary">
                <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                </a>
                <a href="#" class="btn btn-block btn-danger">
                <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                </a>
            </div>
        
            <p class="mb-1">
                <a href="#">I forgot my password</a>
            </p>
            <p class="mb-0">
                <a href="#" class="text-center">Register a new membership</a>
            </p>
        </div>
        
        </div>
   
        <?php
            if(isset($message)){
            echo '<div class="alert alert-danger social-auth-links text-center mt-2 mb-3">'.$message.'</div>';
            }
        ?>
        
    </div>
    
    <script src="plugins/jquery/jquery.min.js"></script>
    
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    
    <script src="dist/js/adminlte.min.js"></script>
 
</body>
</html>