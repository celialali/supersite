<!doctype html>
<?php session_start(); 

$histoires = getDb()->query('select * from superhistoire order by id_hist desc');?>
<html>
    <?php require "head.php";
    require "connect.php"?>
    
    <body>
    <div class="container">
        <?php require_once "header.php"; ?>

        <h2 class="text-center">SuperSite</h2>
        <?php foreach ($histoires as $histoire) { ?>
            <article>
                <h3><a class="histTitle" href="hist.php?id=<?= $movie['id_hist'] ?>"><?= $movie['titre'] ?></a></h3>
                <p class="histContent"><?= $movie['description'] ?></p>
            </article>
        <?php } ?>

        <?php require_once "footer.php"; ?>
    </div>

    

    </body>

</html>