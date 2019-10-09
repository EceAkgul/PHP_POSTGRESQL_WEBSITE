<?php
$conn = ( "host=localhost port=5432 dbname=KampSepeti user=pizza password=Test01" );
$dbconn = pg_connect($conn);

if(isset($_GET['name'])){

    $result=pg_query($dbconn , "SELECT camp_explanation from campground where camp_id= '".$_GET['name']."'  ");
    $row=pg_fetch_assoc($result);
    $explanation=$row['camp_explanation'];
    $image=pg_query($dbconn, " SELECT viusal_path from visual where camp_id= '".$_GET['name']."' ");
    $image=pg_fetch_assoc($image);
    $path=$image['viusal_path'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<style>
#image{
   
    width:150px;
    height:150px;
   }
   #head{
             margin-top:1px;
            background:#9B9797;
        }

</style>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div id="head" >
<img src="campfiles/visual/png/fire.png" height="15" height="15" > <a href="index.php" class="a"><b>Anasayfa<b></a>    
<img src="campfiles/visual/png/fire.png" height="15" height="15"><a href="about.php" class="a">Biz kimiz?</a>
<img src="campfiles/visual/png/fire.png" height="15" height="15"><a href="camp_ground.php" class="a">Kamp Yerleri</a>
<img src="campfiles/visual/png/fire.png" height="15" height="15"><a href="logout.php" class="a">Çıkış</a>
</div>
       <div>
      <p> <?php echo $explanation ?> </p>
      </div>

      <div>
     <img id="image" src=" <?php echo $path ?>">
      </div>
</body>


<!-- /*
if(isset($_GET['name'])){

    $result=pg_query($dbconn , "SELECT camp_explanation from camp_ground where camp_id= '".$_GET['name']."'  ");
    $row=pg_fetch_assoc($result);
    print_r($row);
}
*/-->

</html>