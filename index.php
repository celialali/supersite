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
        
        // $login = $_SESSION['login'];
        // $req_profil = "SELECT * FROM profil WHERE login=:unLogin";
        // $rep_profil = $BDD->prepare($req_profil);
        // $rep_profil->execute(array("unLogin"=>$login));
        // $profil = $rep_profil->fetch();
        // $estAdmin = $profil['admin'];
        ?>

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
                <td class="well well-sm">
                    <p> 
                        <h3>
                            <?php 
                            if (isset($_SESSION['login'])) {
                                ?>
                                <a class="histTitle" href="hist.php?id_hist=<?= $histoire['id_hist'] ?>&id_sit=1"><?= $histoire['titre'] ?></a>
                            <?php
                            }
                            else { ?> <p><?php echo $histoire['titre'] ?> </p> <?php } 
                            ?>
                        </h3>
                        <p class="histContent"><?= $histoire['description'] ?></p>
                    </p>
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