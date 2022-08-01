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
        $res = mysqli_query($con,"SELECT r.id, c.name AS company, r.cost, r.created_at FROM rutes AS r JOIN companies AS c ON r.company_id = c.id ORDER BY r.created_at DESC");

        // If user wants to delete a user
        if($_GET['del']){
            $rute_id = $_GET['id'];
            $query = "DELETE from rutes where id =$rute_id";
            mysqli_query($con, $query);
            echo "<script>alert('Ruta Eliminada')</script>";
            echo "<script>window.location.href='rutas.php'</script>";
        }
?>

<?php include_once('includes/header.php');?>

<div>
<div class="admin_background"></div>
<div class="container">
    
    <div class="row">

        <!-- DATA TABLE START -->
        <div class="col-12 mt-5">
            
            <!-- CARD START -->
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Manejador de Rutas</h4>
                    <a href="crear-ruta.php" class="btn btn-primary btn-m">Create</a>
                    
                    <div class="data-tables">
                        <table class="table text-center">
                            
                            <!-- TABLE HEAD -->
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th>ID</th>
                                    <th>Compañia</th>
                                    <th>Costo</th>
                                    <th>Paradas</th>
                                    <th>Fecha de Creación</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <!-- TABLE END HEAD -->

                            <!-- TABLE BODY -->
                            <tbody>
                                <?php while ( $row = mysqli_fetch_array($res) ): ?>
                                    <?php
                                        $paradas_query = mysqli_query($con,"SELECT s.name, s.created_at FROM rutes_stops AS rs JOIN stops AS s ON s.id = rs.stops_id WHERE rutes_id = '{$row['id']}' ORDER BY rs.sequence");
                                        $has_paradas = NULL;
                                    ?>
                                    <tr data-expanded="true">
                                        <td><?php echo $row['id'];?></td>
                                        <td><?php echo $row['company'];?></td>
                                        <td><?php echo $row['cost'];?> COP</td>
                                        <td>
                                            <!-- Paradas -->
                                            <ol>
                                                <?php while ( $paradas = mysqli_fetch_array($paradas_query) ): ?>
                                                    <?php $has_paradas = true; ?>
                                                    <li><?php echo $paradas['name']; ?></li>
                                                <?php endwhile; ?>

                                                <?php if( is_null($has_paradas) ): ?>
                                                    <strong>Paradas no agregadas</strong>
                                                <?php endif; ?>
                                            </ol>
                                        </td>
                                        <td><?php echo $row['creation_date'] ?? "2022-05-04";?></td>
                                        <td>
                                            <a href="editar-rutas.php?edit_id=<?php echo $row['id'];?>" class="btn btn-primary btn-xs">Edit</a>
                                            <a href="rutas.php?id=<?php echo $row['id']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')" class="btn btn-danger btn-xs">Delete</a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                            <!-- TABLE END BODY -->

                        </table>
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