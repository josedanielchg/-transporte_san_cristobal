<?php
    include_once('config/global.php');

    $title = "Home - " . SITE_TITLE;
?>

<?php include_once('includes/header.php');?>

<div>
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
                            <form>
                                <!-- From input -->
                                <div class="mb-3 search-form__icon">
                                    <label class="form-label"><?php include('assets/icons/geo-alt.svg');?> Desde:</label>
                                    <input type="text" class="form-control" placeholder="Desde:">
                                </div>
                                <!-- To input -->
                                <div class="mb-3 search-form__icon">
                                    <label class="form-label"><?php include('assets/icons/geo-alt.svg');?> Hasta:</label>
                                    <input type="text" class="form-control" placeholder="Hasta:">
                                </div>
                                <!-- Parada Select -->
                                <div class="mb-3 search-form__icon">
                                    <label class="form-label"><?php include('assets/icons/geo-alt.svg');?> Seleccionar punto intermedio:</label>
                                    <select class="form-select search-form__select-stop">
                                        <option value="">Selecciona una parada</option>
                                    </select>
                                </div>
                                <div class="text-center search-form__submit-bttn">
                                    <button type="submit" class="btn">Buscar</button>
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
                    <!-- results__item -->
                    <!-- TODO: agregar todas los resultados con un foreach en php -->
                    <div class="card">
                        <div class="results__item">
                            <h5><?php include('assets/icons/car-front.svg');?> Ruta</h5>
                            <p class="results__item-puntosDe"><?php include('assets/icons/geo-alt.svg');?> Punto de inicio: Las Lomas</p>
                            <li>Punto intermedio 1</li>
                            <li>Punto intermedio 2</li>
                            <!-- TODO: agregar todas los puntos intermedios con un foreach en php -->
                            <p class="results__item-puntosDe"><?php include('assets/icons/geo-alt.svg');?> Punto de Final: Santa Tereza</p>
                            <p class="text-end"><span class="empresa-elements-costo"><?php include('assets/icons/cash-coin.svg');?> Costo:</span> 2000 COP</p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="results__item">
                            <h5><?php include('assets/icons/car-front.svg');?> Ruta</h5>
                            <p class="results__item-puntosDe"><?php include('assets/icons/geo-alt.svg');?> Punto de inicio: Las Lomas</p>
                            <li>Punto intermedio 1</li>
                            <li>Punto intermedio 2</li>
                            <!-- TODO: agregar todas los puntos intermedios con un foreach en php -->
                            <p class="results__item-puntosDe"><?php include('assets/icons/geo-alt.svg');?> Punto de Final: Santa Tereza</p>
                            <p class="text-end"><span class="empresa-elements-costo"><?php include('assets/icons/cash-coin.svg');?> Costo:</span> 2000 COP</p>
                        </div>
                    </div>
                   
                    <!-- End Results items-->
                </div>  
                <!-- End Results -->
            </div>
        </div>
    </div>
</div>