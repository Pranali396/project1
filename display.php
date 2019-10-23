<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    include "db.php";
    session_start();
    $user = $_SESSION['id'];
    
    $query ="select * from `user` where `id` != '".$user."' and `verify` < 3 and `id` not in (select `verified_user_id` from `verify` where `user_id` = '".$user."') ";
    $result = mysqli_query($link,$query);
   
   $query1 = "select `verify` from `user` where `id`='".$user."' ";
   $result1 = mysqli_query($link,$query1);
   $verified = mysqli_fetch_array($result1);
  
 
    $sql="select * from `user` where  `verify` = 3 and `id` != '".$user."'";
    $result2 = mysqli_query($link,$sql);
    
   
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width , initial-scale=1.0">
        <meta http-eqiv="X-UA-compatible" content="IE=edge">
        <title>Profile</title>
        
        <link href="css/bootstrap.css" rel="stylesheet">
        
        <style type="text/css">
            
          
            
            h4
            {
                margin-left:8%;
                font-size:1.8em;
                font-weight:bold;
                text-decoration:underline;
            }
            
            .wallet
            {
                margin-top:5%;
            }
            
            #amt
            {
                width:35px;
                height:35px;
                margin-top:10px;
                margin-left:8%;
                margin-right:5px;
                margin-bottom:5%;
                padding-left:5px;
            }
         
            .logout
            {
                margin-top:8%;
            }
            
           #my
           {
               margin-bottom:2%;
           }
            
            #dropdownMenuButton
            {
                margin-top:5px;
                margin-left:83%;
                width:120px;
            }
           
           #add
           {
               margin-left:4px;
               margin-right:4px;
           }
        </style>
    </head>
    <body>
        <div class="navbar navbar-default navbar-fixed ">
            <div class="container">
                
                <div class="nav pull-right">
                 
                  <a class="btn btn-large btn-primary logout" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
        
        
        
        
        
        <h4 align="left">New User Details</h4>
        
        <div class="container">
            <table  border="0" width="500" align="center" class="table table-striped table-bordered">                     
                 <div class="table responsive col-md-2">
                        <thead>
                              <tr>
                                  <th>Id</th>
                                  <th>username</th>
                                  <th>verify count</th>
                                  <th>verify New User</th>
                              </tr>
                       </thead>
                       <tbody>
                            <?php 
                                            $i = 1;
                            
                                            while($row = $result->fetch_assoc()) 
                                            {
                                                echo '<tr>
                                                          <td scope="row"> '.$i.' </td>
                                                          <td scope="row"> '.$row["username"].' </td>
                                                          <td scope="row"> '.$row["verify"].' </td>
                                                          
                                                          <td><button type="button" id="btn1" class="btn btn-primary" onclick= "javascript:verify('.$row["id"].');">verify</button></td>
                                                      </tr>';
                                                      
                                                $i++;
                                            }
                                
                            ?>
                        </tbody>
                 </div>
            </table>
         </div>
                
        
        
        <? 
        if($verified[0] ==3)
        {
            ?>
        
         <div class="wallet">
             <?php
             
              
              $query = "select `wallet` from `user` where `id` ='".$user."'";
              $res1=mysqli_query($link,$query);
              $r = mysqli_fetch_assoc($res1);
              //echo $r["wallet"];
              
             
             ?>
            
             <h4 align="left" id="my">My Wallet Balance</h4>
             
             <input type="text" id="amt" value="<?php echo $r['wallet'];?>">
             
            
             <a class="btn btn-large btn-primary" id="add" href="add.php");">Add Money</a>
             
             <a class="btn btn-large btn-success" id="send" href="send.php");">Send Money</a>
         </div>
        
        
          
        
        <h4 align="left">Verified Users</h4>
            
            
          
            
             
        <div class="container">
            <table  border="0" width="500" align="center" class="table table-striped table-bordered" >                     
                 <div class="table responsive col-md-2">
                        <thead>
                              <tr>
                                  <th>Id</th>
                                  <th>Username</th>
                                  <th>Balance</th>
                              </tr>
                       </thead>
                       <tbody>
                            <?php 
                                            $i = 1;
                                        
                                            while($row = $result2->fetch_assoc()) 
                                            {
                                                echo '<tr>
                                                          <td scope="row"> '.$i.' </td>
                                                          <td scope="row"> '.$row["username"].' </td>
                                                          <td scope="row"> '.$row["wallet"].' </td>
                                                          
                                                      </tr>';
                                                      
                                                      $i++;
                                            }
                                
                            ?>
                        </tbody>
                 </div>
            </table>
         </div>
         <?
            }
         ?>

                
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        
        <script src="js/bootstrap.js"></script>
        
        <script type="text/javascript">
            
               function verify(id)
               {
                   
                    	console.log(verify);
                    $.ajax({
                		
                		type:'POST',
                		url:'verify.php',
                		data:{'id':id},
                		success:function(data)
                		{
                			
                			console.log(data);
                			
                			if(data == "success")
                				{	
                					$('.message').html("<div class='alert alert-success'> User Verified Successfully.</div>");
                					location.reload();
                					
                				}
                				else{
                					$('.message').html("<div class='alert alert-danger'>Please Try Again</div>");
                				}
                			
                		}
                		
                	});          
               }
                  
                     
              
                       
                
                   
                           
             
           
        </script>
    </body>
</html>