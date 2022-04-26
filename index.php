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
        <h3 class="text-center">Le site dont vous êtes le héros</h3>
        <table>
        <?php foreach ($curseur as $histoire) { ?>
            <hr/>
            <article>
            <tr>
                <td>
                    <h3><a class="histTitle" href="hist.php?id=<?= $histoire['id_hist'] ?>"><?= $histoire['titre'] ?></a></h3>
                </td>
                
                    
            </tr>
            <tr>  
                <td>
                    <img class="img-responsive" src="img/<?= $histoire['image'] ?>" title="<?= $histoire['titre'] ?>" width ="200"/>
                </td>
                  
                <td>
                    <p class="histContent"><?= $histoire['description'] ?></p>
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