<?php // Arquivo de geração do MI


//Inicializa a sessão
    session_start("usuario");

    //Inclusão do arquivo de conexão com o banco e instanciamento da conexao
    include("../model/conecta-mi-db.php");    
    
    //**********RECEBIMENTO DAS VARIÁRVEIS**********/
    $txtDestinatario = $_POST['destinatario'];
    
    $split_strings = preg_split('/[\ \n\,]+/', $txtDestinatario);
    
    $tituloDestinatario = $split_strings[0];
    $nomeDestinatario = $split_strings[1];
    $cargoDestinatario = $split_strings[2];
    
    $bdMi = new MYSQL_MIDB();
    
    $resultado = $bdMi->sql("SELECT idDestinatario FROM destinatario WHERE nome = '$nomeDestinatario' AND titulo = '$tituloDestinatario' and cargo = '$cargoDestinatario'");
    
    if(!mysql_num_rows($resultado) )
    {
        $resultado = $bdMi->sql("INSERT INTO destinatario(nome, titulo, cargo) VALUES ( '$nomeDestinatario', '$tituloDestinatario', '$cargoDestinatario' )");
    }
    
    $emissario = $_POST['emissario'];
    $referencia = $_POST['referencia'];
    $corpo = $_POST['corpo'];
    $dataEmissao = $_POST['data'];
    $numeroMemorando = $_POST['numeroMemorando'];
    
    $usuario = $_SESSION["login"];
   
    $resultado = $bdMi->sql("SELECT idUsuario FROM usuario WHERE emailInstitucional = '$usuario'");
    $idRemetente = mysql_result($resultado, 0, 'idUsuario');
    
    $resultado = $bdMi->sql("SELECT idDestinatario FROM destinatario WHERE nome = '$nomeDestinatario' AND titulo = '$tituloDestinatario' and cargo = '$cargoDestinatario'");
    $idDestinatario = mysql_result($resultado, 0, 'idDestinatario');
    
    $SelectNumeroMemorandoEmitido = $bdMi->sql("SELECT MAX(nMemorandoEmitido) FROM memorando WHERE emissario = '$emissario'");
    $nMemorandoEmitido = mysql_result( $SelectNumeroMemorandoEmitido, 0 );
    $nMemorandoEmitido++;
    
    
    
    $selectMemorando = $bdMi->sql("SELECT * FROM memorando WHERE idMemorando=$numeroMemorando");
     
    if(mysql_num_rows($selectMemorando) == 0 ){
        $insertMemorando = $bdMi->sql( "INSERT INTO memorando(data, remetente, destinatario, referencia , corpo, emitido, nMemorandoEmitido, emissario ) 
                                       VALUES( '$dataEmissao', '$idRemetente', '$idDestinatario' , '$referencia', '$corpo', 1, $nMemorandoEmitido, $emissario )");
        //Verificação de sucesso na inserção da unidade
        if ($insertMemorando > 0) {
          
          echo true;
        } else {
            
          echo false;  
        }
        
    } else{
        
        $updateMemorando = $bdMi->sql("UPDATE memorando 
                                        SET data = '$dataEmissao', remetente = $idRemetente, destinatario = idDestinatario, referencia = '$referencia', corpo = '$corpo', emitido = 1, nMemorandoEmitido = $nMemorandoEmitido, emissario = $emissario
                                        WHERE idMemorando = $numeroMemorando");
        
        //Verificação de sucesso na atualizacao da unidade
        if ($updateMemorando > 0) {
            
            echo true;

        } else {
            
            echo false;
            
        }
    }
    
    
    //Emissario
    //$txtReferencia = $_POST['txtReferencia'];
?>