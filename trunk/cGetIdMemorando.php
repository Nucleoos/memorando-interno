<?php
    session_start("usuario");
    
    include("conecta-mi-db.php");
    include("funcoes.php");
    
    $bdMi = new MYSQL_MIDB();

    $selectMemorando = $bdMi->sql("SELECT MAX(idMemorando) FROM memorando");
    $ultimoMemorando = mysql_fetch_array($selectMemorando);
    
    $_SESSION['numeroMemorando'] = $ultimoMemorando[0] + 1;
    
    header("Location:vCriar.php");
?>
