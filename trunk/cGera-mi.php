<?php

//Arquivo de geração do MI

//Visual da página
include("vPlease-wait.html");

//Inicializa a sessão
session_start("usuario");

//Verificação de sessão iniciada
if (isset($_SESSION["login"]) and ($_SESSION["senha"])) {

    //Inclusão do arquivo de conexão com o banco e instanciamento da conexao
    include("conecta-mi-db.php");
    include("funcoes.php");

    $bdMi = new MYSQL_MIDB();

    //**********RECEBIMENTO DAS VARIÁRVEIS**********/
    $txtDestinatario = $_POST['txtNome'];
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

    $dataEmissao = explode('-', $dataEmissao);

    $dia = $dataEmissao[2];
    $mes = $dataEmissao[1];
    $ano = $dataEmissao[0];

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

    $mes = strtolower($mes);
    
    //*************CRIAÇÃO DO MEMORANDO*************/
    //Inclusão do arquivo contendo as classes de geração do PDF
    include('fpdf16/fpdf.php');

    //Instanciamento das classes
    $mi = new FPDF('P', 'cm', 'A4');

    //Definição da fonte
    $mi->SetFont('Times', '', 12);
    $mi->AddPage();

    //Definição das margens
    $mi->SetMargins(3, 2, 3);

    //Autor e título
    $mi->SetAuthor(utf8_decode("$remetente"));
    $mi->SetTitle(utf8_decode("MI//$remetente/$numeroMemorando/$ano2[1]"));   

    //Número do MI e data de confecção
    $mi->Ln(1);
    $mi->SetFont('Times', 'B');
    $mi->Cell(0, 1, utf8_decode("MI//$remetente/$numeroMemorando/$ano2[1]"), 0, 0, 'L');
    $mi->Cell(0, 1, utf8_decode("Uberlândia - MG, $dia de $mes de $ano"), 0, 1, 'R');

    //Informações do remetente
    $mi->Ln(1);
    $mi->SetFont('Times');
    $mi->Cell(0, 1, utf8_decode(strtoupper("De: $remetente")) , 0, 0, 'L');

    //Informações do destinatário
    $mi->Ln(1);
    $mi->Cell(0, 1, utf8_decode(strtoupper("Para: $txtCargo $txtDestinatario")), 0, 0, 'L');
    
    $mi->Ln(1.2);
    $mi->SetFont('Times', 'B');
    $mi->Cell(0, 1, utf8_decode("Assunto: $txtTitulo"), 0, 0, 'J');

    //Corpo do MI
    $mi->Ln(1.5);
    $mi->SetFont('');
    $mi->MultiCell(0, 0.7, utf8_decode($txtCorpo), 0, 'J');    
    
    //Assinatura
    $mi->Cell(0, 1, "___________________________________________", 0, 1, 'C');
    $mi->Cell(0, 1, utf8_decode($remetente), 0, 0, 'C');

    //Geração do arquivo final    
    $mi->Output("memorandos/$numeroMemorando-$ano2[1].pdf");
    
    header("Location: memorandos/$numeroMemorando-$ano2[1].pdf");
    
} else {
    include("vUsuario-nao-logado.php");
}
?>


