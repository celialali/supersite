<?php 
require('connect.php');
require('head.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if($BDD){
    if(ISSET($_POST['allerHistoire'])){

        $id_hist = $_POST['allerHistoire'];

        // on recupere l'histoire en cours
        $req_hist = "SELECT * FROM histoire WHERE id_hist=:unIDhist";
        $rep_hist = $BDD->prepare($req_hist);
        $rep_hist->execute(array("unIDhist"=>$id_hist));
        $histoire = $rep_hist->fetch();

        // on regarde s'il existe une lecture correspondant à cet utilisateur et cette histoire
        $req_lecture_existente = "SELECT * FROM lecture WHERE id_profil=:unIDprofil AND id_hist=:unIDhist";
        $rep_lecture_existente = $BDD->prepare($req_lecture_existente);
        $rep_lecture_existente->execute(array("unIDprofil"=>$_SESSION['id_profil'], "unIDhist"=>$id_hist));
        $n = $rep_lecture_existente->rowCount();
        $lecture = $rep_lecture_existente->fetch();

        // si oui, on renvoie sur la situation en cours dans la lecture
        if ($n==1){
            
            $targetLink = "hist.php?id_hist=".$histoire['id_hist']."&id_sit=".$lecture['id_sit_en_cours'];
            header('Location: '.$targetLink);
        }

        // si non, on la crée et on renvoie sur la page de la situation initiale
        if ($n==0){
            $req_ajout_lecture = "INSERT INTO lecture(id_hist,id_profil,id_sit_en_cours,en_cours) VALUES (:idhist,:idprofil,:idsit,1)";
            $rep_ajout_lecture = $BDD->prepare($req_ajout_lecture);
            $rep_ajout_lecture->execute(array("idhist"=>$id_hist, "idprofil"=>$_SESSION['id_profil'], "idsit"=>$histoire['id_sit_initiale']));
            $targetLink = "hist.php?id_hist=".$histoire['id_hist']."&id_sit=".$histoire['id_sit_initiale']; 
            header('Location: '.$targetLink);
            echo 'aaaa';
        }  
    }
}
        
?>