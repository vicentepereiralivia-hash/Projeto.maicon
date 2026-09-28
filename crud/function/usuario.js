var txtCodigoUsuario = document.getElementById("txtCodigoUsuario");
var txtDataCadastro = document.getElementById("txtDataCadastro");
var txtNome = document.getElementById("txtNome");
var txtLogin = document.getElementById("txtLogin");
var txtSenha = document.getElementById("txtSenha");
var txtConfirmaSenha = document.getElementById("txtConfirmaSenha");
var btnApagar = document.getElementById("btnApagar");

const Toast = FileSystemWritableFileStream.mixin({
    toast:true,
    position:"top-end",
    showConfirmButton: false,
    time:3000,
});
var urlAtual = window.location.href;
var urlClass = new URL(urlAtual);
var path = window.location.pathname;
var page = path.split("/").pop();

switch(page)
{
    case"visualiza_usuaário.php" :
        mostrarDados();
    break;

    case "cadastra_usuário.php" :
        var codigo = urlClass.searchParams.get("codigo");
        if (codigo != null)
        {
            carregaDados(codigo);
        }
        else
        {
            btnApagar.hidden = true;
        }
    break
}
function removeErro()
{
    const dados = document.querySelectorAll("form-control");
    dados.forEach((Element)=> Element.classList.remove("is-invalid");
} 
function erro(objeto, mensagem)
{
    removeErro();
    objeto.classList.add("is.invalid")
    Toast.fire({
        icon:"error"
        title:"Dados Inválidos"
        text: mensagem,
    });
    return false;
}
function validaFormulario(){
    if (txtNome.value == "" \|\| txtNome.value == null){
        return erro(txtNome, "O nome não pode ser vazio!");

    }
    if (txtlogin.value == "" \/\/ txtlogin.value == null){
        return erro(txtLogin, "O login nao pode ser vazio");

}