<?php
    include('db.php');
$msg='';

/////SCRIPT TO UPDATE PERSON
if(isset($_POST['updateperson'])){
  $mysqli = new mysqli($servername, $username, $password, $dbname);
  $id=$mysqli->real_escape_string($_GET['id']);
  $name=$mysqli->real_escape_string($_POST['name']);
  $fname=$mysqli->real_escape_string($_POST['fname']);
  $email=$mysqli->real_escape_string($_POST['email']);
  $street=$mysqli->real_escape_string($_POST['street']);
  $zip=$mysqli->real_escape_string($_POST['zip']);
  $city=$mysqli->real_escape_string($_POST['city']);
  $mysqli->close();
try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql="UPDATE addressbook SET name='$name', fname='$fname', email='$email', street='$street', zipcode='$zip', city='$city' WHERE id='$id'";
  $conn->exec($sql);
  $msg= "Person Updated successfully";
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
}

/// SCRIPT TO FETCH DATA 
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$id=$conn->real_escape_string($_GET['id']);
$sql = "SELECT * FROM addressbook WHERE id='$id' LIMIT 1";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_assoc($result)) {
    $fname=$row["fname"];
    $name=$row["name"];
    $street=$row["street"];
    $city=$row["city"];
    $zipcode=$row["zipcode"];
    $email=$row["email"];
  }
} else {

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
  <h2>Edit Existing Contact</h2>
  
<form class="w3-container w3-card" action="" method="POST">

  <p><label>Name:</label><input type="text" class="w3-input" value="<?php echo $name;?>" name="name" placeholder="Enter Name" required></p>

  <p><label>First Name:</label><input type="text" class="w3-input" value="<?php echo $fname;?>" name="fname" placeholder="Enter First Name" required></p>
  
  <p><label>Email:</label><input type="email" class="w3-input" value="<?php echo $email;?>" name="email" placeholder="Enter Your Email" required></p>
  
  <p><label>Street:</label><input type="text" class="w3-input" value="<?php echo $street;?>" name="street" placeholder="Enter Street Address" required></p>
  
  <p><label>City:</label><select class="w3-select w3-border"  name="city" required>
    <option value="<?php echo $city;?>" disabled selected><?php echo $city;?></option>

<?php 
include('db.php');
    // Create connection 
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT city FROM city";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    echo '<option value="'.$row["city"].'">'.$row["city"].'</option>';
  }
} else {
  echo "<option disabled>No Cities Added  !</option>";
}
$conn->close(); ?>

  </select></p>
  <p>
  <p><label>Zipcode:</label><input type="text" class="w3-input" value="<?php echo $zipcode;?>" name="zip" placeholder="Enter Zipcode" required></p>
<p><span class="w3-text-green"><?php echo $msg;?></span></p>
  <button class="w3-btn w3-bar w3-teal" name="updateperson">Update Person</button></p>
</form>
 
</div>
</div>
      
</body>
</html>
