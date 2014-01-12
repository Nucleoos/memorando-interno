<?php

//Função para formatar os IDs dos memorandos com zeros à esquerda
function zerofill($numero) {
    if ($numero < 10) {
        $numero = str_pad($numero, 3, "0", STR_PAD_LEFT);
    } elseif ($numero >= 10 && $numero < 100) {
        $numeroMemorando = str_pad($numero, 2, "0", STR_PAD_LEFT);
    }
    
    return $numero;
}

//*************************Função de geração de chave aleatória*************************/

function geraChave() {

    //Tipo da chave. L = Letras, N = Números.
    $tipo = "L L N N L N L N L L L N N N L L N N L N L N";
    $caracteres = explode(" ", $tipo);

    //Caracteres a serem utilizados na definição da senha
    $letras = "a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z";
    $numeros = "0,1,2,3,4,5,6,7,8,9";

    $array_letras = explode(",", $letras);
    $array_numeros = explode(",", $numeros);

    $chave = "";

    //Sorteio de caracteres aleatórios dos arrays e concatenação dos mesmos em uma única variável
    for ($c = 0; $c < sizeof($caracteres); $c++) {
        if ($caracteres[$c] == "L") {
            $chave .= $array_letras[array_rand($array_letras)];
        } else {
            if ($caracteres[$c] == "N") {
                $chave .= $array_numeros[array_rand($array_numeros)];
            }
        }
    }

    return $chave;
}

?>
