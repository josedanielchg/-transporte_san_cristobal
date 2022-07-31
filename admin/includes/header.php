<!-- Head of all admin pages -->
<!DOCTYPE html>
<html lang="en">

<!-- head -->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? SITE_TITLE; ?></title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="../style.css" type="text/css">

    <!-- TODO: Add styles.css -->
    <!-- TODO: Add main.js -->
    <!-- TODO: Add fonts (Roboto) -->
    <!-- TODO: Add icons source -->
    <!-- TODO: Add favicon -->
</head>
<!-- End head -->

<!-- body -->
<body>
<script src="../bootstrap-5.2.0-dist/js/bootstrap.min.js"></script>
<script src="../js/jquery.min.js"></script>

<?php if(!isset($menu_not_required) ): ?>
    <?php include_once('includes/sidebar.php');?>
<?php endif; ?>