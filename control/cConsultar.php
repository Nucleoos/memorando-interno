<?php

try
{
	//Open database connection
	$con = mysql_connect("localhost","root","");
	mysql_select_db("mi-db", $con);
        
        include_once '../model/Debug.php';
        

	//Getting records (listAction)
	if($_GET["action"] == "list")
	{
                
                if( empty($_POST["pesquisa"] ))
                {
                
                    $pesquisa = NULL;
                    
                    if( empty($_POST['selectEmitido']))
                    {
                        $result = mysql_query("SELECT COUNT(*) AS RecordCount FROM memorando;");
                        $row = mysql_fetch_array($result);
                        $recordCount = $row['RecordCount'];
                        
                        //Get records from database
                        $result = mysql_query("SELECT m.idMemorando, data, rem.nome as remetente, des.nome as destinatario, m.referencia, m.corpo, m.emitido FROM memorando m, usuario rem, usuario des WHERE rem.idUsuario = m.remetente AND des.idUsuario = m.destinatario ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");

                    }
                    else if( $_POST['selectEmitido'] == "sim")
                    {
                        $result = mysql_query("SELECT COUNT(*) AS RecordCount FROM memorando WHERE emitido = 1;");
                        $row = mysql_fetch_array($result);
                        $recordCount = $row['RecordCount'];

                        //Get records from database
                        $result = mysql_query("SELECT m.idMemorando, m.data, rem.nome as remetente, des.nome as destinatario, m.referencia, m.corpo, m.emitido FROM memorando m, usuario rem, usuario des WHERE rem.idUsuario = m.remetente AND des.idUsuario = m.destinatario AND emitido = 1 ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");

                    }
                    else if( $_POST['selectEmitido'] == "nao" )
                    {
                        $result = mysql_query("SELECT COUNT(*) AS RecordCount FROM memorando WHERE emitido = 0 ;");
                        $row = mysql_fetch_array($result);
                        $recordCount = $row['RecordCount'];

                        //Get records from database
                        $result = mysql_query("SELECT m.idMemorando, m.data, rem.nome as remetente, des.nome as destinatario, m.referencia, m.corpo, m.emitido FROM memorando m, usuario rem, usuario des WHERE rem.idUsuario = m.remetente AND des.idUsuario = m.destinatario AND emitido = 0 ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");

                    }
                   
                }
                else
                {
                    
                    $select = mysql_real_escape_string($_POST['selectCampo']);
                    $selectEmitido = mysql_real_escape_string($_POST['selectEmitido']);
                     
                    $pesquisa = mysql_real_escape_string($_POST['pesquisa']);                  
                        
                    if( $selectEmitido == "sim" )
                    {
              
                        switch ($select)
                        {

                            case"": $result =  mysql_query("SELECT COUNT(*) AS RecordCount FROM memorando m, usuario rem, usuario des WHERE m.remetente = rem.idUsuario AND m.destinatario = des.idUsuario AND  m.emitido = 1 AND ( m.data LIKE '%".$pesquisa."%' or rem.nome LIKE '%".$pesquisa."%'  or des.nome LIKE '%".$pesquisa."%' or m.referencia LIKE '%".$pesquisa."%' or m.corpo LIKE '%".$pesquisa."%');");
                                    $row = mysql_fetch_array($result);
                                    $recordCount = $row['RecordCount'];

                                    //Get records from database
                                    $result = mysql_query("SELECT m.idMemorando, m.data, rem.nome as remetente, des.nome as destinatario, m.referencia, m.corpo, m.emitido FROM memorando m, usuario rem, usuario des WHERE rem.idUsuario = m.remetente AND des.idUsuario = m.destinatario AND m.emitido = 1 AND ( m.data LIKE '%".$pesquisa."%' or rem.nome LIKE '%".$pesquisa."%'  or des.nome LIKE '%".$pesquisa."%' or m.referencia LIKE '%".$pesquisa."%' or m.corpo LIKE '%".$pesquisa."%') ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
                            break;

                            case"data": $result =  mysql_query("SELECT COUNT(*) AS RecordCount FROM memorando WHERE emitido = 1 AND data LIKE '%".$pesquisa."%';");
                                        $row = mysql_fetch_array($result);
                                        $recordCount = $row['RecordCount'];

                                        //Get records from database
                                        $result = mysql_query("SELECT m.idMemorando, m.data, rem.nome as remetente, des.nome as destinatario, m.referencia, m.corpo, m.emitido FROM memorando m, usuario rem, usuario des WHERE rem.idUsuario = m.remetente AND des.idUsuario = m.destinatario AND emitido = 1 AND m.data LIKE '%".$pesquisa."%' ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
                            break;

                            case"remetente": $result =  mysql_query("SELECT COUNT(*) AS RecordCount FROM memorando m, usuario rem WHERE m.remetente = rem.idUsuario AND m.emitido = 1 AND rem.nome LIKE '%".$pesquisa."%';");
                                        $row = mysql_fetch_array($result);
                                        $recordCount = $row['RecordCount'];

                                        //Get records from database
                                        $result = mysql_query("SELECT m.idMemorando, m.data, rem.nome as remetente, des.nome as destinatario, m.referencia, m.corpo, m.emitido FROM memorando m, usuario rem, usuario des WHERE rem.idUsuario = m.remetente AND des.idUsuario = m.destinatario AND emitido = 1 AND rem.nome LIKE '%".$pesquisa."%' ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
                            break;

                            case"destinatario": $result =  mysql_query("SELECT COUNT(*) AS RecordCount FROM memorando m, usuario des WHERE m.remetente = des.idUsuario AND m.emitido = 1 AND des.nome LIKE '%".$pesquisa."%';");
                            
                                $row = mysql_fetch_array($result);
                                        $recordCount = $row['RecordCount'];

                                        //Get records from database
                                        $result = mysql_query("SELECT m.idMemorando, m.data, rem.nome as remetente, des.nome as destinatario, m.referencia, m.corpo, m.emitido FROM memorando m, usuario rem, usuario des WHERE rem.idUsuario = m.remetente AND des.idUsuario = m.destinatario AND emitido = 1 AND des.nome LIKE '%".$pesquisa."%' ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
                            break;

                            case"referencia": $result =  mysql_query("SELECT COUNT(*) AS RecordCount FROM memorando WHERE emitido = 1 AND referencia LIKE '%".$pesquisa."%';");
                                        $row = mysql_fetch_array($result);
                                        $recordCount = $row['RecordCount'];

                                        //Get records from database
                                        $result = mysql_query("SELECT m.idMemorando, m.data, rem.nome as remetente, des.nome as destinatario, m.referencia, m.corpo, m.emitido FROM memorando m, usuario rem, usuario des WHERE rem.idUsuario = m.remetente AND des.idUsuario = m.destinatario AND emitido = 1 AND m.referencia LIKE '%".$pesquisa."%' ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
                            break;

                            case"corpo": $result =  mysql_query("SELECT COUNT(*) AS RecordCount FROM memorando WHERE emitido = 1 AND corpo LIKE '%".$pesquisa."%';");
                                        $row = mysql_fetch_array($result);
                                        $recordCount = $row['RecordCount'];

                                        //Get records from database
                                        $result = mysql_query("SELECT m.idMemorando, m.data, rem.nome as remetente, des.nome as destinatario, m.referencia, m.corpo, m.emitido FROM memorando m, usuario rem, usuario des WHERE rem.idUsuario = m.remetente AND des.idUsuario = m.destinatario AND emitido = 1 AND m.corpo LIKE '%".$pesquisa."%' ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
                        }
      
                    }
                    else if( $selectEmitido == "nao" )
                    {

                        switch ($select)
                        {

                            case"": $result =  mysql_query("SELECT COUNT(*) AS RecordCount FROM memorando m, usuario rem, usuario des WHERE m.remetente = rem.idUsuario AND m.destinatario = des.idUsuario AND  m.emitido = 0 AND ( m.data LIKE '%".$pesquisa."%' or rem.nome LIKE '%".$pesquisa."%'  or des.nome LIKE '%".$pesquisa."%' or m.referencia LIKE '%".$pesquisa."%' or m.corpo LIKE '%".$pesquisa."%');");
                                    $row = mysql_fetch_array($result);
                                    $recordCount = $row['RecordCount'];

                                    //Get records from database
                                    $result = mysql_query("SELECT m.idMemorando, m.data, rem.nome as remetente, des.nome as destinatario, m.referencia, m.corpo, m.emitido FROM memorando m, usuario rem, usuario des WHERE rem.idUsuario = m.remetente AND des.idUsuario = m.destinatario AND m.emitido = 0 AND ( m.data LIKE '%".$pesquisa."%' or rem.nome LIKE '%".$pesquisa."%'  or des.nome LIKE '%".$pesquisa."%' or m.referencia LIKE '%".$pesquisa."%' or m.corpo LIKE '%".$pesquisa."%') ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
                            break;

                            case"data": $result =  mysql_query("SELECT COUNT(*) AS RecordCount FROM memorando WHERE emitido = 0 AND data LIKE '%".$pesquisa."%';");
                                        $row = mysql_fetch_array($result);
                                        $recordCount = $row['RecordCount'];

                                        //Get records from database
                                        $result = mysql_query("SELECT m.idMemorando, m.data, rem.nome as remetente, des.nome as destinatario, m.referencia, m.corpo, m.emitido FROM memorando m, usuario rem, usuario des WHERE rem.idUsuario = m.remetente AND des.idUsuario = m.destinatario AND emitido = 0 AND m.data LIKE '%".$pesquisa."%' ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
                            break;

                            case"remetente": $result =  mysql_query("SELECT COUNT(*) AS RecordCount FROM memorando m, usuario rem WHERE m.remetente = rem.idUsuario AND m.emitido = 0 AND rem.nome LIKE '%".$pesquisa."%';");
                                        $row = mysql_fetch_array($result);
                                        $recordCount = $row['RecordCount'];

                                        //Get records from database
                                        $result = mysql_query("SELECT m.idMemorando, m.data, rem.nome as remetente, des.nome as destinatario, m.referencia, m.corpo, m.emitido FROM memorando m, usuario rem, usuario des WHERE rem.idUsuario = m.remetente AND des.idUsuario = m.destinatario AND emitido = 0 AND rem.nome LIKE '%".$pesquisa."%' ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
                                break;

                            case"destinatario": $result =  mysql_query("SELECT COUNT(*) AS RecordCount FROM memorando m, usuario des WHERE m.remetente = des.idUsuario AND m.emitido = 0 AND des.nome LIKE '%".$pesquisa."%';");
                                        $row = mysql_fetch_array($result);
                                        $recordCount = $row['RecordCount'];

                                        //Get records from database
                                        $result = mysql_query("SELECT m.idMemorando, m.data, rem.nome as remetente, des.nome as destinatario, m.referencia, m.corpo, m.emitido FROM memorando m, usuario rem, usuario des WHERE rem.idUsuario = m.remetente AND des.idUsuario = m.destinatario AND emitido = 0 AND des.nome LIKE '%".$pesquisa."%' ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
                            break;

                            case"referencia": $result =  mysql_query("SELECT COUNT(*) AS RecordCount FROM memorando WHERE emitido = 0 AND referencia LIKE '%".$pesquisa."%';");
                                        $row = mysql_fetch_array($result);
                                        $recordCount = $row['RecordCount'];

                                        //Get records from database
                                        $result = mysql_query("SELECT m.idMemorando, m.data, rem.nome as remetente, des.nome as destinatario, m.referencia, m.corpo, m.emitido FROM memorando m, usuario rem, usuario des WHERE rem.idUsuario = m.remetente AND des.idUsuario = m.destinatario AND emitido = 0 AND m.referencia LIKE '%".$pesquisa."%' ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
                            break;

                            case"corpo": $result =  mysql_query("SELECT COUNT(*) AS RecordCount FROM memorando WHERE emitido = 0 AND corpo LIKE '%".$pesquisa."%';");
                                        $row = mysql_fetch_array($result);
                                        $recordCount = $row['RecordCount'];

                                        //Get records from database
                                        $result = mysql_query("SELECT m.idMemorando, m.data, rem.nome as remetente, des.nome as destinatario, m.referencia, m.corpo, m.emitido FROM memorando m, usuario rem, usuario des WHERE rem.idUsuario = m.remetente AND des.idUsuario = m.destinatario AND emitido = 0 AND m.corpo LIKE '%".$pesquisa."%' ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
                        }
                        
                    }
                    else 
                    {
                        switch ($select)
                        {

                            case"": $result =  mysql_query("SELECT COUNT(*) AS RecordCount FROM memorando m, usuario rem, usuario des WHERE m.remetente = rem.idUsuario AND m.destinatario = des.idUsuario AND  ( m.data LIKE '%".$pesquisa."%' or rem.nome LIKE '%".$pesquisa."%'  or des.nome LIKE '%".$pesquisa."%' or m.referencia LIKE '%".$pesquisa."%' or m.corpo LIKE '%".$pesquisa."%');");
                                    $row = mysql_fetch_array($result);
                                    $recordCount = $row['RecordCount'];

                                    //Get records from database
                                    $result = mysql_query("SELECT m.idMemorando, m.data, rem.nome as remetente, des.nome as destinatario, m.referencia, m.corpo, m.emitido FROM memorando m, usuario rem, usuario des WHERE rem.idUsuario = m.remetente AND des.idUsuario = m.destinatario AND ( m.data LIKE '%".$pesquisa."%' or rem.nome LIKE '%".$pesquisa."%'  or des.nome LIKE '%".$pesquisa."%' or m.referencia LIKE '%".$pesquisa."%' or m.corpo LIKE '%".$pesquisa."%') ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
                            break;

                            case"data": $result =  mysql_query("SELECT COUNT(*) AS RecordCount FROM memorando WHERE data LIKE '%".$pesquisa."%';");
                                        $row = mysql_fetch_array($result);
                                        $recordCount = $row['RecordCount'];

                                        //Get records from database
                                        $result = mysql_query("SELECT m.idMemorando, m.data, rem.nome as remetente, des.nome as destinatario, m.referencia, m.corpo, m.emitido FROM memorando m, usuario rem, usuario des WHERE rem.idUsuario = m.remetente AND des.idUsuario = m.destinatario  AND m.data LIKE '%".$pesquisa."%' ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
                            break;

                            case"remetente": $result =  mysql_query("SELECT COUNT(*) AS RecordCount FROM memorando m, usuario rem WHERE m.remetente = rem.idUsuario AND rem.nome LIKE '%".$pesquisa."%';");
                                        $row = mysql_fetch_array($result);
                                        $recordCount = $row['RecordCount'];

                                        //Get records from database
                                        $result = mysql_query("SELECT m.idMemorando, m.data, rem.nome as remetente, des.nome as destinatario, m.referencia, m.corpo, m.emitido FROM memorando m, usuario rem, usuario des WHERE rem.idUsuario = m.remetente AND des.idUsuario = m.destinatario  AND rem.nome LIKE '%".$pesquisa."%' ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
                                break;

                            case"destinatario": $result =  mysql_query("SELECT COUNT(*) AS RecordCount FROM memorando m, usuario des WHERE m.remetente = des.idUsuario AND des.nome LIKE '%".$pesquisa."%';");
                                        $row = mysql_fetch_array($result);
                                        $recordCount = $row['RecordCount'];

                                        //Get records from database
                                        $result = mysql_query("SELECT m.idMemorando, m.data, rem.nome as remetente, des.nome as destinatario, m.referencia, m.corpo, m.emitido FROM memorando m, usuario rem, usuario des WHERE rem.idUsuario = m.remetente AND des.idUsuario = m.destinatario  AND des.nome LIKE '%".$pesquisa."%' ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
                            break;

                            case"referencia": $result =  mysql_query("SELECT COUNT(*) AS RecordCount FROM memorando WHERE referencia LIKE '%".$pesquisa."%';");
                                        $row = mysql_fetch_array($result);
                                        $recordCount = $row['RecordCount'];

                                        //Get records from database
                                        $result = mysql_query("SELECT m.idMemorando, m.data, rem.nome as remetente, des.nome as destinatario, m.referencia, m.corpo, m.emitido FROM memorando m, usuario rem, usuario des WHERE rem.idUsuario = m.remetente AND des.idUsuario = m.destinatario  AND m.referencia LIKE '%".$pesquisa."%' ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
                            break;

                            case"corpo": $result =  mysql_query("SELECT COUNT(*) AS RecordCount FROM memorando WHERE corpo LIKE '%".$pesquisa."%';");
                                        $row = mysql_fetch_array($result);
                                        $recordCount = $row['RecordCount'];

                                        //Get records from database
                                        $result = mysql_query("SELECT m.idMemorando, m.data, rem.nome as remetente, des.nome as destinatario, m.referencia, m.corpo, m.emitido FROM memorando m, usuario rem, usuario des WHERE rem.idUsuario = m.remetente AND des.idUsuario = m.destinatario AND m.corpo LIKE '%".$pesquisa."%' ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
                        }                    
                    }                   
                }              
            
                
                
            //Add all records to an array
            $rows = array();
            
            while($row = mysql_fetch_array($result))
            {
                
                $rows[] = $row;
            }
             //Return result to jTable
             $jTableResult = array();
             $jTableResult['Result'] = "OK";
             $jTableResult['TotalRecordCount'] = $recordCount;
             $jTableResult['Records'] = $rows;
             print json_encode($jTableResult);
	}
	
	//Deleting a record (deleteAction)
	else if($_GET["action"] == "delete")
	{
		//Delete from database
		$result = mysql_query("DELETE FROM memorando WHERE idMemorando = " . $_POST["idMemorando"] . ";");

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}

	//Close database connection
	mysql_close($con);

}
catch(Exception $ex)
{
    //Return error message
	$jTableResult = array();
	$jTableResult['Result'] = "ERROR";
	$jTableResult['Message'] = $ex->getMessage();
	print json_encode($jTableResult);
}
	
?>