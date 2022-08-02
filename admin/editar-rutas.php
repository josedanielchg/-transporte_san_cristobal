<?php
    session_start();
    error_reporting(0);

    include_once('../config/global.php');
    include_once('../config/dbconnection.php');

    $title = "Editar Ruta - " . SITE_TITLE;

    // Checks if there is a currently authenticated user, if not redirects to login
    if (strlen($_SESSION['tmsc_id'] == 0)):
        header('location:logout.php');
    else:
        $repopulate = false; 
        
        $query_company = mysqli_query($con,"SELECT * FROM companies");
        $companies = mysqli_fetch_all($query_company, MYSQLI_ASSOC);

        $query_stops = mysqli_query($con,"SELECT * FROM stops");
        $stops = mysqli_fetch_all($query_stops, MYSQLI_ASSOC);

        //Check if all info of the user is right
        if(isset($_POST['update_rute'])) {
            $repopulate = !rute_update($_POST, $con);
        }

        $rute_data = get_rute_data($_GET['edit_id'], $con);
        $rute_stops_data = get_stops_by_rute_id($_GET['edit_id'], $con);

        $rute_stops_ids = [];

        if( count($rute_stops_data) > 0 ) {
            foreach($rute_stops_data as $index => $stop) {
                if( $index != 0 && $index != count($rute_stops_data)-1 )
                    array_push($rute_stops_ids, $stop[0]);
            }
        }
?>

<?php include_once('includes/header.php');?>

<div>
<div class="admin_background"></div>
<div class="container">
    <div class="row">
        <!-- BASIC FORM START -->
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Editar Ruta</h4>

                    <form action="#" method="POST" name="update_user">
                        <!-- Company -->
                        <div class="form-group">
                            <label for="name">Compañia:</label>
                            <select name="company_id" id="roles" class="form-select" >
                                <!-- Goes through all roles in db -->
                                <?php foreach ($companies as $company): ?>
                                    <option 
                                        value="<?php echo $company['id'] ?>" 
                                        <?php 
                                            if( $repopulate && $_POST['company_id'] == $company['id'] )
                                                echo "selected";
                                            elseif( $rute_data['company_id'] == $company['id'] )
                                                echo "selected";
                                    ?>>
                                        <?php echo $company['name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Costo -->
                        <div class="form-group">
                            <label for="cost">Costo:</label>
                            <input type="number" 
                                class="form-control" 
                                id="cost" 
                                name="cost" 
                                placeholder="Ingrese costo del pasaje" 
                                required="true"
                                value="<?php if($repopulate) echo $_POST['cost']; else echo $rute_data['cost'] ?? '';  ?>">
                        </div>

                        <!-- Parada de inicio -->
                        <div class="form-group">
                            <label for="start_point">Parada de inicio:</label>
                            <select name="start_point" id="start_point" class="form-select" required>
                                <?php foreach ($stops as $index => $stop): ?>
                                    <option 
                                        value="<?php echo $stop['id'] ?>" 
                                        <?php 
                                            if( $repopulate && $_POST['start_point'] == $stop['id'] )
                                                echo "selected";
                                            elseif(isset($rute_stops_data[0][0]))
                                                if( $rute_stops_data[0][0] == $stop['id'] )
                                                    echo "selected";
                                    ?>>
                                        <?php echo $stop['name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Parada final -->
                        <div class="form-group">
                            <label for="end_point">Parada final:</label>
                            <select name="end_point" id="end_point" class="form-select" required>
                                <?php foreach ($stops as $index => $stop): ?>
                                    <option 
                                        value="<?php echo $stop['id'] ?>" 
                                        <?php 
                                            if( $repopulate && $_POST['end_point'] == $stop['id'] )
                                                echo "selected";
                                            elseif(isset($rute_stops_data[0][0]))
                                                if( $rute_stops_data[count($rute_stops_data)-1][0] == $stop['id'] )
                                                    echo "selected";
                                    ?>>
                                        <?php echo $stop['name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Paradas -->
                        <div class="form-group">
                            <label for="cost">Paradas Intermedias:</label>
                            <br>
                            <?php foreach ($stops as $index => $stop): ?>
                                <label for="stop-<?php echo $index; ?>">
                                    <input type="checkbox" name="stops[]" 
                                        id="stop-<?php echo $index; ?>" 
                                        value="<?php echo $stop['id']; ?>"
                                        <?php if( in_array($stop['id'], $rute_stops_ids) ) echo "checked"; ?>
                                    >
                                    <?php echo $stop['name']; ?>
                                </label>
                                <br>
                            <?php endforeach; ?>
                        </div>

                        <input type="hidden" class="form-control" id="user_id" name="rute_id" value="<?php echo $_GET['edit_id'] ?>" required="true">
                        
                        <input type="submit" value="Enviar" class="btn btn-primary mt-4 pr-4 pl-4" name="update_rute">
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

    // Function to get info of user that is gonna be edit
    function get_rute_data($rute_id, $connection) {
        $query = "SELECT * FROM rutes WHERE id = $rute_id";
        $query = mysqli_query($connection, $query);

        $res = mysqli_fetch_assoc($query);

        return is_null($res) ? false : $res;
    }


    // Function to get stops data from the rute that is gonna be edit
    function get_stops_by_rute_id($rute_id, $connection) {
        $query = "SELECT s.id, rs.sequence AS sequence,s.name, s.created_at FROM rutes_stops AS rs JOIN stops AS s ON s.id = rs.stops_id WHERE rutes_id = '$rute_id' ORDER BY rs.sequence";
        $query = mysqli_query($connection, $query);

        $res = mysqli_fetch_all($query);
        
        return is_null($res) ? false : $res;
    }

    // Function to update (save) rutes
    function rute_update($rute_id, $connection) {

        //Update main info in rutes table
        $query= "UPDATE rutes set company_id='{$rute_id['company_id']}', cost='{$rute_id['cost']}' where id={$rute_id['rute_id']}";
        $query = mysqli_query($connection, $query);

        //First Delete all rute stops
        $query = "DELETE from rutes_stops where rutes_id = {$rute_id['rute_id']}";
        $query = mysqli_query($connection, $query);
        
        //Update rute start point
        $query= "INSERT INTO rutes_stops (rutes_id, stops_id, sequence) value('{$rute_id['rute_id']}','{$rute_id['start_point']}', '1')";
        $query = mysqli_query($connection, $query);

        //Update rute intermediate points 
        if(is_array($rute_id['stops']))
            foreach($rute_id['stops'] as $index => $stop) {
                if($stop != $rute_id['start_point'] && $stop != $rute_id['end_point']) {
                    $sequence = $index + 2;
                    $query= "INSERT INTO rutes_stops (rutes_id, stops_id, sequence) value('{$rute_id['rute_id']}','$stop', '{$sequence}')";
                    $query = mysqli_query($connection, $query);
                }
            }

        //Update rute end point
        $sequence = count($rute_id['stops']) + 2;
        $query= "INSERT INTO rutes_stops (rutes_id, stops_id, sequence) value('{$rute_id['rute_id']}','{$rute_id['end_point']}', '{$sequence}')";
        $query = mysqli_query($connection, $query);

        if ($query){
            echo '<script>alert("Ruta actualizada exitosamente")</script>';
            echo "<script>window.location.href='rutas.php'</script>";
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