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
                            <button type="submit" name="editer" class="btn btn-default btn-secondary"><span class="glyphicon glyphicon-edit"></span> Editer</button>
                            <?php if($histoire['affichee']==1){?>
                                <button type="submit" name="masquer" class="btn btn-default btn-secondary"><span class="glyphicon glyphicon-lock"></span> Masquer</button>

                            <?php }
                                else{?>
                                    <button type="submit" name ="afficher" class="btn btn-default btn-secondary"><span class="glyphicon glyphicon-unlock"></span> Afficher</button>

                            <?php } ?>
                        

                            <button type="submit" name ="supprimer" class="btn btn-default btn-secondary"><span class="glyphicon glyphicon-trash"></span> Supprimer</button><br/>
                        
                        <?php if(isset($_POST['editer'])){
                            header('modif.php');
                        }
                        if(isset($_POST['afficher'])){
                            $histoire['affichee']==1;
                        }
                        if(isset($_POST['masquer'])){
                            $histoire['affichee']==0;
                        }

                        if(isset($_POST['supprimer'])){
                            if($BDD){
                                $req = "DELETE FROM histoire WHERE id_hist =:id";
                                $prepare=$BDD ->prepare($req);
                                $prepare -> execute(array("id"=>$histoire['id_hist']));
                                }
                         } 
                        } ?>
                        </fieldset>
                        </div>
            
        </div>
    </body>
<?php require "footer.php";?>