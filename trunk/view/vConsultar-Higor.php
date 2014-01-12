<?php
//Inicializa a sessão
session_start("usuario");

//Verificação de sessão iniciada
if (isset($_SESSION["login"]) and ($_SESSION["senha"])) {
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
            <style type="text/css">
                @import url("estilo.css") screen; <!--Design para Desktop -->
            </style>           
            <!-- Biblioteca jQuery -->
            <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.js"></script>
            <!-- Inclusão do arquivo de funções js -->
            <script src="js/funcoes.js"></script>
            <script src="js/jquery.maskedinput.js"></script>
        </head>
        <!-- Body -->
        <body onload="carregaPesquisa();">
            <?php include("vCabecalho-interno.html"); ?>
            <div id="divPrincipal">
                <!-- Section -->
                <section id="corpo">
                    <!-- Fieldset -->
                    <fieldset>
                        <legend>Consulta de Memorandos</legend>
                         Formulário de Usuário
                        <form name="formMemorando">

                             Nome 
                            <div style="padding: 2% 0 1% 2%; ">
                                <!--<p class="campoPesquisa"align="left">-->
                                <p>Pesquisar por:</p>

                                <p>
                                    <input id="radioPesquisa" type="radio" name="radioPesquisa" class="radioPesquisa" onclick="alteraCampoPesquisa(this.value);" value="idPesquisaTudo" checked> Tudo
                                    <input id="radioPesquisa1" type="radio" name="radioPesquisa" class="radioPesquisa" onclick="alteraCampoPesquisa(this.value);" value="idPesquisaMemorando"> Identificador
                                    <input id="radioPesquisa2" type="radio" name="radioPesquisa" class="radioPesquisa" onclick="alteraCampoPesquisa(this.value);" value="rdPesquisaData"> Data
                                    <input id="radioPesquisa3" type="radio" name="radioPesquisa" class="radioPesquisa" onclick="alteraCampoPesquisa(this.value);" value="rdPesquisaRemetente"> Remetente
                                    <input id="radioPesquisa4" type="radio" name="radioPesquisa" class="radioPesquisa" onclick="alteraCampoPesquisa(this.value);" value="rdPesquisaDestinatario"> Destinatário
                                    <input id="radioPesquisa5" type="radio" name="radioPesquisa" class="radioPesquisa" onclick="alteraCampoPesquisa(this.value);" value="rdPesquisaAssunto"> Assunto
                                    <input id="radioPesquisa6" type="radio" name="radioPesquisa" class="radioPesquisa" onclick="alteraCampoPesquisa(this.value);" value="rdPesquisaCorpo"> Corpo
                                </p>

                                <p align="center" id="campoPesquisa"><label class="labelPesquisa"><input class="info" type="text" id="txtPesquisa" name="txtPesquisa" autocomplete="off" placeholder="Selecione uma das opções acima e digite aqui a sua busca" /></label></p>

                                <p class="botaoPesquisa"><input type="button" class="buttonSubmit" id="btPesquisarMemorando" onclick="submeter();" value="PESQUISAR"></p>

                            </div>
                        </form>
                        <!-- Memorandos emitidos com o sistema -->
                        <br>                        
                        <div id="resultadosPesquisa">
                        </div>
                    </fieldset>
                    <!--</form>-->
                </section>
            </div>
            <?php include("vRodape.html"); ?>
        </body>
    </html>
    <?php
} else {
    include("vUsuario-nao-logado.php");
}
?>