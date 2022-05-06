<!doctype html>
<html>
    <?php require "head.php";
    require "connect.php";
    require "header.php";
    for($i=1;$i<=$nbsituation;$i++){
        if(isset($_POST["situation" echo $i])){
            if($BDD){
                $req = "INSERT INTO situation (paragraphe,id_hist) VALUES (:par)";
                $prepare=$BDD ->prepare($req);
                $prepare -> execute(array("par"=>$_POST['situation'echo $i]));
                }
        }
    }
