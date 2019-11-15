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


    function limpa_formulário_cep() {
        //Limpa valores do formulário de cep.
        document.getElementById('rua').value=("");
        document.getElementById('bairro').value=("");
        document.getElementById('cidade').value=("");
    }

    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('rua').value=(conteudo.logradouro);
            document.getElementById('bairro').value=(conteudo.bairro);
            document.getElementById('cidade').value=(conteudo.localidade);
            M.updateTextFields();
        } //end if.
        else {
            //CEP não Encontrado.
            limpa_formulário_cep();
            alert("CEP não encontrado.");
        }
    }
        
    function pesquisacep(valor) {
        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                document.getElementById('rua').value="...";
                document.getElementById('bairro').value="...";
                document.getElementById('cidade').value="...";

                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);

            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    };
