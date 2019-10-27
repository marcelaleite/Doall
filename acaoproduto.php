<?php require_once 'valida.php';
require_once 'autoload.php';
$acao = isset($_POST['acao'])?$_POST['acao']:'';

if (isset($_FILES)) {
    echo 'FILES setado';
}
if($acao == "requisitar"){
    
    $banco = new bancoNN;
    $banco->setTabela("requisicao");
    $dataIni = date('Y-m-d h:i:s');
    $dataFim= date('Y-m-d h:i:s', strtotime($dataIni.' + 3 days'));
    $id = isset($_POST['id'])?$_POST['id']:'';
    $vetor = [$_SESSION['codigo'], $id, $dataIni, $dataFim];
    echo '<pre>';
    print_r($vetor);
    $banco->inserirN($vetor);
    header("location:index.php");
}

else {
    $nome=isset($_POST['nomeprod']) ? $_POST['nomeprod'] : 0;
    $descricao=isset($_POST['descricao']) ? $_POST['descricao'] : 0;
    $loca=isset($_POST['localizaprod']) ? $_POST['localizaprod'] : 0;
    $upload = new Upload;
    $foto_produto = $upload->uploadImagem('arquivo', 'img/Produtos/');
    if(!is_array($foto_produto)){
        $produto=new Produto;
        $produto->setNome($nome);
        $produto->setDescricao($descricao);
        $produto->setFoto($foto_produto);
        $produto->setVerificao(0);
        if(ProdutoDao::Insert($produto,$_SESSION['codigo'], $loca)){
            header("location:meusprodutos.php");
        }
    }
        

}

?>