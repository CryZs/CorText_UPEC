<?php 
    ob_start();
    session_start();
    mb_internal_encoding("UTF-8");
    try{
	    $bdd = new PDO('mysql:host=localhost;dbname=VOEUX;charset=utf8', 'cryz', '');
    } catch (Exception $e){
        die('Erreur : ' . $e->getMessage());
    }
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
        
        <link rel="stylesheet" href="reset.css"/>
        <link href="bootstrap-3.3.6-dist/css/bootstrap.min.css" rel=" stylesheet"/>
        <link rel="stylesheet" href="style.css"/>
        
        <!--- Imports de Scripts JS/Bootstrap/JQuery --->
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css"/> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
        <script src="http://www.google.com/jsapi" type="text/javascript"></script>
        
        <!--- Javascript ---> 
        
        <script type="text/javascript">
        $(document).ready(function(){
            var startYear = 1800;
        var endYear = 2016;
        var countClick = 0;
        $(document).ready(function() {
            $('#header').css('visibility', 'visible').animate({opacity: 1.0}, 1000);
            $('#formContent').css('visibility', 'visible').animate({opacity: 1.0}, 1000);
            
            document.getElementById('buttonAddYear').onclick = function(){
                if (countClick < 5){
                    var myDiv = document.getElementById("listYear"); //Create array of options to be added
                    var array = []; //Create and append select list
                    var selectList = document.createElement("select");
                    selectList.id = "year";
                    myDiv.appendChild(selectList); //Create and append the options
                    for (var i = startYear; i <= endYear; i++) {
                        var option = document.createElement("option");
                        option.text = i;
                        option.selected = 2015;
                        selectList.appendChild(option);
                    }
                    if (countClick == 4){
                        $('#buttonAddYear').hide();
                        var alertCount = document.createElement("div");
                        /*var textAlertCount = ;*/
                        alertCount.appendChild(document.createTextNode("Vous avez atteint la limite de discours"));
                        
                        alertCount.id = "alertCount";
                        myDiv.appendChild(alertCount);
                        
                        // A FAIRE //
                        var reinitialize = document.createElement("div");
                        reinitialize.id = "reinitialize";
                        reinitialize.appendChild(document.createTextNode("Réinitialiser"));
                        reinitialize.className = "btn btn-info";
                        myDiv.appendChild(reinitialize);
                        document.getElementById("reinitialize").onclick = function(){
                            document.getElementById("listYear").innerHTML = "";
                            countClick = 0;
                            $('#buttonAddYear').show();
                            return false;
                        }
                    }
                    countClick++;
                }
                myDiv.appendChild(document.createElement('br')); 
                return false;
            }
            
        })
        
        
        function displayLogin(){
            $('#form').css('visibility','visible').animate({opacity:0},1000);
            $('#form').css('display','none');
            $('#connection').css('visibility','visible').animate({opacity:1},1000);
            $('#connection').css('display','block');
        }
        function displayMain(){
            $('#form').css('visibility','visible').animate({opacity:1},1000);
            $('#form').css('display','block');
            $('#connection').css('visibility','visible').animate({opacity:0},1000);
            $('#connection').css('display','none');
        }
        }) 
        
        </script>
        
    </head>
    <body>
        <div class="header" id="header">
            <h1>Interface de gestion des Voeux présidentiels</h1>
        </div>
        
        <!-- BLOC 1 -->
        <div class="formContent" id="formContent">
            <form method="post" id='form' role="form">
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
        </div>
    </body>
</html>