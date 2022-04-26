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
        <?php require_once "header.php"; ?>

        <h2 class="text-center">SuperSite</h2>
        <h3 class="text-center">Le site dont vous êtes le héros</h3>
        <table>
        <?php foreach ($histoires as $histoire) { ?>
            <hr/>
            <article>
            <tr>
                <td>
                    <img class="img-responsive" src="img/<?= $histoire['image'] ?>" title="<?= $histoire['titre'] ?>" width ="200"/>

                </td>
                <td>
                    <p> 
                        <h3><a class="histTitle" href="hist.php?id_hist=<?= $histoire['id_hist'] ?>&id_sit=1"><?= $histoire['titre'] ?></a></h3>
                        <p class="histContent"><?= $histoire['description'] ?></p>
                    </p>
                </td>
                  
                <td>
                </td>
            </tr>
            </article>
     
        <?php } ?>
        </table>
     
        <br/>

        <?php require_once "footer.php"; ?>
    </div>

    

    </body>

</html>