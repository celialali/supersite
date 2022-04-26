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
        $req_sit = "SELECT * FROM situation WHERE id_hist=:unIDhist and id_sit=:unIDsit";
        $rep_sit = $BDD->prepare($req_sit);
        $rep_sit->execute(array(
            "unIDhist"=>$id_hist,
            "unIDsit"=>$id_sit
        ));
        $situation = $rep_sit->fetch();

        $req_choix = "SELECT * FROM choix WHERE id_sit_precedente=:unIDsit";
        $rep_choix = $BDD->prepare($req_choix);
        $rep_choix->execute(array("unIDsit"=>$id_sit));
        $ensemble_choix = $rep_choix->fetchAll();
    }
?>

    <body> 

    <div class="container">
        <?php require_once "header.php"; ?>

        <p> 
            <?php echo $situation['paragraphe'];?>
        </p>

    </div>
    <div> 
        <table>
            <tr>
                <?php foreach ($ensemble_choix as $choix) { ?> 
                <td>
                    <p class="bouton_choix"> 
                        <a href="hist.php?id_hist=<?= $id_hist ?>&id_sit=<?= $choix['id_sit_suivante']?>"> <?php echo $choix['intitule'] ?> </a>
                    </p>
                </td>
                <?php } ?>
            </tr>

            
        
        </table>
    </div>

    <?php require_once "footer.php"?>

</body>



</html>
