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

<div>
<div class="admin_background"></div>
<div class="container admin_form_container">
    <div class="row"  style="width: 90vw;">

        <!-- DATA TABLE START -->
        <div class="col-12 mt-5">
            
            <!-- CARD START -->
            <div class="card">
                <div class="card-body">
                    <!-- title -->
                    <figure class="text-center">
                        <blockquote class="blockquote">
                            <h4 class="header-title">Manejador de comentarios</h4>
                        </blockquote>
                    </figure>
                    <!-- title end -->
                                       
                    <div class="coment_User-cards">
                        
                        <?php while ( $row = mysqli_fetch_array($res) ): ?> 

                            <!-- Comentario -->
                            <div class="card coment_User-container">
                                <a href="comentarios.php?id=<?php echo $row['id']?>&del=delete" 
                                    onClick="return confirm('Are you sure you want to delete?')" class="coment_User_Delete"
                                >
                                    <?php include('../assets/icons/backspace.svg');?>
                                </a>

                                <div class="coment_User-body">
                                        <!-- Nombre -->
                                        <p class="name coment_User_item">
                                            <strong> <?php include('../assets/icons/person-circle.svg');?> <?php echo $row['name'] . ' ' . $row['lastname'];?></strong>
                                        </p>
                                        
                                        <!-- Fecha -->
                                        <p class="created_at coment_User_item">
                                            <strong> <?php include('../assets/icons/calendar-event.svg');?> Fecha: </strong>
                                            <?php 
                                                $date = strtotime($row['created_at']);
                                                echo date('d-m-Y', $date);
                                            ?>
                                        </p>
        
                                        <!-- Email -->
                                        <p class="email coment_User_item">
                                            <strong> <?php include('../assets/icons/envelope.svg');?> Email: </strong><?php echo $row['email']?>
                                        </p>
        
                                        <!-- Phone -->
                                        <p class="phone coment_User_item">
                                            <strong><?php include('../assets/icons/telephone.svg');?> Telefono: </strong><?php echo $row['phone']?>
                                        </p>
        
                                        <!-- Company -->
                                        <p class="company coment_User_item">
                                            <strong><?php include('../assets/icons/building.svg');?> Empresa de Referencia: </strong> <?php echo $row['company_id']?>
                                        </p>
        
                                        <!-- Comentario -->
                                        <p class="opinions coment_User_item">
                                            <strong><?php include('../assets/icons/pencil-square.svg');?> Comentario:</strong>
                                        </p>
        
                                        <p class="opinions-content coment_User_item" style=" margin-left: 45px;"><?php echo $row['description']?></li>
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
</div>

<?php endif; ?>
