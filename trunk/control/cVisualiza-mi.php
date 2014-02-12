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
    //**********RECEBIMENTO DAS VARIÁRVEIS**********/
    $txtDestinatario = $_POST['txtDestinatario'];
    
    $split_strings = preg_split('/[\ \n\,]+/', $txtDestinatario);
    
    $tituloDestinatario = $split_strings[0];
    $nomeDestinatario = $split_strings[1];
    $cargoDestinatario = $split_strings[2];
    
    $referencia = $_POST['txtReferencia'];
    
    $corpo = $_POST['txtCorpo'];
    
    $dataEmissao = $_POST['data'];
    
    $emissario = $_POST['selecao'];
    
    $usuario = $_SESSION["login"];
   
    $bdMi = new MYSQL_MIDB();
    
    $resultado = $bdMi->sql("SELECT idUsuario, nome, titulo, cargo, portaria, emailInstitucional FROM usuario WHERE emailInstitucional = '$usuario'");
    $row = mysql_fetch_array($resultado);
    $idRemetente = $row[0];
    $nomeRemetente = $row[1];
    $tituloRemetente = $row[2];
    $cargoRemetente = $row[3];
    $portariaRemetente = $row[4];
    $emailRemetente = $row[5];
    
    

    //***********CONSULTA DE MEMORANDOS*************/
    //Consulta o "maior ID" de memorando da tabela (ou seja, o último) e o incrementa, gerando o nome do próximo.
    
    //SO PARA TESTE
    $SelectNumeroMemorando = $bdMi->sql("SELECT MAX(nMemorandoEmitido) FROM memorando");
    $numeroMemorando = zerofill(mysql_result($SelectNumeroMemorando, 0));
    
    //********OBTENÇÃO DO USUÁRIO REMETENTE*********/

   
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
            echo $nomeRemetente;
            echo "<br>";
            echo $emailRemetente;
            echo "<br>";
            echo $portariaRemetente;
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
                echo "MI//$nomeRemetente/$numeroMemorando/$ano2[1]";
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
        echo strtoupper("De: $tituloRemetente $nomeRemetente, $cargoRemetente");
    ?>
    
    <br>
    <br>
    
    <?php
        echo strtoupper("Para: $tituloDestinatario $nomeDestinatario, $cargoDestinatario");
    ?>
    
    <br>
    <br>
    
    <b>
        <?php
            echo "Assunto: $referencia";
        ?>
    </b>
    
    <br>
    <br>
    
    <?php
        echo $corpo;
    ?>
    
    <br>
    <br>
    
    </p>
</page>
    
<?php 
    
    
    $content = ob_get_clean();
    include_once('../resources/html2pdf/html2pdf.class.php');
    //include_once '../resources/PDFMerger/PDFMerger.php';
    include_once '../resources/html2pdf/MergePdf.class.php';
    $pdf = new HTML2PDF('P','A4','pt');
    
    $pdf->pdf->SetAuthor($nomeRemetente);
    $pdf->pdf->SetTitle("MI//$nomeRemetente/$numeroMemorando/$ano2[1]");
    
    $pdf->writeHTML($content);
    $pdf->Output();
    
    
 
//    $pdfmerger->addPDF($mypdf, '1, 2')
//	->addPDF($_FILES['file']['name'], 'all')
//	
//	->merge('browser');
    
    
    

} else {
    include("../view/vUsuario-nao-logado.php");
}

?>