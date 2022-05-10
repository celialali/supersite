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
                <!--<button type="hidden" name ="supprimer" class="btn btn-default btn-secondary" value="<?php echo $situations['id_sit']?>"><span class="glyphicon glyphicon-trash"></span> Supprimer la situation</button>
            A mettre en forme et autre formulaire ?-->
            <?php }
            ?>
            <br/>
            <div class="text-center"><button type="submit" class="btn btn-default btn-secondary">Tout enregistrer</button></div>
        </form>
    </div>
    <h3>Ajout de situations</h3>
    <p>Vous pouvez ajouter des situations à votre histoire, pour cela, entrez le paragraphe correspondant à votre situation et cliquez sur le bouton Ajouter pour ajouter votre situation.</p>
    <div class="well">
    <fieldset>
                <form class="form-signin form-horizontal" role="form" method="post"> 
                    <!-- pas d'action car on reste sur la meme page (en gardant ?id_hist=... dans l'url-->
                <div class="form-group">
                  
                    <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                        <p class="text-center">Situation</p>
                        <textarea required name="situation" class="form-control" placeholder="Ecrivez le paragraphe correspondant à la situation" rows="3"></textarea><br/><br/>
                    </div>
                    <div class="col-sm-8">
                        <p>Cochez l'une de ces cases si la situation correspond à la situation initiale ou la situation finale (victoire): </p>
                    </div>

                    <div class="form-check col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                        <input class="form-check-input" type="checkbox" value="1" id="sit_initiale" name="sit_initiale">
                        <label class="form-check-label" for="sit_initiale"> Situation initiale</label> &emsp;
                        <input class="form-check-input" type="checkbox" value="1" id="sit_finale" name="sit_finale">
                        <label class="form-check-label" for="sit_finale"> Situation finale</label>
                    </div>
                    <br>
                    <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 text-center">
                        <br>
                        <button type="submit" class="btn btn-default btn-secondary"><span class="glyphicon"></span> Ajouter cette situation</button>
                    </div>
                </div>
                
                </form>

            </fieldset>
            <?php  if(isset($_POST['situation'])){
            if (isset($_GET['id_hist'])){
                $id_hist = $_GET['id_hist'];
            }
            if($BDD){
                $req = "INSERT INTO situation (paragraphe,id_hist) VALUES (:par,:id)";
                $prepare=$BDD ->prepare($req);
                $prepare -> execute(array("par"=>$_POST['situation'],"id"=>$id_hist));

                //on récupère l'id de la situation qu'on vient de rajouter
                $req_id_nouvelle_sit = $BDD->prepare("SELECT * FROM situation WHERE paragraphe=:par AND id_hist=:idhist");
                $req_id_nouvelle_sit->execute(array(
                    "par"=>$_POST['situation'],
                    "idhist"=>$id_hist
                ));
                $id_nvelle_sit = $req_id_nouvelle_sit->fetch()['id_sit'];
                            
                if (isset($_POST['sit_initiale'])){ //on écrit dans l'histoire l'id de la situation initiale
                    $req_sit_init = $BDD->prepare("UPDATE histoire SET id_sit_initiale=:sit_init WHERE id_hist=:idhist");
                    $req_sit_init->execute(array(
                        "sit_init"=>$id_nvelle_sit,
                        "idhist"=>$id_hist
                    ));
                }

                if (isset($_POST['sit_finale'])){ //on écrit dans l'histoire l'id de la situation finale
                    $req_sit_finale = $BDD->prepare("UPDATE histoire SET id_sit_finale=:sit_finale WHERE id_hist=:idhist");
                    $req_sit_finale->execute(array(
                        "sit_finale"=>$id_nvelle_sit,
                        "idhist"=>$id_hist
                    ));
                }
            }
        }
                    ?>
        
    </div>
    <br/>
    <h3> Editer les choix </h3>
    <p> Tous les choix existants sont listés ci-dessous. Vous pouvez modifier ceux que vous souhaitez en n'oubliant pas de les enregistrer.</p>
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
    <h3>Ajout de choix</h3>
    <p>Vous pouvez ajouter des choix à votre histoire, pour cela, entrez l'intitulé de votre choix et les situations précédentes et suivantes reliées à celui-ci, puis précisez si celui-ci rapporte des points bonus, malus ou non et cliquez sur le bouton Ajouter ce choix pour l'ajouter à votre histoire.</p>
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
    ?>
    <div class="well">
            <p>Ajoutez un choix à votre histoire</p>
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
                        <p>Ce choix donne-il un bonus ou un malus de vie?</p>
                        
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
                        <button type="submit" class="btn btn-default btn-secondary"><span class="glyphicon"></span> Ajouter ce choix</button>
                    </div>  

                </div>
    <br>
        
    

<?php require "footer.php";



?>
</html>