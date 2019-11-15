<?php
require_once "autoload.php";

$acao = isset($_POST['acao']) ? $_POST['acao'] : 0;
$nome = isset($_POST['nome']) ? $_POST['nome'] : 0;
$sobrenome = isset($_POST['sobrenome']) ? $_POST['sobrenome'] : 0;
$cpf = isset($_POST['cpf']) ? $_POST['cpf'] : 0;
$dtnascimento = isset($_POST['dtnascimento']) ? date("Y-m-d", strtotime(str_replace('/', '-', $_POST['dtnascimento']))) : 0;
$email = isset($_POST['email']) ? $_POST['email'] : 0;
$telefone = isset($_POST['telefone']) ? $_POST['telefone'] : 0;
$sexo = isset($_POST['sexo']) ? $_POST['sexo'] : 0;
$numprot = null;
if (isset($_POST['numprot']) and $_POST['numprot'] != 0)
    $numprot = $_POST['numprot'];
$cep = isset($_POST['cep']) ? $_POST['cep'] : 0;
$rua = isset($_POST['rua']) ? $_POST['rua'] : 0;
$numero = isset($_POST['numcasa']) ? $_POST['numcasa'] : 0;
$bairro = isset($_POST['bairro']) ? $_POST['bairro'] : 0;
$complemento = isset($_POST['complemento']) ? $_POST['complemento'] : 0;
$cidade = isset($_POST['cidade']) ? $_POST['cidade'] : 0;
$referencia = isset($_POST['referencia']) ? $_POST['referencia'] : 0;
$log = isset($_POST['log']) ? $_POST['log'] : 0;
$senha = isset($_POST['senha']) ? $_POST['senha'] : sha1("0000");
$senha = sha1($senha);
if ($acao == "crie") {
    $usuario = new Usuario();
    $usuario->setNome($nome);
    $usuario->setSobrenome($sobrenome);
    $usuario->setCpf($cpf);
    $usuario->setDataNasc($dtnascimento);
    $usuario->setEmail($email);
    $usuario->setTelefone($telefone);
    $usuario->setSexo($sexo);
    $usuario->setNProrocolo($numprot);
    $usuario->setSenha($senha);
    $usuario->setFoto(null);
    $usuario->setTipo('usuario');
    $usuario->setEmailVerificacao(0);

    $verificar = UsuarioDao::VerificaCadastro($usuario);
    if ($verificar != 0) {
        echo "CPF ou email já utilizados";
    } else {
        $valida = UsuarioDao::Insert($usuario);
        if ($valida !== true) {
            echo "Cadastro de usuario falhou tente novamente mais tarde!!";
        }
        $row = UsuarioDao::Select('CPF', $usuario->getCpf());
        $usuario = $row[0];
        $endereco = new Endereco;
        $endereco->setCep($cep);
        $endereco->setRua($rua);
        $endereco->setNumero($numero);
        $endereco->setBairro($bairro);
        $endereco->setComplemento($complemento);
        $endereco->setCidade($cidade);
        $endereco->setReferencia($referencia);
        $valida = EnderecoDao::Insert($endereco, $usuario->getCodigo());
        if ($valida !== true) {
            echo "Cadastro de endereço falhou tente novamente mais tarde";
            UsuarioDao::Deletar($usuario);
        } else {
            echo "Cadastro concluido!";
        }
    }
} elseif ($acao == "alterar") {
    include 'valida.php';
    $usuarios = UsuarioDao::Select('id', $_SESSION['codigo']);
    $usuario = $usuarios[0];
    $usuario->setNome($nome);
    $usuario->setSobrenome($sobrenome);
    $usuario->setCpf($cpf);
    $usuario->setDataNasc($dtnascimento);
    $usuario->setEmail($email);
    $usuario->setTelefone($telefone);
    $usuario->setSexo($sexo);
    $usuario->setNProrocolo($numprot);
    $usuario->setSenha($_SESSION['senha']);
    $verificar = 0;
    $verificar = UsuarioDao::VerificaFoto($usuario, $_FILES['arquivo']['name']);
    if ($verificar[0][0] == 0 and $_FILES['arquivo']['name'] != '') {
        $upload = new Upload;
        $nova_foto = $upload->uploadImagem('arquivo', 'img/Usuario/');
        var_dump($nova_foto);
        if (!is_array($nova_foto)) {
            $antiga_foto = $usuario->getFoto();
            $usuario->setFoto($nova_foto);
            if (UsuarioDao::Update($usuario)) {
                unlink($antiga_foto);
                $_SESSION['foto'] = $usuario->getFoto();
                $_SESSION['nome'] = $usuario->getNome();
                $_SESSION['usuario'] = $usuario->getCpf();
            } else {
                unlink($nova_foto);
            }
        }
    } elseif ($verificar != 0) {
        $usuario->setFoto($_SESSION['foto']);
        if (UsuarioDao::Update($usuario)) {
            $_SESSION['nome'] = $usuario->getNome();
            $_SESSION['usuario'] = $usuario->getCpf();
        }
    } else {
        $usuario->setFoto(null);
        if (UsuarioDao::Update($usuario)) {
            $_SESSION['nome'] = $usuario->getNome();
            $_SESSION['usuario'] = $usuario->getCpf();
        }
    }

    header("location:conta.php");
}

elseif($acao == 'recuperar'){
    $usuarios = UsuarioDao::Select('email', $email);
    $usuario = $usuarios[0];
    $hash = $usuario->hash();
    $email = $usuario->getEmail();
    $link = "doall.tech/novasenha.php?hash=$hash&email=$email";
    $to = $usuario->getEmail();

    $subject = "Alteração de Senha";

    $message = "Para recuperar sua senha \n <button><a href='{$link}'>Clique aqui</a></button>";

    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html;' . "\r\n";
    $headers .= "From: $email";

    if(mail($to, $subject, $message, $headers)){
        header("location:recuperaemail.php?email=success");
    }
    else{
        header("location:recuperaemail.php?email=fail");
    }
}

elseif($acao == 'alterarSenha'){
    $usuarios = UsuarioDao::Select('email', $email);
    $usuario = $usuarios[0];
    $usuario->setSenha($senha);
    if(UsuarioDao::Update($usuario))
        header("location:novasenha.php?senha=success");
    else
        header("location:novasenha.php?senha=fail");
}