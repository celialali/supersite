<!doctype html>
<html>
    <?php require "head.php";
    require "connect.php";
    require "header.php";?>

    <?php 
    if(isset($_POST['titre']) && isset($_POST['description']) && isset($_POST['image'])){
                    $titre = $_POST['titre'];
                    $description = $_POST['description'];
                    $image = $_POST['image'];
                    if($BDD){
                        $req = "INSERT INTO histoire (titre,description, image) VALUES (:ttre,:descr,:img)";
                        $prepare=$BDD ->prepare($req);
                        $prepare -> execute(array("ttre"=>$titre, "descr"=>$description, "img"=>$image));
                }
                header('Location: ajout_situations.php?titre='.$titre);
            } ?>
    <body>
        <h2 class="text-center">Ajouter une histoire</h2>
        <div class="well">
            <p>Entrez les situations présentes dans votre histoire une par une :</p>
            <fieldset>
                <form class="form-signin form-horizontal" role="form" method="post"> 
                    <!-- pas d'action car on reste sur la meme page (en gardant ?titre=... dans l'url-->
                <div class="form-group">
                  
                    <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                        <p class="text-center">Situation</p>
                        <textarea name="situation" class="form-control" placeholder="Ecrivez le paragraphe correspondant à la situation" rows="3"></textarea><br/><br/>
                    </div>
                    <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 text-center">
                        <button type="submit" class="btn btn-default btn-secondary"><span class="glyphicon"></span> Enregistrer</button>
                    </div>
                </div>
                
                </form>

            </fieldset>
                
        <?php  if(isset($_POST['situation'])){
            if (isset($_GET['titre'])){
                $titre = $_GET['titre'];
            }
                        if($BDD){
                            //On recupere l'id de l'histoire qu'il est en train d'écrire
                            $req_id_hist = "SELECT id_hist FROM histoire WHERE titre=:unTitre";
                            $rep_id_hist = $BDD->prepare($req_id_hist);
                            $rep_id_hist->execute(array("unTitre"=>$titre));
                            $idhistoire = $rep_id_hist->fetch()['id_hist'];
                            $req = "INSERT INTO situation (paragraphe,id_hist) VALUES (:par,:id)";
                            $prepare=$BDD ->prepare($req);
                            $prepare -> execute(array("par"=>$_POST['situation'],"id"=>$idhistoire));
                        }
                    }
                    ?>
        
        </div>
        <form>
            <p> Une fois que vous aurez rempli toutes vos situations, passez à l'ajout des choix en appuyant sur 
                <button type="submit" class="btn btn-default btn-secondary"><span class="glyphicon glyphicon-chevron-right"></span> Continuer</button>
            </p>
        </form>
        <br>
    </body>
    <?php require "footer.php";?>

</html>
