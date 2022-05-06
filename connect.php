<?php try {
$BDD = new PDO( "mysql:host=localhost;dbname=cribarddelc;charset=utf8",
"cribarddelc", "SuperSite33", array(PDO::ATTR_ERRMODE
=>PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e) {
die('Erreur fatale : ' . $e->getMessage());
}
?>