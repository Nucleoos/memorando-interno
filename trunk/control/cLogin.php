<?php

//Visual da página
include("../view/vPlease-wait.html");

//Inclusão do arquivo de conexão com o banco
include_once("../model/conecta-mi-db.php");

//Instancia a classe com métodos de conexão com o banco.
$bdMi = new MYSQL_MIDB();

//$txtLogin = $_POST['txtUsuarioLogin'];
//    $given_password = $_POST['txtSenhaLogin'];
//    $resultado = $bdMi->sql("SELECT senha FROM usuario WHERE emailInstitucional='" . $txtLogin . "'");
//    $db_hash = $resultado['senha'];
//    if (password_verify($given_password, $db_hash)) {
//    // password valid
//        $usuario = mysql_result($resultado, 0, "nome");
//
//        //Inicialização da sessão no sistema
//        session_start();
//
//        $_SESSION["login"] = $txtLogin;
//        $_SESSION["senha"] = $db_hash;
//        $_SESSION["usuario"] = $usuario;
//
//        //Direcionamento para a página inicial do sistema
//        header("Location:../view/vMain.php");
//    }
//Verificação de usuário no banco
if (!(empty($_POST['txtUsuarioLogin']) AND empty($_POST['txtSenhaLogin']))) {

    $txtLogin = $_POST['txtUsuarioLogin'];
    $txtSenha = md5($_POST['txtSenhaLogin']);
    $resultado = $bdMi->sql("SELECT * FROM usuario WHERE emailInstitucional='" . $txtLogin . "' AND senha='" . $txtSenha . "'");

    //Verificação de existência de usuário
    if (mysql_num_rows($resultado) > 0) {

        $usuario = mysql_result($resultado, 0, "nome");

        //Inicialização da sessão no sistema
        session_start();

        $_SESSION["login"] = $txtLogin;
        $_SESSION["senha"] = $txtSenha;
        $_SESSION["usuario"] = $usuario;

        //Direcionamento para a página inicial do sistema
        header("Location:../view/vMain.php");
    } else {
        
?>
        <script language="JavaScript">
            alert("Usuário ou senha inválidos!");
            window.location = ('../view/index.html');
        </script>
<?php
    }
}
?>