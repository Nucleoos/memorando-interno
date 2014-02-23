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

<page backtop="50mm" backbottom="7mm" backleft="10mm" backright="10mm" >
    
    <page_header align="center" style="width: 100%; border: solid 1px black;">
        <img src="../resources/images/logo.png" alt="logo" >
    </page_header>

    <page_footer align="center"> 
        
        <p>
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
        </p>
        
        
        <br>
        <br>
        
        <h5>
            ______________________________________________________________________________________________________ <br>
            
                UNIVERSIDADE FEDERAL DE UBERLÂNDIA <br>
                FACULDADE DE COMPUTAÇÃO   
        </h5>		
        
        <?php
            $timestamp = date("d/m/Y (H:i:s)");
            echo 'Documento gerado automaticamente em ' . $timestamp . '.';
            echo '<br>';
            echo'Página ' . '1' . ' / ' . '1';
        ?>
         
    </page_footer> 
    
    <!-- Content here -->
        
    <p>
        <?php
            echo "MI//$nomeRemetente/$numeroMemorando/$ano2[1] 
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                Uberlândia - MG, $dia de $mes2 de $ano";
        ?>
    </p>
    
    <br>
    <br>
    
    <p>
        <?php
            echo strtoupper("De: $tituloRemetente $nomeRemetente, $cargoRemetente");       
            echo '<br>';
            echo strtoupper("Para: $tituloDestinatario $nomeDestinatario, $cargoDestinatario");
        
        ?>
    </p>
    
    <br>
    
    <br>
    
    <p>
        <b>
            <?php
                echo "Assunto: $referencia";
            ?>
        </b>
    </p>
    
    <br>
    
    <p>
        <?php
            echo $corpo;
        ?>
    </p>
    
    <br>
    

</page>
    
<?php 
    
    
    $content = ob_get_clean();
    include_once('../resources/html2pdf/html2pdf.class.php');
    //include_once '../resources/PDFMerger/PDFMerger.php';
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