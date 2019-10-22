<?php
require_once 'autoload.php';

class Usuario extends AbsCodigo {
    private $nome, $sobrenome, $cpf, $dataNasc, $email, $telefone, $sexo, $nProtocolo, $senha, $foto, $endereco = array();

    // function usuario($id)
    // {
    //     $banco = new banco;
    //     $user = $banco->select("select * from usuario where id = $id");
    //     $this->setNome($user[0]['nome']);
    //     $this->setSobrenome($user[0]['sobrenome']);
    //     $this->setCpf($user[0]['CPF']);
    //     $this->setSenha($user[0]['senha']);
    //     $this->setDtnascimento($user[0]['dataNasc']);
    //     $this->setEmail($user[0]['email']);
    //     $this->setTelefone($user[0]['telefone']);
    //     $this->setSexo($user[0]['sexo']);
    //     $this->setNumprot($user[0]['nProtocolo']);
    //     $this->setFoto($user[0]['foto']);
    //     $ids = $banco->select("select * from enderecos where id_usuario = $id");
    //     for ($i = 0; $i < count($ids); $i++) {
    //         $endereco = new endereco($ids[$i]);
    //         $this->endereco[] = $endereco;
    //     }
    // }
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


    public function inserir($nome, $sobrenome, $cpf, $senha, $dtnascimento, $email, $telefone, $sexo, $prot, $foto)
    {
        $this->verificarProt($prot);
        $vetor = array(null, $nome, $sobrenome, $cpf, $senha, $dtnascimento, $email, $telefone, $sexo, $prot, $foto);

        $banco = new banco;
        $banco->setTabela("usuario");
        return $banco->inserir($vetor);
    }

    public function alterar($codigo, $nome, $sobrenome, $cpf, $senha, $dtnascimento, $email, $telefone, $sexo, $prot, $foto)
    {
        $prot = $this->verificarProt($prot);
        echo "<br>protocolo:".$prot."<br>";
        $vetor = array($codigo, $nome, $sobrenome, $cpf, $senha, $dtnascimento, $email, $telefone, $sexo, $prot, $foto);
        $banco = new banco;
        $banco->setTabela("usuario");
        return $banco->update($vetor);
    }
    public function verificarProt($prot)
    {
        if ($prot == null)
            return null;
        else
            return $prot;
    }

    function getAll()
    {
        return [
            'nome' => $this->nome,
            'sobrenome' => $this->sobrenome,
            'CPF' => $this->cpf,
            'dataNasc' => $this->dtnascimento,
            'email' => $this->email,
            'telefone' =>  $this->telefone,
            'sexo' =>   $this->sexo,
            'nProtocolo' =>   $this->numprot,
            'senha' =>  $this->senha,
            'foto' => $this->foto,
        ];
    }
}
