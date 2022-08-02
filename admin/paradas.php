<?php
    session_start();
    error_reporting(0);

    include_once('../config/global.php');
    include_once('../config/dbconnection.php');

    $title = "Paradas - " . SITE_TITLE;

    // Checks if there is a currently authenticated user, if not redirects to login
    if (strlen($_SESSION['tmsc_id'] == 0)):
        header('location:logout.php');
    else:
        $res = mysqli_query($con,"SELECT * FROM stops ORDER BY id DESC");

        // Check if all info of the user is right
        if(isset( $_POST['create_stop']) ) {
            $repopulate = !create_stop($_POST, $con);
        }

        // If user wants to delete a user
        if($_GET['del']){
            $stop_id = $_GET['id'];
            $query = "DELETE from stops WHERE id =$stop_id";
            mysqli_query($con, $query);
            echo "<script>alert('Parada eliminada satisfactoriamente!')</script>";
            echo "<script>window.location.href='paradas.php'</script>";
        }
?>

<?php include_once('includes/header.php');?>

<div>
<div class="admin_background"></div>
<div class="container"  style="margin-top: 15px;">
    <div class="row">

        <!-- DATA TABLE START -->
        <div class="col-12 mt-5">
            
            <!-- CARD START -->
            <div class="card">
                <div class="card-body">
                     <!-- title -->
                     <figure class="text-center">
                        <blockquote class="blockquote">
                            <h4 class="header-title">Manejador de Paradas</h4>
                        </blockquote>
                    </figure>
                    <!-- title end -->

                    <div class="search-form__submit-bttn text-end">
                        <button type="submit" value="Crear" class="btn mt-4 pr-4 pl-4" name="create_stop">Crear</button>
                    </div>


                    <div class="form-group" class="mb-4" style="margin-top: 5px; margin-bottom: 30px;">
                        <form action="#" method="POST" name="create_stop">
                            <label for="stops" style="margin-top: 5px; margin-bottom: 5px;">Crear nueva ruta:</label>
                            <input type="text" class="form-control" id="stops" name="stop" placeholder="Ingrese nombre de la parada" required="true">                            
                        </form>
                    </div>
                    
                    <div class="data-tables">
                        <table class="table text-center">
                            
                            <!-- TABLE HEAD -->
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Fecha de Creación</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <!-- TABLE END HEAD -->

                            <!-- TABLE BODY -->
                            <tbody>
                                <?php while ( $row = mysqli_fetch_array($res) ): ?>
                                    <tr data-expanded="true">
                                        <td><?php echo $row['id'];?></td>
                                        <td>
                                            <?php echo $row['name'];?>
                                        </td>
                                        <td><?php echo $row['creation_date'] ?? "2022-05-04";?></td>
                                        <td>
                                            <a href="editar-paradas.php?edit_id=<?php echo $row['id'];?>" class="btn btn-primary btn-xs">Edit</a>
                                            <a href="paradas.php?id=<?php echo $row['id']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')" class="btn btn-danger btn-xs">Delete</a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                            <!-- TABLE END BODY -->

                        </table>
                    </div>
                </div>
            </div>
            <!-- CARD END -->

        </div>
        <!-- DATA TABLE END -->

    </div>
</div>
</div>

<?php endif; ?>


<!-- ================================ -->
<!-- === Functions from this page === -->
<!-- ================================ -->
<?php

    // function to create (save) stops
    function create_stop($stop_data, $connection) {
        $name = $stop_data['stop'];

        // Insert into Database
        $query = mysqli_query($connection, "INSERT INTO stops (name) VALUES ('$name')");
        
        if ($query):
            echo '<script>alert("Parada creada exitosamente")</script>';
            echo "<script>window.location.href='paradas.php'</script>";
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