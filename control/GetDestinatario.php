<?php

    //Open database connection
    $con = mysql_connect("localhost","root","");
    mysql_select_db("mi-db", $con);

    
    $result = mysql_query("SELECT nome, titulo, cargo, idDestinatario as Value FROM destinatario;");
    
    //Add all records to an array
    $rows = array();
    

    while($row = mysql_fetch_array($result))
    {
        $row2 = array();
        $row2['DisplayText'] = utf8_encode( $row['titulo'] . ' '. $row['nome'] . ', ' . $row['cargo'] );
        $row2['Value'] = (int) $row['Value'];
        $rows[] = $row2;
    }
    
     //Return result to jTable
     $jTableResult = array();
     $jTableResult['Result'] = "OK";
     $jTableResult['Options'] = $rows;
    
     print json_encode($jTableResult);
?>
