<!doctype html>
<html>
    <?php require "head.php";
    require "connect.php";
    require "header.php";?>

    <body>
        <h2 class="text-center">Ajout des situations</h2>
        <div class="well">
            <p>Entrez les <b>situations</b> présentes dans votre histoire une par une :</p>
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
                        <button type="submit" class="btn btn-default btn-secondary"><span class="glyphicon"></span> Enregistrer</button>
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
                            
                // if (isset($_POST['sit_initiale'])){
                //     $req_sit_init = $BDD->prepare("UPDATE histoire SET id_sit_initiale=:sit_init WHERE id_hist=:idhist");
                //     $req_sit_init->execute(array(
                //         "sit_init"=>,  //faire une requete pour recuperer l'id de la situation qui vient d'etre creee
                //         "idhist"=>$id_hist
                //     ));
                // }

                //faire pareil pour la situation finale
            }
        }
                    ?>
        
        </div>
        <p> <h4>Une fois que vous aurez rempli toutes vos situations, passez à l'ajout des choix en appuyant sur
            <a href="ajout_choix.php?id_hist=<?=$id_hist?>" class="btn btn-default btn-secondary"><span class="glyphicon glyphicon-chevron-right"></span> Continuer</a>
            </h4>
        </p>
        <br>
    </body>
    <?php require "footer.php";?>

</html>
