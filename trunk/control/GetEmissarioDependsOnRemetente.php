<?php

    //Open database connection
    $con = mysql_connect("localhost","root","");
    mysql_select_db("mi-db", $con);
    include_once '../model/Debug.php';
    
    if( isset($_GET['remetente']) )
    {  
        $result = mysql_query("SELECT DISTINCT u.nome as DisplayText, u.idUnidade as Value FROM usuario des, usuario_has_unidade uhu, unidade u WHERE des.idUsuario = uhu.idUsuario AND uhu.idUnidade = u.idUnidade  AND des.idUsuario = '" . $_GET['remetente'] . "';");

    } 
    else
    {
        $result = mysql_query("SELECT nome as DisplayText, idUnidade as Value FROM unidade");
    }
    
    //Add all records to an array
    $rows = array();

    while($row = mysql_fetch_array($result))
    {

        $row['DisplayText'] = utf8_encode( $row['DisplayText'] );
        $row['Value'] = (int) $row['Value'];
        $rows[] = $row;
    }
     //Return result to jTable
     $jTableResult = array();
     $jTableResult['Result'] = "OK";
     $jTableResult['Options'] = $rows;
     print json_encode($jTableResult);
    
    
?>

