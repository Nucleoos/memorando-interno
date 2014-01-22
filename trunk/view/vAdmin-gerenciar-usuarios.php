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
                            $('#UserTableContainer').jtable({
                                    title: 'Usuários',
                                    paging: true,
                                    pageSize: 10,
                                    sorting: true,
                                    defaultSorting: 'data ASC',
                                    
                                    actions: {
                                            
                                            listAction: '../control/cAdmin-gerenciar-usuarios.php?action=list',   
                                            updateAction: '../control/cAdmin-gerenciar-usuarios.php?action=edit',
                                            createAction: '../control/cAdmin-gerenciar-usuarios.php?action=create',
                                            deleteAction: '../control/cAdmin-gerenciar-usuarios.php?action=delete'
                                            
                                            
                                    },
                                    fields: {
                                            
                                            idUsuario: {
                                                title: 'Id',
                                                
                                                key: true,
						create: false,
						edit: false,
						
                                            },
                                            
                                            nome: {
                                                    title: 'Nome',
                                                    type: 'date',
                                                    width: '10%'
                                                    
                                            },
                                            titulo: {
                                                    title: 'Título' ,
                                                    width: '10%'
                                                    
                                            },
                                            cargo: {
                                                    title: 'Cargo',
                                                    width: '10%'
                                                    
                                            },
                                            portaria: {
                                                    title: 'Portaria',
                                                    width: '10%'
                                            },
                                            email: {
                                                    title: 'Email',
                                                    width: '5%',
                                                    
                                                   
                                            },                                         
                                            permissao: {
                                                    title: 'Permissão',
                                                    width: '5%',
                                                    options: { 'user' : 'Usuário' , 'admin' : 'Administrador' }
                                                   
                                            }
             
                                            
                                    }
                            });
     
                            $('#LoadRecordsButton').click(function (e) {
                                e.preventDefault();
                            
                                $('#UserTableContainer').jtable('load', {
                                    
                                    pesquisa: $('#pesquisa').val(),
                                    selectCampo: $('#selectCampo').val(),
                                    selectPermissao: $('#selectPermissao').val()
                                });
                            
                                
                                
                            });
                            
                            $('LoadRecordsButton').click();
                            //Load person list from server
                            //$('#UserTableContainer').jtable('load');

                            

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
                    <option value="título">Título</option>
                    <option value="cargo">Cargo</option>
                    <option value="portaria">Portaria</option>
                    <option value="email">Email</option>
                </select>
                
                <select id="selectPermissao">
                    <option value="">Todos</option>
                    <option value="usuario">Usuário</option>
                    <option value="administrador">Administrador</option>
                </select>
               <button type="submit" id="LoadRecordsButton" style="font-family: 'Segoe UI Semilight', 'Open Sans', Verdana, Arial, Helvetica, sans-serif;font-size: 13px; font-weight: 600;">Busca</button>
            </form>
            <div id="UserTableContainer" ></div>
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