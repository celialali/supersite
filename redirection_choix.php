<?php 
require('connect.php');
require('head.php');
if($BDD){
    if (ISSET($_POST['id_choix'])){

        $id_choix = $_POST['id_choix'];
        $id_hist = $_POST['id_hist'];

        $req_choix = $BDD->prepare("SELECT * FROM choix WHERE id_choix=:idchoix");
        $req_choix->execute(array("idchoix"=>$id_choix));
        $choix = $req_choix->fetch();
        $vie = $choix['vie'];

        $req_ajout_choix = $BDD->prepare("UPDATE lecture SET liste_choix=CONCAT(liste_choix,:nv_choix) WHERE id_hist=:idhist AND id_profil=:idprofil");
        $req_ajout_choix->execute(array(
            "idhist"=>$id_hist,
            "idprofil"=>$_SESSION['id_profil'],
            "nv_choix"=>" -> ".$choix['intitule']
        ));

        $req_maj_vies = $BDD->prepare("UPDATE lecture SET nb_vies=nb_vies+$vie,en_cours=1 WHERE id_hist=:idhist AND id_profil=:idprofil");
        $req_maj_vies->execute(array(
            "idhist"=>$id_hist, 
            "idprofil"=>$_SESSION['id_profil']
        ));
        if ($choix['choix_mortel']==1){
            $targetLink = "defaite.php?id_hist=".$id_hist;
        }
        else{
            $targetLink = "hist.php?id_hist=".$id_hist."&id_sit=".$choix['id_sit_suivante'];
        }
        header('Location: '.$targetLink);
    }
}

?>