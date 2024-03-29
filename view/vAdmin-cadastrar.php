<?php
//Inicializa a sessão
session_start("usuario");

//Verificação de sessão iniciada
if (isset($_SESSION["login"]) and ($_SESSION["senha"])) {

//Inclusão do arquivo de conexão com o banco
    include ("../model/conecta-mi-db.php");

//Incusão do arquivo de validação de formulário
//include ('validacao.js');
//Instaciando a classe de conexao com banco de dados
    $bdMi = new MYSQL_MIDB();
    ?>    

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
            <link href="../resources/css/menu.css" media="screen" rel="stylesheet" type="text/css" />
            <style type="text/css">
                @import url("../resources/css/estilo.css") screen; <!--Design para Desktop -->
            </style>
            <script type="text/javascript" src="../resources/js/jquery-1.3.2.min.js"></script>
            <script type="text/javascript" src="../resources/js/validacao.js">  </script> 

            <!--             Validações 
                        <script src="js/validacao.js"></script>
                         Funções 
                        <script src="js/funcoes.js"></script>-->
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
                    <!-- Formul�rio -->
                    <form method="post" enctype="application/x-www-form-urlencoded" action="../control/cRealiza-cadastro.php" name="formUnidade">
                        <!-- Fieldset -->
                        <fieldset>
                            <legend>Cadastro de Unidade</legend>
                            <!-- Nome -->
                            <p align="center" id="campo"><label>Nome: <input class="info" type="text" name="txtUnidade" autocomplete="off" placeholder="Ex.: Coordenação do Curso de Sistemas de Informação" required></label></p>

                            <p class="botao" align="center"><button name="btCadastrarUnidade">CADASTRAR</button></p>

                        </fieldset>
                    </form>	
                </section>

                <section id="corpo">
                    <!-- Formul�rio -->
                    <form method="post" enctype="application/x-www-form-urlencoded" action="../control/cRealiza-cadastro.php" name="formUsuario" autocomplete="off" onSubmit="return verificaCheckBoxVazio();">
                        <!-- Fieldset -->
                        <fieldset>
                            <legend>Cadastro de Usuário</legend>
                            <!-- Nome -->	
                            <p class="campo"><label>Nome: <input class="info" value="Jeff Winger" type="text" name="txtNome" autocomplete="off" placeholder="Ex.: João José da Silva" required></label></p>
                            <!-- Email -->
                            <p class="campo"><label>Email: <input class="info" value="jeffwinger@greendale.edu" type="text" name="txtEmail" autocomplete="off" placeholder="Ex.: seu_email@ufu.br" required></label></p>
                            <!-- Senha -->
                            <p class="campo"><label>Senha: <input class="info" value="jeffwinger" type=password name="txtSenha" autocomplete="off" placeholder="********" required></label></p>
                            <!-- Titulo -->
                            <p class="campo"><label>Titulo: <input class="info" value="Doutor" type="text" name="txtTitulo" placeholder="Ex.: Doutor, Mestre" required></label></p>
                            <!-- Portaria -->
                            <p class="campo"><label>Portaria: <input class="info" value="123/45" type="text" name="txtPortarira" autocomplete="off" placeholder="Ex.: 987/12" required></label></p>
                            <!-- Cargo -->
                            <p class="campo"><label>Cargo: <input class="info" value="Professor" type="text" name="txtCargo" autocomplete="off" placeholder="Ex.: Professor, Técnico de Laboratório" required></label></p>
                            <!-- Permissão -->
                            <p class="campo"><label>Permissão: <select name="selPermissao">
                                        <option value="admin">Administrador</option>
                                        <option value="user">Usuario</option>
                                    </select></label></p>
                            <!-- Unidade -->
                            <input type="hidden" name="idUnidade" id="idUnidade" value=""/>
                            <input type="hidden" name="nomeUnidade" id="nomeUnidade" value=""/>

                            <div align="center">
                            <p id="teste" class="campo">
                            <fieldset class="fieldsetInterno">
                                <legend>Unidade:</legend>
                                    <table border="0" width="70%">
                                        <?php
                                        //Consulta de unidades do sistema
                                        //Linhas com os resultados do SELECT
                                        $selectUnidades = $bdMi->sql("SELECT * FROM unidade");
                                        if (mysql_num_rows($selectUnidades) > 0) {
                                            $c = 0;
                                            while ($resultadoUnidades = mysql_fetch_array($selectUnidades)) {
                                                if ($c % 2 == 0) {
                                                    ?>
                                                    <tr style="background-color:#E7E7E6;">
                                                        <td><?php echo "<input type=\"checkbox\" name=\"chkUnidade[]\" value=\"$resultadoUnidades[0]\">"; ?></td>
                                                        <td><?php echo "$resultadoUnidades[1]"; ?></td>
                                                    </tr>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo "<input type=\"checkbox\" name=\"chkUnidade[]\" value=\"$resultadoUnidades[0]\">"; ?></td>
                                                        <td><?php echo "$resultadoUnidades[1]"; ?></td>
                                                    </tr>
                                                    <?php
                                                }
                                                $c++;
                                            }
                                        } else {
                                            echo "Não há unidades cadastradas!";
                                        }
                                        ?>
                                    </table>
                            </fieldset>
                                </p>   </div>                                       

                            <p class="botao" align="center"><button name="btCadastrarUsuario">CADASTRAR</button></p>
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