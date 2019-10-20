document.getElementById("senha").onkeyup = function () {
 var senha = document.getElementById("senha").value;
 var confsenha = document.getElementById("confsenha").value;
 if (senha != confsenha) {
 document.getElementById("confsenha").classList.add("invalid");
 document.getElementById("confsenha").classList.remove("valid");
 document.getElementById("acao").disabled = true;
 }
 else {
 document.getElementById("confsenha").classList.remove("invalid");
 document.getElementById("confsenha").classList.add("valid");
 document.getElementById("acao").disabled = false;
 }

 };

/*function botao (){
 var botao = document.getElementById("tr").value;
 if(botao === "Sem protocolo"){
 document.getElementById("numprot").disabled = true;
 document.getElementById('tr').value = 'Com protocolo';
 }
 else{
 document.getElementById("numprot").disabled = false;
 document.getElementById('tr').value = 'Sem protocolo';
 }
 }*/

// validação senha
document.getElementById("confsenha").onkeyup = function () {
    var senha = document.getElementById("senha").value;
    var confsenha = document.getElementById("confsenha").value;
    if (senha != confsenha) {
        document.getElementById("confsenha").classList.add("invalid");
        document.getElementById("confsenha").classList.remove("valid");
        document.getElementById("acao").disabled = true;
    } else {
        document.getElementById("confsenha").classList.remove("invalid");
        document.getElementById("confsenha").classList.add("valid");
        document.getElementById("acao").disabled = false;
    }

};

// botão do protocolo
$('#tr').click(function () {
    var botao = document.getElementById("tr").value;
    $("#prot").toggle();
    if (botao === "Sem protocolo") {
        document.getElementById('tr').value = 'Com protocolo';
    } else {
        document.getElementById('tr').value = 'Sem protocolo';
    }

});

document.getElementById("cpf").onkeyup = function () {
    cpf = document.getElementById("cpf").value;
    resultado = cpf.replace(".", ""); 
    resultado = resultado.replace(".", ""); 
    resultado = resultado.replace(".", "");
    resultado = resultado.replace("-", "");
    if (TestaCPF(resultado)) {
        document.getElementById("cpf").classList.remove("invalid");
        document.getElementById("cpf").classList.add("valid");
        document.getElementById("acao").disabled = false;
    } else {
        document.getElementById("cpf").classList.remove("valid");
        document.getElementById("cpf").classList.add("invalid");
        document.getElementById("acao").disabled = true;
    }
};

function TestaCPF(strCPF) {
    var Soma;
    var Resto;
    Soma = 0;
    if (strCPF == "00000000000") return false;

    for (i = 1; i <= 9; i++) Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (11 - i);
    Resto = (Soma * 10) % 11;

    if ((Resto == 10) || (Resto == 11)) Resto = 0;
    if (Resto != parseInt(strCPF.substring(9, 10))) return false;

    Soma = 0;
    for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (12 - i);
    Resto = (Soma * 10) % 11;

    if ((Resto == 10) || (Resto == 11)) Resto = 0;
    if (Resto != parseInt(strCPF.substring(10, 11))) return false;
    return true;
}