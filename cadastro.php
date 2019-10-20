<!DOCTYPE html>
<html>

<head>
    <title>Doall | Cadastro</title>
    <?php require_once "funcoes.php";
    include 'head.php'; ?>
</head>

<body class="grey lighten-3">
    <!-- Cabeçalho -->
    <?php echo header1();
    require_once 'login.php'; ?>
    <main>
        <!-- Quadro de cadastro -->

        <div class="parallax-container">
            <div class="parallax"><img src="img/fundo.jpg" style="transform: translate3d(-50%, 59.761px, 0px); opacity: 1;"></div>
        </div>
        </div>
        <div class="section">
            <div class="center">
                <h4 class="roxo-text ">Identificação</h4>
            </div>
            <br>
            <div class="row col s10">
                <div class="center">
                    <input type='button' name="tr" id="tr" class="btn tooltipped" data-position="top" value="Sem protocolo" data-tooltip="O número é dado pelo CRAS se você for de baixa renda">
                </div>
            </div>
            <div class="row col s12">
                <form class="col s12 grey lighten-3 " method="post" action="acao.php" id="formu">
                    <div class="row">
                        <div class="input-field col l3 m3 s10 offset-l2 offset-m2 offset-s1">
                            <i class="material-icons prefix">account_circle</i>
                            <input required id="nome" name="nome" type="text">
                            <label for="nome">Nome</label>
                        </div>
                        <div class="input-field col l3 m3 s10 offset-s1">
                            <input required id="sobrenome" name="sobrenome" type="text">
                            <label for="sobrenome">Sobrenome</label>
                        </div>
                        <div class="input-field col l3 m3 s10 offset-s1">
                            <input required id="cpf" name="cpf" type="text" data-mask="000.000.000-00">
                            <label for="cpf">CPF</label>
                            <span class="helper-text" data-error="CPF não valido"></span>
                        </div>
                    </div>
                    <br class="hide-on-med-and-down ">

                    <div class="row">
                        <div class="input-field col l2 m2 s10 offset-l2 offset-m2 offset-s1">
                            <i class="material-icons prefix">event</i>
                            <input required id="dtnascimento" name="dtnascimento" type="text" data-mask="00/00/0000">
                            <label for="dtnascimento" class="active">Data de Nascimento</label>
                        </div>
                        <div class="input-field col l1 m1 s10 offset-s1">
                            <select name="sexo" required>
                                <option value="" disabled selected>Sexo</option>
                                <option value="M">Masculino</option>
                                <option value="F">Feminino</option>
                            </select>
                            <label for="sexo">Sexo</label>
                        </div>
                        <div class="input-field col l4 m4 s10 offset-s1">
                            <i class="material-icons prefix">email</i>
                            <input required id="email" name="email" type="email" class="">
                            <label for="email">Email</label>
                            
                        </div>
                        <div class="input-field col l2 m2 s10 offset-s1">
                            <i class="material-icons prefix">call</i>
                            <input required id="telefone" name="telefone" type="text" data-mask="(00)90000-0000">
                            <label for="telefone">Celular</label>
                        </div>
                    </div>

                    <br class="hide-on-med-and-down ">

                    <div class="row">
                        <div class="input-field col l3 m3 s10 offset-l2 offset-m2 offset-s1 ">
                            <i class="material-icons prefix">https</i>
                            <input required id="senha" name="senha" type="password" class="validate">
                            <label for="senha">Senha</label>
                        </div>
                        <div class="input-field col l3 m3 s10 offset-s1">
                            <input id="confsenha" name="confsenha" type="password">
                            <label id="lblconfsenha" for="confsenha">Confirmar senha</label>
                            <span class="helper-text" data-error="Senhas não coincidem"></span>
                        </div>
                        <div class="input-field col l3 m3 s10 offset-s1 " id="prot">
                            <i class="material-icons prefix">assignment</i>
                            <input id="numprot" name="numprot" type="text">
                            <label for="numprot">Nº de protocolo</label>
                        </div>
                    </div>


                    <br class="hide-on-med-and-down ">
                    <br class="hide-on-med-and-down ">
                    <br class="hide-on-med-and-down ">
                    <div class="row col s12">
                        <div class="center">
                            <h4 class="roxo-text ">Endereço</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col l2 m2 s10 offset-l2 offset-m2 offset-s1">
                            <i class="material-icons prefix">place</i>
                            <input required id="cep" name="cep" type="text" data-mask="00000-000">
                            <label for="cep">CEP</label>
                        </div>
                        <div class="input-field col l3 m3 s10 offset-s1">
                            <i class="material-icons prefix">my_location</i>
                            <input required id="rua" name="rua" type="text">
                            <label for="rua">Rua</label>
                        </div>
                        <div class="input-field col l1 m1 s10 offset-s1">
                            <input required id="numcasa" name="numcasa" type="number">
                            <label for="numcasa">Número</label>
                        </div>
                        <div class="input-field col l3 m3 s10 offset-s1">
                            <input required id="bairro" name="bairro" type="text">
                            <label for="bairro">Bairro</label>
                        </div>
                    </div>

                    <br class="hide-on-med-and-down ">

                    <div class="row">
                        <div class="input-field col l3 m3 s10 offset-l2 offset-m1 offset-s1">
                            <i class="material-icons prefix">home</i>
                            <input id="complemento" name="complemento" type="text">
                            <label for="complemento">Complemento</label>
                        </div>

                        <div class="input-field col l3 m3 s10 offset-s1">
                            <i class="material-icons prefix">location_city</i>
                            <input required id="cidade" name="cidade" type="text">
                            <label for="cidade">Cidade</label>
                        </div>
                        <div class="input-field col l3 m3 s10 offset-s1">
                            <i class="material-icons prefix">landscape</i>
                            <input id="referencia" name="referencia" type="text">
                            <label for="referencia">Referência</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="center">
                            <button class="btn waves-effect waves-light" id="acao" type="button" name="acao" value="crie" onclick="insertData()">Enviar
                            </button>
                        </div>
                    </div>
            </div>
            </form>
        </div>
        </div>
    </main>
    <!-- Rodapé -->
    <?php
    echo footer();
    ?>


    <?php require_once 'javas.html'; ?>
    <script src="js/formu.js"></script>
    <script src="js/func.js"></script>
</body>

</html>