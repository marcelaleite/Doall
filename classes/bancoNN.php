<?php

require_once 'autoload.php';

class bancoNN {

    public $pdo, $tabela;

    public function conexao() {
        try {
            
            $this->pdo = new PDO('mysql:host=doall.tech;dbname=u709658536_doall', "u709658536_rian", "senha12");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->exec("SET CHARACTER SET utf8");
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function obterCampos() {
        $consulta = $this->pdo->query("desc " . $this->tabela);

        while ($lista = $consulta->fetch()) {
            $campos [] = $lista[0];
        }
        return $campos;
    }

    public function validarData($campo) {
        $data = DateTime::createfromFormat('d/m/Y', $campo);
        if ($data && $data->format('d/m/Y')) {
            return true;
        } else {
            return false;
        }
    }
    
    public function geraStmt($sql, $vetor, $campos){
        $stmt = $this->pdo->prepare($sql);       
        
            for ($j = 0; $j <= count($vetor)-1; $j++) {
                if (is_numeric($vetor[$j])) {
                    $stmt->bindParam (':' . $campos[$j], $vetor[$j], PDO::PARAM_INT);
                    } elseif ($this->validarData($vetor[$j])) {
                    $stmt->bindParam(':' . $campos[$j], date("Y-m-d", strtotime(str_replace("/", "-", $vetor[$j]))), PDO::PARAM_STR);
                } else {
                    $stmt->bindParam(':' . $campos[$j], $vetor[$j], PDO::PARAM_STR);
                }
            }
            return $stmt;
    }

    public function select($sql) {
        $this->conexao();
        try {
            $consulta = $this->pdo->query($sql);
            $vetor = null;
            while ($linha = $consulta->fetch(PDO::FETCH_BOTH)) {
                $vetor[] = $linha; 
            }
            return $vetor;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function inserirN($vetor) {
        $this->conexao();
        try {
            $campos = $this->obterCampos();
            $sql = "INSERT INTO " . $this->tabela . "(";
            $i = 0;
            foreach ($campos as $v) {
                if ($i == 0) {
                    $sql .= $v;
                } elseif ($i > 0) {
                    $sql .= ", " . $v;
                }
                $i++;
            }
            $sql .= ") VALUES(";
            $i = 0;
            foreach ($campos as $v) {
                if ($i == 0) {
                    $sql .= ":" . $v;
                } elseif ($i > 0) {
                    $sql .= ", :" . $v;
                }
                $i++;
            }
            $sql .= ")";
            #echo $sql;
            #var_dump($vetor);
            $stmt = $this->geraStmt($sql, $vetor, $campos);
            
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public  function deleteN($id, $id2) {
        $this->conexao();
        try {
            
            $stmt = $this->pdo->prepare('DELETE FROM ' . $this->tabela . ' WHERE idUsuario = :id and idProduto = :id2');
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':id2', $id2);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
    
    deleteNParam1

    function getPdo() {
        return $this->pdo;
    }

    function getTabela() {
        return $this->tabela;
    }

 function setPdo($pdo) {
        $this->pdo = $pdo;
    }

 function setTabela($tabela) {
        $this->tabela = $tabela;
    }


}
