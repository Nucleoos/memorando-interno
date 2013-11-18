/*
 * Arquivo com funções javascript gerais utilizadas no sistema 
 */

function acrescentaUnidade(){
    
    $('#preencheUnidade').load('selectUnidade.php');
}

function carregaPesquisa(){
                   
    $('#resultadosPesquisa').fadeOut("slow").load("cConsultar.php").fadeIn("slow");                    
                   
}

function submeter(){
    
    var radioPesquisa = $('input[name=radioPesquisa]:checked').val();
    var txtPesquisa = $('#txtPesquisa').val();    
    if(radioPesquisa != "" && txtPesquisa != ""){
        $('#resultadosPesquisa').fadeOut("slow").load("cConsultar.php?radioPesquisa="+radioPesquisa+"&txtPesquisa="+txtPesquisa).fadeIn("slow");
    }else{
        carregaPesquisa();
    }
}

function alteraCampoPesquisa(str){
    if(str == 'idPesquisaMemorando'){
        $(".info").attr("placeholder", "Ex.: \"987/13\"");
        $("#txtPesquisa").mask("999/99");
    }else if(str == 'rdPesquisaData'){
        $(".info").attr("placeholder","Ex.: \"25/05/2010\"");
        $("#txtPesquisa").mask("99/99/9999");
    }else if(str == 'rdPesquisaRemetente'){
        $(".info").attr("placeholder","Ex.: \"Prof. João\"");
        $("#txtPesquisa").unmask("99/99/9999");
    }else if(str == 'rdPesquisaDestinatario'){
        $(".info").attr("placeholder","Ex.: \"Coordenação\" ou \"Colegiado\"");
        $("#txtPesquisa").unmask("99/99/9999");
    }else if(str == 'rdPesquisaAssunto'){
        $(".info").attr("placeholder","Ex.: \"solicitação equipamentos\" ");
        $("#txtPesquisa").unmask("99/99/9999");
    }else if(str == 'rdPesquisaCorpo'){
        $(".info").attr("placeholder","Ex.: \"solicitação de reserva de sala para...\"");
        $("#txtPesquisa").unmask("99/99/9999");
    }else if(str == 'idPesquisaTudo'){
        $(".info").attr("placeholder","Selecione uma das opções acima e digite aqui a sua busca");
        $("#txtPesquisa").unmask("99/99/9999");
    }
}

