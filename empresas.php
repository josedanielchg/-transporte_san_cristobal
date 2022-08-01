<?php
    include_once('config/global.php');

    // TODO: change "Empresa" in title from the actual name of the company with php dynamically
    $title = "Empresa - " . SITE_TITLE;
?>

<?php include_once('includes/header.php');?>

<div >
<div class="admin_background"></div>
<div>&nbsp;</div>
<div class="container_table_empresas">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Empresa</th>
                <th scope="col"> </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">Jacob Jacob</th>
                <td class="btn_ver_empresa"><a class="btn" href="empresa.php" role="button">Ver</a></td>
            </tr>
            <tr>
                <th scope="row">Thornton San Pedro</th>
                <td class="btn_ver_empresa"><a class="btn" href="empresa.php" role="button">Ver</a></td>
            </tr>
            <tr>
                <th scope="row">Thornton San Pedro</th>
                <td class="btn_ver_empresa"><a class="btn" href="empresa.php" role="button">Ver</a></td>
            </tr>
            <tr>
                <th scope="row">Thornton San Pedro</th>
                <td class="btn_ver_empresa"><a class="btn" href="empresa.php" role="button">Ver</a></td>
            </tr>
        </tbody>
    </table>
</div>
</div>