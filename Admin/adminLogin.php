<?php 
include('../core/server.php');
// include('../core/header.php');
?>
<!DOCTYPE html>
<html>
<head>
  <title>SeatAllcoation System Project</title>
  <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
  <div class="header">
  	<h2>Login</h2>
  </div>
	 
  <form method="post" action="adminLogin.php">
  	<?php include('../core/errors.php'); ?>
  	<div class="input-group">
  		<label>Username</label>
  		<input type="text" name="username" >
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_admin">Login</button>
  	</div>
  	<p>
  		Not yet a member? <a href="adminReg.php">Sign up</a>
  	</p>
  </form>
</body>
</html>