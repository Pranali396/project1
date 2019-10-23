<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    include "db.php";
    
    session_start();
    
    $id = $_SESSION['id'];

    $query = "select wallet from `user` where `id` ='".$id."'";

     $result = mysqli_query($link, $query);

    $row = mysqli_fetch_assoc($result);

    if(array_key_exists("submit",$_POST))
        {
             $amount = $_POST["amount"];
             $error="";
             
             if($_POST["amount"])
             {
                 $wallet = $row['wallet'] + $amount;  
                 
                  $query1 = "update `user` set `wallet`='".$wallet."' where `id` ='".$id."'";
                  $result1=mysqli_query($link,$query1);
                  
                  echo "<div class='alert alert-success'>Amount added in your wallet successfully</div>";
                  //header("location:display.php");
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
        <title>Add Money</title>
        
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
            
            <form method="post">
                
                <fieldset class="form-group row">
                        <div class="col-md-offset-4 col-md-4">
                             <input type="text"  align="center" class="form-control"  id="amount" name="amount" required="amount" placeholder="Enter Amount">
                        </div>
                </fieldset>
                
                <fieldset class="form-group row">
                    <div class="col-md-offset-4 col-md-4">
                        <input type="text" class="form-control"  id="purpose" name="purpose" placeholder="Purpose">
                    </div>
                </fieldset>
                
                
                <fieldset class="form-group" align="center">
                    <button type="submit" name="submit" class="btn btn-primary" align="center" id="add">Add Money</button>
                </fieldset>
            </form>
            
        </div>
	

     <!--jquery-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        
        <script src="js/bootstrap.js"></script>
	<script type="text/javascript">
	    
	</script>
    </body>
</html>