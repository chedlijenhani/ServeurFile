<?php

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
  <?php
$str=explode('upstream', file_get_contents($pathfichier));
foreach ($str as $key => $value){
  if($value!=""){
$st=explode('#parametre',$value);
  foreach ($st as $keyst => $val){
echo $keyst."=>".$val."<br>";
if($keyst==1){
$up=$val;
}}
}}
echo $up;
?>
