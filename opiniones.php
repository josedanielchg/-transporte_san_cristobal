<?php
    include_once('config/global.php');
    include_once('config/dbconnection.php');

    $title = "Dejanos Tú Opinión - " . SITE_TITLE;
    
    $companies = mysqli_query($con,"SELECT * FROM companies ORDER BY id");

    // Create opinion
    if(isset($_POST['create_opinion'])) {
        $repopulate = !opinion_created($_POST, $con);
    }
?>

<?php include_once('includes/header.php');?>

<div class="container">
    <!-- title -->
    <figure class="text-center">
        <blockquote class="blockquote">
            <h1>Dejanos tú opinión</h1>
        </blockquote>
    </figure>
    <!-- title end -->

    <!-- Form Start -->
    <form class="row g-3 form-opinion" method="POST" name="create_opinion">

        <!-- Nombre -->
        <div class="col-md-6">
            <label for="inputname" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="inputname" name="name" required>
        </div>

        <!-- Apellido -->
        <div class="col-md-6">
            <label for="inputLastName" class="form-label">Apellido</label>
            <input type="text" class="form-control" id="inputLastName" name="lastname" required>
        </div>

        <!-- Direccion de correo -->
        <div class="col-12">
            <label for="inputEmail4" class="form-label">Dirreccion de correo</label>
            <input type="email" class="form-control" id="inputEmail4" name="email" required>
        </div>

        <!-- Telefono -->
        <div class="col-12">
            <label for="inputphone" class="form-label">Telefono</label>
            <input type="text" class="form-control" id="inputphone" name="phone" required>
        </div>

        <!-- Empresa -->
        <div class="col-md-12">
            <label for="inputRefCompany" class="form-label">Referencia a empresa</label>
            <select id="inputRefCompany" class="form-select" name="company_id" required>
                <?php while ( $row = mysqli_fetch_array($companies) ): ?>
                    <option value="<?php echo $row['id'];?>">
                        <?php echo $row['name']; ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <!-- Comentario -->
        <div class="col-md-12">
            <label for="TextareaComment" class="form-label">Comentario</label>
            <textarea class="form-control" id="TextareaComment" rows="4" name="comment" required></textarea>
        </div>

        <div class="col-12 search-form__submit-bttn">
            <input type="submit" value="Enviar" class="btn btn-primary" name="create_opinion">
        </div>
    </form>
    <!-- Form end -->
</div>


<!-- ================================ -->
<!-- === Functions from this page === -->
<!-- ================================ -->
<?php

    // function to create (save) users
    function opinion_created($opinion_data, $connection) {
        $name = $opinion_data['name'];
        $lastname = $opinion_data['lastname'];
        $email = $opinion_data['email'];
        $phone = $opinion_data['phone'];
        $company_id = $opinion_data['company_id'];
        $description = $opinion_data['comment'];

        
        // Check if email provided is valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo '<script> alert("Email inválido"); </script>';
            return;
        }

        // Insert into Database
        $query = mysqli_query($connection, "INSERT INTO opinions (name, lastname, email, phone, company_id, description) value('$name','$lastname','$email','$phone','$company_id','$description')");
        
        if ($query):
            echo '<script>alert("Comentario enviado exitosamente")</script>';
            echo "<script>window.location.href='opiniones.php'</script>";
            return true;
        else: 
            //Message of error to give feedback to users 
            $message = "Ocurrio un error Inesperado. Por favor intenta de nuevo!";
            foreach ($connection->error_list as $error)
                $message .= "\\n- " . $error["error"];

            echo '<script> alert("' . $message . '"); </script>';
            return false;
        endif;
    }