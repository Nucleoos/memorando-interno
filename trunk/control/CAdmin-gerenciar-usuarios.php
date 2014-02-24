<?php

function randomPassword() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

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
                $pass = randomPassword();
                $random_password = md5($pass);
//                $random = openssl_random_pseudo_bytes(18);
//                $salt = sprintf('$2y$%02d$%s',
//                    13, // 2^n cost factor
//                    substr(strtr(base64_encode($random), '+', '.'), 0, 22)
//                );

//                $hash = crypt($random_password);
//                $hash =  password_hash($random_password, PASSWORD_BCRYPT, [ 'cost' => 13 ] ); 
//		//Insert record into database

		$result = mysql_query("INSERT INTO usuario(nome, titulo, cargo, portaria, permissaoSistema, emailInstitucional, senha) VALUES('" . utf8_decode($_POST["nome"]) . "','" . utf8_decode($_POST["titulo"]) . "','" . utf8_decode($_POST["cargo"]) ."','" . $_POST["portaria"] ."','" . $_POST["permissao"] ."','" . $_POST["email"] . "','" . $random_password ."');");

		
                $result = mysql_query("INSERT INTO usuario(nome, titulo, cargo, portaria, permissaoSistema, emailInstitucional, senha) VALUES('" . $_POST["nome"] . "','" . $_POST["titulo"] . "','" . $_POST["cargo"] ."','" . $_POST["portaria"] ."','" . $_POST["permissao"] ."','" . $_POST["email"] . "','" . $random_password ."');");
                
                $nome_mail = $_POST["nome"];
                $emaildestinatario = $_POST["email"];
                $senha_mail = $pass;
                $assunto = 'Cadastro Sistema MI';
                
                $mensagemHTML = 'Cadastro efetuado no sistema de emissão de MI
                                Nome: '.$nome_mail.'
                                Usuario: '.$emailremetente.'
                                Assunto: '.$assunto.'
                                Essa será sua senha: 
                                             '. $senha_mail .'
                                ';
                
                $headers = "Content-type: text/html; charset=utf-8\r\n";
                
                $envio = mail($emaildestinatario, $assunto, $mensagemHTML, $header);
                
                
               
                //mail($_POST["email"], "teste", "teste" );

                //mail($_POST["email"], "teste", "teste" );

		//Get last inserted record (to return to jTable)
		$result = mysql_query("SELECT idUsuario, nome, titulo, cargo, portaria, emailInstitucional as email, permissaoSistema as permissao FROM usuario WHERE idUsuario = LAST_INSERT_ID();");
		
		//Return result to jTable
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
		$jTableResult['Record'] = $rows;
		print json_encode($jTableResult);
	}
	//Updating a record (updateAction)
	else if($_GET["action"] == "update")
	{
		//Update record in
                $result = mysql_query( "UPDATE usuario SET nome = '" . utf8_decode($_POST["nome"]) . "', 
                    titulo = '" . utf8_decode($_POST["titulo"]) . "',  
                    cargo = '" . utf8_decode($_POST["cargo"]) . "', 
                    portaria = '" . $_POST["portaria"] . "', 
                    permissaoSistema = '" . $_POST["permissao"] . "', 
                    emailInstitucional = '" . $_POST["email"] . "', 
                WHERE idUsuario = '" . $_POST["idUsuario"] . "';");
                
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