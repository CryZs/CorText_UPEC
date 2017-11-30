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
        <link rel="stylesheet" href="../../bootstrap-3.3.6-dist/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="style.css"/>
        
        <!--- Imports de Scripts JS/Bootstrap/JQuery --->
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css"/> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
        <script src="http://www.google.com/jsapi" type="text/javascript"></script>
        
        <!--- Javascript ---> 
        
        <script type="text/javascript">
        function toggle_div(bouton, id, mess1, mess2) {         // On déclare la fonction toggle_div qui prend en param le bouton et un id
            var div = document.getElementById(id);              // On récupère le div ciblé grâce à l'id
            if(div.style.display=="block") {                    // Si le div est affiché
                div.style.display = "none";                     // On le masque
                bouton.innerHTML = mess1;                       // Et on change le contenu du bouton.
            } else {                                            // S'il n'est pas visible...
                div.style.display = "block";                    // On l'affiche...
                bouton.innerHTML = mess2;                       // Et on change le contenu du bouton.
            }
            return true;
        }
        </script>
        
    </head>
    <body>
        <div id="listvoeux">
        <?php
            $reponse = $bdd->query('SELECT * FROM `DISCOURS` ORDER BY `DISCOURS`.`ANNEE` DESC ');   // Requête SQL
            $i = 0;                                                                                 // On initialise le compteur à 0
            while ($donnees = $reponse->fetch()) {                                                  // On parcours toutes les réponses renvoyées par la base de données
        ?>
        <strong>ID du Discours</strong> : <?php echo $donnees['id_DISCOURS']; ?><br />
        Le président de ce discours est : <?php echo $donnees['PRESIDENT']; ?><br/>
        L'année du discours est : <?php echo $donnees['ANNEE']; ?><br/>
        
        <button id='afficherVoeux' class="btn btn-default" onclick="toggle_div(this,'voeux<?php echo $i;?>','Afficher le discours','Masquer le discours');">Afficher le discours</button>
        <div class="voeux" id='voeux<?php echo $i;?>' style="margin:0 20%;"><?php echo $donnees['VOEUX'];?></div>
        <hr/>
        <?php $i++;}?>
        </div>
        
        
        
        <button onclick="toggle_div(this,'form','Ajouter un discours','Masquer');" class="btn btn-success">Ajouter un discours</button>
        <button onclick="toggle_div(this,'listvoeux','Afficher la liste de Voeux','Masquer la liste de Voeux');" class="btn btn-default">Afficher la liste de Voeux</button>
        <button onclick="location.href='update.php';" class="btn btn-warning">Modifier un Voeux</button>
        <span id="form" style="display:none;">
        <hr/>
        <!--- PARTIE AJOUTER UN DISCOURS --->
        <h1>AJOUTER UNE ENTREE</h1>
        
        <form id="form1" name="form1" method="post" action="add.php">
            <table id="table">
                <tr style="margin-top:20px;">
                    <td>President</td>
                    <td><label><input name="t_president" type="text" id="t_president" maxlength="30" autofocus required/></label></td>
                </tr>
                <tr>
                    <td>id_Discours</td>
                    <td><label><input name="t_id" type="text" id="t_id" maxlength="6" required/></label></td>
                </tr>
                <tr>
                    <td>Voeux</td>
                    <td><textarea name="t_voeux" type="text" id="t_voeux"  cols="40" rows="5" required></textarea></td>
                </tr>
                <tr>
                    <td>Année</td>
                    <td><input name="t_annee" type="number" id="t_annee"/></td>
                </tr>
            </table>
            <input class="btn btn-default" name="ajouter" type="submit" id="ajouter" value="Ajouter" />
        </form>
        </span>
    </body>
</html>