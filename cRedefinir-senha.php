<?php
//Arquivo de envio de confirmação de recuperação de senha

//Visual da página
include("vPlease-wait.html");

//Inclusão do arquivo de conexão com o banco
include_once("conecta-mi-db.php");

//Instancia a classe com métodos de conexão com o banco.
$bdMi = new MYSQL_MIDB();

//Verificação de usuário no banco
if (!((empty($_POST['txtSenha']) && empty($_POST['txtRepeteSenha'])))) {

    $txtSenha = md5($_POST['txtSenha']);
    $txtRepeteSenha = md5($_POST['txtRepeteSenha']);

    if ($txtSenha != $txtRepeteSenha) {
        ?>
        <script language="JavaScript">
            alert("Campos \"Senha\" e \"Confirma Senha\" estão diferentes!");
            window.location = ("vRedefinir-senha.html");
        </script>
        <?php
    } else {

        //Obtenção do e-mail da sessão iniciada em 'confirma-chave.php'
        session_start();
        $usuario = $_SESSION['idUsuario'];

        //Atualização da senha no banco
        $resultadoUpdate = $bdMi->sql("UPDATE usuario SET senha = '$txtSenha' WHERE idUsuario = $usuario");

        //Deleção da chave criada para a alteração
        $resultadoDelete = $bdMi->sql("DELETE FROM chave WHERE idUsuario = $usuario");
    }

    //Verificação de sucesso da operação
    if ($resultadoUpdate > 0 && $resultadoDelete > 0) {
        ?>
        <script language="JavaScript">
            alert("Senha alterada com sucesso!");
            window.location = ("index.php");
        </script>
        <?php
    } else {
        ?>
        <script language="JavaScript">
            alert("Erro na alteração da senha! Tente novamente.");
            window.location = ("vRecover.php");
        </script>
        <?php
    }
}
?>
