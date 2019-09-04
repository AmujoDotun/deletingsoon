<?php include('../core/server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin Portal</title>
  <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
  <div class="header">
  	<h2>Admin Registration</h2>
  </div>
	
  <form method="post" action="adminReg.php">
  	<?php include('../core/errors.php'); ?>
  	<div class="input-group">
  	  <label>Username</label>
  	  <input type="text" name="username" value="<?php echo $username; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Email</label>
  	  <input type="email" name="email" value="<?php echo $email; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password_1">
  	</div>
  	<div class="input-group">
  	  <label>Confirm password</label>
  	  <input type="password" name="password_2">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_admin">Register</button>
  	</div>
  	<p>
  		Already a member? <a href="adminlogin.php">Sign in</a>
  	</p>
  </form>
</body>
</html>