<?php
    session_start("usuario");
    
    include("conecta-mi-db.php");
    
    $bdMi = new MYSQL_MIDB();

    $ultimoMemorando = $bdMi->sql("SELECT MAX(idMemorando) FROM memorando");
    $numeroMemorando = $ultimoMemorando[0] + 1;
    
    $_SESSION["numeroMemorando"] = $numeroMemorando;
    
    header("Location:vCriar.php");
?>
