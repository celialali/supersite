<!doctype html>



<html>
<?php 
require "connect.php";
if($BDD) {
    // On enregistre la requête SQL dans une variable
    $req = "SELECT * FROM histoire ORDER BY id_hist";
    $curseur = $BDD->query($req);
    }?>
    
    
    <?php require "head.php";?>
    
    
    <body>
    <div class="container">
        <?php require_once "header.php"; ?>

        <h2 class="text-center">SuperSite</h2>
        <?php foreach ($curseur as $histoire) { ?>
            <article>
                <h3><a class="histTitle" href="hist.php?id=<?= $histoire['id_hist'] ?>"><?= $histoire['titre'] ?></a></h3>
                <p class="histContent"><?= $histoire['description'] ?></p>
            </article>
        <?php } ?>

        <?php require_once "footer.php"; ?>
    </div>

    

    </body>

</html>