<?php
    require_once('autoload.php');

    class UsuarioDao{
        /**
	 * INSERT
	 */

	public static function Insert(Usuario $usuario) {
		return StatementBuilder::insert("INSERT INTO usuario (nome, sobrenome, CPF, dataNasc, email, telefone, sexo, nProtocolo, senha, foto, tipo, emailVerificacao) VALUES (:nome, :sobrenome, :CPF, :dataNasc, :email, :telefone, :sexo, :nProtocolo, :senha, :foto, :tipo, :emailVerificacao)",
			[
				'nome' => $usuario->getNome(),
				'sobrenome' => $usuario->getSobrenome(),
				'CPF' => $usuario->getCpf(),
				'dataNasc' => $usuario->getDataNasc(),
				'email' => $usuario->getEmail(),
				'telefone' => $usuario->getTelefone(),
				'sexo' => $usuario->getSexo(),
				'nProtocolo' => $usuario->getNProtocolo(),
				'senha' => $usuario->getSenha(),
				'foto' => $usuario->getFoto(),
				'tipo' => $usuario->getTipo(),
				'emailVerificacao' => $usuario->getEmailVerificacao()
			]);
    }
    
    /**
	 * SELECT
	 */

	public static function Popula($row)
	{
		$usuario = new Usuario;
		$usuario->setCodigo($row['id']);
		$usuario->setNome($row['nome']);
		$usuario->setSobrenome($row['sobrenome']);
        $usuario->setCpf($row['CPF']);
        $usuario->setDataNasc($row['dataNasc']);
        $usuario->setEmail($row['email']);
        $usuario->setSexo($row['sexo']);
        $usuario->setNProrocolo($row['nProtocolo']);
        $usuario->setSenha($row['senha']);
		$usuario->setFoto($row['foto']);
		$usuario->setTelefone($row['telefone']);
		$usuario->setTipo($row['tipo']);
		$usuario->setEmailVerificacao($row['emailVerificacao']);
		return $usuario;
	}

	public static function Select($criterio, $pesquisa)
	{
		try {
			switch ($criterio) {
                case 'nome':
                case 'sobrenome':
					$sql = "SELECT * FROM usuario WHERE $criterio like '%$pesquisa%'";
					break;

				case 'id':
                case 'CPF':
                case 'email':
                case 'telefone':
                case 'nProtocolo':
                case 'sexo':
					$sql = "SELECT * FROM usuario WHERE $criterio = '$pesquisa'";
					break;

				case 'todos':
					$sql = "SELECT * FROM usuario";
					break;
			}

			$query = Conexao::conexao()->query($sql);

			$usuarios = array();
			while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
				array_push($usuarios, self::Popula($row));
			}

			return $usuarios;
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public static function SelectEndereco(Usuario $usuario)
	{
		$endereco_codigo = StatementBuilder::select(
			"SELECT id FROM enderecos WHERE idUsuario = :idUsuario",
			['idUsuario' => $usuario->getCodigo()]
		);

		foreach ($endereco_codigo as $codigo) {
			$enderecos = EnderecoDao::Select('id', $codigo['id']);
			$endereco = $enderecos[0];
			$usuario->setEndereco($endereco);
		}

		return $usuario;
	}

	public static function SelectMeusProdutos(Usuario $usuario)
	{
		$produto_codigo = StatementBuilder::select(
			"SELECT id FROM produto WHERE idUsuario = :idUsuario",
			['idUsuario' => $usuario->getCodigo()]
		);

		foreach ($produto_codigo as $codigo) {
			$produtos = ProdutoDao::Select('id', $codigo['id']);
			$produto = $produtos[0];
			$usuario->setMeusProduto($produto);
		}

		return $usuario;
	}

	public static function SelectProdutosRequisitados(Usuario $usuario)
	{
		$produto_codigo = StatementBuilder::select(
			"SELECT idProduto FROM produto WHERE idUsuario = :idUsuario",
			['idUsuario' => $usuario->getCodigo()]
		);

		foreach ($produto_codigo as $codigo) {
			$produtos = ProdutoDao::Select('id', $codigo['id']);
			$produto = $produtos[0];
			$requisicoes = RequisicaoDao::Select2('idUsuario', $usuario->getCodigo(), 'idProduto', $produto->getCodigo());
			$requisicao = $requisicoes[0];
			$usuario->setProdutosRequisitados($requisicoes);
		}

		return $usuario;
	}

	public static function VerificaFoto($usuario, $nome_arquivo){
		$sql = "Select * from usuario where foto = '";
    	$sql .= $nome_arquivo != "" ? $nome_arquivo : 0;
		$sql .= "' and id = " . $usuario->getCodigo();
		
		$query = Conexao::conexao()->query($sql);

		$usuarios = array();
		while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
			array_push($usuarios, self::Popula($row));
		}

		return count($usuarios);
	}
	/**
	 * Verifica se o usuario está cadastrado
	 * @return todos retorna a soma das contas encontradas email e cpf
	 */
	public static function VerificaCadastro($usuario){
		$contadorEmail = count(UsuarioDao::Select('email', $usuario->getEmail()));
		$contadorCPF = count(UsuarioDao::Select('CPF', $usuario->getCpf()));
		return $total = $contadorCPF + $contadorEmail;
	}
    
    /**
	 * UPDATE
	 */

	public static function Update(Usuario $usuario)
	{
		return StatementBuilder::update(
			"UPDATE usuario SET nome = :nome, sobrenome = :sobrenome, CPF = :CPF, senha = :senha, dataNasc = :dataNasc, email = :email, telefone = :telefone, sexo = :sexo, foto = :foto, tipo = :tipo, emailVerificacao = :emailVerificacao WHERE id = :id",
			[
				'nome' => $usuario->getNome(),
				'sobrenome' => $usuario->getSobrenome(),
				'CPF' => $usuario->getCpf(),
				'senha' => $usuario->getSenha(),
				'dataNasc' => $usuario->getDataNasc(),
				'email' => $usuario->getEmail(),
				'telefone' => $usuario->getTelefone(),
				'sexo' => $usuario->getSexo(),
				'foto' => $usuario->getFoto(),
				'tipo' => $usuario->getTipo(),
				'emailVerificacao' => $usuario->getEmailVerificacao(),
				'id' => $usuario->getCodigo()
			]
		);
	}

	////////////////////////
	// FUNÇÕES DE DELETAR //

	public static function Deletar(Usuario $usuario)
	{
		return StatementBuilder::delete(
			"DELETE FROM usuario WHERE id = :id",
			['id' => $usuario->getCodigo()]
		);
	}

    }
?>