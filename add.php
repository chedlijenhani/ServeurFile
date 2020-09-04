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
              <span class="m-r-sm text-muted welcome-message">Welcome to Mind Serveur.</span>
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
         <form name="form" action="add.php" method="post" onsubmit="required()">

     <div class="form-group">  <label>domain :</label>  <Input type="text" class="form-control" name="domain" required></div>
   <div class="form-group">    <label>ip :</label>  <Input type="text" class="form-control" name="ip"  required></div>
   <div class="form-group">    <label>port :</label>  <Input type="number" class="form-control" name="port" min="1" max="64000" required ></div>
  <div class="form-group"><label>parametre :</label>
<TEXTAREA name="modif" class="form-control" rows="5" COLS="40"><?php echo file_get_contents("var.txt"); ?></TEXTAREA></div></div>
     </div>
     <div class="modal-footer">
        <input type="submit" class="btn btn-primary" name="add" value="add">
        </form>
</div>

<?php
if(isset($_POST['add'])){
//$id=$_POST['id'];
$domain=$_POST['domain'];
$ip=$_POST['ip'];
$port=$_POST['port'];
$var1=$_POST['modif'];
$long = ip2long($ip);

if ($long == -1 || $long === FALSE) {
echo 'IP invalide, merci d\'essayer encore';
} else {

  $myfile = fopen($pathfichier, "a+") or die("Unable to open file!");
  $txt = "upstream ".$domain." {
          server ".$ip.":".$port.";
  }
  server {
      server_name ".$domain.";
      location  {
          proxy_pass http".$domain.";
          proxy_set_header    Host $host;
         #parametre
".$var1."
         #parametre
      }
  }\n";

  fwrite($myfile, $txt);

  fclose($myfile);

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


</body>

</html>
<?php
}else{
  echo '<a href="logout.php">Déconnection</a>';
}
?>
