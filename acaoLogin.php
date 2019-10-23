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
        if($user == 0 and $senha == 0){
            header("location:info.php?error=1");
        }
        logar($user, sha1($senha));
    }
}

function logar($user, $senha) {
    $row = UsuarioDao::Select('CPF', $user);
    $usuario = $row[0];
    if ($senha == $usuario->getSenha()) {
        session_start();
        $_SESSION['usuario'] = $usuario->getCPF();
        $_SESSION['nome'] = $usuario->getNome();
        $_SESSION['codigo']= $usuario->getCodigo();
        $_SESSION['foto'] = $usuario->getFoto();
        $_SESSION['senha'] = $usuario->getSenha();
        header("location:index.php");
    } else {
        header("location:info.php?error=1");
    }
}
