<?php

//Arquivo de envio de confirmação de cadastro de usuário

//Visual da página
include("vPlease-wait.html");

//Inclusão do arquivo de conexão com o banco
include_once("conecta-mi-db.php");

//Cadastro de unidade, caso tenha sido este o botão clicado
if (isset($_POST["btCadastrarUnidade"])) {

    $txtUnidade = $_POST["txtUnidade"];

    //Instância de conexão com o banco
    $bdMi = new MYSQL_MIDB();

    //Realização da inserção da unidade no banco
    $resultadoInsertUnidade = $bdMi->sql("INSERT INTO unidade (nome) VALUES ('$txtUnidade')");

    //Verificação de sucesso na inserção da unidade
    if ($resultadoInsertUnidade > 0) {
        ?>
        <script language="JavaScript">
            alert("Unidade inserida com sucesso!");
            window.location = ("vMain.php");
        </script>
        <?php
    } else {
        ?>
        <script language="JavaScript">
            alert("Erro na inserção da unidade. Tente novamente.");
            window.history.go(-1);
        </script>
        <?php
    }
}

//Cadastro de usuário, caso tenha sido este o botão clicado
if (isset($_POST["btCadastrarUsuario"])) {

    //Recebimento das variáveis do formulário
    $txtNome = $_POST["txtNome"];
    $txtEmail = $_POST["txtEmail"];
    $txtSenha = $_POST["txtSenha"];
    $txtTitulo = $_POST["txtTitulo"];
    $txtPortarira = $_POST["txtPortarira"];
    $txtCargo = $_POST["txtCargo"];
    $selPermissao = $_POST["selPermissao"];
    $selUnidade = $_POST["selUnidade"];

    //Instância de conexão com o banco
    $bdMi = new MYSQL_MIDB();

    //Realização da inserção do usuário no banco
    $resultadoInsertUsuario = $bdMi->sql("INSERT INTO usuario (nome,titulo,cargo,portaria,permissaoSistema,emailInstitucional,senha) VALUES ('$txtNome','$txtTitulo','$txtCargo','$txtPortarira','$selPermissao','$txtEmail','$txtSenha')");

    //Caso haja sucesso na inserção do usuário, é executada a seleção do ID deste gerado na inserção
    if ($resultadoInsertUsuario > 0) {
        //Seleção de id do usuário do banco
        $selectId = $bdMi->sql("SELECT idUsuario FROM usuario WHERE emailInstitucional = '$txtEmail'");

        $idUsuario = mysql_result($selectId, 0, "idUsuario");
    } else {
        ?>
        <script language="JavaScript">
            alert("Erro na inserção do usuário. Tente novamente.");
            window.location = ("vMain.php");
        </script>
        <?php
    }

    //Realização na tabela "usuario_has_unidade"
    $resultadoInsertUsuarioHasUnidade = $bdMi->sql("INSERT INTO usuario_has_unidade (idUsuario,idUnidade) VALUES ('$idUsuario','$selUnidade')");

    //Verificação de sucesso da operação
    if ($resultadoInsertUsuario > 0 && $resultadoInsertUsuarioHasUnidade > 0) {
        ?>
        <script language="JavaScript">
            alert("Usuário cadastrado com sucesso!");
            window.location = ("vMain.php");
        </script>
        <?php
    } else {
        ?>
        <script language="JavaScript">
            alert("Erro ao cadastrar novo usuário. Tente novamente.");
            window.location = ("vMain.php");
        </script>
        <?php
    }
}
?>
