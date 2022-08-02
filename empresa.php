<?php
    include_once('config/global.php');
    include_once('config/dbconnection.php');

    $data = get_company_data($_GET['id'], $con);
    $rutes_data = get_rutes_data($_GET['id'], $con);

    if(is_null($data))
        header('location:empresas.php');

        $title = "{$data['name']} - " . SITE_TITLE;
?>

<?php include_once('includes/header.php');?>

<div class="container">
   <!-- Title -->
   <figure class="text-center">
        <blockquote class="blockquote">
            <h1><?php echo $data['name']; ?></h1>
        </blockquote>
    </figure>
    <!-- Title end -->

    <!-- Carousel -->
   <div id="carouselExampleFade" class="carousel slide carousel-fade container-carousel" data-bs-ride="carousel">
        <div class="carousel-inner">

            <!-- Slides -->
            <div class="carousel-item active">
                <div class="carousel-item-text">
                    <span>
                        <h3>Descripción</h3>
                        <p><?php echo $data['description']; ?></p>
                    </span>
                </div>
                <img src="assets/images/buses.jpg" class="d-block w-100" alt="...">
            </div>

            <div class="carousel-item">
                <div class="carousel-item-text">
                    <span>
                        <h3>Número de Rutas Activas:</h3>
                        <p style="font-size: 48px !important; font-weight: bold; margin-top: -16px;"><?php echo count($rutes_data); ?></p>
                    </span>
                </div>
                <img src="assets/images/personas-bus.jpg" class="d-block w-100" alt="...">
            </div>
            <!-- End Slides -->

        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>

        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>

    </div>
    <!-- Carousel end -->

    <h2 style="text-align:center; margin: 24px 0 16px 0;">Rutas:</h2>

    <!-- Rutas -->
    <div class="row justify-content-center">

        <div class="col-6">
            <!-- Card -->
            <?php foreach($rutes_data as $index => $rute): ?>
                <?php
                    $paradas_query = mysqli_query($con,"SELECT s.id, rs.sequence AS sequence,s.name, s.created_at FROM rutes_stops AS rs
                        JOIN stops AS s ON s.id = rs.stops_id
                        WHERE rutes_id = {$rute[0]}
                        ORDER BY rs.sequence");

                    $paradas = mysqli_fetch_all($paradas_query);
                    $has_paradas = NULL;
                    $i = 0;
                ?>
                <div class="card text-bg-light mb-3">
                    <div class="row g-0 align-items-center">
                        <div class="col-md-6">
                            <img src="assets/images/bus-op.jpg" class="img-fluid rounded-start" alt="">
                        </div>
                        <div class="col-md-6">
                            <div class="card-body empresa-elements-container-text">
                                <h5 class="card-title text-center"><?php include('assets/icons/car-front.svg');?> Ruta #<?php echo $index + 1; ?></h5>
                                
                                <?php foreach($paradas as $i => $parada): ?>
                                    <?php $has_paradas = true; ?>

                                    <?php if($i==0): ?>
                                        <p class="card-text"><?php include('assets/icons/geo-alt.svg');?>
                                            <strong>Punto de inicio:</strong> <?php echo $parada[2]; ?>
                                        </p>
                                    <?php elseif($i == count($paradas)-1): ?>
                                        <p class="card-text"><?php include('assets/icons/geo-alt.svg');?>
                                            <strong>Punto de Final:</strong> <?php echo $parada[2]; ?>
                                        </p>
                                    <?php else: ?>
                                        <li><?php echo $parada[2]; ?></li>
                                    <?php endif; ?>
                                    
                                    <?php $i++; ?>
                                <?php endforeach; ?>

                                <?php if( is_null($has_paradas) ): ?>
                                    <strong>Paradas no agregadas</strong>
                                <?php endif; ?>
                                
                                <p class="text-end">
                                    <span class="empresa-elements-costo">
                                        <?php include('assets/icons/cash-coin.svg');?>
                                        Monto: 
                                    </span>
                                    <?php echo $rute[2]; ?> COP
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            <!-- End Card -->
        </div>
    </div>
    <!-- Rutas end -->
</div>

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

    // Function to get company rutes info is gonna be edit
    function get_rutes_data($company_id, $connection) {
        $query = "SELECT r.id, c.name AS company, r.cost, r.created_at FROM rutes AS r JOIN companies AS c ON r.company_id = c.id WHERE r.company_id = $company_id ORDER BY r.id DESC";
        $query = mysqli_query($connection, $query);

        $res = mysqli_fetch_all($query);

        return is_null($res) ? false : $res;
    }
    
    // Function to get company stops info is gonna be edit
    function get_stops_data($rute_id, $connection) {
        $query = "SELECT s.id, rs.sequence AS sequence,s.name, s.created_at FROM rutes_stops AS rs
            JOIN stops AS s ON s.id = rs.stops_id
            WHERE rutes_id = '$rute_id'
            ORDER BY rs.sequence";

        $query = mysqli_query($connection, $query);

        $res = mysqli_fetch_assoc($query);

        return is_null($res) ? false : $res;
    }