<?php
    require_once("autoload.php");

    class Requisicao{
        private $produto;
        private $dataIni;
        private $dataFim;
        private $verificacao;

        public function getProduto(){
            return $this->produto;
        }
        public function setProduto($produto){
            if($produto instanceof Produto){
                $this->produto = $produto;
            }
        }

        public function getDataIni(){
            return $this->dataIni;
        }
        public function setDataIni($dataIni){
            $this->dataIni = $dataIni;
        }

        public function getDataFim(){
            return $this->dataFim;
        }
        public function setDataFim($dataFim){
            $this->dataFim = $dataFim;
        }

        public function getVerificacao(){
            return $this->verificacao;
        }
        public function setVerificacao($verificacao){
            $this->verificacao = $verificacao;
        }
    

    }

?>