<?php

try
{
	//Open database connection
	$con = mysql_connect("localhost","root","");
	mysql_select_db("mi-db", $con);
        
        if($_GET["action"] == "list")
	{
                
                if( empty($_POST["pesquisa"] ))
                {
                
                    $pesquisa = NULL;
                    
                    
                    //Get record count
                    $result = mysql_query("SELECT COUNT(*) AS RecordCount FROM unidade;");
                    $row = mysql_fetch_array($result);
                    $recordCount = $row['RecordCount'];

                    //Get records from database
                    $result = mysql_query("SELECT idUnidade, nome FROM unidade ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");

                } 
                else
                {
                    $select = mysql_real_escape_string($_POST['selectCampo']);
                     
                    $pesquisa = mysql_real_escape_string($_POST['pesquisa']);
                   
                    switch ($select)
                    {

                        case"": $result =  mysql_query("SELECT COUNT(*) AS RecordCount FROM unidade WHERE  idUnidade = '".$pesquisa."' or nome LIKE '%".$pesquisa."%';");
                                $row = mysql_fetch_array($result);
                                $recordCount = $row['RecordCount'];

                                //Get records from database
                                $result = mysql_query("SELECT idUnidade, nome FROM unidade WHERE idUnidade = '".$pesquisa."' or nome LIKE '%".$pesquisa."%' ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
                        break;

                        case"id": $result =  mysql_query("SELECT COUNT(*) AS RecordCount FROM unidade WHERE idUnidade = '".$pesquisa."';");
                                    $row = mysql_fetch_array($result);
                                    $recordCount = $row['RecordCount'];

                                    //Get records from database
                                    $result = mysql_query("SELECT idUnidade, nome FROM unidade WHERE idUnidade = '".$pesquisa."' ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
                        break;

                        case"nome": $result =  mysql_query("SELECT COUNT(*) AS RecordCount FROM unidade WHERE nome LIKE '%".$pesquisa."%';");
                                    $row = mysql_fetch_array($result);
                                    $recordCount = $row['RecordCount'];

                                    //Get records from database
                                    $result = mysql_query("SELECT idUnidade, nome FROM unidade WHERE nome LIKE '%".$pesquisa."%' ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
                        break;

                    }                    
                                   
                }              
            
                
                
            //Add all records to an array
            $rows = array();
            
            while($row = mysql_fetch_array($result))
            {
                $row['nome'] = utf8_encode( $row['nome'] );
                 
                $rows[] = $row;
            }
             //Return result to jTable
             $jTableResult = array();
             $jTableResult['Result'] = "OK";
             $jTableResult['TotalRecordCount'] = $recordCount;
             $jTableResult['Records'] = $rows;
             print json_encode($jTableResult);
	}
	//Creating a new record (createAction)
	else if($_GET["action"] == "create")
	{
		//Insert record into database
		$result = mysql_query("INSERT INTO unidade(nome) VALUES('" . utf8_decode($_POST["nome"]) . "');");
		
		//Get last inserted record (to return to jTable)
		$result = mysql_query("SELECT * FROM unidade WHERE idUnidade = LAST_INSERT_ID();");
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
		//Update record in database
		$result = mysql_query("UPDATE unidade SET nome = '" . utf8_decode($_POST["nome"]) . "' WHERE idUnidade = " . $_POST["idUnidade"] . ";");

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}
	//Deleting a record (deleteAction)
	else if($_GET["action"] == "delete")
	{
		//Delete from database
		$result = mysql_query("DELETE FROM unidade WHERE idUnidade = " . $_POST["idUnidade"] . ";");

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