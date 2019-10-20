<?php
require_once "autoload.php";
$acao = isset($_GET['acao']) ? $_GET['acao'] : $_POST['acao'];

if ($acao == 'logoof') {
    session_start();
    session_destroy();
    header("location:info.php");
} else {
    if ($acao == "login") {
        $user = isset($_POST['log'])?$_POST['log']:0;
        $senha = isset($_POST['senha'])?$_POST['senha']:0;
        logar($user, $senha);
        if($user == 0 and $senha == 0){
            header("location:info.php?error=1");
        }
        
    }
}

function logar($user, $senha) {
    $sql = "SELECT * FROM usuario WHERE CPF = '$user'";
    $banco = new banco;
    $row = $banco->select($sql);
    print_r($row);
    $senhaBD = "";
    $usuario = "";
    $nome = "";
        $senhaBD = $row[0]['senha'];
        $usuario = $row[0]['CPF'];
        $nome = $row[0]['nome'];
        $codigo = $row[0]['id'];
        $foto = $row[0]['foto'];
        echo "$senhaBD =";

    $senha = sha1($senha);
    echo "$senha ei";
    if ($senha == $senhaBD) {
        session_start();
        $_SESSION['usuario'] = $usuario;
        $_SESSION['nome'] = $nome;
        $_SESSION['codigo']= $codigo;
        $_SESSION['foto'] = $foto;
        $_SESSION['senha'] = $senhaBD;
        header("location:index.php");
    } else {
        header("location:info.php?error=1");
    }
}
