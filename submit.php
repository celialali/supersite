<?php
require('connect.php');
require('head.php');
if(isset($_POST['afficher'])){
    if($BDD){
        $id_hist=$_POST["afficher"];
        $req_hist = "SELECT * FROM histoire WHERE id_hist=:unIDhist";
        $rep_hist = $BDD->prepare($req_hist);
        $rep_hist->execute(array("unIDhist"=>$id_hist));
        $histoire = $rep_hist->fetch();              

        $req2 = "UPDATE histoire SET affichee=1 WHERE id_hist=:id";
        $hist = $BDD->prepare($req2);
        $hist -> execute(array(
            'id'=>$id_hist));
    }
    header("Location: gerer_hist.php");
}

if(isset($_POST['masquer'])){
    $id_hist=$_POST["masquer"];
                                
    if($BDD){
        $req_hist = "SELECT * FROM histoire WHERE id_hist=:unIDhist";
        $rep_hist = $BDD->prepare($req_hist);
        $rep_hist->execute(array("unIDhist"=>$id_hist));
        $histoire = $rep_hist->fetch();

        $req2 = "UPDATE histoire SET affichee=0 WHERE id_hist=:id";
        $hist = $BDD->prepare($req2);
        $hist -> execute(array(
            'id'=>$id_hist));
    }
    header("Location: gerer_hist.php");
}

if(isset($_POST['supprimer'])){
    $id_hist=$_POST["supprimer"];
                                
    if($BDD){
        $req_hist = "SELECT * FROM histoire WHERE id_hist=:unIDhist";
        $rep_hist = $BDD->prepare($req_hist);
        $rep_hist->execute(array("unIDhist"=>$id_hist));
        $histoire = $rep_hist->fetch();
        $req2 = "DELETE FROM histoire WHERE id_hist=:id";
        $hist = $BDD->prepare($req2);
        $hist -> execute(array(
            'id'=>$id_hist));
    }
    header("Location: gerer_hist.php");
}

if(isset($_POST['editer'])){
    echo 'aa';
}


?>