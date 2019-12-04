<?php 

include('../core/server.php');
include('../core/header.php');
 ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
  <div class="header">
  	<h2>Register</h2>
  </div>
	
  <form method="post" action="hall.php">
  	<?php include('../core/errors.php'); ?>
  	<div class="input-group">
  	  <label>HallName</label>
  	  <input type="text" name="hallname" value="<?php echo $hallname; ?>">
  	</div>
  	<div class="input-group">
  	  <label>HallCapacity</label>
  	  <input type="number" name="hallcapacity" value="<?php echo $hallcapacity; ?>">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_hall">Register</button>
  	</div>
  </form>
</body>
</html>