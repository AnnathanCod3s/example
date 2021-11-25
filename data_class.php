<?php include("db.php");

class data extends db {

    private $bookpic;
    private $bookname;
    private $bookdetail;
    private $bookaudor;
    private $bookpub;
    private $branch;
    private $bookprice;
    private $bookquantity;
    private $type;

    private $book;
    private $userselect;
    private $days;
    private $getdate;
    private $returnDate;





    function __construct() {
        // echo " constructor ";
        echo "</br></br>";
    }





 function userLogin($t1, $t2) {
        $q="SELECT * FROM userdata where email='$t1' and pass='$t2'";
        $recordSet=$this->connection->query($q);
        $result=$recordSet->rowCount();
        if ($result > 0) {

            foreach($recordSet->fetchAll() as $row) {
                $logid=$row['id'];
                header("location: otheruser_dashboard.php?userlogid=$logid");
            }
        }

        else {
            header("location: index.php?msg=Invalid Credentials");
        }

    }

    function adminLogin($t1, $t2) {

        $q="SELECT * FROM adminn where email='$t1' and pass='$t2'";
        $recordSet=$this->connection->query($q);
        $result=$recordSet->rowCount();

        if ($result > 0) {

            foreach($recordSet->fetchAll() as $row) {
                $logid=$row['id'];
                header("location: admin_service_dashboard.php?logid=$logid");
            }
        }

        else {
            header("location: index.php?msg=Invalid Credentials");
        }

    }



    function userdetail($id){
        $q="SELECT * FROM userdata where id ='$id'";
        $data=$this->connection->query($q);
        return $data;
    }

 function getbus() {
        $q="SELECT * FROM book ";
        $data=$this->connection->query($q);
        return $data;
    }



  function getissuedbus(){
        $q="SELECT * FROM issuedbus ";
        $data=$this->connection->query($q);
        return $data;

  }



//nowNOW

   /* function requestbus($userid,$busid){

       $q="SELECT * FROM requests where userid='$userid'";
       $recordSettt=$this->connection->query($q);
       $result=$recordSettt->rowCount();


       $q="SELECT * FROM userdata where id='$userid'";
        $recordSet=$this->connection->query($q);


        $q="SELECT * FROM issuedbus where busid='$busid'";
        $recordSett=$this->connection->query($q);



        foreach($recordSett->fetchAll() as $row) {


            $seatsleft=$row['seatsleft'];
            
            $busname=$row['busname'];
            $timess=$row['tim'];
            
        }


        foreach($recordSet->fetchAll() as $row) {
            $useremail=$row['email'];
            $userid=$row['id'];
        }

        foreach($recordSettt->fetchAll() as $row) {
           $userid=$row['userid'];
            
        }




if($seatsleft>0)
 {
   $seatsleft=$seatsleft-1;

   $q="UPDATE issuedbus SET seatsleft='$seatsleft' where busid='$busid'";

                $q="INSERT INTO requests(userid,email,busname,timess)VALUES('$userid', '$useremail', '$busname', '$timess')";

                if($this->connection->exec($q)) {
                            header("Location:otheruser_dashboard.php?");
                 }

                else {
                         header("Location:otheruser_dashboard.php?msg=fail");
                     }

 }
 else{

           header("Location:otheruser_dashboard.php?msg=fail");

 }





}


*/

//------------------------------------------------




 function requestbus($userid,$busid){

        $q="SELECT * FROM issuedbus where id='$busid'";
        $recordSetss=$this->connection->query($q);

        $q="SELECT * FROM userdata where id='$userid'";
        $recordSet=$this->connection->query($q);

        foreach($recordSet->fetchAll() as $row) {
            $username=$row['username'];
            $useremail=$row['email'];
            
        }

        foreach($recordSetss->fetchAll() as $row) {
            $busname=$row['busname'];
            $busplate=$row['busplate'];
            $timess=$row['tim'];
            $seatsleft=$row['seatsleft']-1;
        }

      
         $q="UPDATE issuedbus SET seatsleft='$seatsleft'where id='$busid'";

        $q="INSERT INTO requests (userid,email,busname,timess,username,busplate)VALUES('$userid', '$useremail', '$busname', '$timess', '$username', '$busplate')";

        if($this->connection->exec($q)) {
            header("Location:otheruser_dashboard.php?userlogid=$userid");
        }

        else {
            header("Location:otheruser_dashboard.php?msg=fail");
        }

    }











 function addbus($buspic,$busname,$busplate,$seats,$depature,$arival,$timess) {
        $this->$buspic=$buspic;
        $this->busname=$busname;
        $this->busplate=$busplate;
        $this->seats=$seats;
        $this->depature=$depature;
        $this->arival=$arival;
        $this->schedule=$timess;
    

       $q="INSERT INTO bus (id,buspic,busname, busplate,seats, depature,arival, timess)VALUES('','$buspic', '$busname', '$busplate', '$seats', '$depature', '$arival', '$timess')";

        if($this->connection->exec($q)) {
            header("Location:admin_service_dashboard.php?msg=done");
        }

        else {
            header("Location:admin_service_dashboard.php?msg=fail");
        }

    }




    function getbuss() {
        $q="SELECT * FROM bus ";
        $data=$this->connection->query($q);
        return $data;
    }

 function addnewuser($name,$pasword,$email,$type){
        $this->name=$name;
        $this->pasword=$pasword;
        $this->email=$email;
        $this->type=$type;




        if($type=="student"){

             $q="INSERT INTO userdata(id, username, email, pass,usertype)VALUES('','$name','$email','$pasword','$type')";

             if($this->connection->exec($q))
             {
                 header("Location:admin_service_dashboard.php?msg=New Add done");
             }

             else
             {
               header("Location:admin_service_dashboard.php?msg=Register Fail");
             }


        }
        else{




            $q="INSERT INTO adminn(id,email, pass,usertype,username)VALUES('','$email','$pasword','$type','$name')";

            if($this->connection->exec($q))
            {
               header("Location:admin_service_dashboard.php?msg=New Add done");
            }

            else
            {
                     header("Location:admin_service_dashboard.php?msg=Register Fail");
            }



           
       }

    }
   


function getbookissue(){
        $q="SELECT * FROM bus where seats !=0 ";
        $data=$this->connection->query($q);
        return $data;
    }


  // issue book   now NOW
    function issuebook($bus,$selecttime){
        $this->$bus= $bus;
        $this->$selecttime=$selecttime;
        


        $q="SELECT * FROM bus where busplate='$bus' and timess='$selecttime'";
        $recordSetss=$this->connection->query($q);

        //$q="SELECT * FROM userdata where name='$userselect'";
        //$recordSet=$this->connection->query($q);
       // $result=$recordSet->rowCount();

       // if ($result > 0) {

           // foreach($recordSet->fetchAll() as $row) {
             //   $issueid=$row['id'];
              //  $issuetype=$row['type'];

                // header("location: admin_service_dashboard.php?logid=$logid");
           // }

            foreach($recordSetss->fetchAll() as $row) {
                $busid=$row['id'];
                $buspic=$row['buspic'];
                $busname=$row['busname'];
                $busplate=$row['busplate'];
                $seats=$row['seats'];
                $depature=$row['depature'];
                $arival=$row['arival'];
                $timess=$row['timess'];
                $seatsleft=$row['seats'];

                  //  $newseatsava=$row['seats']-1;
                     
            }

        
           // $q="UPDATE book SET bookava='$newbookava', bookrent='$newbookrent' where id='$bookid'";
          // if($this->connection->exec($q)){

            $q="INSERT INTO issuedbus (id,busid,busname,busplate,noofseats,tim,depature,arival,seatsleft,buspic)VALUES('','$busid','$busname','$busplate','$seats','$timess','$depature','$arival','$seatsleft','$buspic')";

            if($this->connection->exec($q)) {
                header("Location:admin_service_dashboard.php?msg=done");
            }
    
            else {
                header("Location:admin_service_dashboard.php?msg=fail");
            }

        }

       
 function issuereport(){
            $q="SELECT * FROM issuedbus ";
            $data=$this->connection->query($q);
            return $data;
            
        }

    
function getbookdetail($id){
        $q="SELECT * FROM bus where id ='$id'";
        $data=$this->connection->query($q);
        return $data;
    }





    
    function requests($id){
        $q="SELECT * FROM requests where userid ='$id'";
        $data=$this->connection->query($q);
        return $data;
    }








    private $id;



    /*

  




   */ 




}