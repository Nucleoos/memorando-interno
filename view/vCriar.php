<?php
//Inicializa a sessão
session_start("usuario");

//Verificação de sessão iniciada
if (isset($_SESSION["login"]) and ($_SESSION["senha"])) {
    
    //Inclusão do arquivo de conexão com o banco
    include("../model/conecta-mi-db.php");
    
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
            <link rel="shortcut icon" href="../resources/images/favicon.gif">
            <!-- Charset -->
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <!-- CSS -->
            <link href="../resources/css/menu.css" media="screen" rel="stylesheet" type="text/css" />
            <style type="text/css">
                @import url("../resources/css/estilo.css") screen; Design para Desktop
            </style>
            <script type="text/javascript" src="../resources/js/validacao.js"></script>
            
            <script src="../resources/js/jquery-1.10.2.min.js" type="text/javascript"></script>

        <script src="../resources/jquery-ui/js/jquery-ui-1.10.4.custom.min.js" type="text/javascript"></script>

<!--            <script src="../resources/js/jquery-1.6.4.min.js" type="text/javascript"></script>
            <script src="../resources/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
            -->
            <!-- TinyMCE -->
   
            <script type="text/javascript" src="../resources/jQuery-TE_v.1.4.0/jquery-te-1.4.0.min.js"></script>
             <link rel="stylesheet" href="../resources/jQuery-TE_v.1.4.0/jquery-te-1.4.0.css">

            
             <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">

        <script src="../resources/jquery-ui/js/jquery-ui-1.10.4.custom.min.js" type="text/javascript"></script>
       
        
        


<!-- The basic File Upload plugin -->
<script src="../resources/jQuery-File-Upload-9.5.6/js/jquery.fileupload.js"></script>





            
            
            <script type="text/javascript">
                
                $(document).ready(function(){
                    $('#fileupload').fileupload({
                        autoUpload: true
                    });
                    
                    $("textarea").jqte();
                    $('#data').datepicker({ dateFormat: 'yy-mm-dd' });
                    $('#destinatariohidden').hide();
                
             
                    $(function() {
                        function split( val ) {
                        return val.split( /,\s*/ );
                        }
                        function extractLast( term ) {
                        return split( term ).pop();
                        }

                        $( "#txtDestinatario" )
                        // don't navigate away from the field on tab when selecting an item
                        .bind( "keydown", function( event ) {
                        if ( event.keyCode === $.ui.keyCode.TAB &&
                        $( this ).data( "autocomplete" ).menu.active ) {
                        event.preventDefault();
                        }
                        })
                        .autocomplete({
                        source: function( request, response ) {
                            $.getJSON( "../control/autocomplete.php",{
                                term: extractLast( request.term )},
                                function( data ) {
                                response( $.map( data, function( item ) {
                                      return {
                                            id: item.id,
                                            //label: item.nomeUsuario + ", " + item.nomeUnidade,
                                            value: item.titulo + " " + item.nome + ", " + item.cargo              
                                      }
                                }));
                            }
                        );
                        },
                        search: function() {
                            // custom minLength
                            var term = extractLast(this.value);
                            if (term.length < 1) {
                                return false;
                            }
                        },
                        focus: function() {
                            // prevent value inserted on focus
                            return false;
                        }

                      });
                    });

   
                    
                    $("#salvaMI").click( function(){
                        
                        
                        var destinatario = $("#txtDestinatario").val();   
                        var referencia = $("#txtReferencia").val();                 
                        //tinymce.triggerSave();
                        var corpo = $("#txtCorpo").val();
                        var data = $("#data").val();
                        var selecao = $("#selecao").val();
                        var numeroMemorando = <?php echo $_SESSION["numeroMemorando"];?>;
                        
                        $.post("../control/cSalva-mi.php",
                        {
                            destinatario: destinatario,
                            referencia: referencia,
                            corpo: corpo,
                            data: data,
                            emissario: selecao,
                            numeroMemorando: numeroMemorando
                        },
                        function( retorno ){             
                            
                           alert( retorno );
                            
                            
                        });
                        
                        return false;
                    });
                    
                    
                    $("#emiteMI").click( function(){
                        var destinatario = $("#txtDestinatario").val();      
                        var referencia = $("#txtReferencia").val();
                        //tinymce.triggerSave();
                        var corpo = $("#txtCorpo").val();
                        var data = $("#data").val();
                        var selecao = $("#selecao").val();
                        var numeroMemorando = <?php echo $_SESSION["numeroMemorando"];?>;
                        
                        $.post("../control/cEmite-mi.php",
                        {
                            destinatario: destinatario,
                            referencia: referencia,
                            corpo: corpo,
                            
                            data: data,
                            emissario: selecao,
                            numeroMemorando: numeroMemorando
                        },
                        function( retorno ){
                            if( retorno )
                                alert( "Emitido." );
                            else
                                alert( "Erro ao emitir" );
 
                        });
                        
                        return false;
                        
                    });
                    
                });
                
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
                    <form id="fileupload"  method="POST" enctype="multipart/form-data">

                        <!-- Fieldset -->
                        <fieldset>
                              
                            <legend>Criação de Memorando Interno</legend>                             
                            
                            
                            <p id="destinatario" class="campo"><label>Destinatário: <input id="txtDestinatario" class="info" type="text" name="txtDestinatario" required></label></p>   
                          
                            <p class="campo"><label>Referência: <input id="txtReferencia" class="info" type="text" name="txtReferencia" required></label></p>
                        
                            <p class="campo"><label>Corpo do Memorando Interno: <textarea id="txtCorpo" name="txtCorpo"></textarea></label></p>
                                       
                            <!-- The file upload form used as target for the file upload widget -->
                            
                            
                           <!-- The template to display files available for upload -->
                            <script id="template-upload" type="text/x-tmpl">
                            {% for (var i=0, file; file=o.files[i]; i++) { %}
                                <tr class="template-upload fade">
                                    <td>
                                        <span class="preview"></span>
                                    </td>
                                    <td>
                                        <p class="name">{%=file.name%}</p>
                                        <strong class="error"></strong>
                                    </td>
                                    <td>
                                        <p class="size">Processing...</p>
                                        <div class="progress"></div>
                                    </td>
                                    <td>
                                        {% if (!i && !o.options.autoUpload) { %}
                                            <button class="start" disabled>Start</button>
                                        {% } %}
                                        {% if (!i) { %}
                                            <button class="cancel">Cancel</button>
                                        {% } %}
                                    </td>
                                </tr>
                            {% } %}
                            </script>
                            <!-- The template to display files available for download -->
                            <script id="template-download" type="text/x-tmpl">
                            {% for (var i=0, file; file=o.files[i]; i++) { %}
                                <tr class="template-download fade">
                                    <td>
                                        <span class="preview">
                                            {% if (file.thumbnailUrl) { %}
                                                <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                                            {% } %}
                                        </span>
                                    </td>
                                    <td>
                                        <p class="name">
                                            <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                                        </p>
                                        {% if (file.error) { %}
                                            <div><span class="error">Error</span> {%=file.error%}</div>
                                        {% } %}
                                    </td>
                                    <td>
                                        <span class="size">{%=o.formatFileSize(file.size)%}</span>
                                    </td>
                                    <td>
                                        <button class="delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>Delete</button>
                                        <input type="checkbox" name="delete" value="1" class="toggle">
                                    </td>
                                </tr>
                            {% } %}
                            </script>
                            

                            <p class="campo"><label>Data de Emissão: <input id="data" type="text" name="data"  required></label></p>
                           
                            <p class="campo"><label>Emissário:
                                    <select id="selecao" name="selecao">
                                        <?php
                                        
                                        $usuario = $_SESSION["login"];
   
                                        $resultado = $bdMi->sql("SELECT idUsuario FROM usuario WHERE emailInstitucional = '$usuario'");
                                        $idUsuario = mysql_result($resultado, 0, 'idUsuario');
                                        //Consulta de unidades do sistema
                                        //Linhas com os resultados do SELECT
                                        $selectUnidades = $bdMi->sql("SELECT unidade.idUnidade, unidade.nome FROM unidade, usuario_has_unidade WHERE $idUsuario = usuario_has_unidade.idUsuario AND usuario_has_unidade.idUnidade = unidade.idUnidade");
                                        if (mysql_num_rows($selectUnidades) > 0) {                          
                                            while ($resultadoUnidades = mysql_fetch_array($selectUnidades)) {
                                                echo "<option value=\"$resultadoUnidades[0]\">$resultadoUnidades[1]</option>";         
                                            }
                                        } else {
                                            echo "Não há unidades cadastradas!";
                                        }
                                        ?>
                                    </select></label>
                            </p>
                            
                            <p class="botao" align="center">
                                <button type="submit" formaction="../control/cVisualiza-mi.php" formtarget="_blank">VISUALIZAR</button>
                                <button id="salvaMI" type="submit">SALVAR</button>
                                <button id="emiteMI" type="submit" >EMITIR</button>
                            </p>
                            
                        </fieldset>
                    </form>﻿  
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