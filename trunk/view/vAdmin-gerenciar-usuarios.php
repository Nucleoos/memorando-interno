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

                        //Prepare jTable
                            $('#UserTableContainer').jtable({
                                    title: 'Usuários',
                                    paging: true,
                                    pageSize: 10,
                                    sorting: true,
                                    defaultSorting: 'idUsuario ASC',
                                    
                                    actions: {
                                            
                                            listAction: '../control/CAdmin-gerenciar-usuarios.php?action=list',   
                                            updateAction: '../control/CAdmin-gerenciar-usuarios.php?action=update',
                                            createAction: '../control/CAdmin-gerenciar-usuarios.php?action=create',
                                            deleteAction: '../control/CAdmin-gerenciar-usuarios.php?action=delete'
                                            
                                            
                                    },
                                    fields: {
                                            
                                            idUsuario: {
                                                title: 'Número de registro',
                                                
                                                key: true,
						create: false,
						edit: false,
                                                list: true
						
                                            },
                                            
                                            nome: {
                                                    title: 'Nome',
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
                                                    width: '5%'
                                                    
                                                   
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
                            $('#UserTableContainer').jtable('load');

                            

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
                    <option value="titulo">Título</option>
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