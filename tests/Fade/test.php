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
        <link rel="stylesheet" href="../../reset.css"/>
        <link href="../../bootstrap-3.3.6-dist/css/bootstrap.min.css" rel="stylesheet"/>
        <link rel="stylesheet" href="style.css"/>
        <!--- JS/Bootstrap/JQuery --->
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css"/>
        <!--- Script JQuery ---> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
        <script src="http://www.google.com/jsapi" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                return false;
            });
            function animation(){
                $('#div2').slideToggle(500);
            }
            function animation2(){
                return false;
            }
            function toggleOption(){
                $("p").toggle('slow');
            }
            
            
            function changeColor(){
                return false;
            }
        </script>
        <title>Test Fade In - Fade Out</title>
    </head>
    <body>
        <div id="div1" onclick="animation()">&nbsp;</div>
        <div id="div2" onclick="animation2()">&nbsp;</div>
        <button class="btn btn-default" id="btn2" onclick="toggleOption()">toggle</button>
        <p>Bonjour</p>
        <p style="display:none;">Bonsoir</p>
        
        <br><br><br>
        
        <input type="checkbox" class="" >
    </body>
</html>