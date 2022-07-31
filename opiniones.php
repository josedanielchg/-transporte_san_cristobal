<?php
    include_once('config/global.php');

    $title = "Dejanos Tú Opinión - " . SITE_TITLE;
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

    <!-- form -->
    <form class="row g-3 form-opinion">
        <div class="col-md-6">
            <label for="inputname" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="inputname">
        </div>
        <div class="col-md-6">
            <label for="inputLastName" class="form-label">Apellido</label>
            <input type="text" class="form-control" id="inputLastName">
        </div>
        <div class="col-12">
            <label for="inputEmail4" class="form-label">Dirreccion de correo</label>
            <input type="email" class="form-control" id="inputEmail4">
        </div>
        <div class="col-12">
            <label for="inputphone" class="form-label">Telefono</label>
            <input type="text" class="form-control" id="inputphone">
        </div>
        <div class="col-md-12">
            <label for="inputRefCompany" class="form-label">Referencia a empresa</label>
            <select id="inputRefCompany" class="form-select">
                <option selected>Choose...</option>
                <option>...</option>
            </select>
        </div>
        <div class="col-md-12">
            <label for="TextareaComment" class="form-label">Comentario</label>
            <textarea class="form-control" id="TextareaComment" rows="4"></textarea>
        </div>
        <div class="col-12 search-form__submit-bttn">
            <button type="submit" class="btn">Enviar</button>
        </div>
    </form>
    <!-- form end -->
</div>