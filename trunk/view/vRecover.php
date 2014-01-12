<!DOCTYPE HTML>
<html lang="pt-br">

    <!-- Header --> 
    <head>
        <!-- Titulo -->
        <title>Sistema de Memorandos Internos</title>
        <!-- Ícone-->
        <link rel="shortcut icon" href="../resources/images/favicon.gif">
        <!-- Charset -->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- CSS -->
        <style type="text/css">
            @import url("../resources/css/estilo.css") screen; <!--Design para Desktop -->
        </style>
    </head>
    <!-- Body -->
    <body>
        <?php include("vCabecalho-externo.html"); ?>
        <div id="divPrincipal">
            <!-- Section -->
            <section id="corpo">
                <form method="post" enctype="application/x-www-form-urlencoded" action="../control/cRecover.php" name="form"> 
                    <fieldset>
                        <legend><b>Redefinição de Senha</b></legend>
                        <p style="padding: 3% 0 2% 0;"><label>Email: <input class="login" type="text" name="txtMail" placeholder="seu_email@ufu.br" required></label></p>
                        <p><button>ENVIAR</button></p>
                    </fieldset>
                </form>
            </section>
        </div>
        <?php include("vRodape.html"); ?>
    </body>
</html>