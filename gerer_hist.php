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
                                </tr>
                                <tr>
                                    <?php $req_stat = "SELECT * FROM lecture WHERE id_hist=:unIDhist";
                                    $rep_stat = $BDD->prepare($req_stat);
                                    $rep_stat->execute(array("unIDhist"=>$histoire['id_hist']));
                                    $stat = $rep_stat->fetch();
                                    $nbjouee=$stat['nb_fois_jouee'];
                                    $nbvictoires=$stat['nb_victoires'];
                                    $nbdefaites=$stat['nb_morts'];
                                    $pourcentagereussite=($nbvictoires/$nbjouee)*100;?>

                                    
                                    Nombre de fois que l'histoire a été jouée : <?php echo $nbjouee;?><br/>
                                    Nombre de victoires : <?php echo $nbvictoires;?><br/>
                                    Nombre de défaites : <?php echo $nbdefaites;?><br/>
                                    Pourcentage de réussite : <?php echo $pourcentagereussite?>%<br/>
                                    

                                </tr><br/>
                        
                       <?php } ?>
                       </td>
                        
                        
                    </fieldset>
                    </table>
                </div>
                        
            
        </div>
    </body>
<?php require "footer.php";?>