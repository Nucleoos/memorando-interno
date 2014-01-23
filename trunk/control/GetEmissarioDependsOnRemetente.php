<?php

    //Open database connection
    $con = mysql_connect("localhost","root","");
    mysql_select_db("mi-db", $con);
    include_once '../model/Debug.php';
    
    if( isset($_POST['remetente']) )
    {
        $result = mysql_query("SELECT DISTINCT u.nome as DisplayText, u.idUnidade as Value FROM unidade u, memorando m WHERE u.idUnidade = m.emissario AND m.remetente = " . $_POST['remetente'] . ";");

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

