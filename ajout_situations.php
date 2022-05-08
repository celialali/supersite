<!doctype html>
<html>
    <?php require "head.php";
    require "connect.php";
    require "header.php";?>

    <body>
        <h2 class="text-center">Ajouter une histoire</h2>
        <div class="well">
            <p>Entrez les situations présentes dans votre histoire une par une :</p>
            <fieldset>
                <form class="form-signin form-horizontal" role="form" method="post"> 
                    <!-- pas d'action car on reste sur la meme page (en gardant ?id_hist=... dans l'url-->
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
            if (isset($_GET['id_hist'])){
                $id_hist = $_GET['id_hist'];
            }
                        if($BDD){
                            $req = "INSERT INTO situation (paragraphe,id_hist) VALUES (:par,:id)";
                            $prepare=$BDD ->prepare($req);
                            $prepare -> execute(array("par"=>$_POST['situation'],"id"=>$id_hist));
                        }
                    }
                    ?>
        
        </div>
        <p> Une fois que vous aurez rempli toutes vos situations, passez à l'ajout des choix en appuyant sur
            <a href="ajout_choix.php?id_hist=<?=$id_hist?>" class="btn btn-default btn-secondary"><span class="glyphicon glyphicon-chevron-right"></span> Continuer</a>
        </p>
        <br>
    </body>
    <?php require "footer.php";?>

</html>
