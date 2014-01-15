<?php

    //connect to your database
    $con = mysql_connect("localhost","root","");
    mysql_select_db("mi-db", $con);     
    
    $term = trim(strip_tags($_GET['term']));//retrieve the search term that autocomplete sends

    $qstring = "SELECT idDestinatario as id, nome, titulo, cargo FROM destinatario WHERE nome LIKE '%".$term."%'";
    $result = mysql_query($qstring);//query the database for entries containing the term

    while ($row = mysql_fetch_array($result,MYSQL_ASSOC))//loop through the retrieved values
    {
                    $row['id']=(int)$row['id'];
                    $row['nome']=htmlentities(stripslashes(utf8_encode($row['nome'])));
                    $row['titulo']=utf8_encode($row['titulo']);
                    $row['cargo']=utf8_encode($row['cargo']);
                    
                    $row_set[] = $row;//build an array
    }
    echo json_encode($row_set);//format the array into json data

?>
