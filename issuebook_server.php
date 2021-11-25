<?php

include("data_class.php");

$bus=$_POST['bus'];
$selecttime= $_POST['selecttime'];


$obj=new data();
$obj->setconnection();
$obj->issuebook($bus,$selecttime);
