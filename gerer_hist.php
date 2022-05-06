<?php require "head.php";
    require "connect.php";
    require "header.php";?>
    <body>
        <h2 class="text-center">Gérer les histoires</h2>
        <div>
            
                <?php if($BDD){
                    $req = "SELECT * FROM histoire ORDER BY id_hist";
                    $reponse = $BDD->prepare($req);
                    $reponse -> execute();
                    $histoires = $reponse->fetchAll();
                }?>
                <div class="well">
                <?php foreach($histoires as $histoire){?>
                        <fieldset>
                        <?php echo $histoire['titre']?>
                        <form action="modif.php" method="POST">
                            <button type="submit" name="editer" class="btn btn-default btn-secondary"><span class="glyphicon glyphicon-edit"></span> Editer</button>
                        </form >
                            <?php if($histoire['affichee']==1){?>
                            <form action="test.php" method="POST">
                                <button type="hidden" name="masquer" class="btn btn-default btn-secondary" value="<?php echo $histoire['id_hist']?>"><span class="glyphicon glyphicon-lock"></span> Masquer</button>
                            </form>
                            <?php }
                                else{?>
                                <form action="test.php" method="POST">
                                    <button type="hidden" name ="afficher" class="btn btn-default btn-secondary" value="<?php echo $histoire['id_hist']?>"><span class="glyphicon glyphicon-unlock"></span> Afficher</button>
                                </form>
                            <?php } ?>
                        
                        <form role="form" action="test.php" method="POST">
                            <button type="hidden" name ="supprimer" class="btn btn-default btn-secondary" value="editer"><span class="glyphicon glyphicon-trash"></span> Supprimer</button><br/>
                        </form>
                     
                       <?php } ?>
                        <?php /*if(isset($_POST['editer'])){
                            header('modif.php');
                        }*/?>

                        
              
                        </fieldset>
                        </div>
                        
            
        </div>
    </body>
<?php require "footer.php";?>