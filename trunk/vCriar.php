<?php
//Inicializa a sessão
session_start("usuario");

//Verificação de sessão iniciada
if (isset($_SESSION["login"]) and ($_SESSION["senha"])) {
    
    //Inclusão do arquivo de conexão com o banco
    include("conecta-mi-db.php");
    
    $bdMi = new MYSQL_MIDB();
    
    //$resultadoSelectUnidadesUsuario = $bdMi->sql("SELECT nome FROM unidade WHERE ");
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
            <!-- CSS -->
            <link href="menu.css" media="screen" rel="stylesheet" type="text/css" />
            <style type="text/css">
                @import url("estilo.css") screen; Design para Desktop 
            </style>
            <script type="text/javascript" src="js/validacao.js"></script>
            
            <!-- TinyMCE -->
            <script type="text/javascript" src="tinymce/tinymce.min.js"></script>
            
            <script type="text/javascript">
                tinymce.init({
                    selector: "textarea"
                 });
            </script>
            
            <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
            <script type="text/javascript">
                
                $(document).ready(function(){
                    
                    $("#salvaMI").click( function(){
                        var destinatario = $("#txtDestinatario").val();
                        var cargo = $("#txtCargo").val();
                        var referencia = $("#txtReferencia").val();
                        var titulo = $("#txtTitulo").val();
                        tinymce.triggerSave();
                        var corpo = $("#txtCorpo").val();
                        var data = $("#data").val();
                        var selecao = $("#selecao").val();
                        
                        $.post("cSalva-mi(copia).php", 
                        { 
                            destinatario: destinatario,
                            cargo: cargo,
                            referencia: referencia,
                            titulo: titulo,
                            corpo: corpo,
                            data: data,
                            selecao: selecao
                        }, 
                        function( retorno ){
                           
                            if( retorno )
                            {
                                alert( "Salvo" );
                            }
                            else
                                alert( "Erro ao salvar" );
       
                        })
                        
                        return false;
                    })
                    
                })
                
            </script>    
            
            <!-- /TinyMCE -->
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
                    <form id="formMemorando" method="post">
                        <!-- Fieldset -->
                        <fieldset>

                            <legend>Criação de Memorando Interno</legend>

                            <p class="campo"><label>Destinatário: <input id="txtDestinatario" class="info" type="text" name="txtDestinatario" value="luiz" required></label></p>

                            <p class="campo"><label>Cargo: <input id="txtCargo" class="info" type="text" name="txtCargo" value="gerente" required></label></p>

                            <p class="campo"><label>Referência: <input id="txtReferencia" class="info" type="text" name="txtReferencia" value="lindo" required></label></p>

                            <p class="campo"><label>Título: <input id="txtTitulo" class="info" type="text" name="txtTitulo" value="ola gato" required></label></p>


                            <p class="campo"><label>Corpo do Memorando Interno: <textarea id="txtCorpo" rows="30" cols="90" name="txtCorpo"></textarea></label></p>

                            <p class="campo"><label>Data de Emissão: <input id="data" type="date" name="data" value="2013-10-10" required></label></p>

                            <p class="campo"><label>Emissário: <select id="selecao" name="selecao"></select></label></p>
                            
                            <p class="botao" align="center">
                                <button type="submit" formaction="cVisualiza-mi.php" formtarget="_blank">VISUALIZAR</button>
                                <button id="salvaMI" type="submit">SALVAR</button>
                                <button type="submit" formaction="cGera-mi.php" >EMITIR</button>
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