<?php
require_once 'autoload.php';

class Usuario extends AbsCodigo {
    private $nome, $sobrenome, $cpf, $dataNasc, $email, $telefone, $sexo, $nProtocolo, $senha, $foto, $endereco = array(), $meusProdutos = array(), $produtosRequisitados = array();


    function getNome()
    {
        return $this->nome;
    }

    function getSobrenome()
    {
        return $this->sobrenome;
    }

    function getCpf()
    {
        return $this->cpf;
    }

    function getDataNasc()
    {
        return $this->dataNasc;
    }

    function getEmail()
    {
        return $this->email;
    }

    function getTelefone()
    {
        return $this->telefone;
    }

    function getSexo()
    {
        return $this->sexo;
    }

    function getNProtocolo()
    {
        return $this->nProtocolo;
    }

    function getSenha()
    {
        return $this->senha;
    }

    function getFoto()
    {
        return $this->foto;
    }

    function getEndereco()
    {
        return $this->endereco;
    }

    function getMeusProdutos()
    {
        return $this->meusProdutos;
    }

    function getProdutosRequisitados()
    {
        return $this->produtosRequisitados;
    }

    function setNome($nome)
    {
        $this->nome = $nome;
    }

    function setSobrenome($sobrenome)
    {
        $this->sobrenome = $sobrenome;
    }

    function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }

    function setDataNasc($dataNasc)
    {
        $this->dataNasc = $dataNasc;
    }

    function setEmail($email)
    {
        $this->email = $email;
    }

    function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }

    function setSexo($sexo)
    {
        $this->sexo = $sexo;
    }

    function setNProrocolo($nProtocolo)
    {
        $this->nProtocolo = $nProtocolo;
    }

    function setSenha($senha)
    {
        $this->senha = $senha;
    }

    function setFoto($foto)
    {
        $this->foto = $foto;
    }

    public function setEndereco($e)
    {
        if ($e instanceof Endereco) {
            array_push($this->endereco, $e);
        }
    }

    public function setMeusProduto($mp)
    {
        if ($mp instanceof Produto) {
            array_push($this->meusProdutos, $mp);
        }
    }

    public function setProdutosRequisitados($pr)
    {
        if ($pr instanceof Requisicao) {
            array_push($this->produtosRequisitados, $pr);
        }
    }

    public function geraSelectEndereco($selected){
        $options = '';
        foreach($this->endereco as $endereco){
            $options .= "<option value='{$endereco->getCodigo()}' ";
            if($endereco->getCodigo() == $selected){
                $options .= "selected";
            }
            $options .= ">{$endereco->getCidade()} - {$endereco->getRua()}</option>";
        }
        return $options;
    }
}
