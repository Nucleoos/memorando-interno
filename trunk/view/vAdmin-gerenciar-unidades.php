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
                            $('#UnidadeTableContainer').jtable({
                                    title: 'Unidades',
                                    paging: true,
                                    pageSize: 10,
                                    sorting: true,
                                    defaultSorting: 'idUnidade ASC',
                                    
                                    actions: {
                                            
                                            listAction: '../control/cAdmin-gerenciar-unidades.php?action=list',   
                                            updateAction: '../control/cAdmin-gerenciar-unidades.php?action=edit',
                                            createAction: '../control/cAdmin-gerenciar-unidades.php?action=create',
                                            deleteAction: '../control/cAdmin-gerenciar-unidades.php?action=delete'
                                                   
                                    },
                                    fields: {
                                            
                                            idUnidade: {
                                                title: 'Id',
                                                
                                                key: true,
						create: false,
						edit: false,
                                                list: true
						
                                            },
                                            
                                            nome: {
                                                    title: 'Nome', 
                                                    width: '10%'
                                                    
                                            }        
                                    }
                            });
     
                            $('#LoadRecordsButton').click(function (e) {
                                e.preventDefault();
                            
                                $('#UnidadeTableContainer').jtable('load', {
                                    
                                    pesquisa: $('#pesquisa').val(),
                                    selectCampo: $('#selectCampo').val()      
                                });
                            
                                
                                
                            });
                            
                            $('LoadRecordsButton').click();
                            //Load person list from server
                            $('#UnidadeTableContainer').jtable('load');

                            

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
                    <option value="nome">Nome</option>               
                </select>
                
               <button type="submit" id="LoadRecordsButton" style="font-family: 'Segoe UI Semilight', 'Open Sans', Verdana, Arial, Helvetica, sans-serif;font-size: 13px; font-weight: 600;">Busca</button>
            </form>
            <div id="UnidadeTableContainer" ></div>
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