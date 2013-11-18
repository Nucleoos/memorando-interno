<?php
//Arquivo de deleção de unidade no banco
//Visual da página
//include("vPlease-wait.html");

//Inicializa a sessão
    session_start("usuario");

    //Verificação de sessão iniciada
    if (isset($_SESSION["login"]) and ($_SESSION["senha"])) {
        $botao = $_REQUEST['botao'];

        switch($botao){

            case'visualizar':
                header("cGera-mi.php");
                break;
            case'salvar':
                //chama alguem;
                break;
            case'emitir':
                //chama alguem
        }
    }else {
        include("vUsuario-nao-logado.php");
    }
?>
