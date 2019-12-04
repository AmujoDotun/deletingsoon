<?php 
include '../core/server.php';


?>
<!DOCTYPE html>
<html>
<head>
  <title><? echo $title ?></title>
  <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
  <div class="header">
  	<h2>Register The Name of Department Here</h2>
  </div>
	
  <form method="post" action="hall.php">
  	<?php include('../core/errors.php'); ?>
  	<div class="input-group">
  	  <label>Department</label>
  	  <input type="text" name="department" value="<?php echo $department; ?>">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_dept">Register</button>
  	</div>
  </form>
</body>
</html>