<?php
?>
<!DOCTYPE html>
<html>
    <head>
        <!--- Balises HTML ---> 
        <meta http-equiv="Content-Type" content="text/html" charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta http-equiv="content-language" content="fr-FR"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <title>Hide- Show</title>
        
        <link rel="stylesheet" href="../../reset.css"/>
        <link href="../../bootstrap-3.3.6-dist/css/bootstrap.min.css" rel="stylesheet"/>
        <link rel="stylesheet" href="../../style.css"/>
        <!--- JS/Bootstrap/JQuery --->
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css"/>
        <!--- Script JQuery ---> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
        <script src="http://www.google.com/jsapi" type="text/javascript"></script>
        <!--- Javascript ---> 
        <script type="text/javascript">
        var startYear = 1900;
        var endYear = 2016;
        var countClick = 0;
        $(document).ready(function() {
            $('#header').css('visibility', 'visible').animate({opacity: 1.0}, 1000);
            $('#formContent').css('visibility', 'visible').animate({opacity: 1.0}, 1000);
            $('#connection').hide();
            
            document.getElementById('buttonAddYear').onclick = function(){
                if (countClick <= 5){
                    var myDiv = document.getElementById("listYear");//Create array of options to be added
                    var array = [];//Create and append select list
                    var selectList = document.createElement("select");
                    selectList.id = "year";
                    myDiv.appendChild(selectList);//Create and append the options
                    for (var i = startYear; i <= endYear; i++) {
                        var option = document.createElement("option");
                        option.text = i;
                        option.selected = 2016;
                        selectList.appendChild(option);
                    }
                    countClick++;
                    if (countClick == 5){
                        document.getElementById("buttonAddYear").remove();
                        var alertCount = document.createElement("div");
                        /*var textAlertCount = ;*/
                        alertCount.appendChild(document.createTextNode("Vous avez atteint la limite de discours"));
                        alertCount.id = "alertCount";
                        myDiv.appendChild(alertCount);
                    }
                }
                myDiv.appendChild(document.createElement('br'));
                return false;
            }
            
        })
        
        // function displayLogin(){
        //     $('#form').css('visibility','visible').animate({opacity:0},1000);
        //     $('#form').css('display','none');
        //     $('#connection').css('visibility','visible').animate({opacity:1},1000);
        //     $('#connection').css('display','block');
        //     }
        function displayLogin(){
            $('#form').hide().fadeOut(100);
            $('#connection').show().fadeIn(100);
        }
        function displayMain(){
            $('#connection').hide().fadeOut(500);
            $('#form').show().fadeIn(500);
        }
        </script>
    </head>
    <body>
        <div class="header" id="header">
            <h1>Interface de gestion des Voeux présidentiels</h1>
        </div>
        <div class="formContent" id="formContent">
            <form id='form' role="form" action="generate.php"><h1>Générer un discours</h1><hr/>
            <div class="table">
                <div class="tc1">
                    <h2 style="text-align:center;">Choisissez un/des président(s)</h2><br/>
                    
                    <!--- Liste dynamique --->
                    
                        <div class="list">
                            <input type="radio" name="president" id="VGE"/><label for="VGE">&nbsp;Valéry Giscard d'Estaing</label><br/>
                            <input type="radio" name="president" id="FM"/><label for="FM">&nbsp;François Mitterrand</label><br/>
                            <input type="radio" name="president" id="JC"/><label for="JC">&nbsp;Jacques Chirac</label><br/>
                            <input type="radio" name="president" id="NS"/><label for="NS">&nbsp;Nicolas Sarkozy</label><br/>
                            <input type="radio" name="president" id="FH"/><label for="FH">&nbsp;François Hollande</label><br/>
                        </div>
                        
                </div>
                <div class="tcsp"></div>
                <div class="tc2" id="tc2">
                    <h2 style="text-align:center;">Choisissez l'année du discours</h2>
                    <div id="listYear"></div>
                    <button id="buttonAddYear" class="btn btn-default">Ajouter une année</button>
                </div>
            </div>
            <div class="btn btn-info" id="login" onclick="displayLogin()">Se connecter</div>
            <input type="submit" class="btn btn-success" id="submit" value="Générer"/>
            </form>
            <div id="connection">
                <h1>Login</h1><hr/>
                <form class="formLogin">
                    <label for="username">Nom d'utilisateur :</label><br/><input type="text" name="username" id="username"/>
                    <br/><br/>
                    <label for="password">Mot de passe :</label><br/><input type="password" name="password" id="password"/>
                    <br/><br/><br/>
                    <div class="btn btn-default" onclick="displayMain()">Revenir en arrière</div>
                    <input type="submit" class="btn btn-success" value="Connexion"/>
                </form>
                
            </div>
        </div>
    </body>
</html>