function generateXMLHttp() {
    if (typeof XMLHttpRequest != "undefined") {
        return new XMLHttpRequest();
    } else {
        if (window.ActiveXObject) {
            var versions = ["MSXML2.XMLHttp.5.0",
                "MSXML2.XMLHttp.4.0",
                "MSXML2.XMLHttp.3.0",
                "MSXML2.XMLHttp",
                "Microsoft.XMLHttp"
            ];
        }
    }
    for (var i = 0; i < versions.length; i++) {
        try {
            return new ActiveXObject(versions[i]);
        } catch (e) {
        }
    }
    alert('Seu navegador não pode trabalhar com Ajax!');
}

function insertData() {
    var formInsert = document.getElementById("formu");
    var fieldsValues = generateFieldsValues(formInsert);
    var tabela = document.getElementById("acao").value;
    //console.log(fieldsValues)
    console.log(tabela);
    var XMLHttp = generateXMLHttp();
    if (tabela == 'crie')
        XMLHttp.open("post", "acao.php", true);

    XMLHttp.setRequestHeader("Content-Type",
            "application/x-www-form-urlencoded");

    XMLHttp.onreadystatechange = function () {
        if (XMLHttp.readyState == 4 && XMLHttp.responseText == "Cadastro concluido!")
            Swal.fire({
                type: 'success',
                title: 'Sucesso',
                text: XMLHttp.responseText
            });
        else if (XMLHttp.statusText != "OK" && XMLHttp.statusText != "")
            Swal.fire({
                type: 'error',
                title: 'Erro',
                text: XMLHttp.statusText
            });
        else if(XMLHttp.statusText != ""){
            Swal.fire({
                type: 'error',
                title: 'Erro',
                text: XMLHttp.responseText
            });
        }
    };
    XMLHttp.send(fieldsValues);
}

function generateFieldsValues(formInsert) {
    var strReturn = new Array();
    console.log(formInsert.elements.length);
    for (var i = 0; i < formInsert.elements.length; i++) {
        if (formInsert.elements[i].name == "autor[]") {
            $('.get_autor').each(function () {
                if ($(this).is(":selected")) {
                    var str = encodeURIComponent(formInsert.elements[i].name);
                    str += "=";
                    str += encodeURIComponent($(this).val());
                    strReturn.push(str);
                }
            });

        } else if (formInsert.elements[i].name == "orientador[]") {
            $('.get_orientador ').each(function () {
                if ($(this).is(":selected")) {
                    var str = encodeURIComponent(formInsert.elements[i].name);
                    str += "=";
                    str += encodeURIComponent($(this).val());
                    strReturn.push(str);
                }
            });
        } else {
            var str = encodeURIComponent(formInsert.elements[i].name);
            str += "=";
            str += encodeURIComponent(formInsert.elements[i].value);
            strReturn.push(str);
        }
    }
    return strReturn.join("&");

}



function getByName() {
    var name = document.getElementById("name").value;
    var result = document.getElementById("result");
    var XMLHttp = generateXMLHttp();
    if (name.length > 0) {
        XMLHttp.open("get", "getDataByName.php?name=" + name, true);
    } else {
        XMLHttp.open("get", "getData.php", true);
    }
    XMLHttp.onreadystatechange = function () {
        if (XMLHttp.readyState == 4)
            if (XMLHttp.status == 200) {
                result.innerHTML = XMLHttp.responseText;
            } else {
                result.innerHTML = "Um erro ocorreu: "
                        + XMLHttp.statusText;
            }
    };
    XMLHttp.send(null);
}



