<?php  
require "head.php";
require "connect.php";

if (isset($_GET['id_hist'])){
    $id_hist = $_GET['id_hist'];
}

if(isset($_POST['situation'])){
    if (isset($_GET['id_hist'])){
        $id_hist = $_GET['id_hist'];
    }
    if($BDD){
        $req = "INSERT INTO situation (paragraphe,id_hist) VALUES (:par,:id)";
        $prepare=$BDD ->prepare($req);
        $prepare -> execute(array("par"=>$_POST['situation'],"id"=>$id_hist));
    }
}

if(isset($_POST['choix']) and isset($_POST['sit_precedente']) and isset($_POST['sit_suivante']) and isset($_POST['vies'])){
    if ($_POST['vies']=='mortel'){
        $mortel=1;
        $vie=-1;
    }
    else{
        $mortel=0;
        $vie=$_POST['vies'];
    }

    if($BDD){
        $req_ajout = "INSERT INTO choix (intitule,vie,id_sit_suivante,id_sit_precedente,choix_mortel,id_hist) VALUES (:intit,:vie,:sit_suivante,:sit_precedente,:mortel,:idhist)";
        $rep_ajout=$BDD ->prepare($req_ajout);
        $rep_ajout -> execute(array(
            "intit"=>$_POST['choix'],
            "sit_suivante"=> $_POST['sit_suivante'],
            "sit_precedente"=> $_POST['sit_precedente'],
            "vie"=> $vie,
            "mortel"=> $mortel,
            "idhist"=>$id_hist
        ));
    }
}

    
$lien="edit.php?id_hist=".$id_hist;
header('Location: '.$lien);
?>