<?php
$conn = ( "host=localhost port=5432 dbname=KampSepeti user=pizza password=Test01" );
$dbconn = pg_connect($conn);

$pmenu = $cmenu = null;
if (isset($_GET["pcat"])) {
    $pmenu = $_GET["pcat"];

    $result=pg_query($dbconn , "SELECT * from public.city where reg_id = '".$pmenu."' ");
    $row = pg_fetch_assoc($result);
  

}


if (isset($_POST['submit'])) {
    if (isset($_POST['ccat'])) {
        $pmenu = $_POST['pcat'];
    }
    if (isset($_POST['ccat']) && is_numeric($_POST['ccat'])) {
        $cmenu = $_POST['ccat'];
    }
    if (isset($_POST['ccat']) && is_numeric($_POST['ccat'])) {
        echo $pmenu  . $cmenu;
    } else if (isset($_POST['ccat'])) {
        echo  $pmenu;
    }
    
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
        <title>...</title>
        <script type="text/javascript">
           
            function autoSubmit()
            {
                with (window.document.form) {
                    
                    if (pcat.selectedIndex === 0) {
                        window.location.href = 'sourcecode.php';
                    } else {
                        window.location.href = 'sourcecode.php?pcat=' + pcat.options[pcat.selectedIndex].value;
                    }
                }
            }
        </script>
    </head>
    <body>
        <?php
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        ?>
        <form class="form" id="form" name="form" method="post" action="<?php echo $actual_link; ?>">
           
   Name:<br>
   <input type="text" class="form" name="name"><br>
   Email:<br>
   <input type="email" class="form" name="email"><br>
   Password:<br>
   <input type="password" class="form" name="password"><br>
   Age:<br>
   <input type="text" class="form" name="age"><br>
   Gender:<br>
   <input type="radio" name="gender" class="form"  value="male" checked> Male<br>
  <input type="radio" name="gender" class="form" value="female"> Female<br>
  <input type="radio" name="gender" class="form"  value="other"> Other <br>
              



<?php require_once 'data.php'; ?>

<select class="form-control" name="location" id="location">
  <?php foreach($cities as $c) { ?>
    <optgroup label="<?php echo $c['title']; ?>">
      <?php foreach($c['districts'] as $d) { ?>
        <option value="<?php echo $c['title']."+".$d; ?>"><?php echo $c['title']; ?> / <?php echo $d; ?></option>
      <?php } ?>
    </optgroup>
  <?php } ?>
</select>


                <p><input name="submit" value="Submit" type="submit" /></p>
           
        </form>
    </body>
    <?php 
if (isset($_POST['submit']))
{
if(isset($_POST['name'])) { $name=$_POST['name'];}
if(isset($_POST['email'])) { $email=$_POST['email'];}
if(isset($_POST['password'])) { $password=$_POST['password'];}
if(isset($_POST['age'])) { $age=$_POST['age'];}
if(isset($_POST['gender'])) { $gender=$_POST['gender']; if($gender=='female'){ $gender=0;} $gender=1;}
if(isset($_POST['ccat'])) { $city=$_POST['ccat']; }
if(isset($_POST['pcat'])) { $region=$_POST['pcat']; } 
}
print_r($_POST); 


echo "INSERT INTO public.user(
	name, email, password, age, gender, created_date, user_city, processedby, processeddate, type, user_reg)
    VALUES ('".$name."', '".$email."', '".md5($password)."', '".$age."', '".$gender."', CURRENT_TIMESTAMP, '".$city."', 1, CURRENT_TIMESTAMP, 1 , '".$region."')";

if($name!='' && $email!='' && $password!='' && $age!='' && $gender!='') {
  $result=pg_query($dbconn,  " INSERT INTO public.user(
	name, email, password, age, gender, created_date, user_city, processedby, processeddate, type, user_reg)
    VALUES ('".$name."', '".$email."', '".md5($password)."', '".$age."', '".$gender."', CURRENT_TIMESTAMP, '".$city."', 1, CURRENT_TIMESTAMP, 1 , '".$region."')"); 
    }
    else{
       echo 'HATA!';
    }
    
    $row=pg_fetch_assoc($result);
    
    print_r($row);

?>
</html>