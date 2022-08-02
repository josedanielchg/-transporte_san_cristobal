<?php
    session_start();
    // error_reporting(0);

    include_once('../config/global.php');
    include_once('../config/dbconnection.php');

    $title = "Paradas - " . SITE_TITLE;

    // Checks if there is a currently authenticated user, if not redirects to login
    if (strlen($_SESSION['tmsc_id'] == 0)):
        header('location:logout.php');
    else:
        $res = mysqli_query($con,"SELECT * FROM stops ORDER BY id DESC");
        $repopulate = false; 
        
        //Check if all info of the user is right
        if(isset($_POST['update_stop'])) {
            $repopulate = !stop_updated($_POST, $con);
        }

        $data = get_stop_data($_GET['edit_id'], $con);
?>

<?php include_once('includes/header.php');?>

<div class="container">
    <div class="row">
        <!-- BASIC FORM START -->
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Editar Usuario</h4>
                    <form action="#" method="POST" name="update_stop">
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

                        <input type="hidden" class="form-control" id="stop_id" name="stop_id" value="<?php echo $_GET['edit_id'] ?>" required="true">
                        
                        <input type="submit" value="Enviar" class="btn btn-primary mt-4 pr-4 pl-4" name="update_stop">
                    </form>
                </div>
            </div>
        </div>
        <!-- basic form end -->
        
    </div>
</div>

<?php endif; ?>


<!-- ================================ -->
<!-- === Functions from this page === -->
<!-- ================================ -->
<?php

    // Function to get info of user that is gonna be edit
    function get_stop_data($stop_id, $connection) {
        $query = "SELECT * FROM stops WHERE id = $stop_id";
        $query = mysqli_query($connection, $query);

        $res = mysqli_fetch_assoc($query);

        return is_null($res) ? false : $res;
    }


    // Function to create (save) users
    function stop_updated($stop_data, $connection) {
        $name = $stop_data['name'];
        $stop_id = $stop_data['stop_id'];

        // Prepare query to update user
        $query= "UPDATE stops set name='$name' where id=$stop_id";
        $query = mysqli_query($connection, $query);

        if ($query){
            echo '<script>alert("Parada actualizada exitosamente")</script>';
            echo "<script>window.location.href='paradas.php'</script>";
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