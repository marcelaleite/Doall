<!DOCTYPE html>
<?php
include 'autoload.php';
require_once "funcoes.php";
require_once 'valida.php';
$codigo = isset($_SESSION['codigo']) ? $_SESSION['codigo'] : 0;
$user = new usuario($codigo);
$row = $user->getAll();

?>
<html>

<head>
    <title>Doall | Alterar/</title>
    <?php include 'head.php'; ?>
</head>

<body class="grey lighten-3">
    <!-- Cabeçalho -->
    <header>
        <!-- Dropdown Structure -->
        <nav class="roxo">
            <div class="nav-wrapper">
                <a href="#" class="brand-logo center">Doall</a>
                <ul class="left ">
                    <li><a href="conta.php"><i class="material-icons">arrow_back</i></a></li>
                </ul>
            </div>

        </nav>
    </header>
    <?php

    ?>
    <form action="acao.php" method="post" enctype="multipart/form-data">
        <h2 class="center-align roxo-text">Seus Dados</h2>
        <div class="row col s3 offset-s2">
            <div class="input-field col s4 offset-s2">
                <div class="file-field">
                    <div class="btn">
                        <span>Fotos</span>
                        <input type="file" name="arquivo">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text" style="display: hidden;" placeholder="Selecione"
                            name="caminho" value="">
                    </div>
                </div>
            </div>
        </div>
        <div class="row col s12">

            <div class="input-field col s3 offset-s2">
                <input id="nome" name="nome" type="text" value="<?php echo $row['nome']; ?>">
                <label for="nome">Nome</label>
            </div>
        </div>
        <div class="row col s12">
            <div class="input-field col s3 offset-s2">
                <input id="sobrenome" name="sobrenome" type="text" value="<?php echo $row['sobrenome']; ?>">
                <label for="sobrenome">sobrenome</label>
            </div>
        </div>
        <div class="row col s12">
            <div class="input-field col s3 offset-s2">
                <input id="cof" name="cpf" type="text" value="<?php echo $row['CPF']; ?>" data-mask="000.000.000-00">
                <label for="cpf">CPF</label>
            </div>
        </div>
        <div class="row col s12">
            <div class="input-field col s3 offset-s2">
                <input id="dtnascimento" name="dtnascimento" type="text"
                    value="<?php echo date("d/m/Y", strtotime($row['dataNasc'])) ?>" data-mask="00/00/0000">
                <label for="dtnascimento">Data de Nasicmento</label>
            </div>
        </div>
        <div class="row col s12">
            <div class="input-field col s3 offset-s2">
                <select name="sexo">
                    <option <?php if ($row['sexo'] == "F") {
                                echo "selected";
                            } ?> value="F">F</option>
                    <option <?php if ($row['sexo'] == "M") {
                                echo "selected";
                            } ?> value="M">M</option>
                </select>
                <label for="dtnascimento">Data de Nasicmento</label>
            </div>
        </div>
        <div class="row col s12">
            <div class="input-field col s3 offset-s2">
                <input id="email" name="email" type="text" value="<?php echo $row['email'] ?>">
                <label for="email">Email</label>
            </div>
        </div>
        <div class="row col s12">
            <div class="input-field col s3 offset-s2">
                <input id="telefone" name="telefone" type="text" value="<?php echo $row['telefone'] ?>">
                <label for="telefone">Telefone</label>
            </div>
        </div>
        <div class="row col s12">
            <div class="input-field col s3 offset-s2">
                <input id="numprot" name="numprot" type="text"
                    value="<?php echo $row['nProtocolo'] != "" ? $row['nProtocolo'] : ''; ?>">
                <label for="numprot">Número de protocolo</label>
            </div>
        </div>
        </div>

        <div class="row col s12">
            <div class="col s2 offset-s2 ">
                <a href="alterar.php"> <button class="btn waves-effect roxo" name="acao"
                        value="alterar">Alterar</button></a>
            </div>
        </div>
    </form>
    <!-- Rodapé -->
    <?php
    echo footer();
    ?>

</body>
<?php require_once 'javas.html'; ?>

</html>