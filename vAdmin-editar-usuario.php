<?php
//Inicializa a sessão
session_start("usuario");

//Verificação de sessão iniciada
if (isset($_SESSION["login"]) and ($_SESSION["senha"])) {

    //Inclusão do arquivo de conexão com o banco
    include ("conecta-mi-db.php");

    //Instaciando a classe de conexao com banco de dados
    $bdMi = new MYSQL_MIDB();

    //Recebimento da variável com nome do usuário
    $idUsuario = $_POST['idUsuario'];
    $txtNome = $_POST['txtNome'];
    $txtTitulo = $_POST['txtTitulo'];
    $txtCargo = $_POST['txtCargo'];
    $txtPortaria = $_POST['txtPortaria'];
    $selPermissao = $_POST['selPermissao'];
    $txtEmail = $_POST['txtEmail'];

    //Consulta de unidades vinculadas a determinado usuário no sistema
    $selectUnidadesUsuario = $bdMi->sql("SELECT un.idUnidade, un.nome FROM usuario_has_unidade us, unidade un WHERE us.idUsuario = '$idUsuario' AND us.idUnidade = un.idUnidade");

    //Consulta de unidades do sistema
    $selectUnidades = $bdMi->sql("SELECT * FROM unidade");
    ?>

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
            <!-- Ícone-->
            <link rel="shortcut icon" href="imagens/favicon.gif">
            <!-- CSS -->
            <style type="text/css">
                @import url("estilo.css") screen; <!--Design para Desktop -->
            </style>
            <script type="text/javascript" src="js/validacao.js"></script>
            <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
            <script type="text/javascript" src="js/funcoes.js"></script>
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
                          action="cAdmin-editar.php"
                          name="formUsuario"
                          onSubmit="return checaUnidadeSelecionada();">
                        <!-- Fieldset -->
                        <fieldset align="left">
                            <legend>Alteração de Usuário</legend>

                            <!-- ID -->
                            <input type="hidden" name="idUsuario" value="<?php echo $idUsuario; ?>" />
                            <!-- Nome -->	
                            <p align="center" id="campo"><label>Nome: <input class="info" type=name name="txtNome" value="<?php echo $txtNome; ?>" required></label></p>
                            <!-- Email -->
                            <p align="center" id="campo"><label>Email: <input class="info" type=mail name="txtEmail" value="<?php echo $txtEmail; ?>" required></label></p>
                            <!-- Titulo -->
                            <p align="center" id="campo"><label>Titulo: <input class="info" type=name name="txtTitulo" value="<?php echo $txtTitulo; ?>" required></label></p>
                            <!-- Portaria -->
                            <p align="center" id="campo"><label>Portaria: <input class="info" type=name name="txtPortarira" value="<?php echo $txtPortaria; ?>" required></label></p>
                            <!-- Cargo -->
                            <p align="center" id="campo"><label>Cargo: <input class="info"type=name name="txtCargo" value="<?php echo $txtCargo; ?>" required></label></p>
                            <!-- Permissão -->
                            <p align="center" id="campo" ><label>Permissão: <select name="selPermissao" required>
                                        <option value="admin" <?php if ($selPermissao == "admin") {
            echo "selected = \"selected\"";
        } ?> >Administrador</option>
                                        <option value="user" <?php if ($selPermissao == "user") {
            echo "selected = \"selected\"";
        } ?>>Usuario</option>
                                    </select>
                                </label>
                            </p>
                            <!-- Unidade -->
                            <p><label>Unidade:</label></p>
                            <div id="preencheUnidade">
                                <table border="1" width="100%">
                                    <?php
                                    $colorCounter = 1;
                                    while ($resultadoSelectUnidadesUsuario = mysql_fetch_array($selectUnidadesUsuario)) {
                                        ?>
                                        <tr <?php
                                if ($colorCounter % 2 == 0) {
                                    echo "style=\"background-color:#E7E7E6;\"";
                                }
                                ?>>
                                            <td>
                                                <div id="selectUnidade">
                                                    <p>
                                                        <label>Unidade: <select name="selUnidade" required>
                                                                <option value="0">--</option>
                                                                <?php
                                                                if (mysql_num_rows($selectUnidades) > 0) {
                                                                    $c = 1;
                                                                    while ($resultadoUnidades = mysql_fetch_array($selectUnidades)) {
                                                                        if ($resultadoUnidades[0] == $resultadoSelectUnidadesUsuario[0]) {
                                                                            echo "<option value = '$c' selected = \"selected\"> $resultadoUnidades[1]</option>";
                                                                            $c++;
                                                                        } else {
                                                                            echo "<option value = '$c'> $resultadoUnidades[1]</option>";
                                                                            $c++;
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </label>
                                                    </p>
                                                </div>
                                            </td>
                                            <td>
                                                <a onClick="" href="#" title="Excluir"><img src="imagens\delete.png"></a>
                                            </td>
                                        </tr>
        <?php
        $colorCounter++;
    }
    ?>
                                </table>
                            </div>

                            <input type="hidden" name="idUsuario" value="<?php echo $idUsuario; ?>" />
                            <input type="hidden" name="tipoEdicao" value="editarUsuario" />

                            <p style="padding: 2% 0 0 2%;"><button name="acrescentarUnidade" onClick="acrescentarUnidade();" />Acrescentar Unidade</button></p>                        
                            <p class="botao" align="center"><button name="btAtualizarUsuario">OK</button></p>
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