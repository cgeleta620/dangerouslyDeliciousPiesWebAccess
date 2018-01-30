<?php
//webapge: http://cgeleta.cs.loyola.edu/index.php

include("vendor/autoload.php");

$loader = new Twig_Loader_Filesystem('views');
$twig = new Twig_Environment($loader, array());

$input = filter_input_array(INPUT_POST);
if ($input == null) {
   // echo "The input was null";
}

$pie_name = $input["pie_name"];
$pie_quantity = $input["pie_quantity"];
$pie_id = $input["pie_id"];
$ing_id = $input["ing_id"];
$type_id = $input["type_id"];
$quantity = $input["quantity"];

$dsn = "mysql:host=cs-database;port=3306;dbname=cgeleta";// driver
$username = 'cgeleta';
$password = '1695614';// password

try {
    $db = new PDO($dsn, $username, $password); // connects to the Database

    $result_set = $db->prepare("INSERT INTO PIE (pie_name, pie_quantity, pie_id, type_id) VALUES (?, ?, ?, ?);");
    $result_set->bindParam(1, $pie_name);
    $result_set->bindParam(2, $pie_quantity);
    $result_set->bindParam(3, $pie_id);
    $result_set->bindParam(4, $type_id);
    $result_set->execute();

    $rs2 = $db->prepare("INSERT INTO USES (pie_id, ing_id, quantity) VALUES (?, ?, ?);");
    $rs2->bindParam(1, $pie_id);
    $rs2->bindParam(2, $ing_id);
    $rs2->bindParam(3, $quantity);
    $rs2->execute();

} catch (PDOException $Exception) {
    die();
}

$stm = $db->prepare("SELECT * FROM PIE;");
$stm->execute();
$resultsArray = $stm->fetchAll(PDO::FETCH_ASSOC);

$stm2 = $db->prepare("SELECT * FROM INGREDIENT;");
$stm2->execute();
$ingResults = $stm2->fetchAll(PDO::FETCH_ASSOC);

echo $twig->render("index.html", array("input" => $input, "pie_array" => $resultsArray, "ing_array" => $ingResults));

?>
