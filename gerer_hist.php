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
                        <form action="edit.php" method="POST">
                            <button type="submit" name="editer" class="btn btn-default btn-secondary"><span class="glyphicon glyphicon-edit"></span> Editer</button>
                        </form >
                            <?php if($histoire['affichee']==1){?>
                            <form action="submit.php" method="POST">
                                <button type="hidden" name="masquer" class="btn btn-default btn-secondary" value="<?php echo $histoire['id_hist']?>"><span class="glyphicon glyphicon-eye-close"></span> Masquer</button>
                            </form>
                            <?php }
                                else{?>
                                <form action="submit.php" method="POST">
                                    <button type="hidden" name ="afficher" class="btn btn-default btn-secondary" value="<?php echo $histoire['id_hist']?>"><span class="glyphicon glyphicon-eye-open"></span> Afficher</button>
                                </form>
                            <?php } ?>
                        
                        <form role="form" action="submit.php" method="POST">
                            <button type="hidden" name ="supprimer" class="btn btn-default btn-secondary" value="<?php echo $histoire['id_hist']?>"><span class="glyphicon glyphicon-trash"></span> Supprimer</button><br/>
                        </form>
                     
                       <?php } ?>
                        

                        
              
                        </fieldset>
                        </div>
                        
            
        </div>
    </body>
<?php require "footer.php";?>