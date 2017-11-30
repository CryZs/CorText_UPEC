<?php
try{
	$bdd = new PDO('mysql:host=localhost;dbname=VOEUX;charset=utf8', 'cryz', '');
}
catch (Exception $e){
        die('Erreur : ' . $e->getMessage());
}
mb_internal_encoding("UTF-8"); ?>
<!DOCTYPE HTML>
<html>
    <head>
        <!--- Balises HTML ---> 
        
        <meta http-equiv="Content-Type" content="text/html" charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta http-equiv="content-language" content="fr-FR"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        
        <!--- A remplir --->
        
        <title>TESTS Checkbox</title>
        
        <link rel="stylesheet" href="../../reset.css"/>
        <link href="../../bootstrap-3.3.6-dist/css/bootstrap.min.css" rel=" stylesheet"/>
        <link rel="stylesheet" href="style.css"/>
        
        <!--- Imports de Scripts JS/Bootstrap/JQuery --->
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css"/> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="http://hyperbase.unice.fr/hyperbase/js/main.js"></script>
        <script src="http://www.google.com/jsapi" type="text/javascript"></script>
        
        <!--- Javascript ---> 
        
        <script type="text/javascript">
        function allSelect(source, id) {
            checkboxes = document.getElementsByClassName(id);
            var n = checkboxes.length;
            for(var i=0;i<n;i++) {
                checkboxes[i].checked = source.checked;
            }
            return true;
        }
        </script>
        
    </head>
    <body>
        <?php 
        // Functions 
        function multiexplode ($delimiters,$string) {
            $ready = str_replace($delimiters, $delimiters[0], $string);
            $launch = explode($delimiters[0], $ready);
            return  $launch;
        }
        ?>
        <form method="post" >
            <?php 
            $sql ="SELECT DISTINCT `PRENOM_PRESIDENT`,`PRESIDENT` FROM `DISCOURS` ORDER BY  `PRESIDENT` DESC ";
            $reponse = $bdd->query($sql);
            $i = 1;
            while($donnees = $reponse->fetch()){
                echo "<input type='checkbox' name='".str_replace(' ','_',str_replace('\'','§',$donnees['PRESIDENT']))."' class='cb' id='cb".$i."'/><label for='cb".$i."'>".$donnees['PRENOM_PRESIDENT']." ".$donnees['PRESIDENT']."</label><br/>";
                
                $i++;
            }
            ?>
            <br/>
            <input type="checkbox" id="sel" onclick="allSelect(this,'cb')"/><label for="sel">Sélectionner tout</label><br/> 
            <input type="submit" value="Submit" class="btn btn-default"/>
        </form>
        <?php
        // $checkpresident = "";
        $sql = "SELECT DISTINCT  `PRESIDENT` FROM  `DISCOURS` ORDER BY `PRESIDENT` DESC";
        $reponse = $bdd->query($sql);
        $alldata = $parseword = array();                                                                                   // Initialisation de la liste contenant les voeux et les présidents

        while ($donnees = $reponse->fetch()){
            $listpresident[] = str_replace(' ','_',str_replace('\'','§',$donnees['PRESIDENT']));               // Création d'un tableau contenant tous les présidents présents dans la base de données
        }
        foreach ($listpresident as $nom){                                                               // Pour chaque élément dans le tableau
            if (isset($_POST[$nom])){                                                                   // Vérifie si l'élément dans la liste est coché par l'utilisateur
                $sql = "SELECT * FROM `DISCOURS` WHERE `PRESIDENT` = \"".str_replace('_',' ',str_replace('§','\'',$nom))."\"";       // Requête SQL
               // echo "Requete SQL : ".$sql."<br/>";
                $reponse = $bdd->query($sql);                                                           // Execution de la requete SQL dans la base de données
                while ($donnees = $reponse->fetch()){
                    array_push($alldata,array($donnees['id_DISCOURS'],$donnees['PRESIDENT'],$donnees['ANNEE'],$donnees['VOEUX']));      // Stockage des données de la base dans une liste
                }
            }
        }
        $id = 0;
        $president = 1;
        $annee = 2;
        $voeux = 3;
        foreach ($alldata as $cle){
            $listvoeux = array();                                                                   // Création de la liste de voeux provisoire, de tous les présidents selectionnés
            array_push($listvoeux,strtolower($cle[$voeux]));                                        // Ajout de chaque voeux des présidents sélectionnés dans la liste
            foreach ($listvoeux as $discours){                                                      // Pour chaque voeux
            $word = multiexplode(array(',','.',':',';','!','?','(',')','\'','"','`','<','>','*','-','_','[',']','«','»','“','”',' ',' ','’','ʼ',"ʻ","ʽ","ʾ","ʿ","ˈ","՚","‘","‛","´","′","ʹ","‵","\r\n"),$discours);                    // Suppression des caractères spéciaux pour récupérer uniquement les mots
                for($x=0;$x<count($word);$x++){
                    if ($word[$x]!=null){                            // Si le mot n'est pas null
                        array_push($parseword,$word[$x]);           // Ajout du mot dans la liste des mots utilisée pour les calculs lexicométriques et lexicographiques
                    }
                }
            }
        }
        // echo "Liste des voeux : ";for($e=0;$e<count($listvoeux);$e++){echo $listvoeux[$e];}echo"<br/>";
        echo 'Nombre de mots dans les voeux : '.count($parseword).'<br/>';
        $searchedword = "français";
        echo "Mot recherché : ".$searchedword."<br/>";
        echo "Longueur de la chaîne : ".mb_strlen($searchedword)."<br/>";
        $z=0;
            for ($y=0;$y<count($parseword);$y++){
            if (strcasecmp($searchedword,$parseword[$y]/*,strlen($searchedword)*/)==0){
                $z++;
            }
        }
        echo "Il y a ".$z." occurrence";if($z>1){echo "s";}echo " du mot : ".$searchedword;
        
        // ----------- ECHO DE LA LISTE DE MOTS ----------- //
        // for($y=0;$y<count($parseword);$y++){
        //     echo $parseword[$y].'_';
        // }
    ?>
    </body>
</html>

