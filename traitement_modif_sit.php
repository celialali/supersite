<?php 
require "head.php";
require "connect.php";

if (isset($_GET['id_hist'])){
    $id_hist = $_GET['id_hist'];
}

if ($BDD){
    $req_situations = $BDD->prepare("SELECT * FROM situation WHERE id_hist=:idhist");
    $req_situations->execute(array("idhist"=>$id_hist));
    $situations = $req_situations->fetchAll();

    foreach($situations as $situation){
        if (isset($_POST[$situation['id_sit']])){
            $req_modif = $BDD->prepare("UPDATE situation SET paragraphe=:nouveau_par WHERE id_sit=:idsit");
            $req_modif->execute(array(
                "nouveau_par"=>$_POST[$situation['id_sit']],
                "idsit" => $situation['id_sit'] 
            ));
        }
    }
}

$lien = 'edit.php?id_hist='.$id_hist;
header('Location:'.$lien);
?>