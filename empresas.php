<?php
    include_once('config/global.php');
    include_once('config/dbconnection.php');

    $title = "Empresas - " . SITE_TITLE;
    $res = mysqli_query($con,"SELECT * FROM companies ORDER BY id");
?>

<?php include_once('includes/header.php');?>

<div >
<div class="admin_background"></div>
<div>&nbsp;</div>
<div class="container_table_empresas">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Empresas:</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php while ( $row = mysqli_fetch_array($res) ): ?>
                <tr>
                    <th scope="row"><?php echo $row['name']; ?></th>
                    <td class="btn_ver_empresa" style="text-align: right;">
                        <a class="btn" href="empresa.php?id=<?php echo $row['id'];?>" role="button">Ver más</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</div>