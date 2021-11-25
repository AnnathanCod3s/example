<?php

include("data_class.php");

$userid=$_GET['userid'];
$busid=$_GET['busid'];





$obj=new data();
$obj->setconnection();
$obj->requestbus($userid,$busid);

?>