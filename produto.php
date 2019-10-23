<!DOCTYPE html>
<?php
include 'autoload.php';
require_once 'valida.php';
$codigo = isset($_GET['caodie'])?($_GET['caodie']-200):0;
if(!isset($_GET['caodie'])){
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
                $produto = new produto($codigo);
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
