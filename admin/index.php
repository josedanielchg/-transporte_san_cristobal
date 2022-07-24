<?php
    include_once('../config/global.php');

    $title = "Login - " . SITE_TITLE;
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
            <form action="#" class="login__form">

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
                    <input type="submit" value="Buscar" class="input__submit-bttn">
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