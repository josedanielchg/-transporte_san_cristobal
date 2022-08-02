<?php
    include_once('config/global.php');
    include_once('config/dbconnection.php');

    $title = "Home - " . SITE_TITLE;

    $stops = mysqli_query($con,"SELECT * FROM stops ORDER BY id DESC");

    $repopulate = false;
    $results = null;

    //Check if all info of the user is right
    if(isset($_POST['search_rutes'])) {
        $results = get_rutes_by_stops($_POST, $con);
        $repopulate = true;
    }

?>

<?php include_once('includes/header.php');?>

<div id='home'>
    <img src="assets/images/mapa.png" alt="" class="background-index">
    <div class="container">
        <div class="row justify-content-center" style="padding: 40px; margin: 0px;">
            <div class="col-4">
                <!-- Search Container -->
                <div class="search-form__form-container">
                    <div class="card" style="margin: 0px; background: rgba(255, 255, 255, 0); border: none">
                        <!-- Search Header -->
                        <div class="card-header" style="background: #1C0764;">
                            <h4 style="color: white; padding: 0px; margin: 0px;">Escribe tú ruta:</h4> 
                        </div>
                        <!-- Search Body -->
                        <div class="card-body">
                            <form action="#" method="POST" name="search_rutes">
                                <!-- Tipo de destino -->
                                <div class="mb-3 search-form__icon">
                                    <label class="form-label" for="stop_type"><?php include('assets/icons/geo-alt.svg');?> Tipo de Destion:</label>

                                    <select class="form-select search-form__select-stop" name="stop_type" id="stop_type">
                                        <option value="1" <?php if($repopulate && $_POST['stop_type'] == 1) echo "selected";?>>Punto de inicio</option>
                                        <option value="2" <?php if($repopulate && $_POST['stop_type'] == 2) echo "selected";?>>Punto intermedio</option>
                                        <option value="3" <?php if($repopulate && $_POST['stop_type'] == 3) echo "selected";?>>Punto final</option>
                                    </select>
                                </div>
                             
                                <!-- Parada Select -->
                                <div class="mb-3 search-form__icon">
                                    <label class="form-label" for="stop"><?php include('assets/icons/geo-alt.svg');?> Paradas:</label>
                                    <select class="form-select search-form__select-stop" id="stop" name="stop_id">
                                        <?php while ( $row = mysqli_fetch_array($stops) ): ?>
                                            <option value="<?php echo $row['id'];?>"
                                                <?php if($repopulate && $_POST['stop_id'] == $row['id']) echo "selected";?>
                                            >
                                                <?php echo $row['name']; ?>
                                            </option>
                                        <?php endwhile; ?>
                                    </select>

                                </div>
                                <div class="text-center search-form__submit-bttn">
                                    <input type="submit" value="Buscar" class="btn" name="search_rutes">
                                </div>
                            </form>
                        </div>
                    </div>  
                </div>
            </div>

            <div class="col-6" >
                <!-- Results -->
                <div class="results__item-container">
                    <!-- results__tittle -->
                    <div class="results__tittle">
                        <h3> Resultados: </h3>
                    </div>
                    <!-- Start Results items -->
                    <?php if(!is_null($results)): ?>
                        <?php foreach($results as $result): ?>
                            <div class="card">
                                <div class="results__item">
                                    <h5><?php include('assets/icons/car-front.svg');?> Ruta #<?php echo $result['rutas_info']['id'] ?></h5>
                                    <h6>Empresa: <?php echo $result['rutas_info']['company'] ?></h6>

                                    <!-- Print stops -->
                                    <?php foreach($result['stops_info'] as $index => $stop): ?>
                                        <?php if($index == 0): ?>
                                            <p class="results__item-puntosDe"><?php include('assets/icons/geo-alt.svg');?> <strong>Punto de inicio</strong>: <?php echo $stop[2]; ?></p>
                                        <?php elseif(count($result['stops_info']) == $index + 1): ?>
                                            <p class="results__item-puntosDe"><?php include('assets/icons/geo-alt.svg');?> <strong>Punto final</strong>: <?php echo $stop[2]; ?></p>
                                        <?php else: ?>
                                            <li><?php echo $stop[2]; ?></li>
                                        <?php endif; ?>
                                    <?php endforeach; ?>

                                    <p class="text-end"><span class="empresa-elements-costo"><?php include('assets/icons/cash-coin.svg');?> Costo:</span> <?php echo $result['rutas_info']['cost'] ?> COP</p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php elseif($repopulate): ?>
                        <strong>No se han encontrado rutas disponibles</strong>
                    <?php else: ?>
                        <strong>Por favor introduce el tipo de destino y parada</strong>
                    <?php endif; ?>

                    <!-- End Results items-->
                </div>  
                <!-- End Results -->
            </div>
        </div>
    </div>
</div>


<!-- ================================ -->
<!-- === Functions from this page === -->
<!-- ================================ -->
<?php

    // Function to get company rutes info is gonna be edit
    function get_rutes_by_stops($data, $connection) {

        /**
         * 1 = Punto de inicio
         * 2 = Punto intermedio
         * 3 = Punto final
         */
        $stop_type = $data['stop_type'];
        $valid_rutes = [];
        
        

        // Function to get info of user that is gonna be edit
        $query = "SELECT r.id AS rute_id, rs.sequence,r.cost, r.created_at FROM rutes_stops AS rs
            JOIN rutes AS r ON r.id = rs.rutes_id
            WHERE stops_id = {$data['stop_id']}";
        $query = mysqli_query($connection, $query);

        // Get all rutes
        $rutes = mysqli_fetch_all($query);
        
        foreach ($rutes as $rute) {
            $query = "SELECT COUNT(*) AS total FROM rutes_stops AS rs
                JOIN stops AS s ON s.id = rs.stops_id
                WHERE rutes_id = '{$rute[0]}'
                ORDER BY rs.sequence";
            $query = mysqli_query($connection, $query);
            $stops_number = mysqli_fetch_assoc($query);

            // echo '<pre>';
            // var_dump($stop_type);
            // var_dump($rute);
            // var_dump($stops_number['total']);
            // echo '</pre>';

            if(
                ($stop_type == 1 && $rute[1] == 1) || //Punto inicial
                ($stop_type == 3 && $rute[1] == $stops_number['total']) || //Punto final
                ($stop_type == 2 && $rute[1] < $stops_number['total']) //Punto intermedio
            ) {
                //Get all stops from a rute
                $query = "SELECT s.id, rs.sequence AS sequence,s.name, s.created_at FROM rutes_stops AS rs JOIN stops AS s ON s.id = rs.stops_id WHERE rutes_id = '{$rute[0]}' ORDER BY rs.sequence";
                $query = mysqli_query($connection, $query);
                $stops_data = mysqli_fetch_all($query);

                //Get all rute info by id
                $query = "SELECT r.id, c.name AS company, r.cost, r.created_at FROM rutes AS r JOIN companies AS c ON r.company_id = c.id WHERE r.id = {$rute[0]} ORDER BY r.id DESC";
                $query = mysqli_query($connection, $query);
                $rute_info = mysqli_fetch_assoc($query);

                array_push($valid_rutes, [
                    'rutas_info' => $rute_info,
                    'stops_info' => $stops_data
                ]);
            }
        }

        return (count($valid_rutes) > 0) ? $valid_rutes : null; 
    }

    // Convert a multi-dimensional array into a single-dimensional array.
    function array_flatten($array) { 
        if (!is_array($array)) { 
          return false; 
        } 
        $result = array(); 
        foreach ($array as $key => $value) { 
          if (is_array($value)) { 
            $result = array_merge($result, array_flatten($value)); 
          } else { 
            $result = array_merge($result, array($key => $value));
          } 
        } 
        return $result; 
      }