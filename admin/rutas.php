<?php
    session_start();
    error_reporting(0);

    include_once('../config/global.php');
    include_once('../config/dbconnection.php');

    $title = "Rutas - " . SITE_TITLE;

    // Checks if there is a currently authenticated user, if not redirects to login
    if (strlen($_SESSION['tmsc_id'] == 0)):
        header('location:logout.php');
    else:
?>

<?php include_once('includes/header.php');?>

<div>
<div class="admin_background"></div>
<div class="container admin_form_container">
    <div class="row">
        <!-- BASIC FORM START -->
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <!-- title -->
                    <figure class="text-center">
                        <blockquote class="blockquote">
                            <h4 class="header-title">Crear un Usuario</h4>
                        </blockquote>
                    </figure>
                    <!-- title end -->
                    
                    <form action="#" method="POST" name="create_user" class="row g-3 form-create_user">

                        <!-- Nombre Empresa -->
                        <div class="form-group col-md-6">
                            <label for="name">Nombre de Empresa:</label>
                            <input type="text"
                                class="form-control" 
                                id="name" 
                                name="name" 
                                placeholder="Ingrese nombre" 
                                required="true"
                                value=" ">
                        </div>

                        <!-- Punto de Inicio -->
                        <div class="form-group col-md-6">
                            <label for="punto_inicio">Punto de Inicio:</label>
                            <input type="text" 
                                class="form-control" 
                                id="punto_inicio" 
                                name="punto_inicio" 
                                placeholder="Ingrese Punto de Inicio" 
                                required="true"
                                value=" ">
                        </div>
                        
                        <!-- Punto Final -->
                        <div class="form-group">
                            <label for="punto_final">Punto Final:</label>
                            <input type="text" 
                                class="form-control" 
                                id="punto_final" 
                                name="punto_final" 
                                placeholder="Ingrese Punto Final" 
                                required="true"
                                value=" "> 
                        </div>

                        <!-- Costo -->
                        <div class="form-group">
                            <label for="costo">Costo:</label>
                            <input type="text" 
                                class="form-control" 
                                id="costo" 
                                name="costo" 
                                placeholder="Ingrese Costo" 
                                required="true"
                                value=" "> 
                        </div>

                        <!-- Puntos Intermedios -->
                        <div class="form-group">
                            <label for="puntos_intermedios" class="form-label">Puntos Intermedios:</label>
                            <select id="puntos_intermedios" class="form-select">
                                <option selected>1234...</option>
                                <option>...2455</option>
                            </select>
                        </div>

                        <!-- Agregar Parada -->
                        <div class="form-group col-md-9">
                            <label for="agregar_parada"> Agregar Parada:</label>
                            <input type="text" 
                                class="form-control" 
                                id="agregar_parada" 
                                required="true"
                                value=" "> 
                        </div>
                        <div class="form-group col-md-2 search-form__submit-bttn">
                            <button class="btn mt-4 pr-4 pl-4" >Agregar</button>
                        </div>


                        <div class="search-form__submit-bttn">
                            <button type="submit" value="Enviar" class="btn mt-4 pr-4 pl-4" name="create_user">Buscar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- basic form end -->
        
    </div>
</div>
</div>

<?php endif; ?>