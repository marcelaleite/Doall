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
                            
                            $sql = "select * from produto where idUsuario != {$_SESSION['codigo']} limit 12";
                        
                        $produto = new produto(1);
                        $listagem = $produto->listar($sql);
                        for($i = 0; $i<count($listagem); $i++){
                            echo "<div class='col l3 m3 s12'>
                            <div class='card'>
                            <a href='produto.php?caodie=".($listagem[$i]['id']+200)."'>
                                <div class='card-image'>
                                    <img width='220' height='220' src='{$listagem[$i]['fotos']}'>
                                </div>
                                <div class='card-content'>
                                    <p class='black-text'><b>{$listagem[$i]['nome']}</b></p>
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
