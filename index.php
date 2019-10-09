
<?php
session_start();
/*ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);*/




if( $_SESSION['email']!= "" &&
$_SESSION['password'] != ""){
   // echo "Wellcome user:  ".$_SESSION['email']." to camping home page!";
    //echo "User:  ".$_SESSION['user_id']."";
    $userId = $_SESSION['user_id'];
    
    
}
else  {
    header("Location: main.php");
}





$conn = ( "host=localhost port=5432 dbname=KampSepeti user=pizza password=Test01" );
$dbconn = pg_connect($conn);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        a{
           
            border-radius:10px;            
            padding-left:5px;
            color:black;
            text-decoration:none;        
        }
        #head{
             margin-top:1px;
            background:#9B9797;
        }

        body{
            background-image:url("campfiles/visual/png/lanet.jpg");
            background-color:#E0F6D5;  
            background-repeat:no-repeat;
            background-size:1400px 650px;
            background-position:top;               
                                        }
       .a{
           color:#000000;
           margin-bottom:10px;
       }
    
    
    
    </style>

<link rel="stylesheet" href="node_modules/animate.css/animate.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body >
<div id="head" >
<img src="campfiles/visual/png/fire.png" height="15" height="15" > <a href="index.php" class="a"><b>Anasayfa<b></a>    
<img src="campfiles/visual/png/fire.png" height="15" height="15"><a href="about.php" class="a">Biz kimiz?</a>
<img src="campfiles/visual/png/fire.png" height="15" height="15"><a href="camp_ground.php" class="a">Kamp Yerleri</a>
<img src="campfiles/visual/png/fire.png" height="15" height="15"><a href="logout.php" class="a">Çıkış</a>
</div>
<div>


</div>

    
    
    
</body>
</html>