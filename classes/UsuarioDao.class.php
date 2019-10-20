<?php
    require_once('autoload.php');

    class UsuarioDao{
        /**
	 * INSERT
	 */

	public static function Insert(Usuario $usuario)
	{
		$sql = "INSERT INTO usuario (nome, sobrenome, cpf, dataNasc, email, telefone, sexo, nProtocolo, senha, foto)
		VALUES (:nome, :sobrenome, :cpf, :dataNasc, :email, :telefone, :sexo, :nProtocolo, :senha, :foto)";

		$params = [
			'nome' => $usuario->getNome(),
			'sobrenome' => $usuario->getSobrenome(),
			'cpf' => $usuario->getCpf(),
            'dataNasc' => $usuario->getDataNasc(),
            'email' => $usuario->getEmail(),
            'telefone' => $usuario->getTelefone(),
            'sexo' => $usuario->getSexo(),
            'nProtocolo' => $usuario->getNProtocolo(),
            'senha' => $usuario->getSenha(),
            'foto' => $usuario->getFoto(),
		];

		return StatementBuilder::insert($sql, $params);
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
	 * UPDATE
	 */

	public static function Update(Usuario $usuario)
	{
		return StatementBuilder::update(
			"UPDATE Usuario SET nome = :nome, sobrenome = :sobrenome, senha = :senha, alimentacao = :alimentacao WHERE matricula = :matricula",
			[
				'nome' => $usuario->getNome(),
				'tipo' => $usuario->getTipo(),
				'senha' => $usuario->getSenha(),
				'alimentacao' => $usuario->getAlimentacao(),
				'matricula' => $usuario->getCodigo()
			]
		);
	}

    }
?>