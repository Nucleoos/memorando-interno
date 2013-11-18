<?php // Arquivo de geração do MI


//Inicializa a sessão
session_start("usuario");

    //Inclusão do arquivo de conexão com o banco e instanciamento da conexao
    include("conecta-mi-db.php");    
    
    
    //**********RECEBIMENTO DAS VARIÁRVEIS**********/
    $txtDestinatario = $_POST['destinatario'];
    $txtCargoRemetente = $_POST['cargo'];
    $txtReferencia = $_POST['referencia'];
    $txtTitulo = $_POST['titulo'];
    $txtCorpo = $_POST['corpo'];
    $dataEmissao = $_POST['data'];

    $usuario = $_SESSION["login"];

    $bdMi = new MYSQL_MIDB();
    
    $numeroMemorando = $_SESSION["numeroMemorando"];
    
    $selectMemorando = $bdMi->sql("SELECT * FROM memorando WHERE idMemorando=$numeroMemorando");
    
    
    $resultado = $bdMi->sql("SELECT idUsuario FROM usuario WHERE emailInstitucional = '$usuario'");
    $idUsuarioAtual = mysql_result($resultado, 0, 'idUsuario');
  
    if(mysql_num_rows($selectMemorando) == 0 ){
        $insertMemorando = $bdMi->sql( "INSERT INTO memorando(data, remetente, destinatario, cargo, titulo, corpo ) 
                                       VALUES( '$dataEmissao', '$idUsuarioAtual', '1', '$txtCargoRemetente', '$txtTitulo', '$txtCorpo' )");
        //Verificação de sucesso na inserção da unidade
        if ($insertMemorando > 0) {
            
            return 1;
            
        } else {
            
            return 3;
            
        }
        
    } else{
        $updateMemorando = $bdMi->sql("UPDATE memorando 
                                        SET data = $dataEmissao, remetente = $idUsuarioAtual, destinatario = 1, cargo = $txtCargoRemetente, titulo = $txtTitulo, corpo = $txtCorpo
                                        WHERE idMemorando = $numeroMemorando");
        
        //Verificação de sucesso na atualizacao da unidade
        if ($updateMemorando > 0) {
            
            return 1;

        } else {
            
            return 3;
            
        }
    }
    
    
    //Emissario
    //$txtReferencia = $_POST['txtReferencia'];
?>