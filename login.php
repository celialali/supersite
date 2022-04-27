<!doctype html>

<html>
    <?php require "connect.php";
    require "head.php";?>
    
    <body>
    <div class="container">
        <?php require "header.php"; ?>

        <h2 class="text-center">Connexion</h2>
        <div class="well connect">
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
        <?php 
        if(!empty($_POST['login']) && !empty($_POST['password'])){
            $login=$_POST['login'];
            $password=$_POST['password'];
            if($BDD){
                $req = "SELECT * FROM profil WHERE login=:unLogin AND mdp=:unPassword";
                $reponse = $BDD->prepare($req);
                $reponse -> execute(array(
                    "unLogin"=>$login,
                    "unPassword"=>$password
                ));
            }
            if ($reponse->rowCount()==0){
                echo "Erreur ! Cet utilisateur n'existe pas";
            }
            else{
                $_SESSION['login'] = $login;
                $utilisateur = $reponse->fetch();
                $estAdmin = $utilisateur['admin'];
                header("Location: index.php");
            }

        }


    ?>

        <?php require_once "footer.php"; ?>
    </div>

    

    </body>

</html>