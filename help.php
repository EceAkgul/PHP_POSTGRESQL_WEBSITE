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
    <title>HELP!</title>
</head>
<body>
<form method="POST">
    NAME:<br>
     <input type="text" name="name"><br>
    EMAIL:<br>
     <input type="email" class="form" name="email"><br>
    PASSWORD:<br>
     <input type="password" class="form" name="password"><br>
    AGE:<br>
     <input type="number" class="form" name="age"><br>
    GENDER:<br>
     <input type="radio" name="gender" class="form"  value="male" checked> Male<br>
     <input type="radio" name="gender" class="form" value="female"> Female<br>
     <input type="radio" name="gender" class="form"  value="other"> Other <br>
     
     BOLGE: <br>
      <select name="region">  <br>
 
          <?php                        
          $result=pg_query($dbconn , " SELECT * from public.region " );
          while ($row = pg_fetch_assoc($result)) {
            echo '<option value="'.htmlspecialchars($row['reg_id']).'">'.$row['name'].'</option>';                           
              }

            ?>
         </select><br>
      SEHIR ve ILCE: <br>
      <?php require_once 'data.php'; ?>
     
	<select class="form-control" name="city" id="location">
	  <?php foreach($cities as $c) { ?>
	    <optgroup label="<?php echo $c['title']; ?>">
	      <?php foreach($c['districts'] as $d) { ?>
	        <option value="<?php echo $c['title'];?> / <?php echo $d;?>"><?php echo $c['title']; ?> / <?php echo $d; ?></option>
	      <?php } ?>
	    </optgroup>
    <?php } ?>
    
  </select> <br>
  

        <input type="submit" name="submit"><br>
 </form>


 <?php



 if(isset($_POST['submit'])){


     if(isset($_POST['name'])){$name=$_POST['name'];}
     if(isset($_POST['email'])){$email=$_POST['email'];}
     if(isset($_POST['password'])){$password=$_POST['password'];}
     if(isset($_POST['age'])){$age=$_POST['age'];}
     if(isset($_POST['gender'])){$gender=$_POST['gender'];} if($gender=='female'){$gender=0;} else{$gender=1;}
     if(isset($_POST['region'])){$region=$_POST['region'];}
     if(isset($_POST['city']))  {$city=$_POST['city'];}
     $city=explode("/", $city); 
    
     $user_city=$city[0];
     echo $user_city;
     $city_code=pg_query($dbconn, " SELECT * from public.city where name= '".trim($user_city)."' ");
     $city_code=pg_fetch_assoc($city_code);
     $result_city_code = $city_code['code'];
     echo $result_city_code;
              
      // die;
    
     
     $dist= $city[1];
     echo $dist;
     

    
 }

 
 echo "INSERT INTO public.user(
	name, email, password, age, gender, created_date,  processeddate, type, user_reg , user_dis , city_code )
	VALUES ('".$name."', '".$email."', '".md5($password)."', '".$age."', '".$gender."',CURRENT_TIMESTAMP, 
    CURRENT_TIMESTAMP , 1 , '".$region."' , '".$dist."');";


   
    

 $result=pg_query($dbconn, " INSERT INTO public.user(
	name, email, password, age, gender, created_date, processeddate, type, user_reg, user_dis, city_code)
	VALUES ('".$name."', '".$email."', '".md5($password)."', '".$age."', '".$gender."',CURRENT_TIMESTAMP,  
    CURRENT_TIMESTAMP , 1 , '".$region."' , '".$dist."' , '".$result_city_code."');");
    $row=pg_fetch_assoc($result);

    print_r($row);







?>

</body>
</html>