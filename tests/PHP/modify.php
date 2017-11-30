<?php
try{
	$bdd = new PDO('mysql:host=localhost;dbname=VOEUX;charset=utf8', 'cryz', '');
}
catch (Exception $e){die('Erreur : ' . $e->getMessage());}
?>
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
        echo $_POST['text']." - ".$_POST['president']." - ".$_POST['years']." - ".$_POST['voeux'];
        echo "<br/>";
        if ($_POST['president']!=null){
            $president = "`PRESIDENT` ='".$_POST['president']."',";
        }else {
            $president = "";
        }
        
        if ($_POST['years']!=null){
            $years = "`ANNEE` ='".$_POST['years']."' ";
        }else {
            $years = "";
        }
        
        if ($_POST['text']!=null){
            $id = "`VOEUX` ='".$_POST['voeux']."',";
        }else {
            $id = "";
        }
        
        if ($_POST['voeux']!=null){
            $voeux = "`id_DISCOURS` ='".$_POST['text']."',";
        }else {
            $voeux = "";
        }
        $newsql = "UPDATE `DISCOURS` SET ".$president.$voeux.$id.$years." WHERE `id_DISCOURS`='FH0001'";
        
        // $sql = "UPDATE `DISCOURS` (`PRESIDENT`,`ANNEE`,`VOEUX`,`id_DISCOURS`) SET ('".$_POST['president']."','".$_POST['years']."','".$_POST['voeux']."','".$_POST['text']."')";
        echo "<br/>";
        echo $newsql;
        echo "<br/>";
        $req = $bdd->exec("$newsql") or die(print_r($bdd->errorInfo(), true));
        echo "Votre voeux du président ".$_POST['t_president']." a bien été modifié.<br/><a href='index.php'>Revenir en arrière</a>";?>
    </body>
</html>