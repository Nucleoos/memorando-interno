<?php
//Inicializa a sess�o
session_start("usuario");

//Verificação de sessão iniciada
if (isset($_SESSION["login"]) and ($_SESSION["senha"])) {

    //Inclus�o do arquivo de conex�o com o banco
    include_once ("../model/conecta-mi-db.php");

    //Instaciando a classe de conexao com banco de dados
    $bdMi = new MYSQL_MIDB();

    //Recebimento do login setado na sessão
    $txtLogin = $_SESSION["login"];

    //Consulta de permiss�o do sistema
    $consultaPermissaoSistema = $bdMi->sql("SELECT t.permissaoSistema FROM usuario t WHERE t.emailInstitucional='$txtLogin'");
    $linhas = mysql_num_rows($consultaPermissaoSistema);
    if ($linhas != 0) {
        $permissao = mysql_result($consultaPermissaoSistema, 0, "permissaoSistema");
    }
    ?>
    <!DOCTYPE HTML>
    <html lang="pt-br">

        <!-- Header --> 
        <head>
            <!-- Titulo -->
            <title>Sistema de Memorandos Internos</title>            
            <!-- Ícone-->
            <link rel="shortcut icon" href="images/favicon.gif">
            <!-- Charset -->
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <!-- CSS -->
            <link href="../resources/css/menu.css" media="screen" rel="stylesheet" type="text/css" />
            <style type="text/css">
                @import url("../resources/css/estilo.css") screen; <!--Design para Desktop -->
            </style>
        
        </head>
        <!-- Body -->
        <body>

            <?php include("vCabecalho-interno.html"); ?>            

            <div id="divPrincipal">
                <div id="menu">
                    <?php include("menu.html"); ?>
                </div>
                <!-- Section -->
                <section id="corpo">
                    <fieldset class="options">
                        <legend>Gerador de MI</legend>
                        <p>
                            <button onclick="window.location='../control/cGetIdMemorando.php'" >CRIAR</button>
                            <button onclick="window.location='vConsultar.php'">CONSULTAR</button>
                        </p>
                    </fieldset>
                </section>
                <?php
                if ($permissao == "admin") {
                    echo "
                <section id=\"corpo\">
                    <fieldset class=\"options\">
                        <legend>Administrador</legend>
                        <p>
                            <button onclick=\"window.location='vAdmin-cadastrar.php'\">CADASTRAR</button>
                            <button onclick=\"window.location='vAdmin-gerenciar.php'\">GERENCIAR</button>
                        </p>
                    </fieldset>
                </section>
                ";
                }
                ?>        
            </div>
            <?php include("vRodape.html"); ?>
        </body>
    </html>
    <?php
} else {
    include("vUsuario-nao-logado.php");
}
?>