<?php
$conn = ( "host=localhost port=5432 dbname=KampSepeti user=pizza password=Test01" );
$dbconn = pg_connect($conn);
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

<style> 
#page-body{
    margin-top:100px;
}
#camplist {
  /*border-style: solid;
  border-width: 1px;*/
  padding:5px;
  display: -webkit-flex; /* Safari */
  display: flex;
  background-color:#9B9797;
}

#camplist div {
  width: %80;
  height: 40px;
 
}
#campitem1{
  width: 40px;
  height: 40px;
 
}

#campitem2{
  width: 200px;
  height: 40px;
  padding-top:12px;
}

#campitem3{
  width: 300px;
  height: 40px;
  padding-top:12px;
}

#campitem4{
  width: 70px;
  height: 20px;
  padding-top:12px;
  color:#FFFFFF;
}
.hiden{
   width:20em;
   white-space: nowrap;  
   overflow: hidden;
   text-overflow: ellipsis;
   -webkit-box-orient: vertical;

}

body{
            background-image:url("campfiles/visual/png/lanet.jpg");
            background-color:#E0F6D5;  
            background-repeat:no-repeat;
            background-size:1400px 650px;
            background-position:top;    
            background-attachment:fixed;           
                                        }
             #head{
             margin-top:1px;
            background:#9B9797;
        }
</style>


</head>
<body>
<div id="head" >
<img src="campfiles/visual/png/fire.png" height="15" height="15" > <a href="index.php" class="a"><b>Anasayfa<b></a>    
<img src="campfiles/visual/png/fire.png" height="15" height="15"><a href="about.php" class="a">Biz kimiz?</a>
<img src="campfiles/visual/png/fire.png" height="15" height="15"><a href="camp_ground.php" class="a">Kamp Yerleri</a>
<img src="campfiles/visual/png/fire.png" height="15" height="15"><a href="logout.php" class="a">Çıkış</a>
</div>
<!-- 1. veritabanının ilgili tablosundan (campgroud) kampların tümünü getir.
2. bunlar geldiğinde bir array içerisinde yer alıyor olacaklar.
3. bu kayıtları fetch_array_bla bla fonksiyonu ile döndür ve ilgili bilgileri aşağıdaki değişken alanlarına yazdır.
4. linkleri ve kamp detay sayfası geçişlerini kontrol et. -->

<div id="page-body">
<hr>
<?php
    
  $result=pg_query($dbconn, "SELECT * FROM public.campground " );
  while($row_camp = pg_fetch_array($result)) {
?> 
    <div id="camplist" >
        <div id="campitem1"><img src="campfiles/visual/png/tree-outline-of-leaf-shape.png" width="40px" height="40px"/></div>
        <div id="campitem2"><b><?php echo $row_camp['camp_name']; ?></b> </div>
        <div id="campitem3"><strong><?php echo $row_camp['camp_address']; ?></strong> </div>
        <div id="campitem3" class="hiden"><b><?php echo $row_camp['camp_explanation']; ?></b> </div>
        <div id="campitem4"> <b><a href="campdetails.php?name=<?php echo $row_camp['camp_id'] ?>"> </b>Detaylar </a></div>
    </div>
    <hr>

    </div>
   
    <?php
  }
    ?>



</body>
</html>