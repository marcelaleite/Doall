<!DOCTYPE html>
<html>

<head>
    <title>Doall | Tela Inicial</title>
    <?php
        require_once 'head.php';
        require_once "funcoes.php"
        ?>
</head>

<body class="grey lighten-3">
    <!-- Cabeçalho -->
    <header>
        <nav class="roxo">
            <div class="nav-wrapper">
                <a href="info.php" class="brand-logo center">Doall</a>
            </div>
        </nav>
    </header>
    <main>
        <div class="row">
            <div class="col s12">
                <div class="center">
                    <h4 class="roxo-text">Recuperação de Senha</h4>
                </div>
            </div>
        </div>
        <form action="acao.php" method="post">
            <div class="row">
                <div class="col s12">
                    <div class="col l6 m6 s10 offset-l3 offset-m3 offset-s1 input-field">
                        <i class="material-icons prefix">email</i>
                        <input required id="email" name="email" type="email" class="">
                        <label for="email">Email</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    <div class="center">
                        <button type="submit" name="acao" class="btn" value="recuperar">Requisitar</button>
                    </div>
                </div>
            </div>
        </form>
        <?php
            $verificacao = isset($_GET['email'])?$_GET['email']:'';
           if($verificacao == 'success'){
            echo '<div class="row">
            <div class="col s12">
                <div class="center">
                    <h5 class="green-text">Email enviado com sucesso.</h5>
                </div>
            </div>
        </div>';
           }
           elseif($verificacao == 'fail'){
            echo '<div class="row">
            <div class="col s12">
                <div class="center">
                    <h5 class="red-text">Email não enviado, tente novamente mais tarde.</h5>
                </div>
            </div>
        </div>';
           }
        ?>
    </main>
    <!-- Rodapé -->
    <?php
            echo footer();
        ?>
</body>
<?php
    require_once 'javas.html'; ?>

</html>