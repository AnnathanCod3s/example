<?php
//addserver_page.php
include("data_class.php");



$busname=$_POST['busname'];
$busplate=$_POST['busplate'];
$seats=$_POST['seats'];
$depature=$_POST['depature'];
$arival=$_POST['arival'];
$timess=$_POST['timess'];




if (move_uploaded_file($_FILES["busphoto"]["tmp_name"],"uploads/" . $_FILES["busphoto"]["name"])) {

    $buspic=$_FILES["busphoto"]["name"];

$obj=new data();
$obj->setconnection();
$obj->addbus($buspic,$busname,$busplate,$seats,$depature,$arival,$timess);
  } 
  else {
     echo "File not uploaded";
  }