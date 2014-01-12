<?php
//Inicializa a sessão
session_start("usuario");

//Verificação de sessão iniciada
if (isset($_SESSION["login"]) and ($_SESSION["senha"])) {

    //Inclusão do arquivo de conexão com o banco
    include ("../model/conecta-mi-db.php");

    //Instaciando a classe de conexao com banco de dados
    $bdMi = new MYSQL_MIDB();
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
            <!-- Biblioteca jQuery -->
            <script type="text/javascript" src="../resources/js/jquery-1.6.4.min.js"></script>
            <!-- Inclusão do arquivo de validações -->
            <script src="../resources/js/validacao.js"></script>
        </head>
        <!-- Body -->
        <body>
            <?php include("vCabecalho-interno.html"); ?>
            <div id="divPrincipal">
                <!-- Section -->

                <section id="corpo">
                    <!-- Formulário de Unidade-->

                    <!-- Fieldset -->
                    <fieldset align="left">
                        <legend>Unidades cadastradas</legend>
                        <!-- Unidades -->
                        <form name="formUnidade" id="formUnidade" action="vAdmin-editar-unidade.php" enctype="application/x-www-form-urlencoded" method="post">
                            <table border="0" align="center" width="100%">
                                <tr>
                                    <!-- Linha com o título -->
                                    <td><strong>Unidade</strong></td>
                                </tr>
                                <input type="hidden" name="idUnidade" id="idUnidade" value=""/>
                                <input type="hidden" name="nomeUnidade" id="nomeUnidade" value=""/>
                                <?php
                                //Consulta de unidades do sistema
                                //Linhas com os resultados do SELECT
                                $selectUnidades = $bdMi->sql("SELECT * FROM unidade");
                                if (mysql_num_rows($selectUnidades) > 0) {
                                    $c = 1;
                                    while ($resultadoUnidades = mysql_fetch_array($selectUnidades)) {
                                        if ($c % 2 != 0) {
                                            ?>
                                            <tr style="background-color:#E7E7E6;">
                                                <td><?php echo $resultadoUnidades[1]; ?></td>
                                                <td align="center" width="4%"><a onClick="encaminhaUnidade(<?php echo $resultadoUnidades[0]; ?>, <?php echo "'" . $resultadoUnidades[1] . "'"; ?>);" href="#" title="Editar"><img src="../resources/images/edit.png"></a></td>
                                                <td align="center" width="4%"><a onClick="confirmaDeletaUnidade(<?php echo $resultadoUnidades[0]; ?>);" href="#" title="Excluir"><img src="../resources/images/delete.png"></a></td>
                                            </tr>
                                            <?php
                                            $c++;
                                        } else {
                                            ?>  
                                            <tr>
                                                <td><?php echo $resultadoUnidades[1]; ?></td>
                                                <td align="center" width="4%"><a onClick="encaminhaUnidade(<?php echo $resultadoUnidades[0]; ?>, <?php echo "'" . $resultadoUnidades[1] . "'"; ?>);" href="#" title="Editar"><img src="../resources/images/edit.png"></a></td>
                                                <td align="center" width="4%"><a onClick="confirmaDeletaUnidade(<?php echo $resultadoUnidades[0]; ?>);" href="#" title="Excluir"><img src="../resources/images/delete.png"></a></td>
                                            </tr>
                                            <?php
                                            $c++;
                                        }
                                    }
                                }
                                ?>
                                <br>
                            </table>
                        </form>
                    </fieldset>
                </section>

                <section id="corpo">
                    <!-- Formulário de Usuário-->
                    <form name="formUsuario" id="formUsuario" action="vAdmin-editar-usuario.php" enctype="application/x-www-form-urlencoded" method="post">
                        <!-- Fieldset -->
                        <fieldset align="left">
                            <legend>Usuários cadastrados</legend>
                            <!-- Usuários no sistema -->
                            <table border="0" align="center" width="100%">
                                <br>
                                <!-- Linha com os títulos -->
                                <tr>
                                    <td><strong>Nome</strong></td>
                                    <td><strong>Título</strong></td>
                                    <td><strong>Cargo</strong></td>
                                    <td><strong>Portaria</strong></td>
                                    <td><strong>Permissão</strong></td>
                                    <td><strong>E-mail Institucional</strong></td>
                                </tr>
                                <input type="hidden" name="idUsuario" id="idUsuario" value=""/>
                                <input type="hidden" name="txtNome" id="txtNome" value=""/>
                                <input type="hidden" name="txtEmail" id="txtEmail" value=""/>
                                <input type="hidden" name="txtSenha" id="txtSenha" value=""/>
                                <input type="hidden" name="txtTitulo" id="txtTitulo" value=""/>
                                <input type="hidden" name="txtPortaria" id="txtPortaria" value=""/>
                                <input type="hidden" name="txtCargo" id="txtCargo" value=""/>
                                <input type="hidden" name="selPermissao" id="selPermissao" value=""/>
                                <?php
                                //Consulta de usuários do sistema
                                //Linhas com os resultados do SELECT
                                $selectUsuarios = $bdMi->sql("SELECT * FROM usuario");
                                if (mysql_num_rows($selectUsuarios) > 0) {
                                    $c = 1;
                                    while ($resultadoUsuarios = mysql_fetch_array($selectUsuarios)) {
                                        if ($c % 2 != 0) {
                                            ?>
                                            <tr style="background-color:#E7E7E6;">
                                                <td><?php echo $resultadoUsuarios[1]; ?></td>
                                                <td><?php echo $resultadoUsuarios[2]; ?></td>
                                                <td><?php echo $resultadoUsuarios[3]; ?></td>
                                                <td><?php echo $resultadoUsuarios[4]; ?></td>
                                                <td><?php echo $resultadoUsuarios[5]; ?></td>
                                                <td><?php echo $resultadoUsuarios[6]; ?></td>
                                                <td align="center" width="4%">
                                                    <a onClick="encaminhaUsuario(<?php echo $resultadoUsuarios[0]; ?>, 
                                                    <?php echo "'" . $resultadoUsuarios[1] . "'"; ?>,
                                                    <?php echo "'" . $resultadoUsuarios[2] . "'"; ?>,
                                                    <?php echo "'" . $resultadoUsuarios[3] . "'"; ?>,
                                                    <?php echo "'" . $resultadoUsuarios[4] . "'"; ?>,
                                                    <?php echo "'" . $resultadoUsuarios[5] . "'"; ?>,
                                                       <?php echo "'" . $resultadoUsuarios[6] . "'"; ?>);" 
                                                       href="#" title="Editar">
                                                        <img src="../resources/images/edit.png">
                                                    </a>
                                                </td>
                                                <td align="center" width="4%"><a onClick="confirmaDeletaUsuario(<?php echo "'" . $resultadoUsuarios[0] . "'"; ?>);" href="#" title="Excluir"><img src="../resources/images/delete.png"></a></td>
                                            </tr>
                                            <?php
                                            $c++;
                                        } else {
                                            ?>
                                            <tr>
                                                <td><?php echo $resultadoUsuarios[1]; ?></td>
                                                <td><?php echo $resultadoUsuarios[2]; ?></td>
                                                <td><?php echo $resultadoUsuarios[3]; ?></td>
                                                <td><?php echo $resultadoUsuarios[4]; ?></td>
                                                <td><?php echo $resultadoUsuarios[5]; ?></td>
                                                <td><?php echo $resultadoUsuarios[6]; ?></td>
                                                <td align="center" width="4%">
                                                    <a onClick="encaminhaUsuario(<?php echo $resultadoUsuarios[0]; ?>, 
                                                    <?php echo "'" . $resultadoUsuarios[1] . "'"; ?>,
                                                    <?php echo "'" . $resultadoUsuarios[2] . "'"; ?>,
                                                    <?php echo "'" . $resultadoUsuarios[3] . "'"; ?>,
                                                    <?php echo "'" . $resultadoUsuarios[4] . "'"; ?>,
                                                    <?php echo "'" . $resultadoUsuarios[5] . "'"; ?>,
                                                       <?php echo "'" . $resultadoUsuarios[6] . "'"; ?>);" 
                                                       href="#" title="Editar">
                                                        <img src="../resources/images/edit.png">
                                                    </a>
                                                </td>
                                                <td align="center" width="4%"><a onClick="confirmaDeletaUsuario(<?php echo "'" . $resultadoUsuarios[0] . "'"; ?>);" href="#" title="Excluir"><img src="../resources/images/delete.png"></a></td>
                                            </tr>
                                            <?php
                                            $c++;
                                        }
                                    }
                                }
                                ?>
                            </table>
                            <br>
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