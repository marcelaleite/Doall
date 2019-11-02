<!DOCTYPE html>
<?php
include 'autoload.php';
require_once 'valida.php';
?>
<html>

<head>
    <title>Doall | Tela Inicial</title>
    <?php include 'head.php'; 
        require_once "funcoes.php"; ?>
</head>

<body class="grey lighten-3">
    <!-- Cabeçalho -->
    <header>
        <nav class="roxo">
            <div class="nav-wrapper">
                <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>

                <ul><li><a href="acaoLogin.php?acao=logoof">Sair</a></li><ul>
                <a href="index.php" class="brand-logo center">Doall</a>
            </div>
        </nav>
        <ul class="sidenav" id="mobile-demo">
            <div class="col s12 row">
                <ul>
                    <li><a href="acaoLogin.php?acao=logoof"><i class="material-icons">exit_to_app</i>Sair</a></li>
                </ul>
            </div>

        </ul>
    </header>
    <main>

        <div class="row col s12 ">
            <div class="col s10 offset-s1">

                <?php 
                        require_once "autoload.php";
                        $produtos = ProdutoDao::Select('todos', ''); 
                        foreach($produtos as $produto){
                            $cor = $produto->getVerificacao() == 0?'red':'green';
                            $texto = $produto->getVerificacao() == 0?"<a href='acaoproduto.php?acao=verificar&codigo={$produto->getCodigo()}'><i class='material-icons roxo-text'>check</i></a>
                            <a href='acaoproduto.php?acao=delete&codigo={$produto->getCodigo()}'><i class='material-icons roxo-text'>delete</i></a>":'';
                            echo "<div class='col l3 m3 s12'>
                            <div class='card'>
                                <div class='card-image'>
                                    <img width='220' height='220' src='{$produto->getFoto()}'>
                                </div>
                                <div class='card-content $cor'>
                                    <p class='black-text'><b>{$produto->getNome()}</b></p>
                                    $texto
                                </div>
                            </div>
                        </div>";
                        }
                    ?>
            </div>
        </div>
    </main>
    <!-- Rodapé -->
    <?php
            echo footer();
        ?>

</body>
<?php require_once 'javas.html'; ?>

</html>