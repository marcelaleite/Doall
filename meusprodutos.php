<!DOCTYPE html>
<?php

require_once 'valida.php';
$codigo = isset($_SESSION['codigo']) ? $_SESSION['codigo'] : 0;
?>
<html>
    <head>
        <title>Doall | Meus Produtos</title>
        <?php include 'head.php'; require_once "funcoes.php"; ?>
    </head>

    <body class="grey lighten-3">
        <!-- Cabeçalho -->
        <?php
        echo header2();
        ?>
        <main>

            <div class="row col s12 ">
                <div class="col s3">
                    
                </div>
                <div class="col s9 offset-s2">
                    
                    <?php 
                        require_once "autoload.php";
                        $produtos = ProdutoDao::Select("idUsuario",$codigo);
                        foreach($produtos as $produto){
                            echo "<div class='col l3 m3 s12'>
                            <div class='card'>
                                <div class='card-image'>
                                    <img width='220' height='220' src='{$produto->getFoto()}'>
                                </div>
                                <div class='card-content'>
                                    <p><b>{$produto->getNome()}</b></p>
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
