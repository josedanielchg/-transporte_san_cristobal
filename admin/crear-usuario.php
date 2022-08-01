<?php
    session_start();
    error_reporting(0);

    include_once('../config/global.php');
    include_once('../config/dbconnection.php');

    $title = "Usuarios - " . SITE_TITLE;

    // Checks if there is a currently authenticated user, if not redirects to login
    if (strlen($_SESSION['tmsc_id'] == 0)):
        header('location:logout.php');
    else:
        $repopulate = false; 
        
        $query_roles = mysqli_query($con,"SELECT * FROM roles");
        $roles = mysqli_fetch_all($query_roles, MYSQLI_ASSOC);

        // Check if all info of the user is right
        if(isset($_POST['create_user'])) {
            $repopulate = !user_created($_POST, $con);

            // If user was created then redirect back
            if( !$repopulate )
                header('location:usuarios.php');
        }
            
?>

<?php include_once('includes/header.php');?>

<div>
<div class="admin_background"></div>
<div class="container admin_form_container">
    <div class="row" >
        <!-- BASIC FORM START -->
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <!-- title -->
                    <figure class="text-center">
                        <blockquote class="blockquote">
                            <h4 class="header-title">Crear un Usuario</h4>
                        </blockquote>
                    </figure>
                    <!-- title end -->
                    
                    <form action="#" method="POST" name="create_user" class="row g-3 form-create_user">

                        <!-- Nombre -->
                        <div class="form-group col-md-6">
                            <label for="name">Nombre:</label>
                            <input type="text"
                                class="form-control" 
                                id="name" 
                                name="name" 
                                placeholder="Ingrese nombre" 
                                required="true"
                                value="<?php if($repopulate) echo $_POST['name'] ?>">
                        </div>

                        <!-- Apellido -->
                        <div class="form-group col-md-6">
                            <label for="lastname">Apellidos:</label>
                            <input type="text" 
                                class="form-control" 
                                id="lastname" 
                                name="lastname" 
                                placeholder="Ingrese apellido" 
                                required="true"
                                value="<?php if($repopulate) echo $_POST['lastname'] ?>">
                        </div>
                        
                        <!-- Username -->
                        <div class="form-group">
                            <label for="username">Nombre de usuario:</label>
                            <input type="text" 
                                class="form-control" 
                                id="username" 
                                name="username" 
                                placeholder="Ingrese nombre de usuario" 
                                required="true"
                                value="<?php if($repopulate) echo $_POST['username'] ?>"> 
                        </div>

                        <!-- Email -->
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" 
                                class="form-control" 
                                id="email" 
                                name="email" 
                                placeholder="Ingrese email" 
                                required="true"
                                value="<?php if($repopulate) echo $_POST['email'] ?>">
                        </div>
                        
                        <!-- Rol -->
                        <div class="form-group">
                            <label for="roles">Rol:</label>
                            <select name="roles" id="roles" class="form-select" >
                                <!-- Goes through all roles in db -->
                                <?php foreach ($roles as $role): ?>
                                    <option value="<?php echo $role['id'] ?>" 
                                        <?php if($repopulate && $_POST['roles'] == $role['id']) echo "selected"?>>
                                        <?php echo $role['name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div> 

                        <!-- Contrasena -->
                        <div class="form-group">
                            <label for="password">Contraseña:</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Ingrese la contraseña del usuario" value="" required="true">
                        </div>
                        
                        <div class="search-form__submit-bttn">
                            <button type="submit" value="Enviar" class="btn mt-4 pr-4 pl-4" name="create_user">Buscar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- basic form end -->
        
    </div>
</div>
</div>

<?php endif; ?>

<!-- TODO: Añadir footer aquí -->



<!-- ================================ -->
<!-- === Functions from this page === -->
<!-- ================================ -->
<?php

    // function to create (save) users
    function user_created($user_data, $connection) {
        $username = $user_data['username'];
        $name = $user_data['name'];
        $lastname = $user_data['lastname'];
        $email = $user_data['email'];
        $password = md5( $user_data['password'] );
        $role_id = $user_data['roles'];
        
        // Check if email provided is valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo '<script> alert("Invalid email"); </script>';
            return;
        }

        // Insert into Database
        $query = mysqli_query($connection, "INSERT INTO  users(username, email, password, role_id) value('$username','$email','$password','$role_id')");
        
        if ($query):
            echo '<script>alert("Usuario creado exitosamente")</script>';
            return true;
        else: 
            //Message of error to give feedback to users 
            $message = "Ocurrio un error Inesperado. Por favor intenta de nuevo!";
            foreach ($connection->error_list as $error)
                $message .= "\\n- " . $error["error"];

            echo '<script> alert("' . $message . '"); </script>';
            return false;
        endif;
    }