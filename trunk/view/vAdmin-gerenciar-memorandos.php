<?php
//Inicializa a sessão
session_start("usuario");

//Verificação de sessão iniciada
if (isset($_SESSION["login"]) and ($_SESSION["senha"])) {
?>

<html>
    <head>
      
      <!-- Titulo -->
        <title>Sistema de Memorandos Internos</title>
        <!-- Ícone-->
        <link rel="shortcut icon" href="images/favicon.gif">
        <!-- Charset -->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
         <!--CSS-->
        <style type="text/css">
            @import url("../resources/css/estilo.css") screen; Design para Desktop 
        </style> 
        
        
        
        
        <link href="../resources/jtable.2.3.1/themes/metro/darkgray/jtable.min.css" rel="stylesheet" type="text/css" />
        
        <script src="../resources/js/jquery-1.10.2.min.js" type="text/javascript"></script>

        <script src="../resources/jquery-ui/js/jquery-ui-1.10.4.custom.min.js" type="text/javascript"></script><!--
        <link href="../resources/jquery-ui/css/ui-darkness/jquery-ui-1.10.4.custom.min.css" rel="stylesheet" type="text/css" />
    -->
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">

        
        
        <script src="../resources/jtable.2.3.1/jquery.jtable.min.js" type="text/javascript"></script>
        
        
        
        
        <script type="text/javascript">

                    $(document).ready(function () {
                      
                        var ptbrMessages = {
                                serverCommunicationError: 'Erro ao tentar conexão com o servidor.',
                                loadingMessage: 'Carregando registros...',
                                noDataAvailable: 'Não existem dados a serem exibibos no momento!',
                                addNewRecord: '+ Adicionar novo registro',
                                editRecord: 'Editar registro',
                                areYouSure: 'Você tem certeza ?',
                                deleteConfirmation: 'Este registro será excluido. Confirmar ?',
                                save: 'Salvar',
                                saving: 'Salvando...',
                                cancel: 'Cancelar',
                                deleteText: 'Excluir',
                                deleting: 'Excluindo...',
                                error: 'Erro',
                                close: 'Fechar',
                                cannotLoadOptionsFor: 'Não foi possivel carregar opções para o campo {0}!',
                                pagingInfo: 'Exibindo registros {0} a {1} de {2}',
                                canNotDeletedRecords: 'Não foi possível excluir registro(s) {0} de {1}!',
                                deleteProggress: 'Excluindo {0} de {1} registros, processando...'
                        };
                        
                        //Prepare jTable
                            $('#MiTableContainer').jtable({
                                    messages: ptbrMessages,
                                    title: 'Memorandos',
                                    paging: true,
                                    pageSize: 10,
                                    sorting: true,
                                    defaultSorting: 'idMemorando ASC',
                                    
                                    actions: {
                                               
                                            listAction: '../control/CAdmin-gerenciar-memorandos.php?action=list',   
                                            updateAction: '../control/CAdmin-gerenciar-memorandos.php?action=update',
                                            //createAction: '../control/CAdmin-gerenciar-memorandos.php?action=create',
                                            deleteAction: '../control/CAdmin-gerenciar-memorandos.php?action=delete'
                                            
                                            
                                    },
                                    fields: {
                                            
                                            idMemorando: {
                                                title: 'Número de registro',
                                            
                                                key: true,
						create: false,
						edit: false,
                                                list: true
						
                                            },
                                            
                                            data: {
                                                    title: 'Data',
                                                    type: 'date',
                                                    width: '10%'
                                                    
                                            },
                                            remetente: {
                                                    title: 'Remetente',
                                                    width: '10%',
                                                    options: '../control/GetRemetente.php'
                                                    
                                            },
                                            destinatario: {
                                                    title: 'Destinatário',
                                                    width: '10%',
                                                    options: '../control/GetDestinatario.php'
                                                    
                                            },
                                            emissario: {
                                                    title: 'Emissário',
                                                    width: '10%',
                                                    
                                                    dependsOn: 'remetente',
                                                    
                                    
                                                    options: function (data) {
                                                        if (data.source == 'list') {
                                                            //Return url of all countries for optimization.
                                                            //This method is called for each row on the table and jTable caches options based on this url.
                                                            return '../control/GetEmissarioDependsOnRemetente.php';
                                                        }
        
                                                        //This code runs when user opens edit/create form or changes continental combobox on an edit/create form.
                                                        //data.source == 'edit' || data.source == 'create'
                                                        return '../control/GetEmissarioDependsOnRemetente.php?remetente=' + data.dependedValues.remetente;
                                                    }
                                               
                                            },
                                            referencia: {
                                                    title: 'Referência',
                                                    width: '10%'
                                            },
                                            corpo: {
                                                    title: 'Corpo',
                                                    width: '45%'
                                                   
                                            },
                                            
                                            emitido: {
                                                    title: 'Emitido',
                                                    width: '5%',
                                                    options: { 0: 'Não', 1 : 'Sim' }
                                                   
                                            }
                                                   
                                    }
                            });
 
                            $( "#selectCampo" ).change(function() {
                                
                                
                                if( $('#selectCampo').val() == "data" )
                                {
                                    
                                    $('#pesquisa').datepicker({ dateFormat: 'yy-mm-dd' });
                                }
                                else
                                    $( '#pesquisa' ).datepicker( "destroy" );
                            });
                           
                            
                            $('#LoadRecordsButton').click(function (e) {
                                e.preventDefault();
                            
                                $('#MiTableContainer').jtable('load', {
                                    
                                    pesquisa: $('#pesquisa').val(),
                                    selectCampo: $('#selectCampo').val(),
                                    selectEmitido: $('#selectEmitido').val()
                                });
                            
                                
                                
                            });
                            
                            $('LoadRecordsButton').click();
                            //Load person list from server
                            $('#MiTableContainer').jtable('load');

                            

                    });

            </script>
	
  </head>
  <body>
    
    <?php include("vCabecalho-interno.html"); ?>

    <div id="divPrincipal">
        <div style="padding: 2% 1% 1% 2%; ">
            <form>
                <span style="font-family: 'Segoe UI Semilight', 'Open Sans', Verdana, Arial, Helvetica, sans-serif;font-size: 13px; font-weight: 600;">Pesquisa: </span><input type='text' name='pesquisa' id="pesquisa" style="font-family: 'Segoe UI Semilight', 'Open Sans', Verdana, Arial, Helvetica, sans-serif;font-size: 12px; font-weight: 400;" />
       
                <select id="selectCampo">
                    <option value="">Todos</option>
                    <option value="id">Id</option>
                    <option value="data">Data</option>
                    <option value="remetente">Remetente</option>
                    <option value="destinatario">Destinatário</option>
                    <option value="emissario">Emissário</option>
                    <option value="referencia">Título</option>
                    <option value="corpo">Corpo</option>
                </select>
                
                <select id="selectEmitido">
                    <option value="">Todos</option>
                    <option value="sim">Emitidos</option>
                    <option value="nao">Não Emitidos</option>
                </select>
               <button type="submit" id="LoadRecordsButton" style="font-family: 'Segoe UI Semilight', 'Open Sans', Verdana, Arial, Helvetica, sans-serif;font-size: 13px; font-weight: 600;">Busca</button>
            </form>
            <div id="MiTableContainer" ></div>
        </div>
    </div>
    
    <?php include("vRodape.html"); ?>
      
  </body>
</html>

<?php
} else {
    include("vUsuario-nao-logado.php");
}
?>