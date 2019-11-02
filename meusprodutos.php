<!DOCTYPE html>
<?php
require_once "autoload.php";
require_once 'valida.php';
$codigo = isset($_SESSION['codigo']) ? $_SESSION['codigo'] : 0;
$usuarios = UsuarioDao::Select('id', $codigo);
$usuario = UsuarioDao::SelectMeusProdutos(UsuarioDao::SelectEndereco($usuarios[0]));
?>
<html>
    <head>
        <title>Doall | Meus Produtos</title>
        <?php include 'head.php'; require_once "funcoes.php"; ?>
        <script>
        function excluirRegistro(url){
            Swal.fire({
            title: 'Tem certeza?',
            text: "Você não será capaz de desfaz",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim'
        }).then((result) => {
            if (result.value) {
                location.href = url ;
            }
        })
    }


        </script>
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
                        
                        $produtos = $usuario->getMeusProdutos();
                        foreach($produtos as $produto){
                            $produto = ProdutoDao::SelectEndereco($produto);
                            $cor = '';
                            if($produto->getVerificacao() == 0){
                                $cor = 'red';
                            }
                            echo "<div class='col l3 m3 s12'>
                            <div class='card $cor'>
                                <div class='card-image'>
                                    <img width='220' height='220' src='{$produto->getFoto()}'>
                                </div>
                                <div class='card-content'>
                                    <p><b>{$produto->getNome()}</b></p>
                                    <a id='delete' href=javascript:excluirRegistro('acaoproduto.php?acao=delete&codigo={$produto->getCodigo()}')><i class='material-icons roxo-text'>delete</i></a>
                                    <a class='modal-trigger' href='#modal{$produto->getCodigo()}'><i class='material-icons roxo-text'>edit</i></a>
                                </div>
                            </div>
                            <div class='modal' id='modal{$produto->getCodigo()}'>
                            <h3 class='center roxo-text'>Alterar</h3>
                            <form class='grey lighten-3 ' method='post' action='acaoproduto.php' enctype='multipart/form-data'>
                            <input name='codigo' value='{$produto->getCodigo()}' type='hidden'>
                            <div class='row col s12'>
                                <div class='input-field col l3 m3 s10 offset-l1 offset-m1 offset-s1'>
                                    <input id='nomeprod' name='nomeprod' type='text' class='validate' value='{$produto->getNome()}'>
                                    <label for='nomeprod'>Nome do produto</label>
                                </div>
                                <div class='input-field col l4 m4 s10 offset-s1'>
                                    <input id='descricao' name='descricao' type='text' class='validate' value='{$produto->getDescricao()}'>
                                    <label for='descricao'>Descrição</label>
                                </div>
                                <div class='input-field col l3 m3 s10 offset-s1'>
                                <select name='tipo'>
                                    <option value='Roupa'";
                                        if($produto->getTipo() == "Roupa")
                                            echo "selected";
                                    echo ">Roupa</option>
                                    <option value='Comida não Perecivel'";
                                    if($produto->getTipo() == "Comida não Perecivel")
                                        echo "selected";
                                echo ">Comida não Perecivel</option>
                                    <option value='Eletrodoméstico'";
                                    if($produto->getTipo() == "Eletrodoméstico")
                                        echo "selected";
                                echo ">Eletrodoméstico</option>
                                </select>
                                <label for='tipo'>Tipo</label>
                            </div>
                               
                            </div>
                            <div class='row col s12'>
                                <div class='input-field col l4 m4 s10 offset-l2 offset-m2 offset-s1'>
                                    <div class='file-field'>
                                        <div class='btn'>
                                            <span>Fotos</span>
                                            <input type='file' name='arquivo'>
                                        </div>
                                        <div class='file-path-wrapper'>
                                            <input class='file-path validate' type='text' placeholder='Adicione 1 foto'
                                                name='caminho'>
                                        </div>
                                    </div>
                                </div>
            
                                <div class='input-field col l4 m4 s10 offset-s1'>
                                    <select name='localizaprod'>
                                        <option disabled>Localização</option>
                                         {$usuario->geraSelectEndereco($produto->getLocalizacao()->getCodigo())}
                                    </select>
                                    <label for='localizaprod'>Localização do produto</label>
                                </div>
                                
                            </div>
                            <div class='row col s12'>
                                <div class='col l2  m2 s2 offset-l5 offset-m5 offset-s5'>
                                    <button class='btn waves-effect waves-light' id='bt' type='submit' name='acao'
                                        value='alterar'>Enviar
                                    </button>
                                </div>
                            </div>
                        </form>
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
