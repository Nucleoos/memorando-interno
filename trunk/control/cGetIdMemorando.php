<?php
    
    session_start("usuario");
    
    include("../model/conecta-mi-db.php");
    include("../model/funcoes.php");
    
    $bdMi = new MYSQL_MIDB();

    $selectMemorando = $bdMi->sql("SELECT MAX(idMemorando) FROM memorando");
    
    $_SESSION['numeroMemorando'] = mysql_result($selectMemorando, 0) + 1;
    
    header("Location:../view/vCriar.php");
            
?>
