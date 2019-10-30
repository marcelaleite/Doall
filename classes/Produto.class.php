<?php require_once 'autoload.php';

class Produto extends AbsCodigo {
    private $nome,
    $descricao,
    $localizacao,
    $foto,
    $verificacao;
   

    function getNome() {
        return $this->nome;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getLocalizacao() {
        return $this->localizacao;
    }

    function getVerificacao() {
        return $this->verificacao;
    }

    function setNome($nome) {
        $this->nome=$nome;
    }

    function setDescricao($descricao) {
        $this->descricao=$descricao;
    }

    function setLocalizacao($localizacao) {
        $this->localizacao=$localizacao;
    }

    function setVerificacao($verificacao) {
        $this->verificacao=$verificacao;
    }

    function getFoto() {
        return $this->foto;
    }

    function setFoto($foto) {
        $this->foto=$foto;
    }


    

    public function __toString() {
        $usuario = ProdutoDao::UsuarioProduto($this);
        return "<div class='row'>
        <div class='col s12 l12 m12'>
            <div class='col l4'></div>
            <div class='col s10 offset-s1 m7 l7 offset-m7 offset-l1'>
                <h4 class='roxo-text'>{$this->getNome()}</h4>
            </div>
            <div class='col s10 offset-s1 l3 m3 offset-m1 offset-l1'>
                <img src='{$this->getFoto()}' width='320' height='320' alt='Imagem do Produto'>
            </div>
            <div class='col s10 m4 l7 offset-s1 offset-m3 offset-l1'>
                <p><b>{$usuario}</b></p>
                <p style='text-align: justify;'><b>Descrição</b><br>{$this->getDescricao()}</p><br>
                <form action='acaoproduto.php' method='post'>
                <input value='{$this->getCodigo()}' name='id' type='hidden'>
                <button class='roxo btn waves-effect' name='acao' value='requisitar'>Requisitar</button>
                </form>
            </div>
        </div>
    </div>";
    }





}