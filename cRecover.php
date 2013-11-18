<?php

//Arquivo de envio de e-mail para redefinição de senha

//Visual da página
include("vPlease-wait.html");

//Inclusão do arquivo de conexão com o banco
include_once("conecta-mi-db.php");
include("funcoes.php");

//Instancia a classe com métodos de conexão com o banco.
$bdMi = new MYSQL_MIDB();

//Verificação de usuário no banco
if (!(empty($_POST['txtMail']))) {

    $txtLogin = $_POST['txtMail'];
    $resultado = $bdMi->sql("SELECT t.idUsuario, t.emailInstitucional, t.senha FROM usuario t WHERE emailInstitucional='" . $txtLogin . "'");

    //Verificação de existência de usuário
    if (mysql_num_rows($resultado) > 0) {

        $idUsuario = mysql_result($resultado, 0, "idUsuario");
        $usuario = mysql_result($resultado, 0, "emailInstitucional");
        $senha = mysql_result($resultado, 0, "senha");

        //Geração de chave aleatória para redefinição de senha
        $chave = geraChave();

        //Inserção da chave no banco para posterior comparação.
        $resultadoInsert = $bdMi->sql("INSERT INTO `chave` (idUsuario,chave) VALUES ('$idUsuario','" . $chave . "')");

        //Envio de e-mail de redefinição de senha
        $destinatario = $usuario;
        $assunto = "Redefinição de Senha - Sistema de Emissão de MI";
        $headers = "";
        $headers .= "From: naoresponda@facom.ufu.br";
        $mensagem = "
Você está recebendo esta mensagem pois solicitou a redefinição de senha no Sistema de Emissão de MI.
            
Caso não tenha solicitado, favor ignorar a mensagem.
            
Caso tenha solicitado, clique no link a seguir e insira a chave de segurança no campo solicitado:
            
http://localhost/mi/vRedefinir-senha.php?keyID=" . $chave . "
            
---------------------------------------------------------------
Sistema de Emissão de MI - FACOM - Universidade Federal de Uberlândia.
Esta é uma mensagem automática. Não a responda.
            ";

        $resultadoEmail = mail($destinatario, $assunto, $mensagem, $headers);
        echo var_dump($resultadoEmail);
        ?>
        <script language="JavaScript">
            alert("Um e-mail de redefinição de senha foi enviado para " + "<?php echo $usuario ?>" + ".");
            window.location = ("index.php");
        </script>
        <?php
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
