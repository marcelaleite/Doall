<?php
    require_once('autoload.php');

    class ProdutoDao{
        /**
	 * INSERT
	 */

	public static function Insert(Produto $produto, $idUsuario, $idEndereco) {
		return StatementBuilder::insert("INSERT INTO produto (nome, descricao, localizacao, fotos, idUsuario) VALUES (:nome, :descricao, :localizacao, :fotos, :idUsuario)",
			[
				'nome' => $produto->getNome(),
				'descricao' => $produto->getDescricao(),
				'localizacao' => $idEndereco, 
				'fotos' => $produto->getFoto(),
				'idUsuario' => $idUsuario
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
					$sql = "SELECT * FROM produto";
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

	public static function Update(Produto $produto) {
		return StatementBuilder::update(
			"UPDATE produto SET nome = :nome, descricao = :descricao, localizacao = :localizacao, fotos = :fotos WHERE id = :id",
			[
				'nome' => $produto->getNome(),
				'descricao' => $produto->getDescricao(),
				'localizacao' => $produto->getLocalizacao(),
                'fotos' => $produto->getFoto(),
                'id' => $produto->getCodigo()
			]
		);
	}

    }
?>