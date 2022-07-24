<?php
    include_once('config/global.php');

    $title = "Home - " . SITE_TITLE;
?>

<?php include_once('includes/header.php');?>

<div class="container">

    <!-- Search Container -->
    <div class="search-form">

        <!-- Search Header -->
        <div class="search-form__header">
            <h3 class="search-form__title">Escribe tú ruta</h3>
        </div>

        <!-- Search Body -->
        <div class="search-form__body">
            <form action="#" class="search-form__form">

                <!-- From input -->
                <div class="search-form__form-container">
                    <label for="from">
                        <span class="search-form__icon">[icon] Desde:</span>
                        <input type="text" name="from" id="from" placeholder="Desde">
                    </label>
                </div>

                <!-- To input -->
                <div class="search-form__form-container">
                    <label for="to">
                        <span class="search-form__icon">[icon] Hasta:</span>
                        <input type="text" name="to" id="to" placeholder="Hasta">
                    </label>
                </div>

                <!-- Parada Select -->
                <div class="search-form__form-container">
                    <label for="stop">
                        <span class="search-form__icon">[icon] Seleccionar punto intermedio:</span>
                        <select name="stop" id="stop" class="search-form__select-stop">
                            <option value="">Selecciona una parada</option>

                            <!-- TODO: agregar todas las paradas con un foreach en php -->
                        </select>
                    </label>
                </div>
                
                <div class="search-form__form-container">
                    <input type="submit" value="Buscar" class="search-form__submit-bttn">
                </div>

            </form>
        </div>
    </div>


    <!-- Results -->
    <div class="results">
        <div class="results__tittle">Resultados:</div>

        <!-- Results items-->
        <!-- TODO: agregar todas los resultados con un foreach en php -->
        <div class="results__item">
            <div class="results__item-container">
                <h3 class="results__item-title">
                    [icon] Name of Company
                </h3>
    
                <span class="results__item-from">
                    <strong>[icon] Punto de inicio: </strong>
                    Las Lomas
                </span>
    
                <ul class="results__item-intermediate-list">
                    <li>Punto intermedio 1</li>
                    <li>Punto intermedio 2</li>
                    <!-- TODO: agregar todas los puntos intermedios con un foreach en php -->
                </ul>
    
                <span class="results__item-to">
                    <strong>[icon] Punto de final: </strong>
                    Santa Teresa
                </span>
            </div>

            <!-- Cost item -->
            <div class="results__item-container">
                <strong>[icon] Costo: </strong>
                2.000 COP
            </div>
        </div>
        <!-- End Results items-->

    </div>
    <!-- End Results -->

</div>