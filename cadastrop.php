<!DOCTYPE html>
<html>
    <head>
        <title>Doall | Cadastro de Produto</title>
        <meta charset="utf-8" />
        <?php
        require_once "funcoes.php";
        include 'head.php';
        include 'valida.php';
        ?>

    </head>

    <body class="grey lighten-3">
         <!-- Cabeçalho -->
         <header>
            <!-- Dropdown Structure -->
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
            <!-- Quadro de cadastro -->
              <div class="row col s12">
            <form class="col s12 grey lighten-3 " method="post" action="acaoproduto.php" enctype="multipart/form-data">
                   <div class="row">
                    <div class="input-field col l3 m3 s10 offset-l2 offset-m2 offset-s1">
                        <input id="nomeprod" name="nomeprod" type="text" class="validate">
                        <label for="nomeprod" >Nome do produto</label>
                    </div>
                 <div class="input-field col l3 m3 s10 offset-s1">
                        <i class="material-icons prefix" >description</i>
                        <input id="descricao" name="descricao" type="text" class="validate">
                        <label for="descricao">Descrição</label>
                    </div>
                    <div class="input-field col l2 m2 s10 offset-s1">
                        <input id="localizaprod" name="localizaprod" type="text" class="validate">
                        <label for="localizaprod" >Localização do produto</label>
                    </div>
                        </div>
               <div class="row col s12">
                    <div class="input-field col l4 m4 s10 offset-l4 offset-m4 offset-s1">
                        <div class="file-field">
                            <div class="btn">
                                <span>Fotos</span>
                                <input type="file" name="arquivo" >
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text" placeholder="Adicione 1 foto" name="caminho">
                            </div>
                        </div>
                    </div>
                </div>
               <div class="row col s12">
                        <div class="col l2  m2 s2 offset-l5 offset-m5 offset-s5">
                            <button class="btn waves-effect waves-light" id="bt" type="submit" name="acao" value="crie">Enviar
                            </button>
                        </div>
                    </div>
            </form>
            </div>
        </main>
        <!-- Rodapé -->
        <?php
            echo footer();
        ?>
    </body>
    <?php require_once 'javas.html'; ?>
</html>
