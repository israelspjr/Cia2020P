<?php
class PlanoAcaoGrupoMaterialMontado extends Database {
	// class attributes
	var $idPlanoAcaoGrupoMaterialMontado;
	var $planoAcaoGrupoIdPlanoAcaoGrupo;
	var $nome;
	var $preco;
	var $obs;
	var $dataInicio;
	var $dataFim;
	var $dataCadastro;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idPlanoAcaoGrupoMaterialMontado = "NULL";
		$this -> planoAcaoGrupoIdPlanoAcaoGrupo = "NULL";
		$this -> nome = "NULL";
		$this -> preco = "NULL";
		$this -> obs = "NULL";
		$this -> dataInicio = "NULL";
		$this -> dataFim = "NULL";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdPlanoAcaoGrupoMaterialMontado($value) {
		$this -> idPlanoAcaoGrupoMaterialMontado = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPlanoAcaoGrupoIdPlanoAcaoGrupo($value) {
		$this -> planoAcaoGrupoIdPlanoAcaoGrupo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setNome($value) {
		$this -> nome = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPreco($value) {
		$this -> preco = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setObs($value) {
		$this -> obs = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataInicio($value) {
		$this -> dataInicio = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataFim($value) {
		$this -> dataFim = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataCadastro($value) {
		//$this->dataCadastro = ($value) ? $this->gravarBD($value) : "NULL";
	}

	/**
	 * addPlanoAcaoGrupoMaterialMontado() Function
	 */
	function addPlanoAcaoGrupoMaterialMontado() {
		$sql = "INSERT INTO planoAcaoGrupoMaterialMontado (planoAcaoGrupo_idPlanoAcaoGrupo, nome, preco, obs, dataInicio, dataFim, dataCadastro) VALUES ($this->planoAcaoGrupoIdPlanoAcaoGrupo, $this->nome, $this->preco, $this->obs, $this->dataInicio, $this->dataFim, $this->dataCadastro)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deletePlanoAcaoGrupoMaterialMontado() Function
	 */
	function deletePlanoAcaoGrupoMaterialMontado() {
		$sql = "DELETE FROM planoAcaoGrupoMaterialMontado WHERE idPlanoAcaoGrupoMaterialMontado = $this->idPlanoAcaoGrupoMaterialMontado";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldPlanoAcaoGrupoMaterialMontado() Function
	 */
	function updateFieldPlanoAcaoGrupoMaterialMontado($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE planoAcaoGrupoMaterialMontado SET " . $field . " = " . $value . " WHERE idPlanoAcaoGrupoMaterialMontado = $this->idPlanoAcaoGrupoMaterialMontado";
		$result = $this -> query($sql, true);
	}

	/**
	 * updatePlanoAcaoGrupoMaterialMontado() Function
	 */
	function updatePlanoAcaoGrupoMaterialMontado() {
		$sql = "UPDATE planoAcaoGrupoMaterialMontado SET planoAcaoGrupo_idPlanoAcaoGrupo = $this->planoAcaoGrupoIdPlanoAcaoGrupo, nome = $this->nome, preco = $this->preco, obs = $this->obs, dataInicio = $this->dataInicio, dataFim = $this->dataFim WHERE idPlanoAcaoGrupoMaterialMontado = $this->idPlanoAcaoGrupoMaterialMontado";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectPlanoAcaoGrupoMaterialMontado() Function
	 */
	function selectPlanoAcaoGrupoMaterialMontado($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idPlanoAcaoGrupoMaterialMontado, planoAcaoGrupo_idPlanoAcaoGrupo, nome, preco, obs, dataInicio, dataFim, dataCadastro FROM planoAcaoGrupoMaterialMontado " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectPlanoAcaoGrupoMaterialMontadoTr() Function
	 */
	function selectPlanoAcaoGrupoMaterialMontadoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "") {

		$sql = "SELECT SQL_CACHE idPlanoAcaoGrupoMaterialMontado, nome, preco, dataInicio, dataFim 
		FROM planoAcaoGrupoMaterialMontado AS PAGMM
		INNER JOIN planoAcaoGrupo AS PAG ON PAG.idPlanoAcaoGrupo = PAGMM.planoAcaoGrupo_idPlanoAcaoGrupo " . $where;

		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {

				$idPlanoAcaoGrupoMaterialMontado = $valor['idPlanoAcaoGrupoMaterialMontado'];
				$dataEntrada = $valor['dataInicio'];
				$dataSaida = $valor['dataFim'];

				$entrada = $dataEntrada > date('Y-m-d') ? " - <font color=\"#009900;\"> iniciará em " . Uteis::exibirData($dataEntrada) . "</font>" : "";
				$saida = $dataSaida ? " - <font color=\"#FF0000;\"> sairá do grupo em " . Uteis::exibirData($dataSaida) . "</font>" : "";

				$html .= "<tr>";

				$onclick = "";
				$html .= "<td $onclick >" . $valor['nome'] . $entrada . $saida . "</td>";

				$html .= "<td $onclick >" . Uteis::exibirData($valor['dataInicio']) . "</td>";

				$html .= "<td $onclick >" . Uteis::exibirData($valor['dataFim']) . "</td>";

				$onclick = " onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "grupo/include/form/planoAcaoGrupoMaterialMontado_deleta.php?id=$idPlanoAcaoGrupoMaterialMontado', '$caminhoAtualizar', '$ondeAtualiza')\" ";
				$html .= "<td align=\"center\" $onclick >" . "<img src=\"" . CAMINHO_IMG . "excluir.png\">" . "</td>";

				$html .= "</tr>";
			}
		}
		return $html;
	}

	function selectPlanoAcaoGrupoMaterialMontadoTr_historico($where) {

		$sql = "SELECT SQL_CACHE idPlanoAcaoGrupoMaterialMontado, nome, preco, dataInicio, dataFim 
		FROM planoAcaoGrupoMaterialMontado AS PAGMM
		INNER JOIN planoAcaoGrupo AS PAG ON PAG.idPlanoAcaoGrupo = PAGMM.planoAcaoGrupo_idPlanoAcaoGrupo 
		WHERE PAGMM.dataFim < CURDATE() " . $where;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {

				$html .= "<tr>";

				$html .= "<td >" . $valor['nome'] . "</td>";

				$html .= "<td >" . Uteis::exibirData($valor['dataInicio']) . "</td>";

				$html .= "<td >" . Uteis::exibirData($valor['dataFim']) . "</td>";

				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectPlanoAcaoGrupoMaterialMontadoSelect() Function
	 */
	function selectPlanoAcaoGrupoMaterialMontadoSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idPlanoAcaoGrupoMaterialMontado, planoAcaoGrupo_idPlanoAcaoGrupo, nome, preco, obs, dataInicio, dataFim, dataCadastro FROM planoAcaoGrupoMaterialMontado " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idPlanoAcaoGrupoMaterialMontado\" name=\"idPlanoAcaoGrupoMaterialMontado\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idPlanoAcaoGrupoMaterialMontado'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idPlanoAcaoGrupoMaterialMontado'] . "\">" . ($valor['idPlanoAcaoGrupoMaterialMontado']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

}
?>