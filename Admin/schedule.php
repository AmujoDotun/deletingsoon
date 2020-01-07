<?php 
include('../core/server.php');
include('../core/header.php');

?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin Portal</title>
  <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
  <div class="header">
  	<h2>Seat Allocation</h2>
  </div>
	
  <form method="post" action="schedule.php">
	  <?php include('../core/errors.php'); 
	  
	//   $deptQuery = $db->query ("SELECT * FROM departments");
	  
	  ?>

<div class="input-group">
  	  <label for="level">Level</label>
		<select name="level" required>
			<option value ="" disabled selected>Level</option>

			<?php
			$level_sql ="SELECT * FROM levels";
			$sql_level = mysqli_query($db, $level_sql);
			while($level = mysqli_fetch_array($sql_level)){
			?>
			<option value="<?= $level['level'] ?>"><?= $level['level']; ?></option>
			<?php
			}

			?>
		</select>
  	</div>
  	<div class="input-group">
  	  <label for="department">Department</label>
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
  	  <label for="hallname"></label>
		<select name="hallname" required>
			<option value ="" disabled selected>Hall</option>

			<?php
			$hall_sql ="SELECT * FROM halls";
			$sql_hall = mysqli_query($db, $hall_sql);
			while($hall = mysqli_fetch_array($sql_hall)){
			?>
			<option value="<?= $hall['hallname'] ?>"><?= $hall['hallname']; ?></option>
			<?php
			}

			?>
		</select>
  	</div>
    <div class="input-group">
  	  <label>Exam Date</label>
  	  <input type="date" name="examdate" value="<?php echo $examdate; ?>">
  	</div>
    <div class="input-group">
  	  <label id="appt-time">start time</label>
  	  <input type="time" id="appt-time" name="starttime" value="<?= $starttime ?>">
  	</div>
    <div class="input-group">
  	  <label id="end-time">End Time</label>
  	  <input type="time" id='end-time' name="endtime" value="<?php echo $endtime; ?>">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_seat">Register</button>
  	</div>
  </form>
 
</body>
</html>