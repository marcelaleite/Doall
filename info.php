<!DOCTYPE html>
<html>
    <head>
        <title>Doall | Tela Inicial</title>
        <?php
        include 'head.php';
        $li = "va";
        ?>
    </head>

    <body class="grey lighten-3" onload="erro = document.getElementById('error').value; if(erro != '') Swal.fire({type: 'error',title: 'Erro',text: 'Usuário ou senha incorretos'});">
        <!-- Cabeçalho -->
        <?php
        require_once "funcoes.php";
        echo header1();
        require_once 'login.php';
        ?>
        <main>
            <input  type='hidden' id='error' value="<?php echo isset($_GET['error'])?$_GET['error']:''; ?>">
            <div class="row col s12 l12 m12">
            <div class="col l5 offset-l1 s10 offset-s1"> 
                <br><br>
                    <center> <h4 style="font-family:arial"> Seja muito bem-vindo(a)!</h4></center>
                    <br><br>
                    <h6 style="text-align:justify; line-height:2">Você está em um site de doações, nos chamamos DOALL.
                    Aqui você poderá doar roupas, produtos eletrônicos, utencílios, entre outros objetos que você não utiliza, mas ainda é útil para outra pessoa. 
                    Lembrando que alimentos perecíveis e dinheiro não serão aceitos!
                    Caso seja cadastrado no CRAS fique tranquilo que você terá preferência ao pedir os produtos: roupas e alimentos. </h6>
                </div>
                <div class="col l6 s12">
                    <div class="carousel">
                        <a class="carousel-item" href="#one!"><img src="img/roupas.jpg" height="260" ></a>
                        <a class="carousel-item" href="#two!"><img src="img/eletronicos.jpg" height="260"></a>
                        <a class="carousel-item" href="#three!"><img src="img/celular.jpg" height="260"></a>
                        <a class="carousel-item" href="#four!"><img src="img/alimentos.jpg" height="260"></a>
                    </div>
                </div>
            </div>
        </main>
        <!-- Rodapé -->
        <?php
            echo footer();
        ?>
    </body>
    <?php
    require_once 'javas.html'; ?>
</html>
