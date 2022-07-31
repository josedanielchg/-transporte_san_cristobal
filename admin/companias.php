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
        $res = mysqli_query($con,"SELECT * FROM companies ORDER BY id DESC");

        // If user wants to delete a user
        if($_GET['del']){
            $company_id = $_GET['id'];
            $query = "DELETE from companies where id = $company_id";
            mysqli_query($con, $query);
            echo "<script>alert('Compañia de Transporte Eliminada')</script>";
            echo "<script>window.location.href='companias.php'</script>";
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
                    <h4 class="header-title">Manejador de compañias de transporte</h4>
                    <a href="crear-compania.php" class="btn btn-primary btn-m">Crear</a>
                    
                    <div class="data-tables">
                        <table class="table text-center">
                            
                            <!-- TABLE HEAD -->
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <!-- TABLE END HEAD -->

                            <!-- TABLE BODY -->
                            <tbody>
                                <?php while ( $row = mysqli_fetch_array($res) ): ?>
                                    <tr data-expanded="true">
                                        <td><?php echo $row['id'];?></td>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo substr($row['description'], 0, 75);?>...</td>
                                        <td>
                                            <a href="editar-compania.php?edit_id=<?php echo $row['id'];?>" class="btn btn-primary btn-xs">Edit</a>
                                            <a href="companias.php?id=<?php echo $row['id']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')" class="btn btn-danger btn-xs">Delete</a>
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

<?php endif; ?>