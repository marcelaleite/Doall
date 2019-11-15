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
        <?php
            require_once "autoload.php";
            if(isset($_GET['senha'])){
                if($_GET['senha'] == 'success'){
                    echo '<div class="row">
                    <div class="col s12">
                        <div class="center">
                            <h5 class="green-text">Senha alterada com sucesso</h5>
                        </div>
                    </div>
                </div>';
                }
                else{
                    echo '<div class="row">
                    <div class="col s12">
                        <div class="center">
                            <h5 class="red-text">A alteração de senha falhou, tente novamente mais tarde</h5>
                        </div>
                    </div>
                </div>';
                }
            }
            else{
                $email = isset($_GET['email']) ? $_GET['email'] : 0;
                $hashEmail = isset($_GET['hash'])?$_GET['hash'] : 0;
                $usuarios = UsuarioDao::Select('email', $email);
                $usuario = $usuarios[0];
                $hash = $usuario->hash();
                if($hashEmail == $hash){
                    echo '<form action="acao.php" method="post">
                    <input type="hidden" value="'.$email.'" name="email">
                    <div class="row">
                    <div class="col s12">
                        <div class="input-field col l3 m3 s10 offset-l3 offset-m3 offset-s1 ">
                            <i class="material-icons prefix">https</i>
                            <input required id="senha" name="senha" type="password" class="validate" minlength="6">
                            <label for="senha">Senha</label>
                        </div>
                        <div class="input-field col l3 m3 s10 offset-s1">
                            <input id="confsenha" name="confsenha" type="password" minlength="6">
                            <label id="lblconfsenha" for="confsenha">Confirmar senha</label>
                            <span class="helper-text" data-error="Senhas não coincidem"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12">
                        <div class="center">
                            <button type="submit" name="acao" class="btn" value="alterarSenha" id="acao">Alterar</button>
                        </div>
                    </div>
                </div></form>';
                }
                else{
                    echo '<div class="row">
                    <div class="col s12">
                        <div class="center">
                            <h5 class="red-text">Codigo Inválido</h5>
                        </div>
                    </div>
                </div>';
                }
            }
        ?>
        
    </main>
    <!-- Rodapé -->
    <?php
            echo footer();
        ?>
</body>
<script>
    document.getElementById("senha").onkeyup = function () {
 var senha = document.getElementById("senha").value;
 var confsenha = document.getElementById("confsenha").value;
 if (senha != confsenha) {
 document.getElementById("confsenha").classList.add("invalid");
 document.getElementById("confsenha").classList.remove("valid");
 document.getElementById("acao").disabled = true;
 }
 else {
 document.getElementById("confsenha").classList.remove("invalid");
 document.getElementById("confsenha").classList.add("valid");
 document.getElementById("acao").disabled = false;
 }

 };


// validação senha
document.getElementById("confsenha").onkeyup = function () {
    var senha = document.getElementById("senha").value;
    var confsenha = document.getElementById("confsenha").value;
    if (senha != confsenha) {
        document.getElementById("confsenha").classList.add("invalid");
        document.getElementById("confsenha").classList.remove("valid");
        document.getElementById("acao").disabled = true;
    } else {
        document.getElementById("confsenha").classList.remove("invalid");
        document.getElementById("confsenha").classList.add("valid");
        document.getElementById("acao").disabled = false;
    }

};
</script>
<?php
    require_once 'javas.html'; ?>

</html>