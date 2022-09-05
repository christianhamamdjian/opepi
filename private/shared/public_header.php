<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OPEPI <?php if(isset($kurssi_title)) { echo '- ' . h($kurssi_title); } ?><?php if(isset($preview) && $preview) { echo ' [PREVIEW]'; } ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
    <link rel="stylesheet" media="all" href="<?php echo url_for('/stylesheets/public.css'); ?>" />
</head>
<body>
<?php include "public_navigation.php"; ?>
