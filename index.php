<?php
$msg='';


if(isset($_GET['action'])){
  include('db.php');

  $mysqli = new mysqli($servername, $username, $password, $dbname);
  $id=$mysqli->real_escape_string($_GET['id']);
  $mysqli->close();

if($_GET['action']=='remove'){
  try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql="DELETE FROM addressbook WHERE id='$id'";
  $conn->exec($sql);
  $msg= "Person Removed successfully";
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
}

}
?>






<!DOCTYPE html>
<html>
<title>Address Book </title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<body>

<!-- Sidebar -->
<div class="w3-sidebar w3-light-grey w3-bar-block" style="width:25%">
  <h3 class="w3-bar-item w3-border-bottom"><i class="fa fa-home"></i> HOME</h3>
  <a href="index.php" class="w3-bar-item w3-button"><i class="fa fa-book"></i> All Addresses</a>
  <a href="add.php" class="w3-bar-item w3-button"><i class="fa fa-plus"></i> Add New</a>
</div>

<!-- Page Content -->
<div style="margin-left:25%">

<div class="w3-container w3-purple">
  <h1><i class="fa fa-book"></i> Manivannan Address Book</h1>
</div>


<div class="w3-container">
  <h2>All Contacts</h2>
  <p>list of people added to the address book:</p>
  <p> <a target="_blank" href="export.php?data=xml" class="w3-bar-item w3-button w3-teal"><i class="fa fa-share"></i> Export XML</a> 
    <a target="_blank" href="export.php?data=json" class="w3-bar-item w3-button w3-teal"><i class="fa fa-share"></i> Export JSON</a></p>
    <p class="w3-text-red"><?php echo $msg;?></p>

  <table class="w3-table-all">
    <tr>
      <th>S No.</th>
      <th>First Name</th>
      <th>Name</th>
      <th>Email</th>
      <th>Street</th>
      <th>City</th>
      <th>Zip Code</th>
      <th>Action</th>
      <th></th>
    </tr>

    <?php 
    include('db.php');
    // Create connection 
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


//to print table

$sql = "SELECT * FROM addressbook ORDER BY id DESC";
$result = $conn->query($sql);


$sn=1;
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    echo '<tr><td>'.$sn.'</td><td>'.$row["fname"].'</td><td>'.$row["name"].'</td><td>'.$row["email"].'</td><td>'.$row["street"].'</td><td>'.$row["city"].'</td><td>'.$row["zipcode"].'</td><td><a class="w3-btn w3-small w3-blue" href="edit.php?id='.$row["id"].'">Edit</a></td><td><a class="w3-btn w3-small w3-red" href="?action=remove&id='.$row["id"].'">Remove</a></td></tr>';
    $sn++;
  }
} else {
  echo "<tr><td> NO Data available</td></tr>";
}
$conn->close(); ?>
   

   

   
  </table>
  <p>  <a href="add.php" class="w3-bar-item w3-button w3-green"><i class="fa fa-plus"></i> Add New</a></p>
</div>
</div>
      
</body>
</html>
