<?php
    include_once('config/global.php');

    // TODO: change "Empresa" in title from the actual name of the company
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
    <!-- carousel -->
   <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/bus-op.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="img/buses.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="img/personas-bus.jpg" class="d-block w-100" alt="...">
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

    <!-- elements -->
    <div class="card text-bg-light mb-3" style="max-width: 540px;">
        <div class="row g-0">
            <div class="col-md-4">
            <img src="img/bus-op.jpg" class="img-fluid rounded-start" alt="">
            </div>
            <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            </div>
            </div>
        </div>
    </div>

    <div class="card text-bg-light mb-3" style="max-width: 540px;">
        <div class="row g-0">
            <div class="col-md-4">
            <img src="img/bus-op.jpg" class="img-fluid rounded-start" alt="">
            </div>
            <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            </div>
            </div>
        </div>
    </div>
</div>