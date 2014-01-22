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
        

        
        <link href="../resources/jtable/themes/metro/darkgray/jtable.css" rel="stylesheet" type="text/css" />
        <script src="../resources/js/jquery-1.6.4.min.js" type="text/javascript"></script>
        <script src="../resources/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
        
        <script src="../resources/jtable/jquery.jtable.js" type="text/javascript"></script>
        
        

	<link href="../resources/jtable/themes/redmond/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css" />
	
        


        
        
        
        <script type="text/javascript">

                    $(document).ready(function () {

                        //Prepare jTable
                            $('#MiTableContainer').jtable({
                                    title: 'Memorandos',
                                    paging: true,
                                    pageSize: 10,
                                    sorting: true,
                                    defaultSorting: 'data ASC',
                                    
                                    actions: {
                                            
                                            listAction: '../control/cConsultar-usuario-memorando.php?action=list',   

                                            deleteAction: '../control/cConsultar-usuario-memorando.php?action=delete'
                                            
                                            
                                    },
                                    fields: {
                                            
                                            idMemorando: {
                                                key: true,
						create: false,
						edit: false,
						list: false
                                            },
                                            
                                            data: {
                                                    title: 'Data',
                                                    type: 'date',
                                                    width: '10%'
                                                    
                                            },
                                            remetente: {
                                                    title: 'Remetente',
                                                    width: '10%'
                                                    
                                            },
                                            destinatario: {
                                                    title: 'Destinatário',
                                                    width: '10%'
                                                    
                                            },
                                            referencia: {
                                                    title: 'Titulo',
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
                                                   
                                            },
                                             
                                            EditLinkColumn: {
                                                
                                                sorting: false,
                                                display: function (data) {

                                                     var argumentos = "idMemorando=" + data.record.idMemorando + "&data=" + data.record.data + "&remetente=" + data.record.remetente + "&destinatario=" + data.record.destinatario + "&titulo=" + data.record.titulo + "&corpo=" + data.record.corpo;
                                                     return '<a href="vCriar_2.php?' + argumentos + '"><img alt="edit icon" src="../resources/jtable/themes/metro/edit.png"></a>';
                                                      
                                                 }
                                                
                                                
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
                    <option value="data">Data</option>
                    <option value="remetente">Remetente</option>
                    <option value="destinatario">Destinatário</option>
                    <option value="titulo">Título</option>
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