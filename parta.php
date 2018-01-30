<html>
<head> <title>Connect to DB</title></head>

<body>
<?php
//Chris Geleta
//cs485
$dsn ="mysql:host=cs-database;port3306;dbname=cgeleta";
$username  = 'cgeleta';
$password = '1695614';

try {

$db = new PDO($dsn, $username, $password);
print "Connected to MySQL";

$sql = "INSERT INTO employee VALUES ('Deion','M','Riley','113356481','1995-06-09','22 Hudson st','M',48500,'000000000',9)";
$db->exec($sql);
echo " ";
echo "Inserted";

$results = $db->query('SELECT * FROM employee WHERE Ssn LIKE '%113356481%'');

$myArray[] = array();

while ($row = $results->fetch()) {
$myArray[] = $row["Fname"];

}

foreach($myArray as $Fname) 
{
echo $Fname;
echo "\n<br/>\n";

}

$results = null;
$db = null;

//$db = null;
} catch (PDOException $e) {
print "Error!: " . $e->getMessage() . "<br/>";
die();
}




?>




</body>
</html>
