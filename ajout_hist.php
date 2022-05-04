<!doctype html>
<html>
    <?php require "head.php";
    require "connect.php";
    require "header.php";?>
    <body>
        <h2 class="text-center">Ajouter une histoire</h2>
        <div class="well">
            <form class="form-signin form-horizontal" role="form" action="situations.php" method="post">
                <div class="form-group">
                    <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                        <p class="text-center">Quel est le titre de votre histoire ?</p>
                        <input type="text" name="titre" class="form-control" placeholder="Entrez le titre de votre histoire" required autofocus>
                    </div>
                    <!--Ajout d'une image-->
                </div>
                <div class="form-group">
                    <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                    <p class="text-center">Quel est le résumé de votre histoire ?</p>
                        <textarea name="description" class="form-control" placeholder="Décrivez votre histoire" required></textarea>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                        <button type="submit" class="btn btn-default btn-secondary">Enregistrer</button>
                    </div>
                </div>
            </form>
            
        </div>
    </body>
    <?php require "footer.php";?>

</html>