<?php
    require_once('autoload.php');

    class RequisicaoDao{
        /**
	 * INSERT
	 */

	public static function Insert(Requisicao $requisicao, $idUsuario, $idProduto) {
		return StatementBuilder::insert("INSERT INTO requisicao (idUsuario, idProduto, dataIni, dataFim, verificacao) VALUES (:idUsuario, :idProduto, :dataIni, :dataFim, :verificacao)",
			[
				'idUsuario' => $idUsuario,
				'idProduto' => $idProduto,
				'dataIni' => $requisicao->getDataIni(), 
                'dataFim' => $requisicao->getDataFim(),
				'verificacao' => $requisicao->getVerificacao()
            ]
        );
    }
    
    /**
	 * SELECT
	 */

	public static function Popula($row)
	{
		$requisicao = new Requisicao;
		$requisicao->setDataIni($row['dataIni']);
		$requisicao->setDataFim($row['dataFim']);
		$requisicao->setVerificacao($row['verificacao']);
		return $requisicao;
	}

	public static function Select($criterio, $pesquisa)
	{
		try {
			switch ($criterio) {
				case 'idUsuario':
                case 'idProduto':
                case 'dataIni':
                case 'dataFim':
                case 'verificacao':
					$sql = "SELECT * FROM requisicao WHERE $criterio = '$pesquisa'";
					break;

				case 'todos':
					$sql = "SELECT * FROM requisicao order by DataIni";
					break;
			}

			$query = Conexao::conexao()->query($sql);

			$produtos = array();
			while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
				array_push($produtos, [self::Popula($row), $row['idUsuario'], $row['idProduto']]);
			}

			return $produtos;
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}
	

	public static function Select2($criterio, $criterio2, $pesquisa, $pesquisa2)
	{
		try {
			switch ($criterio) {
				case 'idUsuario':
                case 'idProduto':
                case 'dataIni':
                case 'dataFim':
                case 'verificacao':
					$sql = "SELECT * FROM requisicao WHERE $criterio = '$pesquisa'";
					break;
			}

			switch ($criterio2) {
				case 'idUsuario':
                case 'idProduto':
                case 'dataIni':
                case 'dataFim':
                case 'verificacao':
					$sql .= " $criterio2 = '$pesquisa2'";
					break;
			}

			$query = Conexao::conexao()->query($sql);

			$produtos = array();
			while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
				array_push($produtos, [self::Popula($row), $row['idUsuario']]);
			}

			return $produtos;
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}
	
	
    /**
	 * UPDATE
	 */

	public static function Update(Requisicao $requisicao, $idUsuario, $idProduto) {
		return StatementBuilder::update(
			"UPDATE requisicao SET dataIni = :dataIni, dataFim = :dataFim, verificacao = :verificacao WHERE idUsuario = :idUsuario and idProduto = :idProduto",
			[
				'dataIni' => $requisicao->getDataIni(),
				'dataFim' => $requisicao->getDataFim(),
				'verificacao' => $requisicao->getVerificacao(),
                'idUsuario' => $idUsuario,
                'idProduto' => $idProduto
			]
		);
	}

	public static function DeletarDiferente($id)
	{
		return StatementBuilder::delete(
			"DELETE FROM requisicao WHERE idProduto != :idProduto",
			['idProduto' => $id]
		);
	}

	}
	
	
?>