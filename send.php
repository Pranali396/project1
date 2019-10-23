<?php
    
    include "db.php";
    session_start();
    
    //user id
    $id = $_SESSION['id'];
    
    //reciever id
    $send = $_POST['id'];
    

    //get user wallet balance
    $query = "select wallet from `user` where `id` ='".$id."'";

    $result = mysqli_query($link, $query);

    $row = mysqli_fetch_assoc($result);
    
    
    
    

    if(array_key_exists("submit",$_POST))
        {
             
             $amount = $_POST["amount"];
             $send = $_POST["send"];
            
            
             
                //to check receiver balance
                $query = "select wallet from `user` where `id` ='".$send."'";
                 $result = mysqli_query($link ,$query); 
                 $row1 = mysqli_fetch_assoc($result);
               
               
             if($_POST["amount"] <= $row["wallet"])
             {
                 
               
                  $wallet = $row['wallet'] - $amount;  
            
                  $query1 = "update `user` set `wallet`='".$wallet."' where `id` ='".$id."'";
                  $result1=mysqli_query($link,$query1);       
                  
                  
                  
                  $walletTo = $row1['wallet'] + $amount;  
                  $query2 = "update `user` set `wallet` = '".$walletTo."' where `id` = '".$send."'";
                  $result2 = mysqli_query($link , $query2);

                  
                  echo "<div class='alert alert-success'>Money sended successfully</div>";
                   
                  ("location:display.php");
             }
             else
             {
                 echo "<div class='alert alert-danger'>Insufficient balance , Please try again!</div>";
             }
        }
    
            
?>



<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-eqiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width , initial-scale=1">
        <title>Send Money</title>
        
        <!--bootstrap-->
        <link href="css/bootstrap.css" rel="stylesheet">
        
        <style type="text/css">
            .center 
            {
                 
                  margin: 0 auto;
                  float: none;
            }
            .row
            {
                
                margin: 1.0em 0 1.5em 0 ;
                
            }
            h4
            {
                font-size:1.5em;
                margin:30px 30px;
                padding-left:35%;
                
            }
           
            #error
            {
                color:red;
            }
            
            a
            {
                margin-top:10px;
                margin-left:50%px;
                position:relative;
            }
          
            .text
            {
                margin-left:1.8%;
                font-weight:bold;
                font-size:1.2em;
            }
            #add
            {
                width:8%;
                font-size:1.0em;
            }
            
            .alert
            {
                font-size:1.5em;
                font-weight:bold;
                color:red;
                text-align:center;
            }
            
              .send
            {
                margin-top:3%;
            }
            
            #send1
            {
                margin-left:1%;
            }
            label
            {
                margin-top:5px;
        
                font-size:1.3em;
            }
        </style>
    
    </head>
        <body>
            
             <div class="navbar navbar-default navbar-fixed ">
                    <div class="container">
                        
                        <div class="nav pull-right">
                          <a class="btn btn-large btn-primary logout" href="display.php">Profile</a>
                          <a class="btn btn-large btn-primary logout" href="logout.php">Logout</a>
                        </div>
                    </div>
             </div>
             
            
            
            
             
       
            <form method="post" id="myform" >
                
                 <fieldset class="form-group send">
                  
                  <div class="col-sm-offset-4 col-md-4">
                    <select name="send"  class="form-control "  required="required">
                            <option value="" >Select Verified User</option>
                            
                             <?php 
                                     $sql= mysqli_query($link, "select * from `user` where `verify` = 3 and `id` != '".$id."'" );
                                        while($result = mysqli_fetch_assoc($sql))
                                    {
            
                                        echo "<option value='".$result['id']."'>".$result['username']."</option>";
    
                                    }
                                    
                                    
                             ?>
                             
                            
                    </select> 
                  </div>
             </fieldset>
                <fieldset class="form-group row">
                        <div class="col-md-offset-4 col-md-4">
                             <input type="text"  align="center" class="form-control"  id="amount" name="amount"  required="amount"  placeholder="Enter Amount">
                        </div>
                </fieldset>
                
                <fieldset class="form-group row">
                    <div class="col-md-offset-4 col-md-4">
                        <input type="text" class="form-control"  id="purpose" name="purpose" placeholder="Purpose">
                    </div>
                </fieldset>
                
                
                <fieldset class="form-group" align="center">
                    <button type="submit" name="submit" class="btn btn-primary" align="center" >send Money</button>
                </fieldset>
            </form>
            
        
	

     <!--jquery-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
        <script src="js/bootstrap.js"></script>
     	<script type="text/javascript">
	           
                 
                 $( "#myform" ).validate(
                {
                    rules: {
                        send: { required: true }
                    },
                    
                    message: {
                        send: "Please select username"
                    }
                });
                
                
                
	   
    	</script>
    </body>
</html>