<?php
session_start();

// Project Title 

$title = 'SeatAllocation System';

// initializing variables
$names = "";
$secondname ="";
$middlename ="";
$matricno ="";
$department ="";
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
$level = "";
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
  $names = mysqli_real_escape_string($db, $_POST['names']);
  $department = mysqli_real_escape_string($db, $_POST['department']);
  $levels = mysqli_real_escape_string($db, $_POST['levels']);
  $matricno = mysqli_real_escape_string($db, $_POST['matricno']);
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($names)) { array_push($errors, "Name is required"); }
  if (empty($department)) { array_push($errors, "Department is required"); }
  if (empty($levels)) { array_push($errors, "Level is required"); }
  if (empty($matricno)) { array_push($errors, "Matricno is required"); }
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

  	$query = "INSERT INTO students (names, matricno, department, levels, username, email, password) 
  			  VALUES('$names', '$matricno', '$department', '$levels', '$username', '$email', '$password')";
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
  $user_check_query = "SELECT * FROM halls WHERE hallname='$hallname' OR hallcapacity='$hallcapacity' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['hallname'] === $hallname) {
      array_push($errors, "Hallname already exists");
    }
  }

  // Finally, register hall if there are no errors in the form
  if (count($errors) == 0) {

  	$query = "INSERT INTO halls (hallname, hallcapacity) 
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
  $level = mysqli_real_escape_string($db, $_POST['level']);
  $department = mysqli_real_escape_string($db, $_POST['department']);
  $hallname = mysqli_real_escape_string($db, $_POST['hallname']);
  $examdate = mysqli_real_escape_string($db, $_POST['examdate']);
  $starttime = mysqli_real_escape_string($db, $_POST['starttime']);
  $endtime = mysqli_real_escape_string($db, $_POST['endtime']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($level)) { array_push($errors, "Level is required"); }
  if (empty($department)) { array_push($errors, "Department is required"); }
  if (empty($hallname)) { array_push($errors, "Hallname is required"); }
  if (empty($examdate)) { array_push($errors, "Examdate is required"); }
  // if (empty($starttime)) { array_push($errors, "Start Time is required"); }
  // if (empty($endtime)) { array_push($errors, "EndTime is required"); }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email

  // $user_check_query = "SELECT * FROM trisub WHERE level='$level' OR department='$department' LIMIT 1";
  // $result = mysqli_query($db, $user_check_query);
  // $user = mysqli_fetch_assoc($result);
  $studentsCount = countDbEntries('students', " WHERE department='$department' ");
  $closestRange  = closestRangeOfHallCapacity($studentsCount);

  if(getHallCapacity($hallname) < $studentsCount ){
    array_push($errors, "The selected hall can't contain the students available in the selected department ");
  }elseif($closestRange !== getHallCapacity($hallname)) {
    array_push($errors, "The selected hall is too large for the students on the selected department, try hall $closestRange".'cap');
  }


  
  

  // Finally, register hall if there are no errors in the form
  if (count($errors) == 0) {


  	$query = "INSERT INTO seatno (level, department, hallname, examdate, starttime, endtime) 
        VALUES('$level', '$department', '$hallname', '$examdate', '$starttime', '$endtime')";
  	mysqli_query($db, $query);
  	$_SESSION['level'] = $level;
  	$_SESSION['success'] = "You have successfully register hall";
    header('location: /Admin/index.php');

    
    
  }
}





function countDbEntries($table, $clause="") {
  global $db;
  $query = mysqli_query($db, "SELECT COUNT(*) AS total FROM ".$table." ".$clause."  ");
  if(mysqli_num_rows($query)>0) {

    $count = mysqli_fetch_assoc($query);

    return $count['total'];

  }
}


function getHallCapacity($hallname) {
  global $db;
  $query = mysqli_query($db, "SELECT hallcapacity FROM halls WHERE hallname='$hallname' LIMIT 1");

  if(mysqli_num_rows($query)>0) {
    $data = mysqli_fetch_assoc($query);
    return $data['hallcapacity'];
  }

}


function getAllHallCapacity() {
  global $db;
  $query = mysqli_query($db, "SELECT hallcapacity FROM halls ");

  if(mysqli_num_rows($query)>0) {
    return $query;
  }

}


function closestRangeOfHallCapacity($studentsCount) {
  //  variable to store difference Between StudentCount And HallCapacity = empty array 
  $diff = [];
  $hallCapacityQuery = getAllHallCapacity();
    while( $data = mysqli_fetch_assoc($hallCapacityQuery) ) {
        if($studentsCount < $data['hallcapacity']) {
          $diff[] = $data['hallcapacity'];
        }
    }

   return min($diff);
}




//still needs improvement but thats the logic
function allocate($department){
  global $db;
  //pick department and allocate
  $selectedStudent = "SELECT * FROM `students` WHERE department = '$department'";
  $result = mysqli_query($db,$selectedStudent);
  $sql="";
  $counter = 1;
  if(mysqli_num_rows($result) > 0){

    while ($array = mysqli_fetch_array($result)) {
    // sql query to check if student has been allocated
    $check = "SELECT * FROM `seatno` WHERE student_id = {$array['id']}";
    $checkresult = $db->query($check);
      if(mysqli_num_rows($checkresult)> 0){
       
      }
      else{
        $sql = "INSERT INTO  seatno() 
              VALUES (NULL,{$array['id']}, '$department', $counter, NULL);";
        $counter++;
      }
    }
    if(empty($sql) ){ 
      return $alert = "No new students to allocate";
    }
    $sql = substr($sql, 0, -1);
    if ($db->multi_query($sql) === TRUE) {
        return $alert = "New records created successfully";
    }else {
        return $alert = "Error: " . $sql . "<br>" . $db->error;
    }
  }
  else{
    return $alert = "No student exist in this department";
  }
  
}

// $row ="";
// $selectedDept = "SELECT * FROM `departments` WHERE department = '$department'";

//   $result1 = mysqli_query($db,$selectedDept);
//   while ($row = $result->fetch_assoc()) {
//     echo $row['department']."<br>";
//   }

//call function
// echo allocate("computer science", "computer engineering", "accountacy");

// echo allocate("computer");


// }



?>
