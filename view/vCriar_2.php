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
        
 
            
        <!-- jQuery UI styles -->
<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/dark-hive/jquery-ui.css" id="theme">
<!-- Demo styles -->
<!--<link rel="stylesheet" href="css/demo.css">-->
        <!-- blueimp Gallery styles -->
<!--<link rel="stylesheet" href="http://blueimp.github.io/Gallery/css/blueimp-gallery.min.css">-->
<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
<link rel="stylesheet" href="../resources/jQuery-File-Upload-9.5.6/css/jquery.fileupload.css">
<link rel="stylesheet" href="../resources/jQuery-File-Upload-9.5.6/css/jquery.fileupload-ui.css">
<!-- CSS adjustments for browsers with JavaScript disabled -->
<noscript><link rel="stylesheet" href="../resources/jQuery-File-Upload-9.5.6/css/jquery.fileupload-noscript.css"></noscript>
<noscript><link rel="stylesheet" href="../resources/jQuery-File-Upload-9.5.6/css/jquery.fileupload-ui-noscript.css"></noscript>
            
 <!-- The Templates plugin is included to render the upload/download listings -->
<script src="http://blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="http://blueimp.github.io/JavaScript-Load-Image/js/load-image.min.js"></script>

<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="../resources/jQuery-File-Upload-9.5.6/js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="../resources/jQuery-File-Upload-9.5.6/js/jquery.fileupload.js"></script>
<!-- The File Upload processing plugin -->
<script src="../resources/jQuery-File-Upload-9.5.6/js/jquery.fileupload-process.js"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="../resources/jQuery-File-Upload-9.5.6/js/jquery.fileupload-image.js"></script>
<!-- The File Upload validation plugin -->
<script src="../resources/jQuery-File-Upload-9.5.6/js/jquery.fileupload-validate.js"></script>
<!-- The File Upload user interface plugin -->
<script src="../resources/jQuery-File-Upload-9.5.6/js/jquery.fileupload-ui.js"></script>
<!-- The File Upload jQuery UI plugin -->
<script src="../resources/jQuery-File-Upload-9.5.6/js/jquery.fileupload-jquery-ui.js"></script>
<!-- The main application script -->
<script src="../resources/jQuery-File-Upload-9.5.6/js/main.js"></script>
 
            
            
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
//                        select: function( event, ui ) {
//                            $('#destinatario').val(ui.item.id);
////                            $('#companyid').val(ui.item.compid);
////                            $('#c_address').val(ui.item.address);
////                            $('#c_phone').val(ui.item.phone);
////                            if (ui.item.problematic!=1){
////                                $('#companyautocomplete').removeClass("ui-autocomplete-error");
////                                document.getElementById('Sendbutton').style.display="block";
////                            } else {
////                                $('#companyautocomplete').addClass("ui-autocomplete-error");
////                                document.getElementById('Sendbutton').style.display="none";
////                            }
//                        }
                      });
                    });

   
                    
                    $("#salvaMI").click( function(){
                        var destinatario = $("#txtDestinatario").val();   
                        var referencia = $("#txtReferencia").val();                 
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
                            if( retorno == true )
                            {
                                alert( "Salvo" );
                            }
                            else
                                alert( "Erro ao salvar" );
       
                        });
                        
                        return false;
                    });
                    
                    $("#emiteMI").click( function(){
                        var destinatario = $("#txtDestinatario").val();      
                        var referencia = $("#txtReferencia").val();
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
                            {
                                alert( "Emitido" );
                            }
                            else
                                alert( "Erro ao Emitir" );
       
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
                            
                            <p id="destinatario" class="campo"><label>Destinatário: <input id="txtDestinatario" class="info" type="text" name="txtDestinatario" value="<?php  
                            
                            $selectDestinatario = $bdMi->sql("SELECT titulo, nome, cargo FROM destinatario WHERE idDestinatario ='" . $_GET['destinatario'] . "';");
                             
                            $row = mysql_fetch_row($selectDestinatario);
                            echo $row[0] . " " . $row[1] . ", " . $row[2]; 
                                    ?>" required></label></p>   
                          
                            <p class="campo"><label>Referência: <input id="txtReferencia" class="info" type="text" name="txtReferencia" value="<?php echo $_GET['referencia'] ?>" required></label></p>

                            <p class="campo"><label>Corpo do Memorando Interno: <textarea id="txtCorpo" name="txtCorpo" ><?php echo $_GET['corpo'] ?></textarea></label></p>
                                 
                            <div align="center">
                                <!-- Redirect browsers with JavaScript disabled to the origin page -->
                                <noscript><input type="hidden" name="redirect" value="http://blueimp.github.io/jQuery-File-Upload/"></noscript>
                                <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                            
                                <div class="fileupload-buttonbar">
                                
                                    <div class="fileupload-buttons" >
                                        <!-- The fileinput-button span is used to style the file input field as button -->
                                        <p class="botao">
                                        <span class="fileinput-button">
                                            <span>Add files...</span>
                                            <input type="file" name="files[]"  accept="application/pdf" multiple>
                                        </span>
                                    
                                        <button type="reset" class="cancel">Cancel upload</button>
                                        <button type="button" class="delete">Delete</button>
                                        <input type="checkbox" class="toggle">
                                        </p>
                                        <!-- The global file processing state -->
                                        <span class="fileupload-process"></span>
                                    </div>
                                    
                                    <!-- The global progress state -->
                                    <div class="fileupload-progress fade" style="display:none">
                                        <!-- The global progress bar -->
                                        <div class="progress" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                                        <!-- The extended global progress state -->
                                        <div class="progress-extended">&nbsp;</div>
                                    </div>
                                </div>
                                <!-- The table listing the files available for upload/download -->
                                <table role="presentation"><tbody class="files"></tbody></table>
                           </div>
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
                                    
                                    
                            <p class="campo"><label>Data de Emissão: <input id="data" type="text" name="data"  value="<?php echo $_GET['data'] ?>" required></label></p>
                            

                            <p class="campo"><label>Emissário: 
                                    <select id="selecao" name="selecao" >
                                        <?php
                                           
                                        //Consulta de unidades do sistema
                                        //Linhas com os resultados do SELECT
                                        $selectUnidades = $bdMi->sql("SELECT unidade.idUnidade, unidade.nome FROM unidade, usuario_has_unidade WHERE usuario_has_unidade.idUsuario ='" . $_GET['remetente'] . "' AND usuario_has_unidade.idUnidade = unidade.idUnidade");
                                        if (mysql_num_rows($selectUnidades) > 0) {                          
                                            while ($resultadoUnidades = mysql_fetch_array($selectUnidades)) {
                                                if( $resultadoUnidades[0] == $_GET['emissario'] )
                                                {
                                                    echo "<option value=\"$resultadoUnidades[0]\" selected >$resultadoUnidades[1]</option>";
                                                }
                                                else
                                                {
                                                    echo "<option value=\"$resultadoUnidades[0]\">$resultadoUnidades[1]</option>";
                                                }
                                                         
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