<?php
    session_start();
    error_reporting(0);

    include_once('../config/global.php');
    include_once('../config/dbconnection.php');

    $title = "Login - " . SITE_TITLE;
    
    // Validate login data
    if(isset($_POST['login']))
    {
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $query = mysqli_query($con,"SELECT id FROM users WHERE username='$username' && password='$password' ");
        $res = mysqli_fetch_array($query);

        //If user credentials are right, then redirect
        if($res>0){
            $_SESSION['tmsc_id'] = $res['id'];
            header('location:comentarios.php');
        }
        else{
            $login_error = true;
        }
    }

    $menu_not_required = true;
?>

<?php include_once('includes/header.php');?>

<div class="login-container">
    <!-- Login -->
    <!-- Login Body -->
    <div class="row justify-content-center login__body">
        <!-- Login Header -->
        <div class="col-12 login__body-col">
            <div class="go-back">
                <p>
                    <a href="../index.php"  style="font-size: 10px;" ><?php include('../assets/icons/arrow-left.svg');?> Volver</a>
                </p>
            </div>
            <div class="login_header text-center"  style="margin: 40px;">
                <h1 class="login__title">
                    <?php echo SITE_TITLE; ?>
                </h1>
                <p>Inicia Sesión para empezar a administrar la plataforma</p>
            </div>
            <!-- form -->
            <form class="row g-3 login__form" action="#" method="POST" name="login">
                <!-- Usename input -->
                <div class="col-md-12">
                    <label for="username" class="form-label"><?php include('../assets/icons/person-circle.svg');?> Username:</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                </div>
                <!-- Password input -->
                <div class="col-md-12">
                    <label for="password" class="col-form-label"><?php include('../assets/icons/key.svg');?> Password:</label>
                    <input type="password" id="password" class="form-control" name="password" placeholder="Password">
                </div>
                <div class="col-12  text-center">
                    <button type="submit" class="btn btn-outline-light" name="login">Acceso</button>
                </div>
            </form>
            <!-- form end -->
        </div>
    </div>
    <!-- End Login -->
</div>


<!-- If user credentials are wrong then display error message -->
<?php if( isset($login_error) ): ?>
    <script>
        alert("Invalid Detail. Please try again");
    </script>
<?php endif; ?>