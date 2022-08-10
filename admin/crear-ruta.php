<?php
    session_start();
    // error_reporting(0);

    include_once('../config/global.php');
    include_once('../config/dbconnection.php');

    $title = "Crear Ruta - " . SITE_TITLE;

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
        if(isset($_POST['create_rute'])) {
            $repopulate = !rute_created($_POST, $con);
        }
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
                    <h4 class="header-title">Crear Ruta</h4>

                    <form action="#" method="POST" name="update_user">
                        <!-- Company -->
                        <div class="form-group">
                            <label for="name">Compañia:</label>
                            <select name="company_id" id="roles" class="form-select" >
                                <!-- Goes through all roles in db -->
                                <?php foreach ($companies as $company): ?>
                                    <option 
                                        value="<?php echo $company['id'] ?>" 
                                        <?php if( $repopulate && $_POST['company_id'] == $company['id'] ) echo "selected";
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
                                value="<?php if($repopulate) echo $_POST['cost']; ?>">
                        </div>

                        <!-- Parada de inicio -->
                        <div class="form-group">
                            <label for="start_point">Parada de inicio:</label>
                            <select name="start_point" id="start_point" class="form-select" required>
                                <?php foreach ($stops as $index => $stop): ?>
                                    <option 
                                        value="<?php echo $stop['id'] ?>" 
                                        <?php if( $repopulate && $_POST['start_point'] == $stop['id'] ) echo "selected";
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
                                        <?php if( $repopulate && $_POST['end_point'] == $stop['id'] ) echo "selected";
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
                                    >
                                    <?php echo $stop['name']; ?>
                                </label>
                                <br>
                            <?php endforeach; ?>
                        </div>

                        <input type="submit" value="Enviar" class="btn btn-primary mt-4 pr-4 pl-4" name="create_rute">
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
    // Function to update (save) rutes
    function rute_created($rute_data, $connection) {

        //Update main info in rutes table
        $query= "INSERT INTO rutes (company_id, cost) value('{$rute_data['company_id']}','{$rute_data['cost']}')";
        $query = mysqli_query($connection, $query);
        
        $query= "SELECT LAST_INSERT_ID();";
        $query = mysqli_query($connection, $query);
        $res = mysqli_fetch_assoc($query);

        $rute_data['rute_id'] = $res['LAST_INSERT_ID()'];

        //Insert rute start point
        $query= "INSERT INTO rutes_stops (rutes_id, stops_id, sequence) value('{$rute_data['rute_id']}','{$rute_data['start_point']}', '1')";
        $query = mysqli_query($connection, $query);

        //Insert rute intermediate points 
        if(is_array($rute_data['stops']))
            foreach($rute_data['stops'] as $index => $stop) {
                if($stop != $rute_data['start_point'] && $stop != $rute_data['end_point']) {
                    $sequence = $index + 2;
                    $query= "INSERT INTO rutes_stops (rutes_id, stops_id, sequence) value('{$rute_data['rute_id']}','$stop', '{$sequence}')";
                    $query = mysqli_query($connection, $query);
                }
            }

        //Insert rute end point
        $sequence = count($rute_data['stops']) + 2;
        $query= "INSERT INTO rutes_stops (rutes_id, stops_id, sequence) value('{$rute_data['rute_id']}','{$rute_data['end_point']}', '{$sequence}')";
        $query = mysqli_query($connection, $query);

        if ($query){
            echo '<script>alert("Ruta creada exitosamente")</script>';
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