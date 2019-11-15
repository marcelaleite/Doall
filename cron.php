<?php
    date_default_timezone_set('America/Sao_Paulo');
    require_once "autoload.php";
    $requisicoes = RequisicaoDao::Select('todos', '');
    $dataHoje = strtotime(date("Y-m-d"));
    foreach($requisicoes as $requisicao){
        if($requisicao[0]->getVerificacao() == 0){
            $usuarios = UsuarioDao::Select('id', $requisicao[1]);
            $usuario = $usuarios[0];
            echo strtotime(date("Y-m-d", strtotime($requisicao[0]->getdataFim()))) ."<br>". $dataHoje;
            if(strtotime(date("Y-m-d", strtotime($requisicao[0]->getdataFim()))) >= $dataHoje){
                
                $requisicao[0]->setVerificacao(1);
                if(RequisicaoDao::Update($requisicao[0], $requisicao[1], $requisicao[2])){
                    $produtos = ProdutoDao::Select('id', $requisicao[2]);
                    $produto = $produtos[0];
                    $from = "naoresponda@doall.tech";

                    $to = $usuario->getEmail();

                    $subject = "Produto Solicitado";

                    $message = "O produto solicitado {$produto->getNome()} está disponivel para retirada";

                    $headers = "De:". $from;

                    mail($to, $subject, $message, $headers);
                    RequisicaoDao::DeletarDiferente($requisicao[2]);
                }
            }
        }
    }
    
?>