<?php

//Arquivo de atualização de unidade ou usuário no banco
//Inicializa a sessão
session_start("usuario");

//Verificação de sessão iniciada
if (isset($_SESSION["login"]) and ($_SESSION["senha"])) {
    
    //Inclusão do arquivo de conexão com o banco
    include("conecta-mi-db.php");
    
    $bdMi = new MYSQL_MIDB();
    
    
    
    $selectUnidades = $bdMi->sql("SELECT * FROM unidade");
    
    if (mysql_num_rows($selectUnidades) > 0) {
        echo "<div>";
        echo "<select name=\"selUnidadeNovo\" class=\"selUnidadePrincipal\" >";
        while ($resultadoUnidades = mysql_fetch_array($selectUnidades)) {
            echo "<option value=\"$resultadoUnidades[0]\">$resultadoUnidades[1]</option>";
        }
        echo "</select>";
        echo "</div>";
    } else {
        echo "Não há unidades cadastradas!";
    }
} else {
    include("vUsuario-nao-logado.php");
}
?>
