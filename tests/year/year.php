<?php
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html" charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta http-equiv="content-language" content="fr-FR"/>
        <title>Test année</title>
        <script type="text/javascript"></script>
    </head>
    <body>
        <form>
            <input type="radio" name="Chirac"/>
            <select name="mySelect" id="mySelect">
                <?php
                for ($i=0; $i<=100; $i++){
                    if ($i==59){
                        echo "<option value='value' selected>",$i,"</option>";
                    }
                    else{
                        echo "<option value='value'>",$i,"</option>";
                    }
                }
                ?>
            </select>
            <select>
                <option value="1">1</option>
                <option value="2" selected="selected">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
            </select>
            <input type="submit" value="Submit"/>
        </form>
    </body>
</html>