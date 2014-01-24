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
                    
                    if( empty($_POST['selectPermissao']))
                    {
                        //Get record count
                        $result = mysql_query("SELECT COUNT(*) AS RecordCount FROM usuario;");
                        $row = mysql_fetch_array($result);
                        $recordCount = $row['RecordCount'];

                        //Get records from database
                        $result = mysql_query("SELECT idUsuario, nome, titulo, cargo, portaria, emailInstitucional as email, permissaoSistema as permissao FROM usuario ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");

                    }
                    else if( $_POST['selectPermissao'] == "usuario")
                    {
                        $result = mysql_query("SELECT COUNT(*) AS RecordCount FROM usuario WHERE permissaoSistema = 'user';");
                        $row = mysql_fetch_array($result);
                        $recordCount = $row['RecordCount'];

                        //Get records from database
                        $result = mysql_query("SELECT idUsuario, nome, titulo, cargo, portaria, emailInstitucional as email, permissaoSistema as permissao FROM usuario WHERE permissaoSistema = 'user' ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");

                    }
                    else if( $_POST['selectPermissao'] == "administrador" )
                    {
                        $result = mysql_query("SELECT COUNT(*) AS RecordCount FROM usuario WHERE permissaoSistema = 'admin';");
                        $row = mysql_fetch_array($result);
                        $recordCount = $row['RecordCount'];

                        //Get records from database
                        $result = mysql_query("SELECT idUsuario, nome, titulo, cargo, portaria, emailInstitucional as email, permissaoSistema as permissao FROM usuario WHERE permissaoSistema = 'admin' ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");

                    }
                   
                }
                else
                {
                    
                    $select = mysql_real_escape_string($_POST['selectCampo']);
                    $selectPermissao = mysql_real_escape_string($_POST['selectPermissao']);
                     
                    $pesquisa = mysql_real_escape_string($_POST['pesquisa']);                  
                        
                    if( $selectPermissao == "usuario" )
                    {
              
                        switch ($select)
                        {

                            case"": $result =  mysql_query("SELECT COUNT(*) AS RecordCount FROM usuario WHERE  permissaoSistema = 'user' AND ( idUsuario = '".$pesquisa."' or nome LIKE '%".$pesquisa."%' or titulo LIKE '%".$pesquisa."%'  or cargo LIKE '%".$pesquisa."%' or portaria LIKE '%".$pesquisa."%' or emailInstitucional LIKE '%".$pesquisa."%');");
                                    $row = mysql_fetch_array($result);
                                    $recordCount = $row['RecordCount'];

                                    //Get records from database
                                    $result = mysql_query("SELECT idUsuario, nome, titulo, cargo, portaria, emailInstitucional as email, permissaoSistema as permissao FROM usuario WHERE permissaoSistema = 'user' AND ( idUsuario = '".$pesquisa."' or nome LIKE '%".$pesquisa."%' or titulo LIKE '%".$pesquisa."%'  or cargo LIKE '%".$pesquisa."%' or portaria LIKE '%".$pesquisa."%' or emailInstitucional LIKE '%".$pesquisa."%') ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
                            break;
                            
                            case"id": $result =  mysql_query("SELECT COUNT(*) AS RecordCount FROM usuario WHERE permissaoSistema = 'user' AND idUsuario = '".$pesquisa."';");
                                        $row = mysql_fetch_array($result);
                                        $recordCount = $row['RecordCount'];

                                        //Get records from database
                                        $result = mysql_query("SELECT idUsuario, nome, titulo, cargo, portaria, emailInstitucional as email, permissaoSistema as permissao FROM usuario WHERE permissaoSistema = 'user' AND idUsuario = '".$pesquisa."' ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
                            break;
                        
                            case"nome": $result =  mysql_query("SELECT COUNT(*) AS RecordCount FROM usuario WHERE permissaoSistema = 'user' AND nome LIKE '%".$pesquisa."%';");
                                        $row = mysql_fetch_array($result);
                                        $recordCount = $row['RecordCount'];

                                        //Get records from database
                                        $result = mysql_query("SELECT idUsuario, nome, titulo, cargo, portaria, emailInstitucional as email, permissaoSistema as permissao FROM usuario WHERE permissaoSistema = 'user' AND nome LIKE '%".$pesquisa."%' ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
                            break;

                            case"titulo": $result =  mysql_query("SELECT COUNT(*) AS RecordCount FROM usuario WHERE permissaoSistema = 'user' AND titulo LIKE '%".$pesquisa."%';");
                                        $row = mysql_fetch_array($result);
                                        $recordCount = $row['RecordCount'];

                                        //Get records from database
                                        $result = mysql_query("SELECT idUsuario, nome, titulo, cargo, portaria, emailInstitucional as email, permissaoSistema as permissao FROM usuario WHERE permissaoSistema = 'user' AND titulo LIKE '%".$pesquisa."%' ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
                                break;

                            case"cargo": $result =  mysql_query("SELECT COUNT(*) AS RecordCount FROM usuario WHERE permissaoSistema = 'user' AND cargo LIKE '%".$pesquisa."%';");
                                        $row = mysql_fetch_array($result);
                                        $recordCount = $row['RecordCount'];

                                        //Get records from database
                                        $result = mysql_query("SELECT idUsuario, nome, titulo, cargo, portaria, emailInstitucional as email, permissaoSistema as permissao FROM usuario WHERE permissaoSistema = 'user' AND cargo LIKE '%".$pesquisa."%' ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
                            break;
                            
                            case"portaria": $result =  mysql_query("SELECT COUNT(*) AS RecordCount FROM usuario WHERE permissaoSistema = 'user' AND portaria LIKE '%".$pesquisa."%';");
                                        $row = mysql_fetch_array($result);
                                        $recordCount = $row['RecordCount'];

                                        //Get records from database
                                        $result = mysql_query("SELECT idUsuario, nome, titulo, cargo, portaria, emailInstitucional as email, permissaoSistema as permissao FROM usuario WHERE permissaoSistema = 'user' AND portaria LIKE '%".$pesquisa."%' ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
                            break;
                        
                            case"email": $result =  mysql_query("SELECT COUNT(*) AS RecordCount FROM usuario WHERE permissaoSistema = 'user' AND emailInstitucional LIKE '%".$pesquisa."%';");
                                        $row = mysql_fetch_array($result);
                                        $recordCount = $row['RecordCount'];

                                        //Get records from database
                                        $result = mysql_query("SELECT idUsuario, nome, titulo, cargo, portaria, emailInstitucional as email, permissaoSistema as permissao FROM usuario WHERE permissaoSistema = 'user' AND emailInstitucional LIKE '%".$pesquisa."%' ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
                        }
      
                    }
                    else if( $selectPermissao == "administrador" )
                    {

                        switch ($select)
                        {

                            case"": $result =  mysql_query("SELECT COUNT(*) AS RecordCount FROM usuario WHERE  permissaoSistema = 'admin' AND ( idUsuario = '".$pesquisa."' or nome LIKE '%".$pesquisa."%' or titulo LIKE '%".$pesquisa."%'  or cargo LIKE '%".$pesquisa."%' or portaria LIKE '%".$pesquisa."%' or emailInstitucional LIKE '%".$pesquisa."%');");
                                    $row = mysql_fetch_array($result);
                                    $recordCount = $row['RecordCount'];

                                    //Get records from database
                                    $result = mysql_query("SELECT idUsuario, nome, titulo, cargo, portaria, emailInstitucional as email, permissaoSistema as permissao FROM usuario WHERE permissaoSistema = 'admin' AND ( idUsuario = '".$pesquisa."' or nome LIKE '%".$pesquisa."%' or titulo LIKE '%".$pesquisa."%'  or cargo LIKE '%".$pesquisa."%' or portaria LIKE '%".$pesquisa."%' or emailInstitucional LIKE '%".$pesquisa."%') ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
                            break;
                            
                            case"id": $result =  mysql_query("SELECT COUNT(*) AS RecordCount FROM usuario WHERE permissaoSistema = 'admin' AND idUsuario = '".$pesquisa."';");
                                        $row = mysql_fetch_array($result);
                                        $recordCount = $row['RecordCount'];

                                        //Get records from database
                                        $result = mysql_query("SELECT idUsuario, nome, titulo, cargo, portaria, emailInstitucional as email, permissaoSistema as permissao FROM usuario WHERE permissaoSistema = 'admin' AND idUsuario = '".$pesquisa."' ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
                            break;
                        
                            case"nome": $result =  mysql_query("SELECT COUNT(*) AS RecordCount FROM usuario WHERE permissaoSistema = 'admin' AND nome LIKE '%".$pesquisa."%';");
                                        $row = mysql_fetch_array($result);
                                        $recordCount = $row['RecordCount'];

                                        //Get records from database
                                        $result = mysql_query("SELECT idUsuario, nome, titulo, cargo, portaria, emailInstitucional as email, permissaoSistema as permissao FROM usuario WHERE permissaoSistema = 'admin' AND nome LIKE '%".$pesquisa."%' ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
                            break;

                            case"titulo": $result =  mysql_query("SELECT COUNT(*) AS RecordCount FROM usuario WHERE permissaoSistema = 'admin' AND titulo LIKE '%".$pesquisa."%';");
                                        $row = mysql_fetch_array($result);
                                        $recordCount = $row['RecordCount'];

                                        //Get records from database
                                        $result = mysql_query("SELECT idUsuario, nome, titulo, cargo, portaria, emailInstitucional as email, permissaoSistema as permissao FROM usuario WHERE permissaoSistema = 'admin' AND titulo LIKE '%".$pesquisa."%' ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
                                break;

                            case"cargo": $result =  mysql_query("SELECT COUNT(*) AS RecordCount FROM usuario WHERE permissaoSistema = 'admin' AND cargo LIKE '%".$pesquisa."%';");
                                        $row = mysql_fetch_array($result);
                                        $recordCount = $row['RecordCount'];

                                        //Get records from database
                                        $result = mysql_query("SELECT idUsuario, nome, titulo, cargo, portaria, emailInstitucional as email, permissaoSistema as permissao FROM usuario WHERE permissaoSistema = 'admin' AND cargo LIKE '%".$pesquisa."%' ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
                            break;
                            
                            case"portaria": $result =  mysql_query("SELECT COUNT(*) AS RecordCount FROM usuario WHERE permissaoSistema = 'admin' AND portaria LIKE '%".$pesquisa."%';");
                                        $row = mysql_fetch_array($result);
                                        $recordCount = $row['RecordCount'];

                                        //Get records from database
                                        $result = mysql_query("SELECT idUsuario, nome, titulo, cargo, portaria, emailInstitucional as email, permissaoSistema as permissao FROM usuario WHERE permissaoSistema = 'admin' AND portaria LIKE '%".$pesquisa."%' ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
                            break;
                        
                            case"email": $result =  mysql_query("SELECT COUNT(*) AS RecordCount FROM usuario WHERE permissaoSistema = 'admin' AND emailInstitucional LIKE '%".$pesquisa."%';");
                                        $row = mysql_fetch_array($result);
                                        $recordCount = $row['RecordCount'];

                                        //Get records from database
                                        $result = mysql_query("SELECT idUsuario, nome, titulo, cargo, portaria, emailInstitucional as email, permissaoSistema as permissao FROM usuario WHERE permissaoSistema = 'admin' AND emailInstitucional LIKE '%".$pesquisa."%' ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
                        }
                        
                    }
                    else 
                    {
                        switch ($select)
                        {

                            case"": $result =  mysql_query("SELECT COUNT(*) AS RecordCount FROM usuario WHERE idUsuario = '".$pesquisa."' or nome LIKE '%".$pesquisa."%' or titulo LIKE '%".$pesquisa."%'  or cargo LIKE '%".$pesquisa."%' or portaria LIKE '%".$pesquisa."%' or emailInstitucional LIKE '%".$pesquisa."%';");
                                    $row = mysql_fetch_array($result);
                                    $recordCount = $row['RecordCount'];

                                    //Get records from database
                                    $result = mysql_query("SELECT idUsuario, nome, titulo, cargo, portaria, emailInstitucional as email, permissaoSistema as permissao FROM usuario WHERE idUsuario = '".$pesquisa."' or nome LIKE '%".$pesquisa."%' or titulo LIKE '%".$pesquisa."%'  or cargo LIKE '%".$pesquisa."%' or portaria LIKE '%".$pesquisa."%' or emailInstitucional LIKE '%".$pesquisa."%' ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
                            break;
                            
                            case"id": $result =  mysql_query("SELECT COUNT(*) AS RecordCount FROM usuario WHERE idUsuario = '".$pesquisa."';");
                                        $row = mysql_fetch_array($result);
                                        $recordCount = $row['RecordCount'];

                                        //Get records from database
                                        $result = mysql_query("SELECT idUsuario, nome, titulo, cargo, portaria, emailInstitucional as email, permissaoSistema as permissao FROM usuario WHERE idUsuario = '".$pesquisa."' ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
                            break;
                        
                            case"nome": $result =  mysql_query("SELECT COUNT(*) AS RecordCount FROM usuario WHERE nome LIKE '%".$pesquisa."%';");
                                        $row = mysql_fetch_array($result);
                                        $recordCount = $row['RecordCount'];

                                        //Get records from database
                                        $result = mysql_query("SELECT idUsuario, nome, titulo, cargo, portaria, emailInstitucional as email, permissaoSistema as permissao FROM usuario WHERE nome LIKE '%".$pesquisa."%' ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
                            break;

                            case"titulo": $result =  mysql_query("SELECT COUNT(*) AS RecordCount FROM usuario WHERE titulo LIKE '%".$pesquisa."%';");
                                        $row = mysql_fetch_array($result);
                                        $recordCount = $row['RecordCount'];

                                        //Get records from database
                                        $result = mysql_query("SELECT idUsuario, nome, titulo, cargo, portaria, emailInstitucional as email, permissaoSistema as permissao FROM usuario WHERE titulo LIKE '%".$pesquisa."%' ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
                                break;

                            case"cargo": $result =  mysql_query("SELECT COUNT(*) AS RecordCount FROM usuario WHERE cargo LIKE '%".$pesquisa."%';");
                                        $row = mysql_fetch_array($result);
                                        $recordCount = $row['RecordCount'];

                                        //Get records from database
                                        $result = mysql_query("SELECT idUsuario, nome, titulo, cargo, portaria, emailInstitucional as email, permissaoSistema as permissao FROM usuario WHERE cargo LIKE '%".$pesquisa."%' ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
                            break;
                            
                            case"portaria": $result =  mysql_query("SELECT COUNT(*) AS RecordCount FROM usuario WHERE portaria LIKE '%".$pesquisa."%';");
                                        $row = mysql_fetch_array($result);
                                        $recordCount = $row['RecordCount'];

                                        //Get records from database
                                        $result = mysql_query("SELECT idUsuario, nome, titulo, cargo, portaria, emailInstitucional as email, permissaoSistema as permissao FROM usuario WHERE portaria LIKE '%".$pesquisa."%' ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
                            break;
                        
                            case"email": $result =  mysql_query("SELECT COUNT(*) AS RecordCount FROM usuario WHERE emailInstitucional LIKE '%".$pesquisa."%';");
                                        $row = mysql_fetch_array($result);
                                        $recordCount = $row['RecordCount'];

                                        //Get records from database
                                        $result = mysql_query("SELECT idUsuario, nome, titulo, cargo, portaria, emailInstitucional as email, permissaoSistema as permissao FROM usuario WHERE emailInstitucional LIKE '%".$pesquisa."%' ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
                        }                    
                    }                   
                }              
            
            //Add all records to an array
              $rows = array();
              while($row = mysql_fetch_array($result))
              {
                  $row['nome'] = utf8_encode($row['nome']);
                  $row['cargo'] = utf8_encode($row['cargo']);
                  $row['portaria'] = utf8_encode($row['portaria']);

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
		$result = mysql_query("INSERT INTO usuario(nome, titulo, cargo, portaria, permissaoSistema, emailInstitucional, senha) VALUES('" . $_POST["nome"] . "','" . $_POST["titulo"] . "','" . $_POST["cargo"] ."','" . $_POST["portaria"] ."','" . $_POST["permissao"] ."','" . $_POST["email"] ."','" . $_POST["senha"] . ");");
		
		//Get last inserted record (to return to jTable)
		$result = mysql_query("SELECT * FROM people WHERE PersonId = LAST_INSERT_ID();");
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
          
		$result = mysql_query("UPDATE usuario SET nome = '" . $_POST["nome"] . "', titulo = " . $_POST["titulo"] . "', cargo = " . $_POST["cargo"] . "', portaria = " . $_POST["portaria"] . "', permissaoSistema = " . $_POST["permissao"] . "', emailInstitucional = " . $_POST["email"] . "', senha = " . $_POST["senha"] . " WHERE idUsuario = " . $_POST["idUsuario"] . ";");

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}
	//Deleting a record (deleteAction)
	else if($_GET["action"] == "delete")
	{
		//Delete from database
		$result = mysql_query("DELETE FROM usuario WHERE idUsuario = " . $_POST["idUsuario"] . ";");

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