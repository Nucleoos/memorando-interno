<?php

//Arquivo de envio de validação de chave enviada por e-mail

//Visual da página
include("vPlease-wait.html");

//Inclusão do arquivo de conexão com o banco
include_once("conecta-mi-db.php");

//Instancia a classe com métodos de conexão com o banco.
$bdMi = new MYSQL_MIDB();

//Verificação de usuário no banco
if (!((empty($_POST['txtMail']) && empty($_POST['txtChave'])))) {

    $txtMail = $_POST['txtMail'];
    $txtChave = $_POST['txtChave'];

    //Seleção da chave no banco
    $resultado = $bdMi->sql("SELECT t.idUsuario, p.chave FROM usuario t, chave p WHERE t.emailInstitucional =  '" . $txtMail . "' AND p.idUsuario = t.idUsuario");
    
    //Armazenamento do email institucional    
    $idUsuario = mysql_result($resultado, 0,"idUsuario");
    session_start();
    $_SESSION['idUsuario'] = $idUsuario;
    
    //Verificação de existência de usuário
    if (mysql_num_rows($resultado) > 0) {

        $chave = mysql_result($resultado, 0, "chave");

        //Verificação de chave no banco
        if ($chave == $txtChave) {
            ?>
            <script language="JavaScript">
                window.location = ("vRedefinir-senha.php");
            </script>
            <?php
        } else {
            ?>
            <script language="JavaScript">
                alert("Chave inválida!");
                window.location = ("vConfirma-chave.php");
            </script>
            <?php
        }
    } else {
        ?>
        <script language="JavaScript">
            alert("E-mail Institucional não cadastrado!");
            window.location = ("vRecover.php");
        </script>
        <?php
    }
}
?>
