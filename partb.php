<html>

<head><title>Part B</title></head>

<body>

<?php
//Chris Geleta
//CS485.01
if (isset($_POST['insert'])) {
$query;
$pnum = $_POST['pnum'];

$dsn ="mysql:host=cs-database;port3306;dbname=cgeleta";
$username  = 'cgeleta';
$password = '1695614';

try {

$db = new PDO($dsn, $username, $password);
print "Connected to MySQL";

$query = $db->prepare('SELECT * FROM project WHERE Pnumber = :pnum');
$query->bindParam(":pnum", $pnum);
$query->execute();

do_fetch($pnum, $query);


} catch (PDOException $e) {
  print "Error!: " . $e->getMessage() . "<br/>";
  die();
}

}

function do_fetch($pnum, $query)
 {
 print '<p>Pnumber is ' . $pnum . '</p>';
 print '<table border="1">';
 while ($row = $query->fetch(PDO::FETCH_NUM)) {
 print '<tr>';
 foreach ($row as $item) {
 print '<td>'.($item?htmlentities($item):'&nbsp;').'</td>';
 }
 print '</tr>';
 }
 print '</table>';
 }

?>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
    <input name="pnum" placeholder="Project Number" type="text"></input>
    <button name="insert" type="submit">Submit</button>
</form>



</body>


</html>
