<?php
$msg='';
if(isset($_POST['addperson'])){
  include('db.php');
  $mysqli = new mysqli($servername, $username, $password, $dbname);
  $name=$mysqli->real_escape_string($_POST['name']);
  $fname=$mysqli->real_escape_string($_POST['fname']);
  $email=$mysqli->real_escape_string($_POST['email']);
  $street=$mysqli->real_escape_string($_POST['street']);
  $zip=$mysqli->real_escape_string($_POST['zip']);
  $city=$mysqli->real_escape_string($_POST['city']);
  $mysqli->close();
try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "INSERT INTO addressbook (name,fname,email,street,zipcode,city)
  VALUES ('$name', '$fname', '$email', '$street', '$zip', '$city')";
  // use exec() because no results are returned
  $conn->exec($sql);
  $msg= "New Person Added successfully";
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
}
?>
<!DOCTYPE html>
<html>
<title>Address Book -</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<body>

<!-- Sidebar -->
<div class="w3-sidebar w3-light-grey w3-bar-block" style="width:25%">
  <h3 class="w3-bar-item w3-border-bottom"><i class="fa fa-home"></i>HOME</h3>
  <a href="index.php" class="w3-bar-item w3-button"><i class="fa fa-book"></i> All Addresses</a>
  <a href="add.php" class="w3-bar-item w3-button"><i class="fa fa-plus"></i> Add New</a>
</div>

<!-- Page Content -->
<div style="margin-left:25%">

<div class="w3-container w3-purple">
  <h1><i class="fa fa-book"></i> My Address Book</h1>
</div>


<div class="w3-container">
  <h2>Add New Contact</h2>
  
<form class="w3-container w3-card" action="" method="POST">

  <p><input type="text" class="w3-input" name="name" placeholder="Enter Name" required></p>
  <p><input type="text" class="w3-input" name="fname" placeholder="Enter First Name" required></p>
  <p><input type="text" class="w3-input" name="email" placeholder="Enter Your Email" required></p>
  <p><input type="text" class="w3-input" name="street" placeholder="Enter Street Address" required></p>
  <p><select class="w3-select w3-border" name="city" required>
    <option value="" disabled selected>Choose your city</option>

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
  echo "<option disabled>No Cities Added Yet !</option>";
}
$conn->close(); ?>

  </select></p>
  <p>
  <p><input type="text" class="w3-input" name="zip" placeholder="Enter Zipcode" required></p>
<p><span class="w3-text-green"><?php echo $msg;?></span></p>
  <button class="w3-btn w3-bar w3-teal" name="addperson">Add Person</button></p>
</form>
 
</div>
</div>
      
</body>
</html>
