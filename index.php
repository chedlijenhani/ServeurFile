<?php
require_once 'config.php';
?>
<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>M€ | Login</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
<link href="css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">M€</h1>
            <form class="m-t" action="index.php" method="post">
                <div class="form-group">
                    <input type="text" name="Username" class="form-control" required="required" placeholder="Username" autofocus required></input>
                </div>
                <div class="form-group">
                    <input type="password" name="Password" class="form-control" required="required" placeholder="Password" required></input>
                </div>
                <input type="submit" class="btn btn-primary block full-width m-b" title="Log In" name="login" value="Login"></input>

            </form>
            <p class="m-t"> <small>Mind  &copy; 2020</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>
<script src="js/plugins/toastr/toastr.min.js"></script>
</body>

</html>
<?php //echo $user; //echo $mdp;?>

  <?php
  if(isset($_POST['Username']) && isset($_POST['Password']))
  {
    if(($user==$_POST['Username'])&&($mdp==$_POST['Password']))  {
$_SESSION['login'] = $_POST['Username'];
$_SESSION['pwd'] =$_POST['Password'];
					header('location:home.php');

				}
		else
			{
				echo 'Invalid Username and Password Combination';
  echo "<script>
                    toastr.success('Invalid Username and Password Combination', 'M€');
</script>";
		}
		}
  ?>

</div>

</body>
</html>
