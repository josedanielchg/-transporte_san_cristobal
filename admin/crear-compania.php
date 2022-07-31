<?php
    session_start();
    error_reporting(0);

    include_once('../config/global.php');
    include_once('../config/dbconnection.php');

    $title = "Crear Compañia - " . SITE_TITLE;

    // Checks if there is a currently authenticated user, if not redirects to login
    if (strlen($_SESSION['tmsc_id'] == 0)):
        header('location:logout.php');
    else:
        $repopulate = false; 
        
        $query_roles = mysqli_query($con,"SELECT * FROM roles");
        $roles = mysqli_fetch_all($query_roles, MYSQLI_ASSOC);

        // Check if all info of the user is right
        if(isset($_POST['create_company'])) {
            $repopulate = !company_created($_POST, $con);

            // If user was created then redirect back
            if( !$repopulate )
                header('location:companias.php');
        }
            
?>

<?php include_once('includes/header.php');?>

<div class="container">
    <div class="row">
        <!-- BASIC FORM START -->
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Crear una compañia de transporte</h4>
                    <form action="#" method="POST" name="create_company">

                        <!-- Nombre -->
                        <div class="form-group">
                            <label for="name">Nombre:</label>
                            <input type="text"
                                class="form-control" 
                                id="name" 
                                name="name" 
                                placeholder="Ingrese nombre" 
                                required="true"
                                value="<?php if($repopulate) echo $_POST['name'] ?>">
                        </div>

                        <!-- Descripcion -->
                        <div class="form-group">
                            <label for="description">Descripción:</label>
                            <textarea class="form-control" 
                                id="description" 
                                rows="4" 
                                name="description" 
                                placeholder="Ingrese una descripción" 
                                required><?php if($repopulate) echo $_POST['description'] ?></textarea>
                        </div>
                        
                        <input type="submit" value="Enviar" class="btn btn-primary mt-4 pr-4 pl-4" name="create_company">
                    </form>
                </div>
            </div>
        </div>
        <!-- basic form end -->
        
    </div>
</div>

<?php endif; ?>

<!-- TODO: Añadir footer aquí -->



<!-- ================================ -->
<!-- === Functions from this page === -->
<!-- ================================ -->
<?php

    // function to create (save) company
    function company_created($user_data, $connection) {
        $name = $user_data['name'];
        $description = $user_data['description'];
        
        // Insert into Database
        $query = mysqli_query($connection, "INSERT INTO  companies (name, description) value('$name','$description')");
        
        if ($query):
            echo '<script>alert("Compañia creada exitosamente")</script>';
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