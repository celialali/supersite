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
                        <p class="text-center">Choisissez un titre à votre histoire</p>
                        <input type="text" name="titre" class="form-control" placeholder="Entrez le titre de votre histoire" required autofocus>
                    </div>

                </div>
                <div class="form-group">
                    <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                    <p class="text-center">Faites un court résumé de votre histoire</p>
                        <textarea name="description" class="form-control" placeholder="Décrivez votre histoire" required></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                        <p class="text-center">Choisissez une image représentative de votre histoire</p>
                        <input type="file" name="image" class="form-control" required>
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