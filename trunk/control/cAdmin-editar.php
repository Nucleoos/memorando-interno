<?php

//Arquivo de atualização de unidade ou usuário no banco

//Inicializa a sessão
session_start("usuario");

//Verificação de sessão iniciada
if (isset($_SESSION["login"]) and ($_SESSION["senha"])) {
    
    //Visual da página
    include("../view/vPlease-wait.html");

    //Inclusão do arquivo de conexão com o banco
    include ("../model/conecta-mi-db.php");

    //Instaciando a classe de conexao com banco de dados
    $bdMi = new MYSQL_MIDB();

    if (isset($_POST['btAtualizarUnidade'])) {

        //Recebimento das variáveis de unidade
        $idUnidade = $_POST['idUnidade'];
        $nomeUnidade = $_POST['txtUnidade'];

        //Atualização de nome de unidade no banco
        $resultadoUpdateUnidade = $bdMi->sql("UPDATE unidade SET nome='$nomeUnidade' WHERE idUnidade='$idUnidade'");

        //Verificação de sucesso na operação
        if ($resultadoUpdateUnidade > 0) {
            ?>
            <script language="JavaScript">
                alert("Unidade atualizada com sucesso!");
                window.location = ("../view/vAdmin-gerenciar.php");
            </script>
            <?php
        } else {
            ?>
            <script language="JavaScript">
                alert("Erro ao atualizar unidade. Tente novamente.");
                window.location = ("../view/vAdmin-gerenciar.php");
            </script>
            <?php
        }
    } else if (isset($_POST['btAtualizarUsuario'])) {
        
    }
} else {
    include("../view/vUsuario-nao-logado.php");
}
?>