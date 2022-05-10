<!doctype html>
<html>
<?php 
require "head.php";
require "connect.php";
require "header.php";

if (isset($_GET['id_hist'])){
    $id_hist = $_GET['id_hist'];
}

// on récupère toutes les situations existantes et tous les choix existants
if ($BDD){
    $req_histoire = $BDD->prepare("SELECT * FROM histoire WHERE id_hist=:idhist");
    $req_histoire->execute(array("idhist"=>$id_hist));
    $histoire = $req_histoire->fetch();

    $req_situations = $BDD->prepare("SELECT * FROM situation WHERE id_hist=:idhist");
    $req_situations->execute(array("idhist"=>$id_hist));
    $situations = $req_situations->fetchAll();

    $req_choix = $BDD->prepare("SELECT * FROM choix WHERE id_hist=:idhist");
    $req_choix->execute(array("idhist"=>$id_hist));
    $choix = $req_choix->fetchAll();
}

?>

    <h1 class="text-center">Editer votre histoire</h1>
    <h3> Editer les infos de l'histoire</h3>
    <div class="well">
        <form method="post" class="form" action="traitement_modif_sit&hist.php?id_hist=<?=$id_hist?>">
            <p> Titre de l'histoire</p>
            <input required type="text" name="titre" class="form-control" size="50" value="<?=$histoire['titre']?>"></input>
            <br>
            <p> Description de l'histoire</p>
            <textarea required name="resume" class="form-control" rows="3" cols="40"><?php echo $histoire['description']?></textarea>
            <br>
            <div class="text-center"> 
                <button type="submit" class="btn btn-secondary btn-default">Enregistrer</button>
            </div>
        </form>
    </div>

    <h3> Editer les situations</h3>
    <div class="well">
        
        <br>
        <form method="post" class="form" action="traitement_modif_sit&hist.php?id_hist=<?=$id_hist?>">
            <?php foreach ($situations as $situation){?>
                <textarea required name="<?=$situation['id_sit']?>" rows="3" cols="40"><?php echo $situation['paragraphe'];?></textarea>
            <?php }
            ?>
            <br>
            <div class="text-center"><button type="submit" class="btn btn-default btn-secondary">Tout enregistrer</button></div>
        </form>
    </div>
    <br>
    <h3> Editer les choix </h3>
    <p> Tous les choix existant sont listés ci-dessous. Vous pouvez modifier ceux que vous souhaitez en n'oubliant pas de les enregistrer.</p>
    <?php foreach ($choix as $unChoix){?>
    <div class="well">
        <fieldset>
            <form method="post" class="form" action="traitement_modif_choix.php?id_hist=<?=$id_hist?>">
                <div class="form-group row">
                    <div class="col-xs-4 my-auto">
                        <p class="text-center"> Situation précédente </p>
                        <select class="form-select btn btn-default btn-secondary" name="sit_precedente" style="width:90%; height:33px">
                            <?php 
                            foreach ($situations as $situation){
                                ?>
                                <option 
                                <?php if ($situation['id_sit']==$unChoix['id_sit_precedente']){
                                    ?> selected <?php
                                }?>
                                value=<?=$situation['id_sit']?>><?=substr($situation['paragraphe'],0,40)?></option>
                            <?php }
                            ?>
                        </select>
                    </div>
                            
                    <div class="col-xs-4">
                        <p class="text-center">Intitulé du choix</p>
                        <input type="text" name="choix" class="form-control " required value="<?=$unChoix['intitule']?>"></input>
                    </div>
                    <div class="col-xs-4 my-auto">
                        <p class="text-center"> Situation suivante </p>
                        <select class="form-select btn btn-default btn-secondary" name="sit_suivante" style="width:90%; height:33px">
                            <?php 
                            foreach ($situations as $situation){
                                ?>
                                <option 
                                <?php if ($situation['id_sit']==$unChoix['id_sit_suivante']){
                                    ?> selected <?php
                                }?>
                                value=<?=$situation['id_sit']?>><?=substr($situation['paragraphe'],0,40)?></option>
                            <?php }
                            ?>
                        </select>
                    </div>
                </div>
                    <br>
                    <div class="">
                        <p>Ce choix donne-il un bonus ou un malus de vie?</p>
                        
                        <div class="form-check form-check-inline" required>
                            <input required class="form-check-input" type="radio" name="vies" id="vies1_<?=$unChoix['id_choix']?>" value="1"
                            <?php if ($unChoix['vie']==1){
                                ?> checked <?php
                            }?>          
                            >&ensp;
                            <label class="form-check-label" for="vies1_<?=$unChoix['id_choix']?>">Bonus</label> &emsp;

                            <input required class="form-check-input" type="radio" name="vies" id="vies2_<?=$unChoix['id_choix']?>" value="0" 
                            <?php if ($unChoix['vie']==0){
                                ?> checked <?php
                            }?>
                            >&ensp;
                            <label class="form-check-label" for="vies2_<?=$unChoix['id_choix']?>">Neutre</label> &emsp;

                            <input required class="form-check-input" type="radio" name="vies" id="vies3_<?=$unChoix['id_choix']?>" value="-1"
                            <?php if ($unChoix['vie']==-1){
                                ?> checked <?php
                            }?>          
                            >&ensp;
                            <label class="form-check-label" for="vies3_<?=$unChoix['id_choix']?>">Malus</label> &emsp;
                            <input required class="form-check-input" type="radio" name="vies" id="vies4_<?=$unChoix['id_choix']?>" value="mortel"
                            <?php if ($unChoix['choix_mortel']==1){
                                ?> checked <?php
                            }?>          
                            >&ensp;
                            <label class="form-check-label" for="vies4_<?=$unChoix['id_choix']?>">Choix mortel (défaite automatique)</label> 
                        </div>
                    </div>  
                    <br>
                    <div class="text-center">
                        <input type="hidden" name="id_choix" value=<?=$unChoix['id_choix']?>>
                        <button type="submit" class="btn btn-default btn-secondary">Enregistrer la modification de ce choix</button>
                    </div>
                
            </form>
        </fieldset>
    </div>
    <?php }
    ?>
    <br>
        
    

<?php require "footer.php";



?>
</html>