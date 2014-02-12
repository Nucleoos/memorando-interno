<?php

try
{
	//Open database connection
	$con = mysql_connect("localhost","root","");
	mysql_select_db("mi-db", $con);
        

        
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
                        $result = mysql_query("SELECT idMemorando, data, remetente, destinatario, emissario, referencia, corpo, emitido FROM memorando ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");

                    }
                    else if( $_POST['selectEmitido'] == "sim")
                    {
                        $result = mysql_query("SELECT COUNT(*) AS RecordCount FROM memorando WHERE emitido = 1;");
                        $row = mysql_fetch_array($result);
                        $recordCount = $row['RecordCount'];

                        //Get records from database
                        $result = mysql_query("SELECT idMemorando, data, remetente, destinatario, emissario, referencia, corpo, emitido FROM memorando WHERE emitido = 1 ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");

                    }
                    else if( $_POST['selectEmitido'] == "nao" )
                    {
                        $result = mysql_query("SELECT COUNT(*) AS RecordCount FROM memorando WHERE emitido = 0 ;");
                        $row = mysql_fetch_array($result);
                        $recordCount = $row['RecordCount'];

                        //Get records from database
                        $result = mysql_query("SELECT idMemorando, data, remetente, destinatario, referencia, emissario, corpo, emitido FROM memorando WHERE emitido = 0 ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");

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

                            case"": $result =  mysql_query("SELECT COUNT(*) AS RecordCount FROM memorando WHERE  emitido = 1 AND ( idMemorando LIKE '%".$pesquisa."%' or data LIKE '%".$pesquisa."%' or remetente LIKE '%".$pesquisa."%'  or destinatario LIKE '%".$pesquisa."%' or emissario LIKE '%".$pesquisa."%' or referencia LIKE '%".$pesquisa."%' or corpo LIKE '%".$pesquisa."%');");
                                    $row = mysql_fetch_array($result);
                                    $recordCount = $row['RecordCount'];

                                    //Get records from database
                                    $result = mysql_query("SELECT idMemorando, data, remetente, destinatario, emissario, referencia, corpo, emitido FROM memorando WHERE emitido = 1 AND ( idMemorando LIKE '%".$pesquisa."%' or data LIKE '%".$pesquisa."%' or remetente LIKE '%".$pesquisa."%' or destinatario LIKE '%".$pesquisa."%' or emissario LIKE '%".$pesquisa."%' or referencia LIKE '%".$pesquisa."%' or corpo LIKE '%".$pesquisa."%' ) ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
                            break;
                            
                            case"id": $result =  mysql_query("SELECT COUNT(*) AS RecordCount FROM memorando WHERE emitido = 1 AND idMemorando LIKE '%".$pesquisa."%';");
                                        $row = mysql_fetch_array($result);
                                        $recordCount = $row['RecordCount'];

                                        //Get records from database
                                        $result = mysql_query("SELECT idMemorando, data, remetente, destinatario, emissario, referencia, corpo, emitido FROM memorando WHERE emitido = 1 AND idMemorando LIKE '%".$pesquisa."%' ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
                            break;
                        
                            case"data": $result =  mysql_query("SELECT COUNT(*) AS RecordCount FROM memorando WHERE emitido = 1 AND data LIKE '%".$pesquisa."%';");
                                        $row = mysql_fetch_array($result);
                                        $recordCount = $row['RecordCount'];

                                        //Get records from database
                                        $result = mysql_query("SELECT idMemorando, data, remetente, destinatario, emissario, referencia, corpo, emitido FROM memorando WHERE emitido = 1 AND data LIKE '%".$pesquisa."%' ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
                            break;

                            case"remetente": $result =  mysql_query("SELECT COUNT(*) AS RecordCount FROM memorando WHERE emitido = 1 AND remetente LIKE '%".$pesquisa."%';");
                                        $row = mysql_fetch_array($result);
                                        $recordCount = $row['RecordCount'];

                                        //Get records from database
                                        $result = mysql_query("SELECT idMemorando, data, remetente, destinatario, emissario, referencia, corpo, emitido FROM memorando WHERE emitido = 1 AND remetente LIKE '%".$pesquisa."%' ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
                                break;

                            case"destinatario": $result =  mysql_query("SELECT COUNT(*) AS RecordCount FROM memorando WHERE emitido = 1 AND destinatario LIKE '%".$pesquisa."%';");
                                        $row = mysql_fetch_array($result);
                                        $recordCount = $row['RecordCount'];

                                        //Get records from database
                                        $result = mysql_query("SELECT idMemorando, data, remetente, destinatario, emissario, referencia, corpo, emitido FROM memorando WHERE emitido = 1 AND destinatario LIKE '%".$pesquisa."%' ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
                            break;
                            
                            case"emissario": $result =  mysql_query("SELECT COUNT(*) AS RecordCount FROM memorando WHERE emitido = 1 AND emissario LIKE '%".$pesquisa."%';");
                                        $row = mysql_fetch_array($result);
                                        $recordCount = $row['RecordCount'];

                                        //Get records from database
                                        $result = mysql_query("SELECT idMemorando, data, remetente, destinatario, emissario, referencia, corpo, emitido FROM memorando WHERE emitido = 1 AND emissario LIKE '%".$pesquisa."%' ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
                            break;
                        
                            case"referencia": $result =  mysql_query("SELECT COUNT(*) AS RecordCount FROM memorando WHERE emitido = 1 AND referencia LIKE '%".$pesquisa."%';");
                                        $row = mysql_fetch_array($result);
                                        $recordCount = $row['RecordCount'];

                                        //Get records from database
                                        $result = mysql_query("SELECT idMemorando, data, remetente, destinatario, emissario, referencia, corpo, emitido FROM memorando WHERE emitido = 1 AND referencia LIKE '%".$pesquisa."%' ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
                            break;

                            case"corpo": $result =  mysql_query("SELECT COUNT(*) AS RecordCount FROM memorando WHERE emitido = 1 AND corpo LIKE '%".$pesquisa."%';");
                                        $row = mysql_fetch_array($result);
                                        $recordCount = $row['RecordCount'];

                                        //Get records from database
                                        $result = mysql_query("SELECT idMemorando, data, remetente, destinatario, emissario, referencia, corpo, emitido FROM memorando WHERE emitido = 1 AND corpo LIKE '%".$pesquisa."%' ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
                        }
      
                    }
                    else if( $selectEmitido == "nao" )
                    {

                        switch ($select)
                        {

                            case"": $result =  mysql_query("SELECT COUNT(*) AS RecordCount FROM memorando WHERE  emitido = 0 AND ( idMemorando LIKE '%".$pesquisa."%' or data LIKE '%".$pesquisa."%' or remetente LIKE '%".$pesquisa."%'  or destinatario LIKE '%".$pesquisa."%' or emissario LIKE '%".$pesquisa."%' or referencia LIKE '%".$pesquisa."%' or corpo LIKE '%".$pesquisa."%');");
                                    $row = mysql_fetch_array($result);
                                    $recordCount = $row['RecordCount'];

                                    //Get records from database
                                    $result = mysql_query("SELECT idMemorando, data, remetente, destinatario, emissario, referencia, corpo, emitido FROM memorando WHERE emitido = 0 AND ( idMemorando LIKE '%".$pesquisa."%' or data LIKE '%".$pesquisa."%' or remetente LIKE '%".$pesquisa."%' or destinatario LIKE '%".$pesquisa."%' or emissario LIKE '%".$pesquisa."%' or referencia LIKE '%".$pesquisa."%' or corpo LIKE '%".$pesquisa."%' ) ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
                            break;
                            
                            case"id": $result =  mysql_query("SELECT COUNT(*) AS RecordCount FROM memorando WHERE emitido = 0 AND idMemorando LIKE '%".$pesquisa."%';");
                                        $row = mysql_fetch_array($result);
                                        $recordCount = $row['RecordCount'];

                                        //Get records from database
                                        $result = mysql_query("SELECT idMemorando, data, remetente, destinatario, emissario, referencia, corpo, emitido FROM memorando WHERE emitido = 0 AND idMemorando LIKE '%".$pesquisa."%' ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
                            break;
                        
                            case"data": $result =  mysql_query("SELECT COUNT(*) AS RecordCount FROM memorando WHERE emitido = 0 AND data LIKE '%".$pesquisa."%';");
                                        $row = mysql_fetch_array($result);
                                        $recordCount = $row['RecordCount'];

                                        //Get records from database
                                        $result = mysql_query("SELECT idMemorando, data, remetente, destinatario, emissario, referencia, corpo, emitido FROM memorando WHERE emitido = 0 AND data LIKE '%".$pesquisa."%' ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
                            break;

                            case"remetente": $result =  mysql_query("SELECT COUNT(*) AS RecordCount FROM memorando WHERE emitido = 0 AND remetente LIKE '%".$pesquisa."%';");
                                        $row = mysql_fetch_array($result);
                                        $recordCount = $row['RecordCount'];

                                        //Get records from database
                                        $result = mysql_query("SELECT idMemorando, data, remetente, destinatario, emissario, referencia, corpo, emitido FROM memorando WHERE emitido = 0 AND remetente LIKE '%".$pesquisa."%' ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
                                break;

                            case"destinatario": $result =  mysql_query("SELECT COUNT(*) AS RecordCount FROM memorando WHERE emitido = 0 AND destinatario LIKE '%".$pesquisa."%';");
                                        $row = mysql_fetch_array($result);
                                        $recordCount = $row['RecordCount'];

                                        //Get records from database
                                        $result = mysql_query("SELECT idMemorando, data, remetente, destinatario, emissario, referencia, corpo, emitido FROM memorando WHERE emitido = 0 AND destinatario LIKE '%".$pesquisa."%' ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
                            break;
                            
                            case"emissario": $result =  mysql_query("SELECT COUNT(*) AS RecordCount FROM memorando WHERE emitido = 0 AND emissario LIKE '%".$pesquisa."%';");
                                        $row = mysql_fetch_array($result);
                                        $recordCount = $row['RecordCount'];

                                        //Get records from database
                                        $result = mysql_query("SELECT idMemorando, data, remetente, destinatario, emissario, referencia, corpo, emitido FROM memorando WHERE emitido = 0 AND emissario LIKE '%".$pesquisa."%' ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
                            break;
                        
                            case"referencia": $result =  mysql_query("SELECT COUNT(*) AS RecordCount FROM memorando WHERE emitido = 0 AND referencia LIKE '%".$pesquisa."%';");
                                        $row = mysql_fetch_array($result);
                                        $recordCount = $row['RecordCount'];

                                        //Get records from database
                                        $result = mysql_query("SELECT idMemorando, data, remetente, destinatario, emissario, referencia, corpo, emitido FROM memorando WHERE emitido = 0 AND referencia LIKE '%".$pesquisa."%' ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
                            break;

                            case"corpo": $result =  mysql_query("SELECT COUNT(*) AS RecordCount FROM memorando WHERE emitido = 0 AND corpo LIKE '%".$pesquisa."%';");
                                        $row = mysql_fetch_array($result);
                                        $recordCount = $row['RecordCount'];

                                        //Get records from database
                                        $result = mysql_query("SELECT idMemorando, data, remetente, destinatario, emissario, referencia, corpo, emitido FROM memorando WHERE emitido = 0 AND corpo LIKE '%".$pesquisa."%' ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
                        }
                        
                    }
                    else 
                    {
                        switch ($select)
                        {

                            case"": $result =  mysql_query("SELECT COUNT(*) AS RecordCount FROM memorando WHERE  idMemorando LIKE '%".$pesquisa."%' or data LIKE '%".$pesquisa."%' or remetente LIKE '%".$pesquisa."%'  or destinatario LIKE '%".$pesquisa."%' or emissario LIKE '%".$pesquisa."%' or referencia LIKE '%".$pesquisa."%' or corpo LIKE '%".$pesquisa."%';");
                                    $row = mysql_fetch_array($result);
                                    $recordCount = $row['RecordCount'];

                                    //Get records from database
                                    $result = mysql_query("SELECT idMemorando, data, remetente, destinatario, emissario, referencia, corpo, emitido FROM memorando WHERE idMemorando LIKE '%".$pesquisa."%' or data LIKE '%".$pesquisa."%' or remetente LIKE '%".$pesquisa."%' or destinatario LIKE '%".$pesquisa."%' or emissario LIKE '%".$pesquisa."%' or referencia LIKE '%".$pesquisa."%' or corpo LIKE '%".$pesquisa."%' ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
                            break;
                            
                            case"id": $result =  mysql_query("SELECT COUNT(*) AS RecordCount FROM memorando WHERE idMemorando LIKE '%".$pesquisa."%';");
                                        $row = mysql_fetch_array($result);
                                        $recordCount = $row['RecordCount'];

                                        //Get records from database
                                        $result = mysql_query("SELECT idMemorando, data, remetente, destinatario, emissario, referencia, corpo, emitido FROM memorando WHERE idMemorando LIKE '%".$pesquisa."%' ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
                            break;
                        
                            case"data": $result =  mysql_query("SELECT COUNT(*) AS RecordCount FROM memorando WHERE data LIKE '%".$pesquisa."%';");
                                        $row = mysql_fetch_array($result);
                                        $recordCount = $row['RecordCount'];

                                        //Get records from database
                                        $result = mysql_query("SELECT idMemorando, data, remetente, destinatario, emissario, referencia, corpo, emitido FROM memorando WHERE data LIKE '%".$pesquisa."%' ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
                            break;

                            case"remetente": $result =  mysql_query("SELECT COUNT(*) AS RecordCount FROM memorando WHERE remetente LIKE '%".$pesquisa."%';");
                                        $row = mysql_fetch_array($result);
                                        $recordCount = $row['RecordCount'];

                                        //Get records from database
                                        $result = mysql_query("SELECT idMemorando, data, remetente, destinatario, emissario, referencia, corpo, emitido FROM memorando WHERE  remetente LIKE '%".$pesquisa."%' ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
                                break;

                            case"destinatario": $result =  mysql_query("SELECT COUNT(*) AS RecordCount FROM memorando WHERE destinatario LIKE '%".$pesquisa."%';");
                                        $row = mysql_fetch_array($result);
                                        $recordCount = $row['RecordCount'];

                                        //Get records from database
                                        $result = mysql_query("SELECT idMemorando, data, remetente, destinatario, emissario, referencia, corpo, emitido FROM memorando WHERE destinatario LIKE '%".$pesquisa."%' ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
                            break;
                        
                            case"emissario": $result =  mysql_query("SELECT COUNT(*) AS RecordCount FROM memorando WHERE emissario LIKE '%".$pesquisa."%';");
                                        $row = mysql_fetch_array($result);
                                        $recordCount = $row['RecordCount'];

                                        //Get records from database
                                        $result = mysql_query("SELECT idMemorando, data, remetente, destinatario, emissario, referencia, corpo, emitido FROM memorando WHERE emissario LIKE '%".$pesquisa."%' ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
                            break;

                            case"referencia": $result =  mysql_query("SELECT COUNT(*) AS RecordCount FROM memorando WHERE referencia LIKE '%".$pesquisa."%';");
                                        $row = mysql_fetch_array($result);
                                        $recordCount = $row['RecordCount'];

                                        //Get records from database
                                        $result = mysql_query("SELECT idMemorando, data, remetente, destinatario, emissario, referencia, corpo, emitido FROM memorando WHERE referencia LIKE '%".$pesquisa."%' ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
                            break;

                            case"corpo": $result =  mysql_query("SELECT COUNT(*) AS RecordCount FROM memorando WHERE corpo LIKE '%".$pesquisa."%';");
                                        $row = mysql_fetch_array($result);
                                        $recordCount = $row['RecordCount'];

                                        //Get records from database
                                        $result = mysql_query("SELECT idMemorando, data, remetente, destinatario, emissario, referencia, corpo, emitido FROM memorando WHERE corpo LIKE '%".$pesquisa."%' ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
                        }                    
                    }                   
                }              
            
                
                
            //Add all records to an array
            $rows = array();
            
            while($row = mysql_fetch_array($result))
            {
                $row['destinatario'] = utf8_encode( $row['destinatario'] );
                $row['emissario'] = utf8_encode( $row['emissario'] );
                $row['referencia'] = utf8_encode( $row['referencia'] );
                $row['corpo'] = utf8_encode( $row['corpo'] );
                
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
        
        //Creating a new record (createAction)
	else if($_GET["action"] == "create")
	{
		//Insert record into database
		$result = mysql_query("INSERT INTO memorando(data, remetente, destinatario, referencia, corpo, emitido, emissario ) VALUES('" . $_POST["data"] . "','" . $_POST["remetente"] . "','" . $_POST["destinatario"] ."','" . $_POST["referencia"] ."','" . $_POST["corpo"] ."','" . $_POST["emitido"] ."','" . $_POST["emissario"] . ");");
		
		//Get last inserted record (to return to jTable)
		$result = mysql_query("SELECT * FROM memorando WHERE idMemorando = LAST_INSERT_ID();");
		$row = mysql_fetch_array($result);

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['Record'] = $row;
		print json_encode($jTableResult);
	}
	//Updating a record (updateAction)
	else if($_GET["action"] == "update")
	{
		//Update record in
          
		$result = mysql_query("UPDATE memorando SET data = '" . $_POST["data"] . "', remetente = '" . $_POST["emissario"] . "', referencia = '" . $_POST["referencia"] . "', corpo = '" . $_POST["corpo"] . "', emitido = " . $_POST["emitido"] . " WHERE idMemorando = " . $_POST["idMemorando"] . ";");

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
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