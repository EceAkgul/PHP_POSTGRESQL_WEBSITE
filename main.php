<?php
session_start();
session_destroy();
session_start();

$conn = ( "host=localhost port=5432 dbname=KampSepeti user=pizza password=Test01" );
$dbconn = pg_connect($conn);
?>


<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Login</title>
	<style>

		body{
			background-image:url("https://i.imgur.com/7XPpSoL.jpg");
			background-repeat:no-repeat;
			background-size:1570px 725px;
			}
		

		#car{
			animation-name:carani;
			animation-duration:5s;
			animation-delay:0s;
			background-image:url("https://i.imgur.com/AA5m3Ep.png");
			width:340px;
			height:188px;
			position:absolute;

			animation-iteration-count:infinite;
			background-size:200px;
			background-repeat:no-repeat;
			margin-top:600px;


			}
			@keyframes carani{
			from{margin-left:-100px;}
			to{margin-left:1500px;}
			
			}
		#logname{
			width:530px;
			height:42px;
			margin-left:500px;
			margin-top:254px;
			background-color: #646267;
			border:none;
		}	
		#logpw{
			width:530px;
			height:42px;
			margin-left:500px;
			margin-top:5px;
			background-color: #646267;
			border:none;
		}
		#click{
		background-color: #646267;
	    border: none;
	    color: white;
	    padding: 15px 340px;
	    text-align: center;
	    text-decoration: none;
	    display: inline-block;
	    font-size: 16px;
		margin-left:285px;
		border-radius:50px;
		}
		#click:hover{
		background-color:#8e8b92;
		box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
		
		
		}
		
	</style>
</head>
<body>
	<form method="post">
	<div id="car">   </div>
	<input id="logname" type="text" name="email"><br><br>
	<input id="logpw" type="password" name="password"><br><br>
    <input id="click" type="submit" value="GİRİŞ YAP">	

    </form>
    
  
	 

</body>

<?php

if(isset($_POST)){
    if(isset($_POST['email']) && isset($_POST['password']))  
    {

        $email=$_POST['email'];
        $password=md5($_POST['password']);
    }    
   
    
    
    
     if(isset($_POST['email'])!='' && isset($_POST['password'])!=''){

         $pass=pg_query($dbconn, "SELECT password from public.user where email = '".$email."' ");
         $pass1=pg_fetch_assoc($pass);

         //echo $pass1['password']; 
         

        if($pass1['password']!= $password) { 
         
                header("Location:notfound.php"); 
                exit();

            } 
       
      $result=pg_query($dbconn , " SELECT email , password , user_id from public.user where email = '".$email."' " );      
      $row=pg_fetch_assoc($result); 
      $_SESSION['email'] = $row['email']; // store username
      $_SESSION['password'] = $row['password']; // store password
      $_SESSION['user_id'] = $row['user_id'];
      header("Location:index.php");
    } 
    
    }


      print_r($row);
     
    
   ?> 

</html>