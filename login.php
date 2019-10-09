<?php

session_start();
session_destroy();
session_start();
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        *{
  box-sizing: border-box;
}

body,
html{
  background: #111;
  justify-content: center;
  align-items: center;
  display: flex;
  font-family: monospace;
  width: 100%;
  height: 100%;
}

form{
  max-width: 34rem;
  width: 90%;
}

form > div{
  position: relative;
}

form label{
  position: absolute;
  opacity: 0.6;
  font-size: 1.25rem;
  left: 1rem;
  pointer-events: none;
  color: #f2cb79;
  transition: all .22s;
  top: 50%;
  transform: translateY(-50%);
  display: block;
}

form input{
  width: 100%;
  padding: 1.5rem;
  background: #222;
  margin: 1.5rem 0;
  border: none;
  color: #aaa;
  font-size: 1.125rem;
}

form input:focus{
  background: #333;
  outline: 0;
}

form label.active{
  top: 0;
  font-size: 1.125rem;
  transform: translateY(0);
  left: 0;
  opacity: 1;
}

form .cover{
  width: 100%;
  position: absolute;
  background: #111;
  height: 4px;
  top: 1.25rem;
}

        </style>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="http://localhost/camping/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
<link rel="stylesheet" href="node_modules/animate.css/animate.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form method="post" >
    <div>
    <label>Email</label>
    <input type="text" name="email">
    <div class="cover"></div>
  </div>   
  <div>
    <label>Password</label>
    <input type="password" name="password">
    <div class="cover"></div>
  </div>   
     <input type=submit value="Let's Go!" name="Kaydet">

</form>
     </body>

   <?php 
 
    
    $conn = ( "host=localhost port=5432 dbname=KampSepeti user=pizza password=Test01" );
    $dbconn = pg_connect($conn);


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

   <script>
let input = document.querySelectorAll('input');

function hover(){
  let label = this.parentNode.children[0];
  label.classList.add('active');
}

function mouseout(){
  let label = this.parentNode.children[0],
      field = this.parentNode.children[1],
      textLength = field.value.length;
  
  if(textLength == 0 && field !== document.activeElement){
    label.classList.remove('active'); 
  }
}

input.forEach(item => {
  item.addEventListener('mouseover', hover);
  item.addEventListener('focus', hover);
  item.addEventListener('mouseout', mouseout);
  item.addEventListener('blur', mouseout);
});
       </script>


</html>