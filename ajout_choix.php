<!doctype html>
<html>
    <?php require "head.php";
    require "connect.php";
    require "header.php";
    
    if (isset($_GET['id_hist'])){
        $id_hist = $_GET['id_hist'];
    }

    // on récupère toutes les situations de l'histoire créée
    $req_situations = $BDD->prepare("SELECT * FROM situation WHERE id_hist=:unID");
    $req_situations->execute(array("unID"=>$id_hist));
    $situations = $req_situations->fetchAll();
    $nb_sit = $req_situations->rowCount();

    ?>

    <body>
        <h2 class="text-center">Ajout des choix</h2>
        <div class="well">
            <p>Entrez chaque choix de l'histoire :</p>
            <br>
            <fieldset>
                <form class="form-signin" role="form" method="post"> 
                    <!-- pas d'action car on reste sur la meme page (en gardant ?titre=... dans l'url-->
                <div class="form-group row">
                    <div class="col-xs-4 my-auto">
                        <p class="text-center"> Situation précédente </p>
                        <select class="form-select btn btn-default btn-secondary" name="sit_precedente" style="width:90%; height:33px">
                            <?php 
                            foreach ($situations as $situation){
                                ?>
                                <option value=<?=$situation['id_sit']?>><?=substr($situation['paragraphe'],0,40)?></option>
                            <?php }
                            ?>
                        </select>
                    </div>
                            
                    <div class="col-xs-4">
                        <p class="text-center">Intitulé du choix</p>
                        <input type="text" name="choix" class="form-control " placeholder="Ecrivez l'intitulé du choix" required></input>
                    </div>
                    <div class="col-xs-4 my-auto">
                        <p class="text-center"> Situation suivante </p>
                        <select class="form-select btn btn-default btn-secondary" name="sit_suivante" style="width:90%; height:33px">
                            <?php 
                            foreach ($situations as $situation){
                                ?>
                                <option value=<?=$situation['id_sit']?>><?=substr($situation['paragraphe'],0,40)?></option>
                            <?php }
                            ?>
                        </select>
                    </div>

                    <br>
                    </div>
                    <br>
                    <div>
                        Ce choix donne-il un bonus ou un malus de vie?
                        <div class="form-check form-check-inline" required>
                            <input required class="form-check-input" type="radio" name="vies" id="vies1" value="1">&ensp;
                            <label class="form-check-label" for="vies1">Bonus</label> &emsp;
                            <input required class="form-check-input" type="radio" name="vies" id="vies2" value="0" checked>&ensp;
                            <label class="form-check-label" for="vies2">Neutre</label> &emsp;
                            <input required class="form-check-input" type="radio" name="vies" id="vies3" value="-1">&ensp;
                            <label class="form-check-label" for="vies3">Malus</label> &emsp;
                            <input required class="form-check-input" type="radio" name="vies" id="vies4" value="mortel">&ensp;
                            <label class="form-check-label" for="vies4">Choix mortel (défaite automatique)</label> 
                        </div>
                    </div>  
                    <br>
                    <div class="text-center">
                        <button type="submit" class="btn btn-default btn-secondary"><span class="glyphicon"></span> Enregistrer</button>
                    </div>  

                </div>
                </form>

            </fieldset>

        </div>
        <p> Une fois que vous aurez rempli toutes vos situations, validez en appuyant sur
            <a href="ajout_choix.php?titre=<?=$titre?>" class="btn btn-default btn-secondary"><span class="glyphicon glyphicon-chevron-right"></span> Continuer</a>
        </p>
        <br>
    </body>
    
    <?php  if(isset($_POST['choix']) and isset($_POST['sit_precedente']) and isset($_POST['sit_suivante']) and isset($_POST['vies'])){
        if ($_POST['vies']=='mortel'){
            $mortel=1;
            $vie=-1;
        }
        else{
            $mortel=0;
            $vie=$_POST['vies'];
        }

        if($BDD){
            $req_ajout = "INSERT INTO choix (intitule,vie,id_sit_suivante,id_sit_precedente,choix_mortel) VALUES (:intit,:vie,:sit_suivante,:sit_precedente,:mortel)";
            $rep_ajout=$BDD ->prepare($req_ajout);
            $rep_ajout -> execute(array(
                "intit"=>$_POST['choix'],
                "sit_suivante"=> $_POST['sit_suivante'],
                "sit_precedente"=> $_POST['sit_precedente'],
                "vie"=> $vie,
                "mortel"=> $mortel
            ));
        }
    }
    ?>

    <?php require "footer.php";?>

</html>