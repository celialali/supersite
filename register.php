<!doctype html>
<html>
    <?php require "connect.php";
    require "head.php";?>
    
    <body>
    <div class="container">
        <?php require_once "header.php"; ?>

        <h2 class="text-center">Inscription</h2>
        <div class="well register">
            <form class="form-signin form-horizontal" role="form" action="register.php" method="post">
                <div class="form-group">
                    <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                    <input type="text" name="login" class="form-control" placeholder="Entrez un login" required autofocus>
                    </div>
                </div>
                
                

                <div class="form-group">
                    <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                        <input type="password" name="password" class="form-control" placeholder="Entrez un mot de passe" required>

                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                        Souhaitez-vous être admin ? <input type="radio" name="admin" id="oui" value=1/><label for="oui">Oui</label> 
                        <input type="radio" name="admin" id="non" checked value=0/><label for="non" >Non</label><br/>
                        <!--Il manque a changer la valeur de admin dans la base de données-->
                    </div>


                </div>

                <div class="form-group">
                    <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                        <button type="submit" class="btn btn-default btn-secondary"><span class="glyphicon glyphicon-log-in"></span> S'inscrire</button>
                    </div>
                </div>
            </form>
        </div>

        <?php

        if(isset($_POST['login']) && isset($_POST['password'])){
            // on vérifie qu'il n'y a pas déjà un utilisateur avec le même login
            $req_login = "SELECT * FROM profil WHERE login=:leLogin";
            $rep_login = $BDD->prepare($req_login);
            $rep_login -> execute(array("leLogin"=>$_POST['login']));
            $nb_login = $rep_login->rowCount();

            if($nb_login==0){
                $login=$_POST['login'];
                $motdepasse = $_POST['password'];
                $admin=$_POST["admin"];

                if($BDD){
                $req = "INSERT INTO profil (login,mdp,admin) VALUES (:logi,:mdp,:admin)";
                $prepare=$BDD ->prepare($req);
                $prepare -> execute(array(":logi"=>$login, ":mdp"=>$motdepasse, ":admin"=>$admin));
                }
                ?> <p class="text-center"> Bienvenue <?=$login?>, votre inscription a réussi. Vous pouvez désormais <a href = "login.php">vous connecter</a> ! </p>
            <?php }
            else{
                echo "Le nom d'utilisateur ",$_POST['login']," est déjà utilisé.";
                ?> <br> <?php
            }
        
        }



        require_once "footer.php"; ?>
    </div>

    

    </body>

</html>