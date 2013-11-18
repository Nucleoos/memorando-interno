/* 
 * Arquivo contendo funções de validação do Sistema de Emissão de MI
 */

//Função de checagem de campos Login e Senha vazios
function checaLoginVazio(formLogin)
{
    if(formLogin.login.value == "")
    {
        alert("Informe um login!");
        formLogin.login.focus();
        formLogin.login.select();
        return false;
    }    
    if(formLogin.senha.value == "")
    {
        alert("Informe uma senha!");
        formLogin.senha.focus();
        formLogin.senha.select();
        return false;
    }
    return true;
}

//Função de checagem de seleção de Unidade no cadastro de usuário
function checaUnidadeSelecionada(formUsuario)
{
    if(formUsuario.selUnidade.value == '0')
    {
        alert("Selecione uma unidade!");
        formUsuario.selUnidade.focus();
        return false;
    }
    return true;
}

//Função de confirmação de deleção de unidade
function confirmaDeletaUnidade(id)
{
    if(confirm('Tem certeza que deseja excluir esta unidade?')){
        window.location = ("cAdmin-excluir.php?idUnidade="+id+"&op='delUnit'");            
    } else {
        return false;
    }
}

//Função de confirmação de deleção de usuário
function confirmaDeletaUsuario(id)
{
    if(confirm('Tem certeza que deseja excluir este usuário?')){
        window.location = ("cAdmin-excluir.php?idUsuario="+id+"&op='delUser'");            
    } else {
        return false;
    }
}

//Função de confirmação de deleção de unidade
function confirmaDeletaMemorando(id)
{
    if(confirm('ATENÇÃO:\n\nUma vez deletado, o memorando será perdido e não será possível recuperá-lo. Seu número identificador também será inutilizado (não poderão haver outros memorandos com o mesmo número).\n\nTem certeza que deseja excluir este memorando?')){
        window.location = ("cAdmin-excluir.php?idMemorando="+id+"&op='delMemo'");            
    } else {
        return false;
    }
}

//Função que pega o ID da linha da unidade a ser editada e executa um post para a página de edição
function encaminhaUnidade(id, nomeUnidade)
{    
    $("#idUnidade").val(id);
    $("#nomeUnidade").val(nomeUnidade);
    $("#formUnidade").submit();
}

//Função que pega o ID da linha do usuário a ser editado e executa um post para a página de edição
function visualizarMemorando(){
    var mensagem = $("#formMemorando").attr("action");
    alert(mensagem);
    alert("oi");
    $("#formMemorando").attr("action", "cGera-mi.php");
    $("#formMemorando").submit();
}

function salvarMemorando(){
        
    var data = $("form#formMemorando").serialize();
    $.post("cSalvar-mi(copia).php", 
        {
            txtDestinatario : $("#txtDestinatario").val(),
            txtTitulo : $("#txtTitulo").val(),
            txtCargo : $("#txtCargo").val(),
            txtCorpo : $("#txtPortaria").val(),
            txtReferencia : $("#txtReferencia").val(),    
            data : $("#data").val()
        }
        ,
        function(dataa,status){
        alert("Data: " + dataa + "\nStatus: " + status);
    });

}

function emitirMemorando(){
    $("#formMemorando").attr("action", "");
    $("#formMemorando").submit();
}