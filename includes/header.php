<!-- Head of all pages in front (no admin pages) -->
<!DOCTYPE html>
<html lang="en">

<!-- head -->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
    <title><?php echo $title ?? SITE_TITLE; ?></title>

    <!-- TODO: Add styles.css -->

    <!-- TODO: Add main.js -->
    <!-- TODO: Add fonts (Roboto) -->
    <!-- TODO: Add icons source -->
    <!-- TODO: Add favicon -->
</head>
<!-- End head -->

<!-- body -->
<body>
<script src="assets/js/bootstrap.min.js"></script>
<script src="js/jquery.min.js"></script>

<?php include_once('includes/menu.php');?>