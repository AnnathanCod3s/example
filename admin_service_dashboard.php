<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <![endif]-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Admin Dashboard</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
      <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
      <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!-- <link rel="stylesheet" href="style.css"> -->
    </head>
    <style>
        .innerright,label {
    color: rgb(16, 170, 16);
    font-weight:bold;
}
.container,
.row,
.imglogo {
    margin:auto;
}

.innerdiv {
    text-align: center;
    /* width: 500px; */
    margin: 100px;
}
input{
    margin-left:20px;
}
.leftinnerdiv {
    float: left;
    width: 25%;
}

.rightinnerdiv {
    float: right;
    width: 75%;
}

.innerright {
    background-color: rgb(105, 221, 105);
}

.greenbtn {
    background-color: rgb(16, 170, 16);
    color: white;
    width: 95%;
    height: 40px;
    margin-top: 8px;
}

.greenbtn,
a {
    text-decoration: none;
    color: white;
    font-size: large;
}

th{
    background-color: orange;
    color: black;
}
td{
    background-color: #fed8b1;
    color: black;
}
td, a{
    color:black;
}
    </style>
    <body>

    <?php
   include("data_class.php");

$msg="";

   if(!empty($_REQUEST['msg'])){
    $msg=$_REQUEST['msg'];
 }

if($msg=="done"){
    echo "<div class='alert alert-success' role='alert'>Sucssefully Done</div>";
}
elseif($msg=="fail"){
    echo "<div class='alert alert-danger' role='alert'>Fail</div>";
}

    ?>



        <div class="container">
        <div class="innerdiv">
            <div class="row"><img class="imglogo" src="images/logo.PNG"/></div>

            
            <div class="leftinnerdiv">
                <Button class="greenbtn"> ADMIN</Button>
                <Button class="greenbtn" onclick="openpart('addbus')" >ADD BUS</Button>
                <Button class="greenbtn" onclick="openpart('addperson')"> ADD NEW USER</Button>
                <Button class="greenbtn" onclick="openpart('busreport')" > BUS REPORT</Button>
                <Button class="greenbtn"  onclick="openpart('issuebus')"> ISSUE BUS</Button>
                <Button class="greenbtn" onclick="openpart('issuedbusreport')"> ISSUED BUS REPORT</Button>
                <a href="index.php"><Button class="greenbtn" > LOGOUT</Button></a>
            </div>










            
            
            <div class="rightinnerdiv">   
            <div id="addbus" class="innerright portion" style="<?php  if(!empty($_REQUEST['viewid'])){ echo "display:none";} else {echo ""; }?>">
            <Button class="greenbtn" >ADD NEW BUS</Button>
            <form action="addbookserver_page.php" method="post" enctype="multipart/form-data">
            <label>Bus Name:</label><input type="text" name="busname"/>
            </br>
            <label>Bus Plate:</label><input  type="text" name="busplate"/></br>
            <label>Number Of Seats:</label><input type="text" name="seats"/></br>
            <label>Place Of Depature:</label><input type="text" name="depature"/></br>   
            <label>Arival Place:</label><input  type="text" name="arival"/></br>
            <label>Time:</label><input type="text" name="timess"/></br>
            <label>Bus Photo</label><input  type="file" name="busphoto"/></br>
            </br>
   
            <input type="submit" value="SUBMIT"/>
            </br>
            </br>

            </form>
            </div>
            </div>




            
            <div class="rightinnerdiv">   
            <div id="addperson" class="innerright portion" style="display:none">
            <Button class="greenbtn" >ADD NEW USER</Button>
            <form action="addpersonserver_page.php" method="post" enctype="multipart/form-data">
            <label>Name:</label><input type="text" name="addname"/>
            </br>
            <label>Pasword:</label><input type="pasword" name="addpass"/>
            </br>
            <label>Email:</label><input  type="email" name="addemail"/></br>
            <label for="type">Choose type:</label>
            <select name="type" >
                <option value="student">student</option>
                <option value="admin">admin</option>
            </select>

            <input type="submit" value="SUBMIT"/>
            </form>
            </div>
            </div>


           <div class="rightinnerdiv">   
            <div id="busreport" class="innerright portion" style="<?php  if(!empty($_REQUEST['returnid'])){ echo "display:none";} else {echo ""; }?>">
            <Button class="greenbtn" >BUS RECORD</Button>
            <?php
            $u=new data;
            $u->setconnection();
            $u->getbuss();
            $recordset=$u->getbuss();

            $table="<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style='  border: 1px solid #ddd;
            padding: 8px;'>Bus Name</th><th>Bus Plate</th><th>Depature</th><th>Arival</th><th>Seats</th><th>From-To</th></th><th>View</th></tr>";
            foreach($recordset as $row){
                $table.="<tr>";
               "<td>$row[0]</td>";
                $table.="<td>$row[2]</td>";
                $table.="<td>$row[3]</td>";
                $table.="<td>$row[5]</td>";
                $table.="<td>$row[6]</td>";
                $table.="<td>$row[4]</td>";
                $table.="<td>$row[7]</td>";
                $table.="<td><a href='admin_service_dashboard.php?viewid=$row[0]'><button type='button' class='btn btn-primary'>View Bus</button></a></td>";
                // $table.="<td><a href='deletebook_dashboard.php?deletebookid=$row[0]'>Delete</a></td>";
                $table.="</tr>";
                // $table.=$row[0];
            }
            $table.="</table>";

            echo $table;
            ?>

            </div>
            </div>


            <div class="rightinnerdiv">   
            <div id="bookdetail" class="innerright portion" style="<?php  if(!empty($_REQUEST['viewid'])){ $viewid=$_REQUEST['viewid'];} else {echo "display:none"; }?>">
            
            <Button class="greenbtn" >BOOK DETAIL</Button>
</br>
<?php
            $u=new data;
            $u->setconnection();
            $u->getbookdetail($viewid);
            $recordset=$u->getbookdetail($viewid);
            foreach($recordset as $row){

                $busid= $row[0];
               $busimg= $row[1];
               $busname= $row[2];
               $busplate= $row[3];
               $seats= $row[4];
               $depature= $row[5];
               $arival= $row[6];
               $timess= $row[7];
               
               

            }            
?>

            <img width='150px' height='150px' style='border:1px solid #333333; float:left;margin-left:20px' src="uploads/<?php echo $busimg?> "/>
            </br>
            <p style="color:black"><u>Bus Name:</u> &nbsp&nbsp<?php echo $busname ?></p>
            <p style="color:black"><u>Bus Plate:</u> &nbsp&nbsp<?php echo $busplate ?></p>
             <p style="color:black"><u>Bus Id:</u> &nbsp&nbsp<?php echo $busid ?></p>
            <p style="color:black"><u>Number of seats:</u> &nbsp&nbsp<?php echo $seats ?></p>
            <p style="color:black"><u>Depature:</u> &nbsp&nbsp<?php echo $depature ?></p>
            <p style="color:black"><u>Arival:</u> &nbsp&nbsp<?php echo $arival ?></p>
            <p style="color:black"><u>Times:</u> &nbsp&nbsp<?php echo $timess ?></p>
           


            </div>
            </div>
            
            
            
           
            <div class="rightinnerdiv">   
            <div id="issuebus" class="innerright portion" style="display:none">
            <Button class="greenbtn" >issue bus</Button>
            <form action="issuebook_server.php" method="post" enctype="multipart/form-data">
            <label for="bus">Choose bus plate:</label>
            <select name="bus" >
            <?php
            $u=new data;
            $u->setconnection();
            $u->getbookissue();
            $recordset=$u->getbookissue();
            foreach($recordset as $row){

                echo "<option value='". $row[3] ."'>" .$row[3] ."</option>";
        
            }            
            ?>
            </select>



            <label for="Selecttime">time:</label>
            <select name="selecttime" >
            <?php
            $u=new data;
            $u->setconnection();
            $u->getbookissue();
            $recordset=$u->getbookissue();
            foreach($recordset as $row){
               $id= $row[0];
                echo "<option value='". $row[7] ."'>" .$row[7] ."</option>";
            }            
            ?>
            </select>
<br>
           

            <input type="submit" value="SUBMIT"/>
            </form>
            </div>
            </div>


 <div class="rightinnerdiv">   
            <div id="issuedbusreport" class="innerright portion" style="display:none">
            <Button class="greenbtn" >Issued Bus Record</Button>

            <?php
            $u=new data;
            $u->setconnection();
            $u->issuereport();
            $recordset=$u->issuereport();

            $table="<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style='  border: 1px solid #ddd;
            padding: 8px;'>Bus Name</th><th>Bus Plate</th><th>Seats</th><th>Depature</th><th>Arival</th><th>From-To</th><th>Seats Leaft</th></tr>";

            foreach($recordset as $row){
                $table.="<tr>";
               "<td>$row[0]</td>";
                $table.="<td>$row[2]</td>";
                $table.="<td>$row[3]</td>";
                $table.="<td>$row[4]</td>";
                $table.="<td>$row[6]</td>";
                $table.="<td>$row[7]</td>";
                $table.="<td>$row[5]</td>";
                 
                    $table.="<td>$row[8]</td>";
                // $table.="<td><a href='otheruser_dashboard.php?returnid=$row[0]&userlogid=$userloginid'>Return</a></td>";
                $table.="</tr>";
                // $table.=$row[0];
            }
            $table.="</table>";

            echo $table;
            ?>

            </div>
            </div>
           
           
    
        <script>
        function openpart(portion) {
        var i;
        var x = document.getElementsByClassName("portion");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";  
        }
        document.getElementById(portion).style.display = "block";  
        }
        </script>
    </body>
</html>