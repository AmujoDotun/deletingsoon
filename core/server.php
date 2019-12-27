<?php
session_start();

// Project Title 

$title = 'SeatAllocation System';

// initializing variables
$username = "";
$email    = "";
$hallname ="";
$hallcapacity ="";
$department = "";
$classroom ="";
$course = "";
$examdate = "";
$starttime = "";
$endtime = "";
$levels = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'examseatallocation');



// REGISTER ADMIN
if (isset($_POST['reg_admin'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM admins WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO admins (username, email, password) 
  			  VALUES('$username', '$email', '$password')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: ../Admin/index.php');
  }
}



// LOGIN ADMIN
if (isset($_POST['login_admin'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$password = md5($password);
  	$query = "SELECT * FROM admins WHERE username='$username' AND password='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: ../Admin/index.php');
  	}else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}
//...end of login logic







// REGISTER STUDENT
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM students WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO students (username, email, password) 
  			  VALUES('$username', '$email', '$password')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: index.php');
  }
}

// ...


// LOGIN USER
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$password = md5($password);
  	$query = "SELECT * FROM students WHERE username='$username' AND password='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: index.php');
  	}else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}
//...end of login logic





// REGISTRATION OF HALL
if (isset($_POST['reg_hall'])) {
  // receive all input values from the form
  $hallname = mysqli_real_escape_string($db, $_POST['hallname']);
  $hallcapacity = mysqli_real_escape_string($db, $_POST['hallcapacity']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($hallname)) { array_push($errors, "Hallname is required"); }
  if (empty($hallcapacity)) { array_push($errors, "hallcapacity is required"); }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM hall WHERE hallname='$hallname' OR hallcapacity='$hallcapacity' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['hallname'] === $hallname) {
      array_push($errors, "Hallname already exists");
    }
  }

  // Finally, register hall if there are no errors in the form
  if (count($errors) == 0) {

  	$query = "INSERT INTO hall (hallname, hallcapacity) 
  			  VALUES('$hallname', '$hallcapacity')";
  	mysqli_query($db, $query);
  	$_SESSION['hallname'] = $hallname;
  	$_SESSION['success'] = "You have successfully register hall";
  	header('location: ../Admin/index.php');
  }
}




// REGISTRATION OF DEPARTMENT
if (isset($_POST['reg_dept'])) {
  // receive all input values from the form
  $department = mysqli_real_escape_string($db, $_POST['department']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($department)) { array_push($errors, "Department name is required"); }

  // first check the database to make sure 
  // a department does not already exist with the same department name
  $user_check_query = "SELECT * FROM departments WHERE department='$department' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if department exists
    if ($user['department'] === $department) {
      array_push($errors, "Department already exists");
    }
  }

  // Finally, register hall if there are no errors in the form
  if (count($errors) == 0) {

      $query = "INSERT INTO departments (department) 
                VALUES('$department')";
      mysqli_query($db, $query);
      $_SESSION['department'] = $department;
      $_SESSION['success'] = "You have successfully register department name";
      header('location: ../Admin/index.php');
  }
}





// REGISTER SEAT

// REGISTRATION OF HALL
if (isset($_POST['reg_seat'])) {
  // receive all input values from the form
  $levels = mysqli_real_escape_string($db, $_POST['levels']);
  $department = mysqli_real_escape_string($db, $_POST['department']);
  $enrollnumber = mysqli_real_escape_string($db, $_POST['enrollnumber']);
  $classroom = mysqli_real_escape_string($db, $_POST['classroom']);
  $course = mysqli_real_escape_string($db, $_POST['course']);
  $examdate = mysqli_real_escape_string($db, $_POST['examdate']);
  $starttime = mysqli_real_escape_string($db, $_POST['starttime']);
  $endtime = mysqli_real_escape_string($db, $_POST['endtime']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($levels)) { array_push($errors, "Level is required"); }
  if (empty($department)) { array_push($errors, "Department is required"); }
  if (empty($enrollnumber)) { array_push($errors, "Enrollnumber is required"); }
  if (empty($classroom)) { array_push($errors, "Classroom is required"); }
  if (empty($course)) { array_push($errors, "Course is required"); }
  if (empty($examdate)) { array_push($errors, "Examdate is required"); }
  if (empty($starttime)) { array_push($errors, "Start Time is required"); }
  if (empty($endtime)) { array_push($errors, "EndTime is required"); }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM trisub WHERE levels='$levels' OR department='$department' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  

  // Finally, register hall if there are no errors in the form
  if (count($errors) == 0) {

  	$query = "INSERT INTO trisub (levels, department, enrollnumber, classroom, course, examdate, starttime, endtime) 
        VALUES('$levels', '$department', '$enrollnumber', '$classroom', '$course', '$examdate', '$starttime', '$endtime')";
  	mysqli_query($db, $query);
  	$_SESSION['levels'] = $levels;
  	$_SESSION['success'] = "You have successfully register hall";
  	header('location: /Admin/timetable.php');
  }
}


// if (isset($_POST['reg_seat'])) {
//   // receive all input values from the form
//   $levels = mysqli_real_escape_string($db, $_POST['levels']);
//   $department = mysqli_real_escape_string($db, $_POST['department']);
//   $enrollnumber = mysqli_real_escape_string($db, $_POST['enrollnumber']);
//   $classroom = mysqli_real_escape_string($db, $_POST['classroom']);
//   $course = mysqli_real_escape_string($db, $_POST['course']);
//   $examdate = mysqli_real_escape_string($db, $_POST['examdate']);
//   $starttime = mysqli_real_escape_string($db, $_POST['starttime']);
//   $endtime = mysqli_real_escape_string($db, $_POST['endtime']);

//   // form validation: ensure that the form is correctly filled ...
//   // by adding (array_push()) corresponding error unto $errors array
  // if (empty($levels)) { array_push($errors, "Levels is required"); }
  // if (empty($department)) { array_push($errors, "department is required"); }
  // if (empty($enrollnumber)) { array_push($errors, "Enrollnumber is required"); }
  // if (empty($classroom)) { array_push($errors, "Classroom is required"); }
  // if (empty($course)) { array_push($errors, "Course is required"); }
  // if (empty($examdate)) { array_push($errors, "Examdate is required"); }
  // if (empty($starttime)) { array_push($errors, "Start Time is required"); }
  // if (empty($endtime)) { array_push($errors, "EndTime is required"); }


  

//   // Finally, register user if there are no errors in the form
//   if (count($errors) == 0) {
  
//   	$query = "INSERT INTO seatno (levels, department, enrollnumber, classroom, subjects, examdate, starttime, endtime) 
//   			  VALUES('$levels', $department', '$enrollnumber', '$classroom', '$course','$examdate', '$starttime', '$endtime')";
//   	mysqli_query($db, $query);
//   	echo "you have succefully assign seat for the sudent of " .$department;
//   	// header('location: ../Admin/index.php');
//   }
// }



?>
