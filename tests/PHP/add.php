<?php
try{
	$bdd = new PDO('mysql:host=localhost;dbname=VOEUX;charset=utf8', 'cryz', '');
}
catch (Exception $e){
        die('Erreur : ' . $e->getMessage());
}?>

<!DOCTYPE HTML>
<html>
    <head>
        <!--- Balises HTML ---> 
        
        <meta http-equiv="Content-Type" content="text/html" charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta http-equiv="content-language" content="fr-FR"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        
        <!--- A remplir --->
        
        <title>TESTS Base de Données</title>
        
        <link rel="stylesheet" href="../../reset.css"/>
        <link href="../../bootstrap-3.3.6-dist/css/bootstrap.min.css" rel=" stylesheet"/>
        <link rel="stylesheet" href="style.css"/>
        
        <!--- Imports de Scripts JS/Bootstrap/JQuery --->
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css"/> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
        <script src="http://www.google.com/jsapi" type="text/javascript"></script>
        
        <!--- Javascript ---> 
        
        <script type="text/javascript">
        
        $(document).ready(function(){
            return false;
        }) 
        
        </script>
        
    </head>
    <body>
        <?php 
        /*if (isset($_POST["t_president"]) && isset($_POST["t_voeux"]) && isset($_POST["t_annee"]) && isset($_POST["t_id"])){
            $sql = "INSERT INTO `DISCOURS`(`PRESIDENT`, `ANNEE`, `VOEUX`, `id_DISCOURS`) VALUES ('".$_POST[`t_president`]."','".$_POST[`t_annee`]."','".$_POST[`t_voeux`]."','".$_POST[`t_id`]."')";
            $bdd->exec($sql);
            echo "Votre requête a bien été envoyée. <br/> <a href=\"index.php\"> Revenir en arrière </a>";
        }
        else{
            echo "Le formulaire n'est pas complet, <a href=\"index.php\"> veuillez réessayer</a>";
        }
        $req = $bdd->prepare('INSERT INTO "DISCOURS" ("PRESIDENT", "ANNEE", "VOEUX", "id_DISCOURS") VALUES  (:president, :annee, :voeux, :id_DISCOURS)');
        $req->execute(array('president' => $_POST['t_president'],'annee' => $_POST['t_annee'],'voeux' => $_POST['t_voeux'],'id_DISCOURS' => $_POST['t_id']));
        echo 'Votre voeux du président '.$_POST['t_president'].' a bien été ajouté à la base de données. <br/><a href="index.php">Revenir en arrière</a>' ;
        */
        //echo 'Le formulaire n\'est pas complet, <a href="index.php"> veuillez réessayer</a>';
        
        if (isset($_POST['t_president']) && isset($_POST['t_annee']) && isset($_POST['t_voeux']) && isset($_POST['t_id'])){
        $sql = "INSERT INTO `DISCOURS` (`PRESIDENT`,`ANNEE`,`VOEUX`,`id_DISCOURS`) VALUES ('".$_POST['t_president']."','".$_POST['t_annee']."','".$_POST['t_voeux']."','".$_POST['t_id']."')";
        $req = $bdd->exec("$sql") or die(print_r($bdd->errorInfo(), true));
        echo "Votre voeux du président ".$_POST['t_president']." a bien été ajouté.<br/><a href='index.php'>Revenir en arrière</a>";
        }
        else{
            echo "";
        }
        ?>
    </body>
</html>