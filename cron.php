<?php
    require_once "autoload.php";
    $sql = "SELECT * from requisicao order by dataIni";
    $banco = new banco;
    $vetor = $banco->select($sql);
    foreach($vetor as $linha){
        var_dump($linha);
        if($linha['verificado'] == 0){
            $banco->setTabela('requisicao');
            $banco->update([])
        }
    }
    
?>