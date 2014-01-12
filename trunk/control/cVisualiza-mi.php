<?php

//Arquivo de geração do MI

//Inicializa a sessão
session_start("usuario");

//Verificação de sessão iniciada
if (isset($_SESSION["login"]) and ($_SESSION["senha"])) {

    //Inclusão do arquivo de conexão com o banco e instanciamento da conexao
    include("../model/conecta-mi-db.php");
    include("../model/funcoes.php");

    $bdMi = new MYSQL_MIDB();

    //**********RECEBIMENTO DAS VARIÁRVEIS**********/
    $txtDestinatario = $_POST['txtDestinatario'];
    $txtCargo = $_POST['txtCargo'];
    $txtReferencia = $_POST['txtReferencia'];
    $txtTitulo = $_POST['txtTitulo'];
    $txtCorpo = $_POST['txtCorpo'];
    $dataEmissao = $_POST['data'];

    $usuario = $_SESSION["login"];

    //***********CONSULTA DE MEMORANDOS*************/
    //Consulta o "maior ID" de memorando da tabela (ou seja, o último) e o incrementa, gerando o nome do próximo.
    $ultimoMemorando = $bdMi->sql("SELECT MAX(idMemorando) FROM memorando");
    $numeroMemorando1 = $ultimoMemorando[0] + 1;
    
    $numeroMemorando = zerofill($numeroMemorando1);
    
    //********OBTENÇÃO DO USUÁRIO REMETENTE*********/

    $resultadoRemetente = $bdMi->sql("SELECT nome FROM usuario WHERE emailInstitucional = '$usuario'");

    $remetente = mysql_result($resultadoRemetente, 0, 'nome');

    //*********OBTENÇÃO DE OUTRAS VARIÁVEIS*********/

    $dataEmissao2 = explode('-', $dataEmissao);

    $dia = $dataEmissao2[2];
    $mes = $dataEmissao2[1];
    $ano = $dataEmissao2[0];

    $ano2 = explode('0', $ano);

    switch ($mes) {
        case 01:
            $mes = 'Janeiro';
            break;
        case 02:
            $mes = 'Fevereiro';
            break;
        case 03:
            $mes = 'Março';
            break;
        case 04:
            $mes = 'Abril';
            break;
        case 05:
            $mes = 'Maio';
            break;
        case 06:
            $mes = 'Junho';
            break;
        case 07:
            $mes = 'Julho';
            break;
        case 08:
            $mes = 'Agosto';
            break;
        case 09:
            $mes = 'Setembro';
            break;
        case 10:
            $mes = 'Outubro';
            break;
        case 11:
            $mes = 'Novembro';
            break;
        case 12:
            $mes = 'Dezembro';
            break;
    }

    $mes2 = strtolower($mes);
    
    //*************CRIAÇÃO DO MEMORANDO*************/
    ob_start();
?>

<page backtop="50mm" backbottom="7mm" backleft="10mm" backright="25mm" backimg="../resources/images/logo_ufu.png">
    
    <page_header align="center" style="width: 100%; border: solid 1px black;">
        <img src="../resources/images/favicon.gif" alt="logo ufu">
        <h5>
            UNIVERSIDADE FEDERAL DE UBERLÂNDIA <br> <br>
            FACULDADE DE COMPUTAÇÃO <br> 
            ______________________________________________________________________________________________________
        </h5>
    </page_header>

    <page_footer align="center"> 
        <?php
            echo '___________________________________________';
        ?>

        <br>

        <?php
            echo $remetente;
        ?>         
        
        <br>
        <br>
        
        <h5>
            ______________________________________________________________________________________________________ <br>
            
                UNIVERSIDADE FEDERAL DE UBERLÂNDIA <br> <br>
                FACULDADE DE COMPUTAÇÃO   
        </h5>		
         
    </page_footer> 
    
    <!-- Content here -->
    <p>
    <div>
        
        <div align="left">
            <?php
                echo "MI//$remetente/$numeroMemorando/$ano2[1]";
            ?>
        </div>
        
        <div align="right">
            <?php
                echo "Uberlândia - MG, $dia de $mes2 de $ano";
            ?>
        </div>
            
    </div>
    
    <br>
    <br>
    <br>
    
    <?php
        echo strtoupper("De: $remetente");
    ?>
    
    <br>
    <br>
    
    <?php
        echo strtoupper("Para: $txtCargo $txtDestinatario");
    ?>
    
    <br>
    <br>
    
    <b>
        <?php
            echo "Assunto: $txtTitulo";
        ?>
    </b>
    
    <br>
    <br>
    
    <?php
        echo $txtCorpo;
    ?>
    
    <br>
    <br>
    
    </p>
</page>
    
<?php 
    
    $content = ob_get_clean();
    
    include_once('../resources/html2pdf/html2pdf.class.php');
    
    $pdf = new HTML2PDF('P','A4','pt');
    
    $pdf->pdf->SetAuthor($remetente);
    $pdf->pdf->SetTitle("MI//$remetente/$numeroMemorando/$ano2[1]");
    
    $pdf->writeHTML($content);
    $pdf->Output();
    
    
    

} else {
    include("../view/vUsuario-nao-logado.php");
}

?>