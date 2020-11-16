<?php
class ProdutoAdicionalPlanoAcaoGrupo extends Database {
	// class attributes
	var $idProdutoAdicionalPlanoAcaoGrupo;
	var $produtoAdicionalIdProdutoAdicional;
	var $planoAcaoGrupoIdPlanoAcaoGrupo;
	var $dataCadastro;
	var $dataInicio;
	var $dataSaida;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idProdutoAdicionalPlanoAcaoGrupo = "NULL";
		$this -> produtoAdicionalIdProdutoAdicional = "NULL";
		$this -> planoAcaoGrupoIdPlanoAcaoGrupo = "NULL";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";
		$this -> dataInicio = "NULL";
		$this -> dataSaida = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdProdutoAdicionalPlanoAcaoGrupo($value) {
		$this -> idProdutoAdicionalPlanoAcaoGrupo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setProdutoAdicionalIdProdutoAdicional($value) {
		$this -> produtoAdicionalIdProdutoAdicional = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPlanoAcaoGrupoIdPlanoAcaoGrupo($value) {
		$this -> planoAcaoGrupoIdPlanoAcaoGrupo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataCadastro($value) {
		//$this->dataCadastro = ($value) ? $this->gravarBD($value) : "NULL";
	}

	function setDataInicio($value) {
		$this -> dataInicio = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataSaida($value) {
		$this -> dataSaida = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	/**
	 * addProdutoAdicionalPlanoAcaoGrupo() Function
	 */
	function addProdutoAdicionalPlanoAcaoGrupo() {
		$sql = "INSERT INTO produtoAdicionalPlanoAcaoGrupo (produtoAdicional_idProdutoAdicional, planoAcaoGrupo_idPlanoAcaoGrupo, dataCadastro, dataInicio, dataSaida) VALUES ($this->produtoAdicionalIdProdutoAdicional, $this->planoAcaoGrupoIdPlanoAcaoGrupo, '" . date('Y-m-y H:i:s') . "', $this->dataInicio, $this->dataSaida)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteProdutoAdicionalPlanoAcaoGrupo() Function
	 */
	function deleteProdutoAdicionalPlanoAcaoGrupo() {
		$sql = "DELETE FROM produtoAdicionalPlanoAcaoGrupo WHERE idProdutoAdicionalPlanoAcaoGrupo = $this->idProdutoAdicionalPlanoAcaoGrupo";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldProdutoAdicionalPlanoAcaoGrupo() Function
	 */
	function updateFieldProdutoAdicionalPlanoAcaoGrupo($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE produtoAdicionalPlanoAcaoGrupo SET " . $field . " = " . $value . " WHERE idProdutoAdicionalPlanoAcaoGrupo = $this->idProdutoAdicionalPlanoAcaoGrupo";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateProdutoAdicionalPlanoAcaoGrupo() Function
	 */
	function updateProdutoAdicionalPlanoAcaoGrupo() {
		$sql = "UPDATE produtoAdicionalPlanoAcaoGrupo SET produtoAdicional_idProdutoAdicional = $this->produtoAdicionalIdProdutoAdicional, planoAcaoGrupo_idPlanoAcaoGrupo = $this->planoAcaoGrupoIdPlanoAcaoGrupodataInicio = $this->dataInicio, dataSaida = $this->dataSaida WHERE idProdutoAdicionalPlanoAcaoGrupo = $this->idProdutoAdicionalPlanoAcaoGrupo";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectProdutoAdicionalPlanoAcaoGrupo() Function
	 */
	function selectProdutoAdicionalPlanoAcaoGrupo($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idProdutoAdicionalPlanoAcaoGrupo, produtoAdicional_idProdutoAdicional, planoAcaoGrupo_idPlanoAcaoGrupo, dataCadastro, dataInicio, dataSaida FROM produtoAdicionalPlanoAcaoGrupo " . $where;
		return $this -> executeQuery($sql);
	}

	function selectProdutoAdicionalPlanoAcaoGrupoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "") {

		$sql = "SELECT SQL_CACHE P.idProdutoAdicionalPlanoAcaoGrupo, P.dataInicio, P.dataSaida, PA.nome
		FROM produtoAdicionalPlanoAcaoGrupo AS P
		INNER JOIN produtoAdicional AS PA ON PA.idProdutoAdicional = P.produtoAdicional_idProdutoAdicional " . $where;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$html = "";
			$Uteis = new Uteis;

			while ($valor = mysqli_fetch_array($result)) {

				$idProdutoAdicionalPlanoAcaoGrupo = $valor['idProdutoAdicionalPlanoAcaoGrupo'];

				$html .= "<tr>
					
				<td >" . strtotime($valor['dataInicio']) . "</td>
				
				<td >" . $valor['nome'] . "</td>
				
				<td >" . Uteis::exibirData($valor['dataInicio']) . "</td>
				
				<td >" . Uteis::exibirData($valor['dataSaida']) . "</td>
				
				<td >
					<center><img onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "grupo/include/form/produtoAdicionalPlanoAcaoGrupo_del.php?id=$idProdutoAdicionalPlanoAcaoGrupo&idPlanoAcaoGrupo=$idPlanoAcaoGrupo', '$caminhoAtualizar', '$ondeAtualiza')\" src=\"" . CAMINHO_IMG . "excluir.png\"></center>
				</td>
				
				</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectProdutoAdicionalPlanoAcaoGrupoSelect() Function
	 */
	function selectProdutoAdicionalPlanoAcaoGrupoSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idProdutoAdicionalPlanoAcaoGrupo, produtoAdicional_idProdutoAdicional, planoAcaoGrupo_idPlanoAcaoGrupo, dataCadastro, dataInicio, dataSaida FROM produtoAdicionalPlanoAcaoGrupo " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idProdutoAdicionalPlanoAcaoGrupo\" name=\"idProdutoAdicionalPlanoAcaoGrupo\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idProdutoAdicionalPlanoAcaoGrupo'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idProdutoAdicionalPlanoAcaoGrupo'] . "\">" . ($valor['idProdutoAdicionalPlanoAcaoGrupo']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

}
?>