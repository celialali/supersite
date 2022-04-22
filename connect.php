<?php
try {
$BDD = new PDO( "mysql:host=localhost;dbname=superhistoire;charset=utf8",
"root","root", array(PDO::ATTR_ERRMODE
=>PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e) {
die('Erreur fatale : ' . $e->getMessage());
}
?>