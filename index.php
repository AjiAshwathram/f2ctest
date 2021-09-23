<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>LoginSuccess</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="header">
	<h2>Redirecting...</h2>
</div>
<div class="content">
  	<!-- notification message -->
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>

    <!-- logged in user information -->
    <?php  if (isset($_SESSION['username'])) : ?>
    	<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
    <?php endif ?>
    <br>
    <p>You will be redirected to the site in five seconds.</p><br>
    <p>If you see this message for more than 5 seconds, please click on <a href="home.html">this link!</a></p>
    <br><p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
    <?php
      $user = $_SESSION['username'];
      $db = mysqli_connect('localhost', 'root', '', 'registration');
      $query = "SELECT * FROM users WHERE username = '$user'";
      $results = mysqli_query($db, $query);
      $row = mysqli_fetch_array($results)
    ?>
    <?php if ($row["isfarm"] == "buyr") : ?>
      <meta http-equiv="Refresh" content="5;url=homeb.html">
    <?php endif ?>
    <?php if ($row["isfarm"] == "farm") : ?>
      <meta http-equiv="Refresh" content="5;url=home.html">
    <?php endif ?>
</div>
		
</body>
</html>