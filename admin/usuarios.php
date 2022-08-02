<?php
    session_start();
    error_reporting(0);

    include_once('../config/global.php');
    include_once('../config/dbconnection.php');

    $title = "Usuarios - " . SITE_TITLE;

    // Checks if there is a currently authenticated user, if not redirects to login
    if (strlen($_SESSION['tmsc_id'] == 0)):
        header('location:logout.php');
    else:
        $res = mysqli_query($con,"SELECT * FROM users ORDER BY id DESC");

        // If user wants to delete a user
        if($_GET['del']){
            $user_id = $_GET['id'];
            $query = "DELETE from users where id =$user_id";
            mysqli_query($con, $query);
            echo "<script>alert('User Deleted')</script>";
            echo "<script>window.location.href='usuarios.php'</script>";
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
                    <!-- title -->
                    <figure class="text-center">
                        <blockquote class="blockquote">
                            <h4 class="header-title">Manejador de Usuarios</h4>
                        </blockquote>
                    </figure>
                    <!-- title end -->
                    
                    <div class="btn_ver_empresa text-end" style="margin-top: 5px; margin-bottom: 10px;">
                        <a href="crear-usuario.php" class="btn" role="button">Create</a>
                    </div>
                    
                    
                    <div class="data-tables">
                        <table class="table text-center">
                            
                            <!-- TABLE HEAD -->
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Rol</th>
                                    <th>Fecha de Creación</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <!-- TABLE END HEAD -->

                            <!-- TABLE BODY -->
                            <tbody>
                                <?php while ( $row = mysqli_fetch_array($res) ): ?>
                                    <tr data-expanded="true">
                                        <td><?php echo $row['id'];?></td>
                                        <td><?php echo $row['username'];?></td>
                                        <td><?php echo $row['email'];?></td>
                                        <td><?php echo $row['role_id'];?></td>
                                        <td><?php echo $row['creation_date'] ?? "2022-05-04";?></td>
                                        <td>
                                            <a href="editar-detalles-usuario.php?edit_id=<?php echo $row['id'];?>" class="btn btn-primary btn-xs">Edit</a>
                                            <a href="usuarios.php?id=<?php echo $row['id']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')" class="btn btn-danger btn-xs">Delete</a>
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