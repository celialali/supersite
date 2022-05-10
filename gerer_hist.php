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
                <table class="gerer">
                <?php foreach($histoires as $histoire){?>
                    <fieldset>
                       
                            <td>
                                <tr><?php echo $histoire['titre']?></tr>
                                <tr>
                                    <form class="form-inline" action="edit.php?id_hist=<?=$histoire['id_hist']?>" method="POST">
                                        <button type="submit" name="editer" class="btn btn-default btn-secondary"><span class="glyphicon glyphicon-edit"></span> Editer</button>
                                    </form >
                                </tr>
                                <tr>
                                    <?php if($histoire['affichee']==1){?>
                                    <form class="form-inline" action="submit.php" method="POST">
                                        <button type="hidden" name="masquer" class="btn btn-default btn-secondary" value="<?php echo $histoire['id_hist']?>"><span class="glyphicon glyphicon-eye-close"></span> Masquer</button>
                                    </form>
                                    <?php }
                                        else{?>
                                        <form class="form-inline" action="submit.php" method="POST">
                                            <button type="hidden" name ="afficher" class="btn btn-default btn-secondary" value="<?php echo $histoire['id_hist']?>"><span class="glyphicon glyphicon-eye-open"></span> Afficher</button>
                                        </form>
                                    <?php } ?>
                                </tr>
                                <tr>
                                    <form class="form-inline" role="form" action="submit.php" method="POST">
                                        <button type="hidden" name ="supprimer" class="btn btn-default btn-secondary" value="<?php echo $histoire['id_hist']?>"><span class="glyphicon glyphicon-trash"></span> Supprimer</button><br/>
                                    </form>
                                </tr><br/>
                        
                       <?php } ?>
                       </td>
                        
                        
                    </fieldset>
                    </table>
                </div>
                        
            
        </div>
    </body>
<?php require "footer.php";?>