<?php
$userd="mind";
$mdpd="mind";
$host='$host';
//$line=file("config.txt"); // Création du nouveau fichier et ouverture du fichier
$line=explode('|', file_get_contents("config.txt"));
foreach ($line as $key => $value){
//echo $key."=>".$value."<br>";
if($key==0){
$user=$value;
}
if($key==1){
$mdp=$value;
}
if($key==2){
    $pathfichier=$value;
}
}
$var=file_get_contents("var.txt");
?>
