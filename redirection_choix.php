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

        $req_maj_vies = $BDD->prepare("UPDATE lecture SET nb_vies=nb_vies+$vie WHERE id_hist=:idhist AND id_profil=:idprofil");
        $req_maj_vies->execute(array(
            "idhist"=>$id_hist, 
            "idprofil"=>$_SESSION['id_profil']
        ));
        $targetLink = "hist.php?id_hist=".$id_hist."&id_sit=".$choix['id_sit_suivante'];
        echo "hist.php?id_hist=".$id_hist."&id_sit=".$choix['id_sit_suivante'];
        header('Location: '.$targetLink);
    }
}

?>