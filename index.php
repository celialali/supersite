<!doctype html>
<html>
<?php 
require "connect.php";
if($BDD) {
    // On sélectionne les histoire qui doivent être affichées
    $req = "SELECT * FROM histoire WHERE affichee=1 ORDER BY id_hist";  
    $rep = $BDD->prepare($req);
    $rep->execute();
    $histoires = $rep->fetchAll();
}?>
    
    <?php require "head.php";?>
    
    
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
            <?php foreach ($histoires as $histoire) { ?>
                <div class="ligne">
                    <div class="col1" ><img class="img-responsive" src="img/<?= $histoire['image'] ?>" title="<?= $histoire['titre'] ?>" width ="200"/>
                    </div>
                
                    <div class="col2" > 
                        <h3>
                            <?php 
                            if (isset($_SESSION['login'])) {
                                ?>
                                <a class="lien" href="hist.php?id_hist=<?= $histoire['id_hist'] ?>&id_sit=<?=$histoire['id_sit_initiale']?>"><?= $histoire['titre'] ?></a>
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