<!DOCTYPE html>

<?php
$conn = ( "host=localhost port=5432 dbname=KampSepeti user=pizza password=Test01" );
$dbconn = pg_connect($conn);
?>

<html lang="en">
<head>
    <script src="https:localhost/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

   <form id="myform" method="post">

   Name:<br>
   <input type="text" name="name"><br>
   Email:<br>
   <input type="email" name="email"><br>
   Password:<br>
   <input type="password" name="password"><br>
   Age:<br>
   <input type="text" name="age"><br>
   Gender:<br>
   <input type="radio" name="gender" value="male" checked> Male<br>
  <input type="radio" name="gender" value="female"> Female<br>
  <input type="radio" name="gender" value="other"> Other <br>
  <?php
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
        echo 'Parent Cat Id: ' . $pmenu . ' -> ' . 'Subcategory Id: ' . $cmenu;
    } else if (isset($_POST['ccat'])) {
        echo 'Parent Cat Id: ' . $pmenu;
    }
}
?>
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

 
  
  <?php
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        ?>
  

  <form class="form" id="form" name="form" method="post" action="<?php echo $actual_link; ?>">
            <fieldset>
                <p class="bg">
                    Bölge: <br>
                    <select id="pcat" name="pcat" onchange="autoSubmit();">
                        <option value="">Bölge Seçiniz..</option>
                        <?php
                        
                        $result=pg_query($dbconn , " SELECT * from public.region " );
                        $row = pg_fetch_assoc($result);
                        while ($row = pg_fetch_assoc($result)) {
                            echo '<option value="'.htmlspecialchars($row['reg_id']).'">'.$row['name'].'</option>';
                            //echo ("<option value=\"{$row['reg_id']}\" " . ($pmenu == $row['reg_id'] ? " selected" : "") . ">{$row['name']}</option>");
                        }
                        ?>
                    </select>
                </p>
                <?php
                //check whether parent category was really selected and parent category id is numeric
                if ($pmenu != '' && is_numeric($pmenu)) {
                    ////select sub-categories categories for a given parent category id
                    $result=pg_query($dbconn, " SELECT name from public.city where reg_id= '".$pmenu."' ");
                    $row=pg_fetch_assoc($result);
                   // $sql = "select name from public.city where reg_id=" . $pmenu;
                  //  $result = pg_query($dbconn,$sql);
                    if (pg_num_rows($result) > 0) {
                        ?>
                        <p class="bg">
                            Şehir: <br>
                            <select id="ccat" name="ccat">
                                <option value="">Şehir Seçiniz..</option>
                                <?php
                                //POPULATE DROP DOWN WITH SUBCATEGORY FROM A GIVEN PARENT CATEGORY
                                while ($row = pg_fetch_assoc($result)) {
                                    echo '<option value="'.htmlspecialchars($row['reg_id']).'">'.$row['name'].'</option>';
                                   // echo ("<option value=\"{$row['name']}\" " . ($cmenu == $row['name'] ? " selected" : "") . ">{$row['name']}</option>");
                                }
                                ?>
                            </select>
                        </p>
<input type="submit" name="submit"><br>

   
   </form>

    
</body>

<?php 

if(isset($_POST['name'])) { $name=$_POST['name'];}
if(isset($_POST['email'])) { $email=$_POST['email'];}
if(isset($_POST['password'])) { $password=$_POST['password'];}
if(isset($_POST['age'])) { $age=$_POST['age'];}
if(isset($_POST['gender'])) { $gender=$_POST['gender']; if($gender=='female'){$gender=0;} $gender=1;}
if(isset($_POST['city'])) { $city=$_POST['user_city']; }
echo "INSERT INTO public.user(
	name, email, password, age, gender, created_date, user_city, processedby, processeddate, type)
    VALUES ('".$name."', '".$email."', '".md5($password)."', '".$age."', '".$gender."', CURRENT_TIMESTAMP, '".$city."', 1, CURRENT_TIMESTAMP, 1 )";

if($name!='' && $email!='' && $password!='' && $age!='' && $gender!='') {
  $result=pg_query($dbconn,  " INSERT INTO public.user(
	name, email, password, age, gender, created_date, user_city, processedby, processeddate, type)
    VALUES ('".$name."', '".$email."', '".md5($password)."', '".$age."', '".$gender."', CURRENT_TIMESTAMP, '".$city."', 1, CURRENT_TIMESTAMP, 1 )"); }
    
    $row=pg_fetch_assoc($result);
    
    print_r($row);

?>

</html>