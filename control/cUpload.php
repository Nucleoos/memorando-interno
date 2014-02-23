<?php // Arquivo de geração do MI


//Inicializa a sessão
session_start("usuario");
    
    $allowedExts = array("pdf");
    $temp = explode(".", $_FILES["file"]["name"]);
    $extension = end($temp);
    if ((($_FILES["file"]["type"] == "application/pdf"))
    
    && in_array($extension, $allowedExts))
      {
      if ($_FILES["file"]["error"] > 0)
        {
        
        }
      else
        {
        

        if (file_exists("../pdf-anexos/" . $_FILES["file"]["name"]))
          {
          
          }
        else
          {
          move_uploaded_file($_FILES["file"]["tmp_name"],
          "../pdf-anexos/" . $_FILES["file"]["name"]);
          
          }
        }
      }
    else
      {
     
      }
    
?>