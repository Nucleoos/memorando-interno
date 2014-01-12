<?php
//Arquivo de deleção de unidade no banco
//Visual da página
include("../view/vPlease-wait.html");

//Inicializa a sessão
session_start("usuario");

//Verificação de sessão iniciada
if (isset($_SESSION["login"]) and ($_SESSION["senha"])) {

    //Inclusão do arquivo de conexão com o banco
    include ("../model/conecta-mi-db.php");

    //Instaciando a classe de conexao com banco de dados
    $bdMi = new MYSQL_MIDB();

    $op = $_REQUEST['op'];

    if ($op == "'delUnit'") {

        $idUnidade = $_REQUEST['idUnidade'];

        //Verificação de existência de relação entre a unidade e o usuário
        $resultadoSelectHasUnidade = $bdMi->sql("SELECT * FROM usuario_has_unidade WHERE idUnidade='$idUnidade'");

        if ($resultadoSelectHasUnidade > 0) {

            //Deleção do relacionamento da unidade com usuário
            $resultadoDeleteHasUnidade = $bdMi->sql("DELETE FROM usuario_has_unidade WHERE idUnidade='$idUnidade'");

            if ($resultadoDeleteHasUnidade > 0) {
                //Deleção de unidade
                $resultadoDeleteUnidade = $bdMi->sql("DELETE FROM unidade WHERE idUnidade='$idUnidade'");

                //Verificação de sucesso da operação
                if ($resultadoDeleteUnidade > 0) {
                    ?>
                    <script language="JavaScript">
                        alert("Unidade deletada com sucesso!");
                        window.location = ("../view/vAdmin-gerenciar.php");
                    </script>
                    <?php
                } else {
                    ?>
                    <script language="JavaScript">
                        alert("Erro ao deletar unidade. Tente novamente.");
                        window.location = ("../view/vAdmin-gerenciar.php");
                    </script>
                    <?php
                }
            } else {
                //Deleção de unidade
                $resultadoDeleteUnidade = $bdMi->sql("DELETE FROM unidade WHERE idUnidade='$idUnidade'");

                //Verificação de sucesso da operação
                if ($resultadoDeleteUnidade > 0) {
                    ?>
                    <script language="JavaScript">
                        alert("Unidade deletada com sucesso!");
                        window.location = ("../view/vAdmin-gerenciar.php");
                    </script>
                    <?php
                } else {
                    ?>
                    <script language="JavaScript">
                        alert("Erro ao deletar unidade. Tente novamente.");
                        window.location = ("../view/vAdmin-gerenciar.php");
                    </script>
                    <?php
                }
            }
        }
    } else if ($op == "'delUser'") {

        $idUsuario = $_REQUEST['idUsuario'];

        //Verificação de existência de relação entre a unidade e o usuário
        $resultadoSelectHasUnidade = $bdMi->sql("SELECT * FROM usuario_has_unidade WHERE idUsuario='$idUsuario'");

        if ($resultadoSelectHasUnidade > 0) {

            //Deleção do relacionamento da unidade com usuário
            $resultadoDeleteHasUnidade = $bdMi->sql("DELETE FROM usuario_has_unidade WHERE idUsuario='$idUsuario'");

            if ($resultadoDeleteHasUnidade > 0) {
                //Deleção de usuário
                $resultadoDeleteUsuario = $bdMi->sql("DELETE FROM usuario WHERE idUsuario='$idUsuario'");

                //Verificação de sucesso da operação
                if ($resultadoDeleteUsuario > 0) {
                    ?>
                    <script language="JavaScript">
                        alert("Usuário deletado com sucesso!");
                        window.location = ("../view/vAdmin-gerenciar.php");
                    </script>
                    <?php
                } else {
                    ?>
                    <script language="JavaScript">
                        alert("Erro ao deletar Usuário. Tente novamente.");
                        window.location = ("../view/vAdmin-gerenciar.php");
                    </script>
                    <?php
                }
            } else {
                //Deleção de unidade
                $resultadoDeleteUsuario = $bdMi->sql("DELETE FROM usuario WHERE idUsuario='$idUsuario'");

                //Verificação de sucesso da operação
                if ($resultadoDeleteUsuario > 0) {
                    ?>
                    <script language="JavaScript">
                        alert("Usuário deletado com sucesso!");
                        window.location = ("../view/vAdmin-gerenciar.php");
                    </script>
                    <?php
                } else {
                    ?>
                    <script language="JavaScript">
                        alert("Erro ao deletar usuário. Tente novamente.");
                        window.location = ("../view/vAdmin-gerenciar.php");
                    </script>
                    <?php
                }
            }
        }
    } else if ($op == "'delMemo'") {

        $idMemorando = $_REQUEST['idMemorando'];
        //Deleção de memorando
        $resultadoDeleteMemorando = $bdMi->sql("DELETE FROM memorando WHERE idMemorando='$idMemorando'");

        //Verificação de sucesso da operação
        if ($resultadoDeleteMemorando > 0) {
            ?>
            <script language="JavaScript">
                alert("Memorando deletado com sucesso!");
                window.location = ("../view/vConsultar.php");
            </script>
            <?php
        } else {
            ?>
            <script language="JavaScript">
                alert("Erro ao deletar Memorando. Tente novamente.");
                window.location = ("../view/vConsultar.php");
            </script>
            <?php
        }
    } else {
        ?>
        <script language="JavaScript">
            alert("Operação incorreta. Por favor, tente novamente");
            window.location = ("../view/vConsultar.php");
        </script>
        <?php
    }
} else {
    include("../view/vUsuario-nao-logado.php");
}
?>