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
            header('location:dashboard.php');
        }
        else{
            $login_error = true;
        }
    }
?>

<?php include_once('includes/header.php');?>

<div class="container">

    <!-- Login -->
    <div class="login">

        <!-- Login Header -->
        <div class="login_header">
            <h2 class="login__title">
                <?php echo SITE_TITLE; ?>
            </h2>

            <h4>Inicia Sesión para empezar a administrar la plataforma</h4>
        </div>

        <!-- Login Body -->
        <div class="login__body">
            <form action="#" method="POST" class="login__form" name="login">

                <!-- Usename input -->
                <div class="login__input-container">
                    <label for="username">
                        <span class="login__icon">[icon] Username:</span>
                        <input type="text" name="username" id="username" placeholder="Username">
                    </label>
                </div>

                <!-- Password input -->
                <div class="login__input-container">
                    <label for="password">
                        <span class="login__icon">[icon] password:</span>
                        <input type="text" name="password" id="password" placeholder="Password">
                    </label>
                </div>

                <div class="login__input-container">
                    <input type="submit" value="Buscar" class="input__submit-bttn" name="login">
                </div>

            </form>
        </div>

    </div>
    <!-- End Login -->
    
    <div class="go-back">
        <h3>
            <a href="../index.php">Volver a la Página Principal</a>
        </h3>
    </div>
</div>

<!-- If user credentials are wrong then display error message -->
<?php if( isset($login_error) ): ?>
    <script>
        alert("Invalid Detail. Please try again");
    </script>
<?php endif; ?>