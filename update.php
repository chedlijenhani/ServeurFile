<?php
session_start ();
// On récupère nos variables de session
if (isset($_SESSION['login']) && isset($_SESSION['pwd'])) {
require_once 'config.php';
?>
<!DOCTYPE html>
<html>
<head>

    <title>MindTable</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
<link href="css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <!-- FooTable -->
    <link href="css/plugins/footable/footable.core.css" rel="stylesheet">
<link href="css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">


</head>


<body class="gray-bg">
<div class="row border-bottom">
  <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
  <div class="navbar-header">

  </div>
      <ul class="nav navbar-top-links navbar-right">
          <li style="padding: 20px">
              <span class="m-r-sm text-muted welcome-message">Welcome to Mind .</span>
          </li>

          <li>
            <a href="para.php"><i class="fa fa-cog"></i></a>
          </li>
          <li>
              <a href="logout.php">
                  <i class="fa fa-sign-out"></i>Logout
              </a>
          </li>
      </ul>

  </nav>
</div>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Table</h2>
    </div>
    <div class="col-sm-8">
        <div class="title-action">

        </div>
    </div>
</div>
       <div class="ibox-content">
         <form name="form" action="update.php" method="post" >
           <input type='hidden' name='id' class='form-control' value='<?php echo $_POST["id"]; ?>'>
           <?php //print_r(explode('upstream', file_get_contents($pathfichier)));
           $x=0;
           $ch="";
           //$tab[] = array();
           //$i=0;
           $str=explode('upstream', file_get_contents($pathfichier));
           foreach ($str as $key => $value){

             if($value!=""){
               //  echo $key."=>".$value."<br>";
           $str1=explode(' ',$value);
           foreach ($str1 as $key1 => $value1){

           if ($value1!=""){
           //echo $key1."=>".$value1."<br>";
           if($key1==1){
             $domain=$value1;

           }
           if($value1=="server"){
             $x=$key1+1;
             //echo $x."<br>";
           }
           if($key1==$x){
           //echo $key1."=>".$value1."<br>";
           $str2=explode(';',$value1);
           foreach ($str2 as $key2 => $value2){
           //echo $key2."=>".$value2."<br>";
           if(strpos($value2,":")==true){
           //echo $key2."=>".$value2."<br>";
           $str3=explode(':',$value2);
           foreach ($str3 as $key3 => $value3){
           //echo $key3."=>".$value3."<br>";
           if($key3==0){
           $ip=$value3;

           }else{
             $port=$value3;

           }
           }
           }
           }
           }
           }
           }
           $str4=explode('#parametre',$value);
             foreach ($str4 as $key4 => $value4){
           //echo $keyst."=>".$val."<br>";
           if($key4==1){
           $up=$value4;
           }}
           $tab[$key]=array($domain,$ip,$port,$up);
           }
           }
           ?>
         <?php   $id=$_POST['id'];

         foreach ($tab as $key => $val){
          if($id==$key){
            foreach ($val as $keyt => $valuet){
            //echo $keyt."=>".$valuet."<br>";
            if($keyt==0){

            echo '<div class="form-group"><label>domain :</label><Input type="text" class="form-control" name="domain" value="'.$valuet.'"  required></div>';
          }
            if($keyt==1){

            echo '<div class="form-group"><label>ip :</label><Input type="text" class="form-control" name="ip" value="'.$valuet.'"  required></div>';
          }
            if($keyt==2){

            echo '<div class="form-group"><label>port :</label><Input type="number" class="form-control" name="port" min="1" max="64000" value="'.$valuet.'"  required></div>';
          }
          if($keyt==3){ ?>
            <div class="form-group"><label>parametre :</label><TEXTAREA name="modif" class="form-control" rows="5" COLS="40"><?php echo $valuet; ?></TEXTAREA></div>
<?php        }
         }}}?>

         <input type="submit" class="btn btn-primary" name="update" value="update">
         </form>
</div>

<?php
//var_dump($tab);
//print_r($tab);
if(isset($_POST['update'])){

  $id=$_POST['id'];
  $domain=$_POST['domain'];
  $ip=$_POST['ip'];
  $port=$_POST['port'];
  $up=$_POST['modif'];
  $long = ip2long($ip);
  echo $domain."<br>";
   echo $ip."<br>";
   echo $port."<br>";
   echo $up."<br>";
  if ($long == -1 || $long === FALSE) {
    echo 'IP invalide, merci d\'essayer encore';
  } else {
  foreach ($tab as $key => $val){
 if($id==$key){

   $ch.="upstream ".$domain." {
           server ".$ip.":".$port.";
   }
   server {
       server_name ".$domain.";
       location  {
           proxy_pass http://".$domain.";
           proxy_set_header    Host $host;
           #parametre
".$up."
           #parametre

       }
   }\n";
 }else{
   foreach ($val as $keyt => $valuet){
   //echo $keyt."=>".$valuet."<br>";
   if($keyt==0){
   $DOMAIN=$valuet;}
   if($keyt==1){
   $UPSTREAM_IP=$valuet;}
   if($keyt==2){
   $UPSTREAM_PORT=$valuet;}
   if($keyt==3){
   $UPPARA=$valuet;}
   }
   $ch.="upstream ".$DOMAIN." {
           server ".$UPSTREAM_IP.":".$UPSTREAM_PORT.";
   }
   server {
       server_name ".$DOMAIN.";
       location  {
           proxy_pass http://".$DOMAIN.";
           proxy_set_header    Host $host;
           #parametre
".$UPPARA."
          #parametre

       }
   }\n";
 }
}
//echo $ch ;
 unlink($pathfichier); // suppression du fichier pour le remplacer par le nouveau avec les nouveau éléments
 $ouverture=fopen("$pathfichier","a+"); // Création du nouveau fichier et ouverture du fichier
   fwrite($ouverture,"$ch"); // ecriture
   fclose($ouverture); // fermeture du fichier
    //echo '<h2>Modification effectue</h2>'; // Affichage validation
    //echo "<meta http-equiv='refresh' content='0'>";
    	header('location:home.php');
  }}
?>
<!-- Mainly scripts -->
<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="js/plugins/toastr/toastr.min.js"></script>
<!-- FooTable -->
<script src="js/plugins/footable/footable.all.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="js/inspinia.js"></script>
<script src="js/plugins/pace/pace.min.js"></script>

<!-- Page-Level Scripts -->
<script>
    $(document).ready(function() {

        $('.footable').footable();
        $('.footable2').footable();

    });

</script>

</body>

</html>
<?php
}else{
  echo '<a href="logout.php">Déconnection</a>';
}
?>
