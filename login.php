<?php
/*error_reporting(E_ALL);
ini_set('display_errors', 1);*/
    include "db.php";
    session_start();
  
    
               
                        
                if(array_key_exists("submit",$_POST))
                {
                   
                                $email=$_POST['email'];
                                $password = $_POST['password'];
                                $message="";
                                $error="";
                                
                                $query = "select * from `user` where `email`= '".$email."' and `password` = '".$password."' limit 1" ;
                                
                                $result=mysqli_query($link , $query);
                                
                                
                                $results = mysqli_fetch_array($result);
                                
                              
                                
                                if($results)
                                {
                                     $message = $results[1]." Login Sucessfully!!";
                                     $_SESSION['id'] = $results[0]; 
                                     header("location: display.php");
                                }
                                else
                                {
                                    $error = "Invalid email or password!!";
                                    echo '<div class="alert alert-danger">'.$error.'</div';
                                }        
                }
    
   
?>


<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-eqiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width , initial-scale=1">
        <title>Login</title>
        
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
            #login
            {
                width:8%;
                font-size:1.0em;
            }
        </style>
    
</head>
<body>
    <div class="navbar navbar-light navbar-fixed bg-primary">
            <div class="container">
                   
                <h4 class="navbar-text">Please Login Your Account</h4>
                
                <div class="nav pull-right">
                    
                    <a class="btn btn-large btn-info" href="signup.php">Signup</a>
        
                </div>
            </div>
        </div>
        
     <div class="container">
            
            <form method="post">
                
                <fieldset class="form-group row">
                        <div class="col-md-offset-4 col-md-4">
                             <input type="email"  align="center" class="form-control"  id="inputemail" name="email" placeholder="Enter Email address">
                        </div>
                </fieldset>
                
                <fieldset class="form-group row">
                    <div class="col-md-offset-4 col-md-4">
                        <input type="password" class="form-control"  id="inputpassword" name="password" placeholder="Password">
                    </div>
                </fieldset>
                
                
                <fieldset class="form-group" align="center">
                    <button type="submit" name="submit" class="btn btn-primary" align="center" id="login">Login</button>
                </fieldset>
            </form>
            
            <div class="login-help" align="center">
					   <a href="signup.php" class="text">New User Registration?</a>                  
		    </div>
        </div>
	

     <!--jquery-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        
        <script src="js/bootstrap.js"></script>
	<script type="text/javascript">
	    
	</script>
</body>
</html>
