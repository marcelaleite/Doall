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
        <?php
            echo header2();
        ?>
        <main>

            <div class="row col s12 ">
                <div class="col s3">
                    <form method="post" action="#">
                        <div class="col s3 input-field">
                            <!-- <label>
                                <input type="checkbox" name="">
                                <span>O</span>
                            </label> -->
                        </div>
                    </form>
                </div>
                <div class="col s9 offset-s2">
                    
                    <?php 
                        require_once "autoload.php";
                        $produtos = ProdutoDao::ListagemDosVerificados($_SESSION['codigo']); 
                        foreach($produtos as $produto){
                            echo "<div class='col l3 m3 s12'>
                            <div class='card'>
                            <a href='produto.php?id=".($produto->getCodigo()+200)."'>
                                <div class='card-image'>
                                    <img width='220' height='220' src='{$produto->getFoto()}'>
                                </div>
                                <div class='card-content'>
                                    <p class='black-text'><b>{$produto->getNome()}</b></p>
                                </div>
                                </a>
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
