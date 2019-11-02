<?php require_once 'valida.php';
require_once 'autoload.php';
$acao = isset($_POST['acao'])?$_POST['acao']:$_GET['acao'];


if($acao == "requisitar"){
    $requisicao = new Requisicao;
    $dataIni = date('Y-m-d h:i:s');
    $dataFim= date('Y-m-d h:i:s', strtotime($dataIni.' + 3 days'));
    $requisicao->setDataIni($dataIni);
    $requisicao->setDataFim($dataFim);
    $requisicao->setVerificacao(0);
    $id = isset($_POST['id'])?$_POST['id']:'';
    RequisicaoDao::Insert($requisicao ,$_SESSION['codigo'], $id);

    header("location:index.php");
}

elseif($acao == "delete"){
    $codigo = isset($_GET['codigo'])?$_GET['codigo']:0;
    $produtos = ProdutoDao::Select('id', $codigo);
    $produto = $produtos[0];
    $antiga_foto = $produto->getFoto();
    if(ProdutoDao::Deletar($produto)){
        unlink($antiga_foto);
        if($_SESSION['tipo'] == 'usuario')
        header("location:meusprodutos.php");
        else
        header('location:admin.php');
    }
}

elseif($acao == "alterar"){
    $codigo = isset($_POST['codigo'])?$_POST['codigo']:0;
    $nome = isset($_POST['nomeprod'])?$_POST['nomeprod']:'';
    $descricao = isset($_POST['descricao'])?$_POST['descricao']:'';
    $localizacao_id = isset($_POST['localizaprod'])?$_POST['localizaprod']:'';
    $tipo = isset($_POST['tipo'])?$_POST['tipo']:0;
    $verificao = 0;
    $produtos = ProdutoDao::Select('id', $codigo);
    $produto = $produtos[0];
    $produto->setNome($nome);
    $produto->setDescricao($descricao);
    $produto->setTipo($tipo);
    if($_FILES['arquivo']['name'] != ''){
        $upload = new Upload;
        $foto_produto = $upload->uploadImagem('arquivo', 'img/Produtos/');
        $antiga_foto = $produto->getFoto();
        $produto->setFoto($foto_produto);
    }
    if($produto = ProdutoDao::Update($produto, $localizacao_id)){
        unlink($antiga_foto);
        header("location:meusprodutos.php");
    }
}

elseif($acao == "verificar"){
    $codigo = isset($_GET['codigo'])?$_GET['codigo']:0;
    $verificao = 1;
    $produtos = ProdutoDao::Select('id', $codigo);
    $produto = $produtos[0];
    $produto = ProdutoDao::SelectEndereco($produto);
    $produto->setVerificacao($verificao);
    
    if(ProdutoDao::Update($produto, $produto->getLocalizacao()->getCodigo())){
        header('location:admin.php');
    }
}

else {
    $nome=isset($_POST['nomeprod']) ? $_POST['nomeprod'] : 0;
    $descricao=isset($_POST['descricao']) ? $_POST['descricao'] : 0;
    $loca=isset($_POST['localizaprod']) ? $_POST['localizaprod'] : 0;
    $tipo = isset($_POST['tipo'])? $_POST['tipo']:0;
    $upload = new Upload;
    $foto_produto = $upload->uploadImagem('arquivo', 'img/Produtos/');
    if(!is_array($foto_produto)){
        $produto=new Produto;
        $produto->setNome($nome);
        $produto->setDescricao($descricao);
        $produto->setFoto($foto_produto);
        $produto->setVerificacao(0);
        $produto->setTipo($tipo);
        if(ProdutoDao::Insert($produto,$_SESSION['codigo'], $loca)){
            header("location:meusprodutos.php");
        }
    }
        

}

?>