<?php

//Arquivo de envio de validação de chave enviada por e-mail

//Visual da página
include("vPlease-wait.html");

//Inclusão do arquivo de conexão com o banco
include_once("conecta-mi-db.php");

//Instancia a classe com métodos de conexão com o banco.
$bdMi = new MYSQL_MIDB();

//Verificação de usuário no banco
if (!(empty($_GET['keyID']))) {

    $chaveRecebida = $_REQUEST['keyID'];

    //Seleção da chave no banco
    $resultado = $bdMi->sql("SELECT t.idUsuario, p.chave FROM usuario t, chave p WHERE p.chave =  '" . $chaveRecebida . "' AND p.idUsuario = t.idUsuario");
    
    //Início da    
    $idUsuario = mysql_result($resultado, 0,"idUsuario");
    session_start();
    $_SESSION['idUsuario'] = $idUsuario;
    
    //Verificação de existência de usuário
    if (mysql_num_rows($resultado) > 0) {

        $chaveBD = mysql_result($resultado, 1, "chave");

        //Verificação de chave no banco
        if ($chaveBD == $chaveRecebida) {
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
            alert("Chave não encontrada ou inválida!");
            window.location = ("vRecover.php");
        </script>
        <?php
    }
}else{
    ?>
        <script language="JavaScript">
            alert("Chave inválida!");
            window.location = ("vRecover.php");
        </script>
    <?php
}
?>
