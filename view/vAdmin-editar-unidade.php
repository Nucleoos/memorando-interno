<?php
//Inicializa a sessão
session_start("usuario");

//Verificação de sessão iniciada
if (isset($_SESSION["login"]) and ($_SESSION["senha"])) {
    
    //Recebimento do ID da unidade por POST
    $idUnidade = $_POST['idUnidade'];
    $nomeUnidade = $_POST['nomeUnidade'];
    
    ?>    

    <!DOCTYPE HTML>
    <html lang="pt-br">

        <!-- Header --> 
        <head>
            <!-- Titulo -->
            <title>Sistema de Memorandos Internos</title>
            <!-- Charset -->
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <!-- Ícone-->
            <link rel="shortcut icon" href="../resources/images/favicon.gif">
            <!-- CSS -->
            <style type="text/css">
                @import url("../resources/css/estilo.css") screen; <!--Design para Desktop -->
            </style>
            <!-- Validações -->
            <script src="../resources/js/validacao.js"></script>
        </head>
        <!-- Body -->
        <body>
            <?php include("vCabecalho-interno.html"); ?>
            <div id="divPrincipal">
            <!-- Section -->

            <section id="corpo">
                <!-- Formulário -->
                <form method="post"
                      enctype="application/x-www-form-urlencoded"
                      action="../control/cAdmin-editar.php"
                      name="formUnidade">
                    <!-- Fieldset -->
                    <fieldset align="left">
                        <legend>Alteração de Unidade</legend>
                        <!-- Nome -->
                        <p id="campo" align="center"><label>Nome: <input class="info" type=name name="txtUnidade" value="<?php echo $nomeUnidade; ?>" required></label></p>
                        <input type="hidden" name="idUnidade" value="<?php echo $idUnidade; ?>" />
                        <input type="hidden" name="tipoEdicao" value="editarUnidade" />
                        
                        <p class="botao" align="center">
                            <button name="btAtualizarUnidade">OK</button>
                        </p>

                    </fieldset>
                </form>	
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