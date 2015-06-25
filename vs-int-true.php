<?php
    session_start();
    
    if(!isset($_SESSION['ingelogd'])) {
        header("location:login.php");
    }
    require 'includes/connectdb.php';
    require_once 'includes/header.php';
?>
<?php  
    $needed_answers=[0,1,2,5];
    $locatie=$_SESSION["antwoorden"]["0"];
    $hw_id=$_SESSION["antwoorden"]["1"];
    $beschrijving=$_SESSION["antwoorden"]["2"];
    $sw_id="";
    $user_id=$_SESSION["id"];
    if ($_SESSION["antwoorden"]["5"]==true) $impact=1; else $impact=2;
    
   $query="INSERT INTO `de hondsrug`.`incidenten` "
               . "(`id`, `omschrijving`, `workaround`, `datum`, `starttijd`, `eindtijd`, `hw_id`, `sw_id`, `urgentie`, `impact`, `status`, `soort`, `toegekend_aan`, `melder`) "
           . "VALUES "
               . "(NULL, '".$beschrijving."', 'gfs', '".date("d-m-Y")."', '".date("H:i:s")."', NULL, '".$hw_id."', '".$sw_id."', '1', '".$impact."', '1', 'vragenscript', '1', '".$user_id."');";
    $result=  mysqli_query($db, $query);
    if (!$result) {
        echo $query.'<br />'.$result;
        die('Database query failed.');
    }
    
    $inc_id=  mysqli_insert_id($db);
    
    $query="SELECT id FROM gegeven_antwoord ORDER BY id DESC LIMIT 1";
    $result=  mysqli_query($db, $query);
    $ant_id=  mysqli_fetch_assoc($result)["id"];
    if (!$result) {
        echo $query;
        die('Database query failed.');
    }
    
    foreach ($needed_answers as $vrg_id) {
        $ant_id++;
        $query="INSERT INTO `de hondsrug`.`gegeven_antwoord` (id,vrg_id,inc_id,gegeven_antwoord) VALUES (".$ant_id.", '".$vrg_id."', '".$inc_id."', '".$_SESSION["antwoorden"][$vrg_id]."')";
        $result=  mysqli_query($db, $query);
        if (!$result) {
            echo $query;
            die('Database query failed.');
        }
    }
    
?>

<div class="titel2">
    <div class="container">
        <h1>Vragenscript</h1>
    </div>
</div>
<div class="lijst">
    <div class="container">
        Bedankt voor het melden van uw incident. Deze is door gegeven en zal snel weer vergeten worden. Tot ziens...
        </br>
        Incident netwerkkaart kapot
        </div>
    </div>
<?php 
    require_once 'includes/footer.html'; 
?>
