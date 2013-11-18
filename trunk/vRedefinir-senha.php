<!DOCTYPE HTML>
<html lang="pt-br">

    <!-- Header --> 
    <head>
        <!-- Titulo -->
        <title>Sistema de Memorandos Internos</title>
        <!-- Ícone-->
        <link rel="shortcut icon" href="imagens/favicon.gif">
        <!-- Charset -->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- CSS -->
        <style type="text/css">
            @import url("estilo.css") screen; <!--Design para Desktop -->
        </style>
    </head>
    <!-- Body -->
    <body>
        <?php include("vCabecalho-externo.html"); ?>
        <div id="divPrincipal">
            <section id="corpo">
                <form method="post" enctype="application/x-www-form-urlencoded" action="cRedefinir-senha.php" name="form"> 
                    <fieldset>
                        <legend><b>Redefinição de Senha</b></legend>
                        <div id="menuLogin" align="center">
                            <table border="0" width="70%" style="font-size: 20px;">
                                <tr>
                                    <td align="right" width="30%" style="padding-right: 5px; height: 50px;">Nova senha: </td>
                                    <td align="left" width="70%" style="padding-left: 5px; height: 50px;"><input class="login" type="password" name="txtSenha" placeholder="********" required></td>
                                </tr>
                                <tr>
                                    <td align="right" style="padding-right: 5px; height: 50px;">Confirme a nova senha: </td>
                                    <td align="left" style="padding-left: 5px; height: 50px;"><input class="login" type="password" name="txtRepeteSenha" placeholder="********" required></td>
                                </tr>
                            </table>

                            <p><button>ENVIAR</button></p>
                        </div>
                    </fieldset>
                </form>
            </section>
        </div>
        <?php include("vRodape.html"); ?>
    </body>
</html>