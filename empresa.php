<?php
    include_once('config/global.php');

    // TODO: change "Empresa" in title from the actual name of the company with php dynamically
    $title = "Empresa - " . SITE_TITLE;
?>

<?php include_once('includes/header.php');?>

<div class="container">
   <!-- TODO: Add all HTML to this Page -->
   <!-- title -->
   <figure class="text-center">
        <blockquote class="blockquote">
            <h1>Titulo</h1>
        </blockquote>
    </figure>
    <!-- title end -->

    <!-- carousel -->
   <div id="carouselExampleFade" class="carousel slide carousel-fade container-carousel" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="carousel-item-text">
                    <span>
                        <h3>Third slide label</h3>
                        <p>Some representative placeholder content for the third slide.</p>
                    </span>
                </div>
                <img src="assets/images/bus-op.jpg" alt="...">
            </div>

            <div class="carousel-item">
                <div class="carousel-item-text">
                    <span>
                        <h3>Third slide label</h3>
                        <p>Some representative placeholder content for the third slide.</p>
                    </span>
                </div>
                <img src="assets/images/buses.jpg" class="d-block w-100" alt="...">
            </div>

            <div class="carousel-item">
                <div class="carousel-item-text">
                    <span>
                        <h3>Third slide label</h3>
                        <p>Some representative placeholder content for the third slide.</p>
                    </span>
                </div>
                <img src="assets/images/personas-bus.jpg" class="d-block w-100" alt="...">
            </div>
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
    <!-- carousel end -->

    <!-- elements -->
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card text-bg-light mb-3">
                <div class="row g-0 align-items-center">
                    <div class="col-md-6">
                        <img src="assets/images/bus-op.jpg" class="img-fluid rounded-start" alt="">
                    </div>
                    <div class="col-md-6">
                    <div class="card-body empresa-elements-container-text">
                        <h5 class="card-title text-center"><?php include('assets/icons/car-front.svg');?>Ruta</h5>
                        <p class="card-text"><?php include('assets/icons/geo-alt.svg');?> Punto de inicio: Las Lomas</p>
                        <li>Punto intermedio 1</li>
                        <li>Punto intermedio 2</li>
                        <p class="card-text"><?php include('assets/icons/geo-alt.svg');?> Punto de Final: Santa Tereza</p>
                        <p class="text-end"><span class="empresa-elements-costo"><?php include('assets/icons/cash-coin.svg');?> Costo:</span> 2000 COP</p>
                    </div>
                    </div>
                </div>
            </div>

            <div class="card text-bg-light mb-3">
                <div class="row g-0 align-items-center">
                    <div class="col-md-6">
                        <img src="assets/images/bus-op.jpg" class="img-fluid rounded-start" alt="">
                    </div>
                    <div class="col-md-6">
                    <div class="card-body empresa-elements-container-text">
                        <h5 class="card-title text-center"><?php include('assets/icons/car-front.svg');?>Ruta</h5>
                        <p class="card-text"><?php include('assets/icons/geo-alt.svg');?> Punto de inicio: Las Lomas</p>
                        <li>Punto intermedio 1</li>
                        <li>Punto intermedio 2</li>
                        <p class="card-text"><?php include('assets/icons/geo-alt.svg');?> Punto de Final: Santa Tereza</p>
                        <p class="text-end"><span class="empresa-elements-costo"><?php include('assets/icons/cash-coin.svg');?> Costo:</span> 2000 COP</p>
                    </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- elements end -->
</div>