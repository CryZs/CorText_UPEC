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
            return $launch;
        }
        ?>
        <div>
        <form method="post">
                    <?php 
                    $sql = "SELECT DISTINCT `PRENOM_PRESIDENT`,`PRESIDENT` FROM `DISCOURS` ORDER BY  `PRESIDENT` DESC ";             // Préparation de la requête SQL contenant les prénoms & noms des présidents
                    $reponse = $bdd->query($sql);                       // Envoi de la requête SQL à la base de données
                    $i = 1;                                             // Initialisation du compteur qui s'incrémentera pour chaque 'input' de chaque président
                    while($donnees = $reponse->fetch()){
                        echo "<li><input type='checkbox' name='".str_replace(' ','_',str_replace('\'','§',$donnees['PRESIDENT']))."' class='cb' id='cb".$i."'/><label for='cb".$i."'>".$donnees['PRENOM_PRESIDENT']." ".$donnees['PRESIDENT']."</label></li><br/>";       // Construction du 'input' selon les présidents présents dans la base de données
                        
                        $i++;
                    }
                    ?>
            <br/>
            <input type="checkbox" id="sel" onclick="allSelect(this,'cb')"/><label for="sel">Sélectionner tout</label><br/> 
        <?php
        $sql = "SELECT DISTINCT  `PRESIDENT` FROM `DISCOURS` ORDER BY `PRESIDENT` DESC";                        // Préparation d
        $reponse = $bdd->query($sql);
        $alldata = $parseword = $parsedata = array();                                                                                   // Initialisation de la liste contenant les voeux et les présidents

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
        
        // ------- CREATION DU CORPUS ------- //
        $id = 0;
        $president = 1;
        $annee = 2;
        $voeux = 3;
        foreach ($alldata as $cle){
            $listvoeux = array();                                                                   // Création de la liste de voeux provisoire, de tous les présidents selectionnés
            array_push($listvoeux,strtolower($cle[$voeux]));                                        // Ajout de chaque voeux des présidents sélectionnés dans la liste
            foreach ($listvoeux as $discours){                                                      // Pour chaque voeux
            $word = multiexplode(array(',','.',':',';','!','?','(',')','\'','"','`','<','>','*','—','–','-','-',"    ",'_','[',']','«','»','“','”',' ',' ','’','ʼ',"ʻ","ʽ","ʾ","ʿ","ˈ","՚","‘","‛","´","′","ʹ","‵","\r\n"),$discours);                    // Suppression des caractères spéciaux pour récupérer uniquement les mots
            $identifiant = $cle[$id];
                for($x=0;$x<count($word);$x++){
                    if ($word[$x]!=null){                                                           // Si le mot n'est pas null
                        array_push($parsedata,$identifiant,$word[$x]);                              // Ajout du mot dans la liste des mots utilisée pour les calculs lexicométriques et lexicographiques
                    }
                }
            }
        }
        $arrayIdWord = array();
        for ($i=0;$i<count($parsedata);$i+=2){
            array_push($arrayIdWord,array("ID"=>$parsedata[$i],"MOT"=>$parsedata[$i+1]));
        }
        // ------- FIN CONSTRUCTION CORPUS ------- //
        
        // ------- PARTIE TRAITEMENT DE DONNEES ------- //
        
        //echo "Liste des voeux : ";for($e=0;$e<count($listvoeux);$e++){echo $listvoeux[$e]."<br/>";}echo"<br/>";
        
        
        echo 'Nombre de mots dans les voeux : '.count($arrayIdWord).'<br/>';
        $nbmots = count($arrayIdWord);                      // Variable contenant le nombre de mots dans le corpus (utilisée plus tard)
        ?>
        
        <h3>Rechercher un mot :</h3>
            <input type="text" placeholder="'français', 'année', 'le', ..." name="searchword"/><br/> 
        <?php 
        if (isset($_POST["searchword"]) && $_POST["searchword"]!=null){             // Si le input type='text' contient des caractères ET n'est pas null
            $searchedword = $_POST["searchword"];                                   // Affectation de la recherche dans une variable PHP
            echo "Mot recherché : ".$searchedword."<br/>";                          // Affichage du mot recherché
            $z=0;                                                                   // Déclaration de la variable qui comptera le nombre d'occurences du mot recherché dans le corpus
            echo "<h1 style='text-align:center;'>Concordances</h1><br/>";           // Titre "Concordances"
            for ($y=0;$y<count($arrayIdWord);$y++){                                 // Parcours de tous les mots du corpus
                if (strcasecmp($searchedword,$arrayIdWord[$y]["MOT"])==0){          // Si le mot recherché correspond à un ou plusieurs mots dans le corpus
                    $sql = "SELECT  `PRENOM_PRESIDENT` ,  `PRESIDENT`, `ANNEE` FROM  `DISCOURS` WHERE  `id_DISCOURS` = \"".$arrayIdWord[$y]['ID']."\"";                                                      // Préparation de la requête SQL contenant l'ID de chaque mots afin de retrouver le président ainsi que l'année du voeux
                    $reponse = $bdd->query($sql);                                   // Envoi de la requête SQL à la base de données
                    while ($result = $reponse->fetch()){
                        // --- Affectation des résultats à une variable --- //
                        $prenomauteur = $result["PRENOM_PRESIDENT"];
                        $nomauteur = $result["PRESIDENT"];
                        $anneediscours = $result["ANNEE"];
                    }
                    // ----------- AFFICHAGE DES CONCORDANCES ----------- //
                    echo "<div class=\"column-left\">... ".$arrayIdWord[$y-5]["MOT"]." ".$arrayIdWord[$y-4]["MOT"]." ".$arrayIdWord[$y-3]["MOT"]." ".$arrayIdWord[$y-2]["MOT"]." ".$arrayIdWord[$y-1]["MOT"]."</div>";
                    echo "<div class=\"column-middle\"><b>".$arrayIdWord[$y]["MOT"]."</b></div>";
                    echo "<div class=\"column-right\">".$arrayIdWord[$y+1]["MOT"]." ".$arrayIdWord[$y+2]["MOT"]." ".$arrayIdWord[$y+3]["MOT"]." ".$arrayIdWord[$y+4]["MOT"]." ".$arrayIdWord[$y+5]["MOT"]." ...</div>";
                    echo "<span style=\"float:right;\"><i>".$prenomauteur." ".$nomauteur." - ".$anneediscours."</i></span><br/>";
                    $z++;
                }
            }
            echo "Il y a <b>".$z."</b> occurrence";if($z>1){echo "s";}echo " du mot : ".$searchedword."<br/>";
            
        }
        
        
        
        // echo "Longueur du mot : ".mb_strlen($searchedword)."<br/>";
        
        // ----------- ECHO DE LA LISTE DE MOTS ----------- //
        // for($y=0;$y<count($arrayIdWord);$y++){
        //     echo $arrayIdWord[$y]["MOT"];
        // }
        // ----------- ECHO DE LA LISTE DE MOTS + ID ----------- //
        // for($j=0;$j<count($arrayIdWord);$j++){
        //     echo $arrayIdWord[$j]["ID"]." - ".$arrayIdWord[$j]["MOT"]."<br/>";
        // }
    ?>
            <input type="submit" value="Générer" placeholder="Rechercher un mot" class="btn btn-default"/>
        </form>
    </body>
</html>