<?php
//Arquivo de consulta de memorando ao banco
//Inicializa a sessão
session_start("usuario");

//Verificação de sessão iniciada
if (isset($_SESSION["login"]) and ($_SESSION["senha"])) {

    //Inclusão do arquivo de conexão com o banco
    include ("conecta-mi-db.php");

    //Instaciando a classe de conexao com banco de dados
    $bdMi = new MYSQL_MIDB();

    if (!isset($_GET['radioPesquisa'])) {
        //Consulta de memorandos do sistema        
        $selectMemorandos = $bdMi->sql("SELECT * FROM memorando ORDER BY idMemorando DESC");
    } else {
        //Recebimento das variáveis do formulário
        $txtPesquisa = $_GET['txtPesquisa'];
        $coluna = $_GET['radioPesquisa'];
        $txtPesquisa2 = $txtPesquisa;
        //Conversão das variáveis do radiogroup em tabela no banco
        if ($coluna == 'idPesquisaTudo') {

            $pesquisa = explode(" ", $txtPesquisa);
           
            $termos = count($pesquisa);
            for ($c = 0; $c < $termos; $c++) {
                $selectMemorandos = $bdMi->sql("SELECT * FROM memorando m, usuario u, destinatario d WHERE m.idMemorando LIKE '%$pesquisa[$c]%' OR m.data LIKE '%$pesquisa[$c]%' OR u.nome LIKE '%$pesquisa[$c]%' OR d.nome LIKE '%$pesquisa[$c]%' OR m.titulo LIKE '%$pesquisa[$c]%' OR m.corpo LIKE '%$pesquisa[$c]%' ORDER BY idMemorando DESC");
            }
        } else if ($coluna == 'idPesquisaMemorando') {

            //Identificador do memorando
            $explodeIdMemorando = explode('/', $txtPesquisa);

            $idMemorando = $explodeIdMemorando[0];
            $anoMemorando = $explodeIdMemorando[1];

            $selectMemorandos = $bdMi->sql("SELECT * FROM memorando WHERE idMemorando LIKE '%$idMemorando%' AND data LIKE '%$anoMemorando%' ORDER BY idMemorando DESC");
        } else if ($coluna == 'rdPesquisaData') {

            //Tratamento da data
            $data1 = explode("/", $txtPesquisa);
            $data = $data1[2] . "-" . $data1[1] . "-" . $data1[0];

            $selectMemorandos = $bdMi->sql("SELECT * FROM memorando WHERE data LIKE '%$data%' ORDER BY idMemorando DESC");
        } else if ($coluna == 'rdPesquisaRemetente') {

            $selectMemorandos = $bdMi->sql("SELECT * FROM memorando m, usuario u WHERE u.nome LIKE '%$txtPesquisa%' AND m.remetente = u.idUsuario ORDER BY idMemorando DESC");
        } else if ($coluna == 'rdPesquisaDestinatario') {

            $selectMemorandos = $bdMi->sql("SELECT * FROM memorando m, destinatario d WHERE d.nome LIKE '%$txtPesquisa%' AND m.destinatario = d.idDestinatario ORDER BY idMemorando DESC");
        } else if ($coluna == 'rdPesquisaAssunto') {

            $selectMemorandos = $bdMi->sql("SELECT * FROM memorando WHERE titulo LIKE '%$txtPesquisa%' ORDER BY idMemorando DESC");
        } else if ($coluna == 'rdPesquisaCorpo') {

            $selectMemorandos = $bdMi->sql("SELECT * FROM memorando WHERE corpo LIKE '%$txtPesquisa2%' ORDER BY idMemorando DESC");
        }

        //Consulta de memorandos do sistema utilizando filtro
//        $selectMemorandos = $bdMi->sql("SELECT * FROM memorando WHERE $coluna LIKE '%$txtPesquisa%' ORDER BY idMemorando DESC");
    }
    //Linhas com os resultados do SELECT  
    if (mysql_num_rows($selectMemorandos) > 0) {

        $c = 1;
        $contadorResultado = 0;
        ?><!-- Linha com os títulos -->
        <table border="0" align="center" width="100%">
            <tr>
                <td><strong>Identificador</strong></td>
                <td><strong>Data</strong></td>
                <td><strong>Remetente</strong></td>
                <td><strong>Destinatário</strong></td>
                <td><strong>Assunto</strong></td>
                <td><strong>Corpo</strong></td>
                <td><strong>Emitido</strong></td>
                
            </tr>

            <?php
            while ($resultadoMemorandos = mysql_fetch_array($selectMemorandos)) {

                //***********TRATAMENTO DE VARIÁVEIS************/
                //Identificador do memorando
                $numeroMemorando = $resultadoMemorandos[0];

                $resultAno = explode('-', $resultadoMemorandos[1]);
                $ano = substr($resultAno[0], 2);

                $identificador = $numeroMemorando . "/" . $ano;

                //Obtenção dos IDs do remetente e do destinatário
                $idRemetente = mysql_result($selectMemorandos, $contadorResultado, "remetente");
                $idDestinatario = mysql_result($selectMemorandos, $contadorResultado, "destinatario");

                //Tratamento da data
                $data2 = mysql_result($selectMemorandos, $contadorResultado, "data");
                $data1 = explode("-", $data2);
                $data = $data1[2] . "/" . $data1[1] . "/" . $data1[0];

                //Informações do Remetente
                $selectRemetente = $bdMi->sql("SELECT nome FROM usuario WHERE idUsuario = $idRemetente");
                $remetente = mysql_result($selectRemetente, 0, "nome");

                //Informações do Destinatário
                $selectDestinatario = $bdMi->sql("SELECT nome FROM destinatario WHERE idDestinatario = $idDestinatario");
                $destinatario = mysql_result($selectDestinatario, 0, "nome");

                //Título do texto
                $titulo = mysql_result($selectMemorandos, $contadorResultado, "titulo");
                if (strlen($titulo) > 40) {
                    $titulo = substr($titulo, 0, 40) . "...";
                }
                //Corpo do texto
                $corpo = mysql_result($selectMemorandos, $contadorResultado, "corpo");
                if (strlen($corpo) > 40) {
                    $corpo = substr($corpo, 0, 40) . "...";
                }
                
                $emitido = mysql_result($selectMemorandos, $contadorResultado, "emitido") == 1 ? "sim" : "nao";
                
                if ($c % 2 != 0) {
                    ?>
                    <tr style="background-color:#E7E7E6;">
                        <td><?php echo $identificador; ?></td>
                        <td><?php echo $data; ?></td>
                        <td><?php echo $remetente; ?></td>
                        <td><?php echo $destinatario; ?></td>
                        <td><?php echo $titulo; ?></td>
                        <td><?php echo $corpo; ?></td>
                        <td><?php echo $emitido; ?></td>
                        
                        <td align="center" width="4%">
                            <a
                                href="#" title="Editar">
                                <?php
                                    if( $emitido == "sim" )
                                    {
                                ?>
                                                <img src="imagens\edit_not.png">
                                            </a>
                                        </td>
                                        
                                        <td align="center" width="4%"><a href="#" title="Excluir"><img src="imagens\delete_not_v1.png"></a></td>
                        
                                <?php
                                    }
                                    else
                                    {
                                ?>
                                                <img src="imagens\edit_yes.png">
                                            </a>
                                        </td>
                                        <td align="center" width="4%"><a onClick="confirmaDeletaMemorando(<?php echo "'" . $numeroMemorando . "'"; ?>);" href="#" title="Excluir"><img src="imagens\delete_yes_v1.png"></a></td>
                        
                                <?php
                                    }
                                ?>
                            
                        
                    </tr>
                    <?php
                } else {
                    ?>
                    <tr>
                        <td><?php echo $identificador; ?></td>
                        <td><?php echo $data; ?></td>
                        <td><?php echo $remetente; ?></td>
                        <td><?php echo $destinatario; ?></td>
                        <td><?php echo $titulo; ?></td>
                        <td><?php echo $corpo; ?></td>
                        <td><?php echo $emitido; ?></td>
                        
                        <td align="center" width="4%">
                            <a 
                                href="#" title="Editar">
                                
                                <?php
                                    if( $emitido == "sim" )
                                    {
                                ?>
                                                <img src="imagens\edit_not.png">
                                            </a>
                                        </td>
                                        <td align="center" width="4%"><a href="#" title="Excluir"><img src="imagens\delete_not_v1.png"></a></td>

                                <?php
                                    }
                                    else
                                    {
                                ?>
                                                <img src="imagens\edit_yes.png">
                                            </a>
                                        </td>
                                        <td align="center" width="4%"><a onClick="confirmaDeletaMemorando(<?php echo "'" . $numeroMemorando . "'"; ?>);" href="#" title="Excluir"><img src="imagens\delete_yes_v1.png"></a></td>

                                <?php
                                    }
                                ?>
                                        
                                
                            
                        </tr>                
                    <?php
                }
                $c++;
                $contadorResultado++;
            }
            ?></table><?php
    } else {
            ?>
        <p id="campo">A pesquisa não encontrou resultados. Tente algo diferente.</p>
        <?php
    }
} else {
    include("vUsuario-nao-logado.php");
}
?>