<?php
class ProdutoAdicionalItemValorSimuladoProposta extends Database {
	// class attributes
	var $idProdutoAdicionalItemValorSimuladoProposta;
	var $produtoAdicionalIdProdutoAdicional;
	var $itemValorSimuladoPropostaIdItemValorSimuladoProposta;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idProdutoAdicionalItemValorSimuladoProposta = "NULL";
		$this -> produtoAdicionalIdProdutoAdicional = "NULL";
		$this -> itemValorSimuladoPropostaIdItemValorSimuladoProposta = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdProdutoAdicionalItemValorSimuladoProposta($value) {
		$this -> idProdutoAdicionalItemValorSimuladoProposta = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setProdutoAdicionalIdProdutoAdicional($value) {
		$this -> produtoAdicionalIdProdutoAdicional = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setItemValorSimuladoPropostaIdItemValorSimuladoProposta($value) {
		$this -> itemValorSimuladoPropostaIdItemValorSimuladoProposta = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	/**
	 * addProdutoAdicionalItemValorSimuladoProposta() Function
	 */
	function addProdutoAdicionalItemValorSimuladoProposta() {
		$sql = "INSERT INTO produtoAdicionalItemValorSimuladoProposta (produtoAdicional_idProdutoAdicional, itemValorSimuladoProposta_idItemValorSimuladoProposta) VALUES ($this->produtoAdicionalIdProdutoAdicional, $this->itemValorSimuladoPropostaIdItemValorSimuladoProposta)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteProdutoAdicionalItemValorSimuladoProposta() Function
	 */
	function deleteProdutoAdicionalItemValorSimuladoProposta($where = "") {
		$sql = "DELETE FROM produtoAdicionalItemValorSimuladoProposta WHERE idProdutoAdicionalItemValorSimuladoProposta = $this->idProdutoAdicionalItemValorSimuladoProposta " . $where;
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldProdutoAdicionalItemValorSimuladoProposta() Function
	 */
	function updateFieldProdutoAdicionalItemValorSimuladoProposta($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE produtoAdicionalItemValorSimuladoProposta SET " . $field . " = " . $value . " WHERE idProdutoAdicionalItemValorSimuladoProposta = $this->idProdutoAdicionalItemValorSimuladoProposta";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateProdutoAdicionalItemValorSimuladoProposta() Function
	 */
	function updateProdutoAdicionalItemValorSimuladoProposta() {
		$sql = "UPDATE produtoAdicionalItemValorSimuladoProposta SET produtoAdicional_idProdutoAdicional = $this->produtoAdicionalIdProdutoAdicional, itemValorSimuladoProposta_idItemValorSimuladoProposta = $this->itemValorSimuladoPropostaIdItemValorSimuladoProposta WHERE idProdutoAdicionalItemValorSimuladoProposta = $this->idProdutoAdicionalItemValorSimuladoProposta";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectProdutoAdicionalItemValorSimuladoProposta() Function
	 */
	function selectProdutoAdicionalItemValorSimuladoProposta($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idProdutoAdicionalItemValorSimuladoProposta, produtoAdicional_idProdutoAdicional, itemValorSimuladoProposta_idItemValorSimuladoProposta FROM produtoAdicionalItemValorSimuladoProposta " . $where;
		return $this -> executeQuery($sql);
	}

	function selectProdutoAdicionalItemValorSimuladoPropostaTr($where = "") {

		$sql = " SELECT PI.idProdutoAdicionalItemValorSimuladoProposta, PA.nome, PA.inativo, PA.valor, PI.itemValorSimuladoProposta_idItemValorSimuladoProposta FROM produtoAdicionalItemValorSimuladoProposta AS PI INNER JOIN produtoAdicional AS PA ON PI.produtoAdicional_idProdutoAdicional = PA.idProdutoAdicional  " . $where;
		//echo $sql;
		//exit;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {

				$html .= "<tr>";

				$html .= "<td  >" . ($valor['nome']) . "</td>";

				$html .= "<td  >R$ " . Uteis::formatarMoeda($valor['valor']) . "</td>";

				$deleta = " onclick=\"deletaRegistro('" . CAMINHO_VENDAS . "proposta/include/acao/produtoAdicional.php', " . $valor['idProdutoAdicionalItemValorSimuladoProposta'] . ", '" . CAMINHO_VENDAS . "proposta/include/resourceHTML/produtoAdicional.php?id=" . $valor['itemValorSimuladoProposta_idItemValorSimuladoProposta'] . "', '#div_lista_ProdutoAdicional')\" ";

				$html .= "<td $deleta >" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";

				$html .= "</tr>";
			}
		}
		return $html;
	}

}
?>