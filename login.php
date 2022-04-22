<!doctype html>
<html>
    <?php require "head.php";?>
    
    <body>
    <div class="container">
        <?php require_once "header.php"; ?>

        <h2 class="text-center">Connexion</h2>
        <div class="well">
            <form class="form-signin form-horizontal" role="form" action="login.php" method="post">
                <div class="form-group">
                    <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                    <input type="text" name="login" class="form-control" placeholder="Entrez votre login" required autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                        <input type="password" name="password" class="form-control" placeholder="Entrez votre mot de passe" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                        <button type="submit" class="btn btn-default btn-secondary"><span class="glyphicon glyphicon-log-in"></span> Se connecter</button>
                    </div>
                </div>
            </form>
        </div>

        <?php require_once "footer.php"; ?>
    </div>

    

    </body>

</html>