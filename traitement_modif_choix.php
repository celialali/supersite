<?php 
require "head.php";
require "connect.php";

if (isset($_GET['id_hist'])){
    $id_hist = $_GET['id_hist'];
}

if ($BDD){
    if (isset($_POST['id_choix'])){
        $id_choix=$_POST['id_choix'];
        if ($_POST['vies']=='mortel'){
            $mortel=1;
            $vie=-1;
        }
        else{
            $mortel=0;
            $vie=$_POST['vies'];
        }

        $req_modif_choix = $BDD->prepare("UPDATE choix SET intitule=:intit,vie=:vie,id_sit_suivante=:sit_suivante,id_sit_precedente=:sit_precedente,choix_mortel=:mortel WHERE id_choix=:idchoix");
        $req_modif_choix->execute(array(
                "intit"=>$_POST['choix'],
                "sit_suivante"=> $_POST['sit_suivante'],
                "sit_precedente"=> $_POST['sit_precedente'],
                "vie"=> $vie,
                "mortel"=> $mortel,
                "idchoix"=>$id_choix
        ));

    }
}

$lien = 'edit.php?id_hist='.$id_hist;
header('Location:'.$lien);
?>