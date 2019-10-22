<!DOCTYPE html>
<?php
include 'autoload.php';
require_once 'valida.php';
$codigo = isset($_SESSION['codigo']) ? $_SESSION['codigo'] : 0;
$row = UsuarioDao::Select('id', $codigo);
$usuario = $row[0];
?>
<html lang="pt-br">
    <head>
        <title>Doall | Conta</title>
        <?php require_once "funcoes.php";
        include 'head.php'; ?>
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
            <div class="row col s12">
                <?php
               
                    ?>
                    <h2 class="center-align roxo-text">Seus Dados</h2> 
                    <div class="col s8 offset-s2">
                        <div class="col l2 m2 s10 offset-s1">
                            <img class="circle" style="margin-top: 10px; " src="<?php echo $usuario->getFoto()!= ""?$usuario->getFoto():"img/user_default.png";  ?>" width="150">
                        </div>
                        <div class="col l4 m4 s10 offset-l1 offset-m3 offset-s1">
                        <p><b>Nome:</b> <?php echo $usuario->getNome(); ?></p>
                        <p><b>Sobrenome:</b> <?php echo $usuario->getSobrenome() ?></p>
                        <p><b>CPF:</b> <?php echo $usuario->getCpf() ?></p>
                        <p><b>Data de Nascimento:</b> <?php echo date("d/m/Y", strtotime($usuario->getDataNasc())) ?></p>
                        <p><b>Sexo:</b> <?php echo ($usuario->getSexo() == "M" ? "Masculino" : "Feminino"); ?></p>
                        <p><b>Email:</b> <?php echo $usuario->getEmail() ?></p>
                        <p><b>Telefone:</b> <?php echo $usuario->getTelefone()?></p>
                        <p><b>Protocolo:</b> <?php echo $usuario->getNProtocolo() != "" ? $usuario->getNProtocolo() : "Não Possui"; ?></p>
                        </div>
                    </div>
                </div>
           
            <div class="row col s12">
                <div class="col s2 offset-s2 ">
                    <a href="alterar.php"> <button class="btn waves-effect roxo" name="enviar" value="alterar">Alterar</button></a>
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
