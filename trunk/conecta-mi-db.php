<?php

//Verificação de segurança
//if (eregi("conecta.php", $_SERVER[PHP_SELF])) 
//{
//    header("Location: ../");
//}

class MYSQL_MIDB {

    var $host = "localhost";
    var $user = "root";
    var $pass = "";
    var $db = "mi-db";
    var $query;
    var $link;
    var $result;

    //Função de conexão com o servidor.
    function connect() {
        $this->link = mysql_connect($this->host, $this->user, $this->pass);
        
        //Acentuação
        mysql_set_charset('utf8');
        mysql_query("SET NAMES 'utf8'");
        mysql_query("SET character_set_connection=utf8");
        mysql_query("SET character_set_client =utf8");
        mysql_query("SET character_set_results = utf8");
        
        if (!$this->link) {
            echo "<div id=\"erro\"><p>Erro na Conexão. Verifique se o serviço foi realmente iniciado.</p></div>";
            die();
        } elseif (!mysql_select_db($this->db, $this->link)) {
            echo "<div id=\"erro\"><p>Erro na seleção. Banco de dados não existe</p></div>";
            die();
        }
    }

    //Função que executa query. Recebe a string contendo a query e a executa.
    //Caso haja erro, retorna 0.
    function sql($query) {
        $this->connect();
        $this->query = $query;
        if ($this->result = mysql_query($this->query) or die (mysql_error())) {
            return $this->result;
            $this->disconnect();
        }
    }

    //Função de desconexão com o servidor.
    function disconnect() {
        return mysql_close($this->link);
    }
}
?>
