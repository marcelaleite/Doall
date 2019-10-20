<?php 
    require_once 'autoload.php';

    class endereco {
       private $codigo, $cep, $rua, $numero, $bairro, $complemento, $cidade, $referencia;
       
       function __construct($endereco) {
           $this->codigo = $endereco[0];
           $this->cep = $endereco[1];
           $this->rua = $endereco[2];
           $this->numero = $endereco[3];
           $this->bairro = $endereco[4];
           $this->complemento = $endereco[5];
           $this->cidade = $endereco[6];
           $this->referencia = $endereco[7];
       }

       
       function getCodigo() {
           return $this->codigo;
       }

       function getCep() {
           return $this->cep;
       }

       function getRua() {
           return $this->rua;
       }

       function getNumero() {
           return $this->numero;
       }

       function getBairro() {
           return $this->bairro;
       }

       function getComplemento() {
           return $this->complemento;
       }

       function getCidade() {
           return $this->cidade;
       }

       function getReferencia() {
           return $this->referencia;
       }

       function setCodigo($codigo) {
           $this->codigo = $codigo;
       }

       function setCep($cep) {
           $this->cep = $cep;
       }

       function setRua($rua) {
           $this->rua = $rua;
       }

       function setNumero($numero) {
           $this->numero = $numero;
       }

       function setBairro($bairro) {
           $this->bairro = $bairro;
       }

       function setComplemento($complemento) {
           $this->complemento = $complemento;
       }

       function setCidade($cidade) {
           $this->cidade = $cidade;
       }

       function setReferencia($referencia) {
           $this->referencia = $referencia;
       }

              
       function inserir($cep, $rua, $numero, $bairro, $complemento, $cidade, $referencia,$codigo){
           $vetor = array(null,$cep, $rua, $numero, $bairro, $complemento, $cidade, $referencia, $codigo);
           $banco = new banco;
           $banco->setTabela("enderecos");
           return $banco->inserir($vetor);
       }
    }
?>