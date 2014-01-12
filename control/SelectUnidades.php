<?php

    include("../model/conecta-mi-db.php");

    $idUnidade = mysql_real_escape_string($_POST['idUnidade']);

    $bdMi = new MYSQL_MIDB();
    $usuarios = array();
    $result = $bdMi->sql("SELECT DISTINCT usuario.idUsuario as id, usuario.nome as nome
                                    FROM usuario, usuario_has_unidade, unidade 
                                    WHERE usuario.idUsuario = usuario_has_unidade.idUsuario AND
                                            usuario_has_unidade.idUnidade = unidade.idUnidade AND
                                            $idUnidade = unidade.idUnidade");

    while( $row = mysql_fetch_array($result) )
    {
        $usuarios[] = $row;
        
    }

    echo json_encode($usuarios);

?>
