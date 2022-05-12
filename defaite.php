<!doctype html>
<html>
    <?php 
        require "connect.php";
        require "head.php";

        if(isset($_GET['id_hist'])){
        $id_hist = $_GET['id_hist'];
        }
        if ($BDD){
        // on recupere l'histoire en cours
        $req_hist = "SELECT * FROM histoire WHERE id_hist=:unIDhist";
        $rep_hist = $BDD->prepare($req_hist);
        $rep_hist->execute(array("unIDhist"=>$id_hist));
        $histoire = $rep_hist->fetch();
        }

        $req_maj_sit = $BDD->prepare("UPDATE lecture SET id_sit_en_cours=:idsitinit, nb_morts=nb_morts+1, nb_fois_jouee=nb_fois_jouee+1, nb_vies=3, en_cours=0 WHERE id_hist=:idhist AND id_profil=:idprofil");
        $req_maj_sit->execute(array(
            "idsitinit"=>$histoire['id_sit_initiale'], 
            "idhist"=>$id_hist, 
            "idprofil"=>$_SESSION['id_profil']
        ));

        $req_recup_choix = $BDD->prepare("SELECT * FROM lecture WHERE id_hist=:idhist AND id_profil=:idprofil");
        $req_recup_choix->execute(array("idhist"=>$id_hist, "idprofil"=>$_SESSION['id_profil']));
        $tous_les_choix = $req_recup_choix->fetch()['liste_choix'];
    ?>

    <body>
        <div class="container">
            <?php require_once("header.php"); ?>
            <div> 
                <h2> Histoire en cours : <?= $histoire['titre'] ?> </h2>
                <hr>
            </div>
            <div class = "paragraph text-center">
            <h3> Vous avez malheureusement fait un choix fatal ou perdu toutes vos vies... 
                Il va falloir retenter l'histoire en essayant de faire de meilleurs choix !</h3>
                <br>
                <p> Voici le récapitulatif des choix que vous avez effectué:</p>
                <p> <?=$tous_les_choix?></p>

                <p class="text-center">
                    <img class="responsive-image" src="img/loser.gif" width='300'>
                </p>
                <br>
                <a class="btn btn-default btn-warning" href="index.php">Retourner à l'accueil</a>

            </div>
        </div>
    </body>
    <br>
    <?php require "footer.php";?>

    <?php 
    // on remet la liste des choix à zéro
    $req_suppr_choix = $BDD->prepare("UPDATE lecture SET liste_choix='' WHERE id_hist=:idhist AND id_profil=:idprofil");
    $req_suppr_choix->execute(array("idhist"=>$id_hist, "idprofil"=>$_SESSION['id_profil']));

    ?>


</html>