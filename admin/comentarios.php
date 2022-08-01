<?php
    session_start();
    error_reporting(0);

    include_once('../config/global.php');
    include_once('../config/dbconnection.php');

    $title = "Compañias - " . SITE_TITLE;

    // Checks if there is a currently authenticated user, if not redirects to login
    if (strlen($_SESSION['tmsc_id'] == 0)):
        header('location:logout.php');
    else:
        $res = mysqli_query($con,"SELECT * FROM opinions ORDER BY id DESC");

        // If user wants to delete a comment
        if($_GET['del']){
            $opinion_id = $_GET['id'];
            $query = "DELETE FROM opinions where id = $opinion_id";
            mysqli_query($con, $query);
            echo "<script>alert('Comentario Eliminado')</script>";
            echo "<script>window.location.href='comentarios.php'</script>";
        }
?>

<?php include_once('includes/header.php');?>

<div class="container">
    <div class="row">

        <!-- DATA TABLE START -->
        <div class="col-12 mt-5">
            
            <!-- CARD START -->
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Manejador de comentarios</h4>
                    
                    <div class="opinions-cards">
                        <?php while ( $row = mysqli_fetch_array($res) ): ?>

                            <!-- Comentario -->
                            <div class="card opinion-container">
                                <a href="comentarios.php?id=<?php echo $row['id']?>&del=delete" 
                                    onClick="return confirm('Are you sure you want to delete?')" >[icon] Delete</a>

                                <div class="opinion-body">
                                    <ul>
                                        <!-- Nombre -->
                                        <li class="name">
                                            <strong>[icon] <?php echo $row['name'] . ' ' . $row['lastname'];?></strong>
                                        </li>
                                        
                                        <!-- Fecha -->
                                        <li class="created_at">
                                            <strong>[icon] Fecha: </strong>
                                            <?php 
                                                $date = strtotime($row['created_at']);
                                                echo date('d-m-Y', $date);
                                            ?>
                                        </li>
        
                                        <!-- Email -->
                                        <li class="email">
                                            <strong>[icon] Email: </strong><?php echo $row['email']?>
                                        </li>
        
                                        <!-- Phone -->
                                        <li class="phone">
                                            <strong>[icon] Telefono: </strong><?php echo $row['phone']?>
                                        </li>
        
                                        <!-- Company -->
                                        <li class="company">
                                            <strong>[icon] Empresa de Referencia: </strong> <?php echo $row['company_id']?>
                                        </li>
        
                                        <!-- Comentario -->
                                        <li class="opinions">
                                            <strong>[icon] Comentario:</strong>
                                        </li>
        
                                        <li class="opinions-content"><?php echo $row['description']?></li>
                                    </ul>
                                </div>
                            </div>

                        <?php endwhile; ?>

                    </div>
                </div>
            </div>
            <!-- CARD END -->

        </div>
        <!-- DATA TABLE END -->

    </div>
</div>

<?php endif; ?>
