<!doctype html>
<html>
    <?php require "head.php";
    require "connect.php";
    require "header.php";?>

    <?php $titre;
    $decription;
    if(isset($_POST['titre']) && isset($_POST['description']) && isset($_POST['image'])){
                    $titre = $_POST['titre'];
                    $description = $_POST['description'];
                    $image = $_POST['image'];
                    if($BDD){
                        $req = "INSERT INTO histoire (titre,description, image) VALUES (:ttre,:descr, :img)";
                        $prepare=$BDD ->prepare($req);
                        $prepare -> execute(array("ttre"=>$titre, "descr"=>$description, ":img"=>$image));
                }
            } ?>
    <body>
        <h2 class="text-center">Ajouter une histoire</h2>
        <div class="well">
        <p>Combien de situations voulez-vous écrire ?</p>
        <form class="form-signin form-horizontal" role="form" action="situations.php" method="post">
            <input type="text" name="nbsit">
            <button type="submit" class="btn btn-default btn-secondary"> Enregistrer</button>
            <?php 
            $nbsituation = 0;
            if(isset($_POST['nbsit']) && is_numeric($_POST['nbsit']) ){
                $nbsituation=$_POST['nbsit'];}
                else if(isset($_POST['nbsit']) && !is_numeric($_POST['nbsit'])){
                    echo "Erreur de saisie, veuillez rentrer un nombre !";
                }?>
        </form>

        <form class="form-signin form-horizontal" role="form" action="situations.php" method="post">
            <p class="text-center">Entrez les situations présentes dans votre histoire</p>
                <fieldset>
                <?php for($i=1;$i<=$nbsituation;$i++){?>
                <div class="form-group">
                   
                    <div class="form-group">
                  
                        <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                        <p class="text-center">Situation <?php echo $i?></p>
                            <textarea name="situation" class="form-control" placeholder="Ecrivez le paragraphe correspondant à la situation" rows="3"></textarea><br/><br/>
                        </div>
                        <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                    Enregistrez votre situation avant de continuer
                    <button type="submit" class="btn btn-default btn-secondary"><span class="glyphicon"></span> Enregistrer</button>
                </div>
                    </div> 
                </div>
                <?php
                
                    if(isset($_POST['situation'])){
                        if($BDD){
                            //On recupere l'id de l'histoire qu'il est en train d'écrire
                            $req_id_hist = "SELECT id_hist FROM histoire WHERE titre=:unTitre AND description=:uneDescription";
                                    $rep_id_hist = $BDD->prepare($req__id_hist);
                                    $rep_id_hist->execute(array("unTitre"=>$titre,"uneDescription"=>$description));
                                    $idhistoire = $rep_id_hist->fetch();

                            $req = "INSERT INTO situation (paragraphe,id_hist) VALUES (:par,:id)";
                            $prepare=$BDD ->prepare($req);
                            $prepare -> execute(array("par"=>$_POST['situation'],"id"=>$idhistoire));
                            }
                    }
                ?>
                <?php } ?>
                
                <form>
                   Pour passer à la page suivante, appuyez sur
                <button type="submit" class="btn btn-default btn-secondary"><span class="glyphicon glyphicon-chevron-right"></span> Continuer</button>
                </form>

                </fieldset>
                
        </form>
        
        </div>
    </body>
    <?php require "footer.php";?>

</html>
