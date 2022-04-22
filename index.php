<!doctype html>
<?php session_start(); 

$movies = getDb()->query('select * from movie order by mov_id desc');?>
<html>
    <?php require "head.php";?>
    
    <body>
    <div class="container">
        <?php require_once "header.php"; ?>

        <h2 class="text-center">SuperSite</h2>
        <?php foreach ($histoires as $histoire) { ?>
            <article>
                <h3><a class="movieTitle" href="movie.php?id=<?= $movie['mov_id'] ?>"><?= $movie['mov_title'] ?></a></h3>
                <p class="movieContent"><?= $movie['mov_description_short'] ?></p>
            </article>
        <?php } ?>

        <?php require_once "footer.php"; ?>
    </div>

    

    </body>

</html>