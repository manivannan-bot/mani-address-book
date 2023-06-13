<?php 
include('db.php');
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
$sql = "SELECT * FROM addressbook";
$result = mysqli_query($conn, $sql);

//EXPORT XML DATA
if($_GET['data'] == 'xml'){
$xml = "<root_contact>";




if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    $xml .= '<contact name="'.$row["name"].'" firstname="'.$row["fname"].'" email="'.$row["email"].'" street="'.$row["street"].'" city="'.$row["city"].'" zipcode="'.$row["zipcode"].'" />';

  }
} 

$xml .= "</root_contact>";
$sxe = new SimpleXMLElement($xml);
$dom = new DOMDocument('1,0');
$dom->preserveWhiteSpace = false;
$dom->formatOutput = true;
$dom->loadXML($sxe->asXML());
echo $dom->saveXML();
$dom->save('xmldata.xml');
header('location: xmldata.xml');
exit;	
}


//EXPORT JSON DATA
if($_GET['data'] == 'json'){

$emparray = array();
    while($row =mysqli_fetch_assoc($result))
    {
        $peoplearray[] = $row;
    }
echo json_encode($peoplearray);
$fp = fopen('jsondata.json', 'w');
    fwrite($fp, json_encode($peoplearray));
    fclose($fp);
header('location: jsondata.json');
exit;	
}
$conn->close();