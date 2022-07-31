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

        //Check if all info of the user is right
        if(isset($_POST['update_company'])) {
            $repopulate = !company_update($_POST, $con);
        }

        $data = get_company_data($_GET['edit_id'], $con);
?>

<?php include_once('includes/header.php');?>

<div class="container">
    <div class="row">
        <!-- BASIC FORM START -->
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Editar compañia de transporte</h4>
                    <form action="#" method="POST" name="update_company">

                        <!-- Nombre -->
                        <div class="form-group">
                            <label for="name">Nombre:</label>
                            <input type="text"
                                class="form-control" 
                                id="name" 
                                name="name" 
                                placeholder="Ingrese nombre" 
                                required="true"
                                value="<?php if($repopulate) echo $_POST['name']; else echo $data['name']; ?>">
                        </div>

                        <!-- Descripcion -->
                        <div class="form-group">
                            <label for="description">Descripción:</label>
                            <textarea class="form-control" 
                                id="description" 
                                rows="4" 
                                name="description" 
                                placeholder="Ingrese una descripción" 
                                required><?php if($repopulate) echo $_POST['description']; else echo $data['description']; ?></textarea>
                        </div>

                        <input type="hidden" class="form-control" id="company_id" name="company_id" value="<?php echo $_GET['edit_id'] ?>" required="true">
                        
                        <input type="submit" value="Enviar" class="btn btn-primary mt-4 pr-4 pl-4" name="update_company">
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

    // Function to get company info is gonna be edit
    function get_company_data($company_id, $connection) {
        $query = "SELECT * FROM companies WHERE id = $company_id";
        $query = mysqli_query($connection, $query);

        $res = mysqli_fetch_assoc($query);

        return is_null($res) ? false : $res;
    }


    // Function to create (save) company
    function company_update($company_data, $connection) {
        $name = $company_data['name'];
        $description = $company_data['description'];
        $company_id = $company_data['company_id'];
        
        // Prepare query to update company
        $query= "UPDATE companies set name='$name', description='$description' where id=$company_id";
        $query = mysqli_query($connection, $query);

        if ($query){
            echo '<script>alert("Compañia actualizada exitosamente")</script>';
            echo "<script>window.location.href='companias.php'</script>";
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