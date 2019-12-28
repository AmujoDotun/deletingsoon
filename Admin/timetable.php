<?php 
include  ('../core/server.php'); 
include ('../core/header.php');

$sql = "SELECT * FROM trisub ORDER BY department";
$squery = $db->query($sql);
// $sql = "SELECT  FROM MyGuests";
// $result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $title ?></title>
</head>
<body>
 <?php 
// $username ='dotun';
// $matric ="2019899299222";
// $levels ="ND1";
// $year ="2019";\


 ?>
<table class="table table-dark">

  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First\</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
  <?php while(mysqli_fetch_assoc($squery)) :?>
    <tr>
      <th scope="row">1</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <?php endwhile; ?>
  </tbody>
</table>
</body>
</html>