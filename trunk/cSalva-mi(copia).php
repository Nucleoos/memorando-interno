<?php

//Arquivo de geração do MI

//Inicializa a sessão
session_start("usuario");

    //Inclusão do arquivo de conexão com o banco e instanciamento da conexao
    include("conecta-mi-db.php");    
    
    //**********RECEBIMENTO DAS VARIÁRVEIS**********/
    $txtDestinatario = $_POST['txtDestinatario'];
    $txtCargoRemetente = $_POST['txtCargo'];
    $txtReferencia = $_POST['txtReferencia'];
    $txtTitulo = $_POST['txtTitulo'];
    $txtCorpo = $_POST['txtCorpo'];
    $dataEmissao = $_POST['data'];

    $usuario = $_SESSION["login"];

    $bdMi = new MYSQL_MIDB();
    
    //***********GERAÇÃO DO ID DO MEMORANDO*************/
    //Consulta o "maior ID" de memorando da tabela (ou seja, o último) e o incrementa, gerando o nome do próximo.
    $ultimoMemorando = $bdMi->sql("SELECT MAX(idMemorando) FROM memorando");
    $numeroMemorando = $ultimoMemorando[0] + 1;
    
    $selectMemorando = $bdMi->sql("SELECT * FROM memorando WHERE idMemorando=$numeroMemorando");
    
    
    $resultado = $bdMi->sql("SELECT idUsuario FROM usuario WHERE emailInstitucional = '$usuario'");
    $idUsuarioAtual = mysql_result($resultado, 0, 'idUsuario');
  
    if(mysql_num_rows($selectMemorando) == 0 ){
        $insertMemorando = $bdMi->sql("INSERT INTO memorando(data, remetente, destinatario, cargo, titulo, corpo, conteudo) 
                                       VALUES('$dataEmissao', '$idUsuarioAtual', '1', '$txtCargoRemetente', '$txtTitulo', '$txtCorpo', '$content' )");
        //Verificação de sucesso na inserção da unidade
        if ($insertMemorando > 0) {
            echo "Salvo com sucesso!";
            
        } else {
            echo "Erro ao salvar. Tente novamente.";
            
        }
        
    } else{
        $updateMemorando = $bdMi->sql("UPDATE memorando 
                                        SET data = $dataEmissao, remetente = $idUsuarioAtual, destinatario = 1, cargo = $txtCargoRemetente, titulo = $txtTitulo, corpo = $txtCorpo, conteudo = $content 
                                        WHERE idMemorando = $numeroMemorando");
        
        //Verificação de sucesso na atualizacao da unidade
        if ($updateMemorando > 0) {
            echo "Salvo com sucesso!";


        } else {
            echo "Erro ao salvar. Tente novamente.";
        }
    }
    
    
    //Emissario
    //$txtReferencia = $_POST['txtReferencia'];
?>