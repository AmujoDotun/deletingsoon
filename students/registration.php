<?php include('../core/server.php') ?>
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
	
  <form method="post" action="registration.php">
  	<?php include('../core/errors.php'); ?>
	  <div class="input-group">
  	  <label>Name</label>
  	  <input type="text" name="names" value="<?php echo $names; ?>">
  	</div>
	  <div class="input-group">
  	  <label>Matricno</label>
  	  <input type="text" name="matricno" value="<?php echo $matricno; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Email</label>
  	  <input type="email" name="email" value="<?php echo $email; ?>">
  	</div>
	  <div class="input-group">
  	  <label>Department</label>
  	  <select name="department" required>
			<option value ="" disabled selected>Select Department</option>

			<?php
			$dept_sql ="SELECT DISTINCT department FROM departments";
			$sql_exe = mysqli_query($db, $dept_sql);
			while($dept = mysqli_fetch_array($sql_exe)){
			?>
			<option value="<?= $dept['department'] ?>"><?= $dept['department']; ?></option>
			<?php
			}

			?>
		</select>
  	</div>
	  
	  <div class="input-group">
  	  <label>Level</label>
  	  <input type="text" name="levels" value="<?php echo $levels; ?>">
  	</div>
	  <div class="input-group">
  	  <label>Username</label>
  	  <input type="text" name="username" value="<?php echo $username; ?>">
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
  	  <button type="submit" class="btn" name="reg_user">Register</button>
  	</div>
  	<p>
  		Already a member? <a href="login.php">Sign in</a>
  	</p>
  </form>
</body>
</html>