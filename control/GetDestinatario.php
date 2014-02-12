<?php

    //Open database connection
    $con = mysql_connect("localhost","root","");
    mysql_select_db("mi-db", $con);

    
    $result = mysql_query("SELECT nome as DisplayText, idDestinatario as Value FROM destinatario;");
    
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
