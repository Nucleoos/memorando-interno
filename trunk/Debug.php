<?php
    /* Este arquivo de Debug é bem simples. 
     * Dica: quando um select não está dando certo, ou vc quer ver um valor de uma variável.
     */
    class Debug{
        /**
         * a função estática gravaEmArquivo, recebe uma variavel e armazena o conteudo da 
         * mesma em um arquivo. 
         * @param type $msg
         */
        public static function gravaEmArquivo($msg){
            if($arq2 = fopen("../out.txt", "w"))//PARA GRAVAÇÃO
            {
                fputs($arq2,$msg);                
                fclose($arq2);
            }
        }
        
        /**
         * a função estática alert, recebe uma variavel e imprime ela como um alert
         * @param type $msg
         */
        public static function alert($msg){
            echo "<script>alert($msg)</script>";
        }
    }
?>
