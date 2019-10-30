<!DOCTYPE html>
<?php
require_once 'valida.php';
include 'autoload.php';

$codigo = isset($_GET['id'])?($_GET['id']-200):0;
if(!isset($_GET['id'])){
    header('location:index.php');
}
?>
<html>
    <head>
        <title>Doall | Produto</title>
        <?php include 'head.php'; 
        require_once "funcoes.php"; ?>
    </head>

    <body class="grey lighten-3">
        <!-- Cabeçalho -->
        <header>
            <nav class="roxo">
                <div class="nav-wrapper" >
                    <ul class="left " >
                        <li><a href="index.php"><i class="material-icons">arrow_back</i></a></li>
                    </ul>
                    <a href="#" class="brand-logo center">Doall</a>
                </div>
            </nav>
        </header>
        <main>
            <?php
                $produtos = ProdutoDao::Select('id', $codigo);
                $produto = $produtos[0];
                echo $produto;
            ?>
        </main>
        <!-- Rodapé -->
        <?php
            echo footer();
        ?>

    </body>
    <?php require_once 'javas.html'; ?>
</html>
