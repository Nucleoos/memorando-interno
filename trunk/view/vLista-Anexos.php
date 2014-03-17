<?php // Arquivo de geração do MI


//Inicializa a sessão
session_start("usuario");

function remove_zeros($record){
$string=$record;
$s_lenght=strlen ($string);
$pos=0;
for ($i=0;$i<=$s_lenght;$i++){
    $_arr[$i]=substr($string,$i,1);    
    if($_arr[$i]!=0){
    $pos=$i;
    $i=$s_lenght+1;
    }
}
if($pos!=0){
return substr($string,$pos,$s_lenght-$pos);
}else{
return 0;
}
} 

function human_filesize($bytes, $decimals = 2) {
  $sz = 'BKMGTP';
  $factor = floor((strlen($bytes) - 1) / 3);
  return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];
}

    //Inclusão do arquivo de conexão com o banco e instanciamento da conexao
    include("../model/conecta-mi-db.php");    
    
    //**********RECEBIMENTO DAS VARIÁRVEIS**********/
    
    $bdMi = new MYSQL_MIDB();
    
    $numeroMemorando = remove_zeros( $_GET['idMemorando'] );
    
    $usuario = $_SESSION["login"];
    
    if( is_dir( "server/php/files/$usuario/$numeroMemorando" ) )
    {
        if ( $handle = opendir("server/php/files/$usuario/$numeroMemorando") ) {
            while (false !== ($file = readdir($handle))) {
                if ($file != "." && $file != "..")
                {
                    echo "$file ----------- ". human_filesize( filesize( "server/php/files/$usuario/$numeroMemorando/$file" ), 2 ) ."<br>";
                }
            }

            closedir($handle);
        }
    }
    

?>