<?php
    include "db.php";
    session_start();
   
            
        if(array_key_exists("submit",$_POST))
        {
             $username = $_POST["username"];
             $email =$_POST["email"];
             $password = $_POST["password"];
              
            $error="";
            if(!$_POST['username'])
            {
                $error .= "Username is required<br>";
              
            }
            
             if(!preg_match("/^[a-zA-Z ]*$/",$username)) 
            {
                $error .= "Only letters and white space allowed<br>"; 
            }
            
            if(!$_POST['email'])
            {
        
                $error .= "Email Address Required<br>";
                
            }
            
             if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                  $error .= "Invalid email format<br>"; 
            }
            
            if(!$_POST['password'])
            {
               
                $error .= "Password Required<br>";
                
            }
            
            if(strlen($password) < 6)
            {
                $error .= "Password must have  6 character<br>";
            }
            
            if(!$_POST['password'] == $_POST['cpassword'])
            {
                $error .= "Password could not be matched";
            }
            if($error != "")
            {
                $error = "There were Some error's in your form: <br>".$error;
                echo '<div class="alert alert-danger">'.$error.'</div>';
                
            }
            
    
            else
            {
                 $query = "select id from `user` where email ='".$email."'limit 1";
                
                
                
                $result=mysqli_query($link,$query);
                
                if(mysqli_num_rows($result) > 0)
                {
                    $error="These email address is already taken";
                }
                else
                {
                    $query="insert into `user`(`username`,`email`,`password`) values ('".$username."','".$email."','".$password."')";
                
                    if(!mysqli_query($link,$query))
                    {
                        $error="Could not logged in";
                    }
                    else
                    {
                       // $query = "UPDATE `user` SET password ='".md5(md5(mysqli_insert_id($link)).$_POST['password'])."' WHERE id= '".mysqli_insert_id($link)."' LIMIT 1";
                        //mysqli_query($link,$query);
                         echo '<div class="alert alert-success"> Your Registration Successfully Done.</div>';
                    }
               
                }
    
            }
           
            
        }
        
        
?>


<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-eqiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width , initial-scale=1">
        <title>Profile Details</title>
        
        <!--bootstrap-->
        <link href="css/bootstrap.css" rel="stylesheet">
        
        <style type="text/css">
            .navbar-text
            {
                font-weight:bold;
                font-size:2.0em;
               
                padding-left:35%;
            }
            .row
            {
                  width: 100%;
                  margin: 20px auto;
                  
            }
           
            .form-horizontal
            {
                margin-left:20%;
            }
            
            #signup
            {
                width:120px;
                margin-left:35%;
                font-size:1.2em;
            }
            
            #error
            {
                color:red;
            }
            
            #msg
            {
                color:green;
                font-weight:strong;
                font-size:1.2em;
            }
            
            a
            {
                margin-top:10px;
                margin-right:30px;
            }
            
           
        </style>
    </head>
    <body>
        
        <!--<div id="error"><?php echo $error; ?></div>-->
        <div class="navbar navbar-default navbar-fixed ">
            <div class="container">
                   
                            <h4 class="navbar-text">New User Registartion</h4>
                <div class="nav pull-right">
                  <a class="btn btn-large btn-info" href="login.php">Login</a>
                  
                </div>
            </div>
        </div>
        <div class="container">
             
            <form method="post">
                <fieldset class="form-group row">
                    <label for="name" class="col-md-6">User Name</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                        </div>
                </fieldset>
                <fieldset class="form-group row ">
                    <label for="inputemail" class="col-md-6">Email Address</label>
                        <div class="col-md-10">
                             <input type="email" class="form-control" id="inputemail" name="email" placeholder="Email address">
                        </div>
                </fieldset>
                
                <fieldset class="form-group row">
                    <label for="inputpassword" class="col-md-6">Password</label>
                    <div class="col-md-10">
                        <input type="password" class="form-control" id="inputpassword" name="password" placeholder="Password">
                    </div>
                </fieldset>
                
                 <fieldset class="form-group row">
                    <label for="inputpassword" class="col-sm-6"> Confirm Password</label>
                    <div class="col-md-10">
                        <input type="password" class="form-control" name="cpassword" id="inputpassword" placeholder="Again Enter Password">
                    </div>
                </fieldset>
                
                <fieldset class="form-group">
                    <button type="submit" name="submit" class="btn btn-success" id="signup">Sign Up!</button>
                </fieldset>
                
            </form>
        </div>
        <!--jquery-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        
        <script src="js/bootstrap.js"></script>
  </body>
</html>