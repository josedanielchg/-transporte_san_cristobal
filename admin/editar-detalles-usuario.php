<?php
    session_start();
    // error_reporting(0);

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

        //Check if all info of the user is right
        if(isset($_POST['update_user'])) {
            $repopulate = !user_updated($_POST, $con);
        }

        $data = get_user_data($_GET['edit_id'], $con);
?>

<?php include_once('includes/header.php');?>

<div>
<div class="admin_background"></div>
<div class="container" style="margin-top: 15px;">
    <div class="row">
        <!-- BASIC FORM START -->
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <!-- title -->
                    <figure class="text-center">
                        <blockquote class="blockquote">
                            <h4 class="header-title">Editar Usuario</h4>
                        </blockquote>
                    </figure>
                    <!-- title end -->
                    
                    <form action="#" method="POST" name="update_user"  class="row g-3 form-create_user update_user">

                        <!-- Nombre -->
                        <div class="form-group">
                            <label for="name">Nombre:</label>
                            <input type="text"
                                class="form-control" 
                                id="name" 
                                name="name" 
                                placeholder="Ingrese nombre" 
                                required="true"
                                value="<?php if($repopulate) echo $_POST['name']; else echo $data['name'] ?? ''; ?>">
                        </div>

                        <!-- Apellido -->
                        <div class="form-group">
                            <label for="lastname">Apellidos:</label>
                            <input type="text" 
                                class="form-control" 
                                id="lastname" 
                                name="lastname" 
                                placeholder="Ingrese apellido" 
                                required="true"
                                value="<?php if($repopulate) echo $_POST['lastname']; else echo $data['lastname'] ?? '';  ?>">
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
                                value="<?php if($repopulate) echo $_POST['username']; else echo $data['username']; ?>"> 
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
                                value="<?php if($repopulate) echo $_POST['email']; else echo $data['email']; ?>">
                        </div>
                        
                        <!-- Rol -->
                        <div class="form-group">
                            <label for="roles">Rol:</label>
                            <select name="roles" id="roles" class="form-select" >
                                <!-- Goes through all roles in db -->
                                <?php foreach ($roles as $role): ?>
                                    <option 
                                        value="<?php echo $role['id'] ?>" 
                                        <?php 
                                            if( $repopulate && $_POST['roles'] == $role['id'] )
                                                echo "selected";
                                            elseif( $data['role_id'] == $role['id'] )
                                                echo "selected";
                                    ?>>
                                        <?php echo $role['name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div> 

                        <!-- Old Contrasena -->
                        <div class="form-group">
                            <label for="current_password">Contraseña Actual:</label>
                            <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Ingrese la contraseña actual del usuario" value="" required="true">
                        </div>
                        
                        <!-- Contrasena -->
                        <div class="form-group">
                            <label for="new_password">Contraseña Nueva:</label>
                            <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Ingrese la contraseña nueva del usuario" value="" required="true">
                        </div>

                        <input type="hidden" class="form-control" id="user_id" name="user_id" value="<?php echo $_GET['edit_id'] ?>" required="true">
                        
                        <div class="search-form__submit-bttn text-center">
                            <button type="submit" value="Enviar" class="btn mt-4 pr-4 pl-4" name="update_user">Enviar</button>
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


<!-- ================================ -->
<!-- === Functions from this page === -->
<!-- ================================ -->
<?php

    // Function to get info of user that is gonna be edit
    function get_user_data($user_id, $connection) {
        $query = "SELECT * FROM users WHERE id = $user_id";
        $query = mysqli_query($connection, $query);

        $res = mysqli_fetch_assoc($query);

        return is_null($res) ? false : $res;
    }


    // Function to create (save) users
    function user_updated($user_data, $connection) {
        $username = $user_data['username'];
        $name = $user_data['name'];
        $lastname = $user_data['lastname'];
        $email = $user_data['email'];
        $role_id = $user_data['roles'];
        $user_id = $user_data['user_id'];
        
        $current_password = md5( $user_data['current_password'] );
        $new_password = md5( $user_data['new_password'] );
        
        // Check if email provided is valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo '<script> alert("Invalid email"); </script>';
            return;
        }

        // Insert into Database
        $query = "SELECT * FROM users WHERE password = '$current_password' AND id = $user_id";
        $query = mysqli_query($connection, $query);

        $res = mysqli_fetch_assoc($query);

        if(is_null($res)) {
            echo '<script>alert("Contraseña incorrecta")</script>';
            return true;
        }

        // Prepare query to update user
        $query= "UPDATE users set name='$name', lastname='$lastname', username='$username', email='$email', password='$new_password', role_id='$role_id' where id=$user_id";
        $query = mysqli_query($connection, $query);

        if ($query){
            echo '<script>alert("Usuario actualizado exitosamente")</script>';
            echo "<script>window.location.href='usuarios.php'</script>";
            return true;
        } else {
            //Message of error to give feedback to users 
            $message = "Ocurrio un error Inesperado. Por favor intenta de nuevo!";
            foreach ($connection->error_list as $error)
                $message .= "\\n- " . $error["error"];

            echo '<script> alert("' . $message . '"); </script>';
            return false;
        } 
    }