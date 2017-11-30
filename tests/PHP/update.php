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
        <script src="https://www.google.com/jsapi" type="text/javascript"></script>
        
        <!--- Javascript ---> 
        
        <script type="text/javascript">
        function toggle_voeux(bouton,id){
            var div = document.getElementById(id);
            if (div.style.display=="none"){
                div.style.display = "block";
            }
            else if (div.style.display == "block"){
                div.style.display = "none";
            }
            else {
                return false;
            }
            return true;
        }
        </script>
        
    </head>
    <body>
        <h1>Modifier un voeux</h1>
        <p>Sélectionnez un voeux : </p><br>
        <?php
        $reponse = $bdd->query('SELECT * FROM `DISCOURS`');
        $i=1;
        while ($donnees = $reponse->fetch()){?>
        <button onclick="toggle_voeux(this,'form<?php echo $i;?>')" class="btn btn-default">
        <?php
            echo "Voeux du président ".$donnees['PRESIDENT'].", en ".$donnees['ANNEE'].".";?>
        </button>
            <form id="form<?php echo $i;?>" method="post" style="display:none;" action="modify.php" style="margin-top=20px;">
                <label for="text">ID du discours </label><input type="text" name="text" id="text" placeholder="<?php echo $donnees['id_DISCOURS']; ?>"/><br/>
                <label for="years">Année </label><input type="number" name="years" id="years" placeholder="<?php echo $donnees['ANNEE'] ?>"/><br/>
                <label for="voeux">Voeux </label><input type="textarea" name="voeux" id="voeux" placeholder="<?php echo $donnees['VOEUX'];?>"/><br/>
                <label for="president">Président </label><input type="text" name="president" id="president" placeholder="<?php echo $donnees['PRESIDENT'];?>"/><br/>
                <input type="submit" value="Modifier"/>
            </form>
        <?php
            echo "<br/>";
            $i++;
        }
        ?>
    </body>
</html>