<?php
    session_start();
    
    require_once 'includes/header.html';
    require_once 'includes/connectdb.php';
    
    $ids = implode('" OR hw_id = "', $_SESSION['ids']);
    
    $query_all = "SELECT * FROM hardware WHERE hw_id = \"$ids\"";
    $result_all = mysqli_query($db, $query_all);
    
    $qry_dropdown_connected_hw = "SELECT hw_id FROM hardware";
    $dropdown_connected_hw = mysqli_query($db, $qry_dropdown_connected_hw);
    
    while($connected = mysqli_fetch_assoc($dropdown_connected_hw)):
        $array_connected[] .= $connected['hw_id'];
    endwhile;
    
    if(isset($_POST['opslaan'])):
        foreach ($_SESSION['ids'] as $id):
            $update = "UPDATE hardware SET soort_hw='".$_POST[$id][1]."', "
            . "locatie='".$_POST[$id][2]."', "
            . "OS='".$_POST[$id][3]."', "
            . "merk='".$_POST[$id][4]."', "
            . "leverancier='".$_POST[$id][5]."', "
            . "aanschafjaar='".$_POST[$id][6]."', "
            . "connected_hw='".$_POST[$id][7]."' "
            . "WHERE hw_id='".$id."'";
            mysqli_query($db, $update);
            echo $update;
            echo "<br/>";
        endforeach;
        empty($SESSION['ids']);
        header('Location: hardware.php');
        exit;
    endif;
    
    if(isset($_POST['overzicht'])):
        header('Location: hardware.php');
        exit;
    endif;
?>
<div class="titel2">
    <div class="container">
        <h1>Hardware bewerken</h1>
    </div>
</div>
<div class="lijst">
    <div class="container-fluid">
        <div class="col-md-10">
            <form action="" method="POST">
                <table>
                    <tr>
                        <td><b>Hardware ID</b></td>
                        <td><b>Soort Hardware</b></td>
                        <td><b>Locatie</b></td>
                        <td><b>OS</b></td>
                        <td><b>Merk</b></td>
                        <td><b>Leverancier</b></td>
                        <td><b>Aanschafjaar</b></td>
                        <td><b>Verbonden met</b></td>
                    </tr>
                    <?php
                        while($row = mysqli_fetch_assoc($result_all)):
                    ?>
                        <tr>
                    <?php
                            foreach($row as $k => $v):
                                if($k == 'hw_id') :
                                    echo "<td><input type=\"text\" readonly=\"readonly\" name=\"".$row["hw_id"]."[]\" value=\"$v\"/></td>\n";
                                elseif ($k == 'aanschafjaar'):
                                    echo "<td><input type=\"number\" name=\"aanschafjaar\" value=\"$v\"/></td>";
                                elseif($k == 'connected_hw') :
                                    echo"<td><select name=\"".$row["hw_id"]."[]\">";
                                    foreach($array_connected as $key => $value) :
                                        if($value == $row['hw_id']) :
                                            echo "<option value=\"".$value."\" selected>".$value."</option>\n";
                                        else:
                                            echo "<option value=\"".$value."\">".$value."</option>\n";
                                        endif;
                                    endforeach;
                                elseif ($k == 'status') :
                                    // doe maar niks
                                else:
                                    echo "<td><input type=\"text\" name=\"".$row["hw_id"]."[]\" value=\"$v\"/></td>\n";
                                endif;
                            endforeach;
                    ?>
                        </tr>
                    <?php
                        endwhile;
                    ?>

                </table>
        </div>
        <div class='col-md-2'>
            <div class='submenu'>
                <input type="submit" name="opslaan" value="Opslaan" class="btn btn-primary"/>
                <input type="submit" name="overzicht" value="Terug naar overzicht" class="btn btn-default"/>
            </div>
            </form>
        </div>
    </div>
</div>
<?php 
    require_once 'includes/header.html'; 
?>