<?php require "head.php";
    require "connect.php";
    require "header.php";?>
    <body>
        <h2 class="text-center">Gérer les histoires</h2>
        <div class="well">
            <form class="form-signin form-horizontal" role="form" action="gerer_hist.php" method="post">
                <?php if($BDD){
                    $req = "SELECT * FROM histoire ORDER BY id_hist";
                    $reponse = $BDD->prepare($req);
                    $reponse -> execute();
                    $histoires = $reponse->fetchAll();
                }
                foreach($histoires as $histoire){?>
                        <?php echo $histoire['titre']?>
                            <button type="submit" name="editer" class="btn btn-default btn-secondary"><span class="glyphicon glyphicon-edit"></span> Editer</button>
                            <?php if($histoire['affichee']==1){?>
                                <button type="submit" name="masquer" class="btn btn-default btn-secondary"><span class="glyphicon glyphicon-lock"></span> Masquer</button>

                            <?php }
                                else{?>
                                    <button type="submit" name ="afficher" class="btn btn-default btn-secondary"><span class="glyphicon glyphicon-unlock"></span> Afficher</button>

                            <?php } ?>
                    
                                <button type="submit" name ="supprimer" class="btn btn-default btn-secondary"><span class="glyphicon glyphicon-trash"></span> Supprimer</button><br/>

                <?php } ?>
                </table>
            </form>
        </div>
    </body>
<?php require "footer.php";?>