<!doctype html>
<html>
<?php 
    require "connect.php";
    require "head.php";
    // on récupère l'id de l'histoire dans l'url
    if(isset($_GET['id_hist']) and isset($_GET['id_sit'])){
        $id_hist = $_GET['id_hist'];
        $id_sit = $_GET['id_sit'];
    }

    if ($BDD){
        // on recupere l'histoire en cours
        $req_hist = "SELECT * FROM histoire WHERE id_hist=:unIDhist";
        $rep_hist = $BDD->prepare($req_hist);
        $rep_hist->execute(array("unIDhist"=>$id_hist));
        $histoire = $rep_hist->fetch();

        // on recupere la situation souhaitee
        $req_sit = "SELECT * FROM situation WHERE id_hist=:unIDhist and id_sit=:unIDsit";
        $rep_sit = $BDD->prepare($req_sit);
        $rep_sit->execute(array(
            "unIDhist"=>$id_hist,
            "unIDsit"=>$id_sit
        ));
        $situation = $rep_sit->fetch();

        // on recupere la liste des choix possibles
        $req_choix = "SELECT * FROM choix WHERE id_sit_precedente=:unIDsit";
        $rep_choix = $BDD->prepare($req_choix);
        $rep_choix->execute(array("unIDsit"=>$id_sit));
        $ensemble_choix = $rep_choix->fetchAll();
    }
?>

    <body> 

        <div class="container">
            <?php require_once "header.php"; ?>
            <div> 
                <h2> Histoire en cours : <?= $histoire['titre'] ?> </h2>
                <br/>
            </div>
            <div class=" paragraph">
                <p> 
                    <?php echo $situation['paragraphe'];?>
                </p>    
            </div>
            <table>
                <tr>
                    <?php foreach ($ensemble_choix as $choix) { ?>
                   <td>
                        <div class="col-sm">
                            <p>
                                <a class="btn btn-default btn-secondary" href="hist.php?id_hist=<?= $id_hist ?>&id_sit=<?= $choix['id_sit_suivante']?>"> <?php echo $choix['intitule'] ?> </a>
                            </p>
                        </div>
                    </td>
                    <?php } ?>
                </tr>        
            </table>
        </div>

        <?php if ($histoire['id_sit_finale'] == $situation['id_sit']){ ?>
            <div class = "paragraph text-center">
                Bravo, vous êtes arrivé au bout de l'histoire !
                <p class="text-center">
                    <img class="responsive-image" src="img/welldone.png" width="170"/>
                </p>
            </div>

        <?php }
        ?>

        <?php require_once "footer.php"?>

    </body>



</html>
