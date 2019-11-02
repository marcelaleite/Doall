<?php
    require_once('autoload.php');

    class ProdutoDao{
        /**
	 * INSERT
	 */

	public static function Insert(Produto $produto, $idUsuario, $idEndereco) {
		return StatementBuilder::insert("INSERT INTO produto (nome, descricao, localizacao, fotos, idUsuario, verificacao, tipo) VALUES (:nome, :descricao, :localizacao, :fotos, :idUsuario, :verificacao, :tipo)",
			[
				'nome' => $produto->getNome(),
				'descricao' => $produto->getDescricao(),
				'localizacao' => $idEndereco, 
				'fotos' => $produto->getFoto(),
				'idUsuario' => $idUsuario,
				'verificacao' => $produto->getVerificacao(),
				'tipo' => $produto->getTipo()
            ]
        );
    }
    
    /**
	 * SELECT
	 */

	public static function Popula($row)
	{
		$produto = new Produto;
		$produto->setCodigo($row['id']);
		$produto->setNome($row['nome']);
		$produto->setDescricao($row['descricao']);
		$produto->setFoto($row['fotos']);
		$produto->setVerificacao($row['verificacao']);
		$produto->setTipo($row['tipo']);
		return $produto;
	}

	public static function Select($criterio, $pesquisa)
	{
		try {
			switch ($criterio) {
                case 'nome':
                case 'descricao':
					$sql = "SELECT * FROM produto WHERE $criterio like '%$pesquisa%'";
					break;

				case 'id':
                case 'localizacao':
                case 'idUsuario':
					$sql = "SELECT * FROM produto WHERE $criterio = '$pesquisa'";
					break;

				case 'todos':
					$sql = "SELECT * FROM produto order by verificacao";
					break;
			}

			$query = Conexao::conexao()->query($sql);

			$produtos = array();
			while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
				array_push($produtos, self::Popula($row));
			}

			return $produtos;
		} catch (Exception $e) {
			echo $e->getMessage();
		}
    }
	
	public static function ListagemDosVerificados($idUsuario){
		try{
			$sql = "SELECT * FROM produto WHERE idUsuario != {$idUsuario} and verificacao = 1";

			$query = Conexao::conexao()->query($sql);

			$produtos = array();
			while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
				array_push($produtos, self::Popula($row));
			}

			return $produtos;
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public static function UsuarioProduto(Produto $produto){
		$sql = "select idUsuario from produto where id = {$produto->getCodigo()}";
		$query = Conexao::conexao()->query($sql);
		$produto = $query->fetch(PDO::FETCH_ASSOC);
		$sql = "select nome, sobrenome from usuario where id = {$produto['idUsuario']}";
		$query = Conexao::conexao()->query($sql);
        $usuario = $query->fetch(PDO::FETCH_ASSOC);
        $nomeUsuario = $usuario['nome']." ".$usuario['sobrenome'];
        return $nomeUsuario;
	}
	
	public static function SelectEndereco(Produto $produto){
		$endereco_codigo = StatementBuilder::select(
			"SELECT localizacao FROM produto WHERE id = :id",
			['id' => $produto->getCodigo()]
		);

		foreach ($endereco_codigo as $codigo) {
			$localicacoes = EnderecoDao::Select('id', $codigo['localizacao']);
			$localicacao = $localicacoes[0];
			$produto->setLocalizacao($localicacao);
		}

		return $produto;
	}
    /**
	 * UPDATE
	 */

	public static function Update(Produto $produto, $localizacao_id) {
		return StatementBuilder::update(
			"UPDATE produto SET nome = :nome, descricao = :descricao, localizacao = :localizacao, fotos = :fotos, tipo = :tipo, verificacao = :verificacao WHERE id = :id",
			[
				'nome' => $produto->getNome(),
				'descricao' => $produto->getDescricao(),
				'localizacao' => $localizacao_id,
				'fotos' => $produto->getFoto(),
				'tipo' => $produto->getTipo(),
				'verificacao' => $produto->getVerificacao(),
				'id' => $produto->getCodigo()
			]
		);
	}

	////////////////////////
	// FUNÇÕES DE DELETAR //

	public static function Deletar(Produto $produto)
	{
		return StatementBuilder::delete(
			"DELETE FROM produto WHERE id = :id",
			['id' => $produto->getCodigo()]
		);
	}

    }
?>