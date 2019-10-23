<?php 
    require_once 'autoload.php';

    class Endereco {
       private $codigo, $cep, $rua, $numero, $bairro, $complemento, $cidade, $referencia;

       
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

              
    }
?>