<?php

    //connect to your database
    $con = mysql_connect("localhost","root","");
    mysql_select_db("mi-db", $con);     
    
    $term = trim(strip_tags($_GET['term']));//retrieve the search term that autocomplete sends

    $qstring = "SELECT des.idUsuario as id, des.nome as nomeUsuario, u.nome as nomeUnidade FROM usuario des, usuario_has_unidade uhu, unidade u WHERE des.idUsuario = uhu.idUsuario AND uhu.idUnidade = u.idUnidade AND des.nome LIKE '%".$term."%'";
    $result = mysql_query($qstring);//query the database for entries containing the term

    while ($row = mysql_fetch_array($result,MYSQL_ASSOC))//loop through the retrieved values
    {
                    $row['id']=(int)$row['id'];
                    $row['nomeUsuario']=htmlentities(stripslashes(utf8_encode($row['nomeUsuario'])));
                    $row['nomeUnidade']=utf8_encode($row['nomeUnidade']);
                    
                    $row_set[] = $row;//build an array
    }
    echo json_encode($row_set);//format the array into json data

?>
