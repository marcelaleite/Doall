<?php
    require_once('autoload.php');

    class UsuarioDao{
        /**
	 * INSERT
	 */

	public static function Insert(Usuario $usuario) {
		return StatementBuilder::insert("INSERT INTO usuario (nome, sobrenome, CPF, dataNasc, email, telefone, sexo, nProtocolo, senha, foto) VALUES (:nome, :sobrenome, :CPF, :dataNasc, :email, :telefone, :sexo, :nProtocolo, :senha, :foto)",
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
				'foto' => $usuario->getFoto()
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
			"UPDATE Usuario SET nome = :nome, sobrenome = :sobrenome, CPF = :CPF, senha = :senha, dataNasc = :dataNasc, email = :email, telefone = :telefone, sexo = :sexo, foto = :foto WHERE id = :id",
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
				'id' => $usuario->getCodigo()
			]
		);
	}

	////////////////////////
	// FUNÇÕES DE DELETAR //

	public static function Deletar(Usuario $usuario)
	{
		return StatementBuilder::delete(
			"DELETE FROM usuario WHERE codigo = :codigo",
			['codigo' => $usuario->getCodigo()]
		);
	}

    }
?>