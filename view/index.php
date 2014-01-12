<?php 
session_start("usuario");
if(!(isset($_SESSION['login']) and isset($_SESSION['senha']))){
?>
<!DOCTYPE HTML>
<html lang="pt-br">

    <!-- Header --> 
    <head>
        <!-- Titulo -->
        <title>Sistema de Memorandos Internos</title>
        <!-- Ícone-->
        <link rel="shortcut icon" href="resources/images/favicon.gif">
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
                <form name="formLogin" method="post" enctype="application/x-www-form-urlencoded" action="../control/cLogin.php"> 
                    <fieldset>
                        <legend>Login</legend>
                        <div id="menuLogin" align="center">
                            <table border="0" width="70%" style="font-size: 20px;">
                                <tr>
                                    <td align="right" width="30%" style="padding-right: 5px; height: 50px;">Login: </td>
                                    <td align="left" width="70%" style="padding-left: 5px; height: 50px;"><input class="login" type="text" name="txtUsuarioLogin" placeholder="compadrewashington@ufu.br" required></td>
                                </tr>
                                <tr>
                                    <td align="right" style="padding-right: 5px; height: 50px;">Senha: </td>
                                    <td align="left" style="padding-left: 5px; height: 50px;"><input class="login" type="password" name="txtSenhaLogin" placeholder="********" required></td>
                                </tr>
<!--                                <tr>
                                    <td>&nbsp</td>
                                    <td align="left" style="padding-left: 5px;"><input type="checkbox" class="checkboxLogin" name="manterConectado" />Mantenha-me conectado</td>
                                </tr>-->
                                <tr>
                                    <td></td>
                                    <td align="left" style="padding-left: 5px; height:  50px;"><span id="recover" ><a href="vRecover.php">Esqueci minha senha</a></span></td>
                                </tr>                                
                            </table>

                            <p><button>ENTRAR</button></p>
                        </div>

                    </fieldset>
                </form>
            </section>

        </div>
        <?php include("vRodape.html"); ?>
    </body>
</html>
<?php 
} else {
    header("Location: vMain.php");
}
?>