<?php session_start(); ?>
<?php
    if(isset($_GET["error"])&&$_GET["error"]=="noinput") {
        $error="U heeft geen optie geselecteerd</br>
            Selecteer een optie:</br></br>";
    }
    elseif (isset($_GET["error"])&&$_GET["error"]=="wronginput") {
        $error="U heeft een ongeldige optie geselecteerd</br>
            Selecteer een geldige optie:</br></br>";
    }
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        
        <?php if(isset($error)) { ?>
        <div id="error">
            <?=$error?>
        </div>
        <?php } ?>
        
        
        <div id="form">
            <form action="redirect-sw.php" name="form" method="post">
                Waar loopt u tegen aan?
                </br>
                <input type="radio" name='probleem' value="start_niet">Het programma start niet op</input>
                </br>
                <input type="radio" name='probleem' value="loopt_vast">Het programma loopt vast</input>
                </br>
                <input type="radio" name='probleem' value="internet">Er is geen internet verbinding</input>
                </br>
                <input type="radio" name='probleem' value="anders">Anders</input>
                </br>
                <INPUT Type="button" VALUE="Back" onClick="history.go(-1);return true;">
                <input type="submit" name="submit" value="Submit" />
            </form>
        </div>
    </body>
</html>