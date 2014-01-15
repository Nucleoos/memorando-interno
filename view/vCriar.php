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
            
            <!-- TinyMCE -->
            <script type="text/javascript" src="../resources/tinymce/tinymce.min.js"></script>
            
             <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">

        <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
            
            <script type="text/javascript">
                tinymce.init({
                    selector: "textarea"
                 });
            </script>
            <script src="../resources/js/jquery-1.6.4.min.js" type="text/javascript"></script>
            <script src="../resources/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
            
            <script type="text/javascript">
                
                $(document).ready(function(){
                    
                    $('#data').datepicker({ dateFormat: 'yy-mm-dd' });
             
                    $(function() {
                        function split( val ) {
                        return val.split( /,\s*/ );
                        }
                        function extractLast( term ) {
                        return split( term ).pop();
                        }

                        $( "#autocomplete" )
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
                                            label: item.nomeUsuario + ", " + item.nomeUnidade,
                                            value: item.nomeUsuario                  
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
                        },
//                        select: function( event, ui ) {
//                            $('#companyautocomplete').val(ui.item.value);
//                            $('#companyid').val(ui.item.compid);
//                            $('#c_address').val(ui.item.address);
//                            $('#c_phone').val(ui.item.phone);
//                            if (ui.item.problematic!=1){
//                                $('#companyautocomplete').removeClass("ui-autocomplete-error");
//                                document.getElementById('Sendbutton').style.display="block";
//                            } else {
//                                $('#companyautocomplete').addClass("ui-autocomplete-error");
//                                document.getElementById('Sendbutton').style.display="none";
//                            }
//                        }
                      });
                    });

                    $("#txtUnidadeDestinatario").live('change', function(){
                        
                        var idUnidade = $("#txtUnidadeDestinatario").val();
                        if( idUnidade == "default" )
                        {
                            $("#destinatario").hide();
                        }
                        else
                        {
                            
                            $.post("../control/SelectUnidades.php", 
                            {
                                idUnidade: idUnidade
                            }, 
                            function (data) {
                                // console.log(data);
                                // jQuery will convert the string "['foo', 'bar', 'blah', 'baz']" into a JavaScript object
                                // (an array in this case) and pass as the first parameter
                                    $("#txtDestinatario").empty();
    
                                    for(var i = 0; i < data.length; i++) {
                                    
                                    $("#txtDestinatario").append( "<option value=" + data[i][0] + ">" + data[i][1] + "</option>" );
                                }
                            }, "json");
                            
                            $("#destinatario").show();
                        }
                   
        
                    });
                    
                    $("#salvaMI").click( function(){
                        var destinatario = $("#txtDestinatario").val();
                        var cargo = $("#txtCargo").val();
                        var referencia = $("#txtReferencia").val();
                        var titulo = $("#txtTitulo").val();
                        tinymce.triggerSave();
                        var corpo = $("#txtCorpo").val();
                        var data = $("#data").val();
                        var selecao = $("#selecao").val();
                        var numeroMemorando = <?php echo $_SESSION["numeroMemorando"];?>;
                        
                        $.post("../control/cSalva-mi.php", 
                        { 
                            destinatario: destinatario,
                            cargo: cargo,
                            referencia: referencia,
                            titulo: titulo,
                            corpo: corpo,
                            data: data,
                            selecao: selecao,
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
                        var cargo = $("#txtCargo").val();
                        var referencia = $("#txtReferencia").val();
                        var titulo = $("#txtTitulo").val();
                        tinymce.triggerSave();
                        var corpo = $("#txtCorpo").val();
                        var data = $("#data").val();
                        var selecao = $("#selecao").val();
                        var numeroMemorando = <?php echo $_SESSION["numeroMemorando"];?>;
                        
                        $.post("../control/cEmite-mi.php", 
                        { 
                            destinatario: destinatario,
                            cargo: cargo,
                            referencia: referencia,
                            titulo: titulo,
                            corpo: corpo,
                            data: data,
                            selecao: selecao,
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
                    <form id="formMemorando" method="post">
                        <!-- Fieldset -->
                        <fieldset>
                              
                            <legend>Criação de Memorando Interno</legend>                             
                            
                            <p id="destinatario" class="campo"><label>Destinatário: <input id="autocomplete" class="info" type="text" required></label></p>

                            <p class="campo"><label>Cargo: <input id="txtCargo" class="info" type="text" name="txtCargo" value="gerente" required></label></p>

                            <p class="campo"><label>Referência: <input id="txtReferencia" class="info" type="text" name="txtReferencia" value="lindo" required></label></p>

                            <p class="campo"><label>Título: <input id="txtTitulo" class="info" type="text" name="txtTitulo" value="ola gato" required></label></p>


                            <p class="campo"><label>Corpo do Memorando Interno: <textarea id="txtCorpo" rows="30" cols="90" name="txtCorpo"></textarea></label></p>

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