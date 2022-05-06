<!doctype html>
<html>
<?php 
require "connect.php";
require "head.php";
if($BDD) {
    // On sélectionne les histoires qui doivent être affichées
    $req = "SELECT * FROM histoire WHERE affichee=1 ORDER BY titre";  
    $rep = $BDD->prepare($req);
    $rep->execute();
    $histoires = $rep->fetchAll();

    // On trouve les id des histoires qui sont en cours de lecture par l'utilisateur connecté
    $histoires_en_cours = $BDD->prepare("SELECT * FROM lecture WHERE id_profil=:idprofil AND en_cours=1");
    $histoires_en_cours-> execute(array(
        "idprofil"=>$_SESSION['id_profil']
    ));
    $liste_hist_en_cours = $histoires_en_cours->fetchAll();
}?>
    
    
    <body>
    <div class="container">
        <?php require_once "header.php";
        ?>

        <h2 class="text-center">SuperSite</h2>
        <h3 class="text-center">Le site dont vous êtes le héros</h3>
        <?php if(!isset($_SESSION['login'])){
            ?> 
            <p> <br> <a class="lien" href="login.php">Connectez-vous</a> ou <a class="lien" href="register.php">inscrivez-vous</a> pour avoir accès aux histoires !</p>
        <?php } 
        ?>
        
        <div class="container">
            <hr/>
            
            <?php if (isset($_SESSION['login'])){
                ?> <h3> Histoires en cours </h3>
                <hr>
                <?php 
                // s'il y a au moins une histoire en cours, on les affiche
                if ($histoires_en_cours->rowCount() >0){
                    foreach ($liste_hist_en_cours as $hist_en_cours){
                        $id = $hist_en_cours['id_hist'];
                        // on cherche l'histoire correspondant à l'id
                        if ($BDD){
                            $req_hist = $BDD->prepare("SELECT * FROM histoire WHERE id_hist=:idhist");
                            $req_hist->execute(array("idhist"=>$id));
                            $hist_en_cours = $req_hist->fetch();
                        }
                        // si l'histoire n'est pas masquée, on l'affiche
                        if ($hist_en_cours['affichee'] == 1){
                            ?> 
                            <div class="ligne">
                                <div class="col1" ><img class="img-responsive" src="img/<?= $hist_en_cours['image'] ?>" title="<?= $hist_en_cours['titre'] ?>" width ="200"/>
                                </div>
                
                                <div class="col2" > 
                                    <h3>
                                        <form method="POST" action="redirection_hist.php">
                                            <button type="hidden" name="allerHistoire" value="<?=$hist_en_cours['id_hist']?>"><?= $hist_en_cours['titre'] ?></button>
                                        </form>
                                    </h3>
                                <p class="histContent"><?= $hist_en_cours['description'] ?></p>
                                </div>
                            </div>
                        <?php }
                    }
                }
                // s'il n'y a pas d'histoire en cours
                else{
                    ?>
                    <div>
                        <p> Vous n'avez pas d'histoire en cours. Commencez-en une de la liste ci-dessous ! </p>
                    </div>
                    <br>
                    <hr>
                <?php }

            }

            ?>
            <h3> Toutes les histoires </h3>
            <br>
            <?php foreach ($histoires as $histoire) { ?>
                <div class="ligne">
                    <div class="col1" ><img class="img-responsive" src="img/<?= $histoire['image'] ?>" title="<?= $histoire['titre'] ?>" width ="200"/>
                    </div>
                
                    <div class="col2" > 
                        <h3>
                            <?php 
                            if (isset($_SESSION['login'])) {
                                ?>
                                <form method="POST" action="redirection_hist.php">
                                    <button type="hidden" name="allerHistoire" value="<?=$histoire['id_hist']?>"><?= $histoire['titre'] ?></button>
                                </form>
                                <?php
                            }
                            else { ?> <p><?php echo $histoire['titre'] ?> </p> <?php } 
                            ?>
                        </h3>
                        <p class="histContent"><?= $histoire['description'] ?></p>
                        </div>
                </div>
                    
            <?php } ?>

            
        </div>
     
        <br/>
        

        <?php require_once "footer.php"; ?>
    </div>

    

    </body>

</html>