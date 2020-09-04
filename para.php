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
            <a href="home.php"><i class="fa fa-home"></i></a>
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
         <form class="m-t" action="para.php" method="post">
<?php

echo '<div class="form-group"><label>user :</label><Input type="text" class="form-control" name="user" value="'.$user.'"  ></div>';
echo '<div class="form-group"><label>mot de passe :</label><Input type="password" class="form-control" name="mdp" value="'.$mdp.'"  ></div>';
echo '<div class="form-group"><label>path fichier :</label><Input type="text" class="form-control" name="path" value="'.$pathfichier.'"  ></div>';

 ?><div class="form-group"><label>parametre :</label>
     <TEXTAREA name="modif" class="form-control" rows="5" COLS="40"><?php echo file_get_contents("var.txt"); ?></TEXTAREA></div>
 <input type="submit" class="btn btn-primary" name="para" value="valide">
</form>

</div>

<?php

if(isset($_POST['para'])){
$admin=$_POST['user'];
$password=$_POST['mdp'];
$path=$_POST['path'];
$var=$_POST['modif'];
$ch=$admin."|".$password."|".$path."|";
//echo $ch ;
 unlink("config.txt"); // suppression du fichier pour le remplacer par le nouveau avec les nouveau éléments
 $ouverture=fopen("config.txt","a+"); // Création du nouveau fichier et ouverture du fichier
   fwrite($ouverture,"$ch"); // ecriture
   fclose($ouverture); // fermeture du fichier
    //echo '<h2>Modification effectue</h2>'; // Affichage validation
    unlink("var.txt");
    $ouv=fopen("var.txt","a+"); // Création du nouveau fichier et ouverture du fichier
      fwrite($ouv,"$var"); // ecriture
      fclose($ouv);
    echo "<meta http-equiv='refresh' content='0'>";
    //	header('location:home.php');

  }
 ?>
<!-- Mainly scripts -->
<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

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
