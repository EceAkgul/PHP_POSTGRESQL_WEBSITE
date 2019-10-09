<?php
session_start();
$conn = ( "host=localhost port=5432 dbname=KampSepeti user=pizza password=Test01" );
$dbconn = pg_connect($conn);

if( $_SESSION['email']!= "" &&
$_SESSION['password'] != ""){
   // echo "Wellcome user:  ".$_SESSION['email']." to camping home page!";
    //echo "User:  ".$_SESSION['user_id']."";
    $userId = $_SESSION['user_id'];}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style>
      @import url(https://fonts.googleapis.com/css?family=Roboto);

body {
  font-family: 'Roboto', sans-serif;
   background: url("http://tadalafilforsale.net/data/media/29/54933516.jpg");
  background-repeat: no-repeat;
  background-size: cover;
}

.box {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 50rem;
  background: #9e9c9c;
  padding: 40px;
  box-sizing: border-box;
  border: 2px solid rgba(0,152,0,.3);
  border-radius: 15px;
  box-shadow: 0 5px 10px rgb(0,0,0,.2);
}

.box h1 {
  margin: 0 0 40px;
  padding: 0;
  color: rgb(0,152,0);
  text-align: center;
  text-transform: uppercase;
}

.formgroup {
  position: relative;
  padding: 15px 0 0;
  margin-top: 10px;
}

.formfield {
  font-family: inherit;
  width: 100%;
  border: 0;
  border-bottom: 1px solid;
  outline: 0;
  font-size: 16px;
  color: #212121;
  padding: 7px 0;
  background: transparent;
  transition: border-color 0.1s;
}

.formfield::placeholder {
  color: transparent;
}

.formfield:placeholder-shown ~ .formlabel {
  font-size: 16px;
  cursor: text;
  top: 20px;
}

label, .formfield:focus ~ .formlabel {
  position: absolute;
  top: 0;
  display: block;
  transition: 0.1s;
  font-size: 12px;
  font-weight: bold;
  color: #212121;
}

.formfield:focus ~ .formlabel {
  color: #009800;
}

.formfield:focus {
  padding-bottom: 6px;
  border-bottom: 2px solid #009800;
}

.formbutton {
  margin: 2% 25% 0 25%;
  padding: 0;
}


.button {
  width: 150px;
  border: 1px solid rgba(0,0,0,.4);
  font-weight: 700;
  font-size: 1em;
  padding: 10px;
  cursor: pointer;
  background: #9e9c9c;
  border-radius: 20px;
}

.button:hover {
  background: #009800;
  border: 1px solid rgba(0,152,0,.6);
  box-shadow: 0 5px 10px rgb(0,0,0,.5);
}

/* @media only screen and (max-width: 600px) {
  .formfield {
    width: 50%;
    margin-left: 25%;
    margin-right: 25%;
  }
  
  
}

 */  
    </style>
    <link rel="stylesheet" href="node_modules/animate.css/animate.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form method="POST">
 
 <div class="box">
                <h1>Kamp Yeri Girişi</h1>
                <form autocomplete="off" method="post">
              <div class="formgroup">
                <input type="text" id="fullname" name="name" class="formfield" placeholder="" autocomplete="off" required>
                <label for="fullname" class="formlabel">Kamp Yeri Adı</label>
                <div class="formgroup">
                  <input type="text" id="adres" name="adress" class="formfield" placeholder="" autocomplete="off"  required>
                  <label for="email" class="formlabel">Adres</label>
                </div>
                <div class="formgroup">
                  <input type="tel" id="phone" name="telefon" class="formfield" placeholder="" autocomplete="off" required>
                  <label for="phone" class="formlabel">Telefon Numarası</label>
                </div>
                <div class="formgroup">
                  <input type="number" id="price" name="price" class="formfield" placeholder="" autocomplete="off" required>
                  <label for="price" class="formlabel">Ucret</label>
                </div>
              </div>
              <div class="formgroup">
              <?php require_once 'data.php'; ?>
   
   <select class="form-control" class="formfield" name="city" id="location">
     <?php foreach($cities as $c) { ?>
       <optgroup label="<?php echo $c['title']; ?>">
         <?php foreach($c['districts'] as $d) { ?>
         <label class="formlabel">  <option value="<?php echo $c['title'];?> / <?php echo $d;?>"><?php echo $c['title']; ?> / <?php echo $d; ?></option></label>
         <?php } ?>
       </optgroup>
   <?php } ?>
   
 </select> 

         </div>   
              <div class="formgroup">
              <textarea name="aciklama" id="aciklama" class="formfield" placeholder="" autocomplete="off" rows="3"></textarea>
                <label for="aciklama" class="formlabel">Açıklama</label>
              </div>
                <div class="formbutton">
                <button type="submit" name="submit" value="submit" class="button">Submit</button>
                <button type="reset" value="reset" class="button">Reset</button>
                </div>
             
              </div>
              </form>
         </body>
</html>

<?php
 if(isset($_POST['submit'])){
  if(isset($_POST['name'])){$name=$_POST['name'];}
  if(isset($_POST['city'])){$city=$_POST['city'];}
    $city=explode("/", $city);     
    $camp_city=$city[0];
    $camp_dist=$city[1];
   if(isset($_POST['adress'])){$adress=$_POST['adress'];}
   if(isset($_POST['aciklama'])){$exp=$_POST['aciklama'];}
   if(isset($_POST['telefon'])){$phone=$_POST['telefon'];}
   if(isset($_POST['price'])){$price=$_POST['price'];}

 /*  echo "INSERT INTO public.campground(
    camp_name, camp_city, camp_distinct, camp_address, camp_explanation, camp_tel, camp_user, camp_prices,
     processeddate)
    VALUES ('".$name."', '".$camp_city."', '".$camp_dist."', '".$adress."', '".$exp."', '".$phone."', '".$userId."', 
    '".$price."', CURRENT_TIMESTAMP);";*/



    $result=pg_query($dbconn , "INSERT INTO public.campground(
    camp_name, camp_city, camp_distinct, camp_address, camp_explanation, camp_tel, camp_user, camp_prices,
     processeddate)
    VALUES ('".$name."', '".$camp_city."', '".$camp_dist."', '".$adress."', '".$exp."', '".$phone."', '".$userId."', 
    '".$price."', CURRENT_TIMESTAMP);");
    $row=pg_fetch_assoc($result);
    print_r($row);

 }
?>

