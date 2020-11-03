<?php
class PlanoAcaoGrupoMaterialDidatico extends Database {
	// class attributes
	var $idPlanoAcaoGrupoMaterialDidatico;
	var $planoAcaoGrupoIdPlanoAcaoGrupo;
	var $materialDidaticoIdMaterialDidatico;
	var $dataInicio;
	var $dataFim;
	var $dataCadastro;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idPlanoAcaoGrupoMaterialDidatico = "NULL";
		$this -> planoAcaoGrupoIdPlanoAcaoGrupo = "NULL";
		$this -> materialDidaticoIdMaterialDidatico = "NULL";
		$this -> dataInicio = "NULL";
		$this -> dataFim = "NULL";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdPlanoAcaoGrupoMaterialDidatico($value) {
		$this -> idPlanoAcaoGrupoMaterialDidatico = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPlanoAcaoGrupoIdPlanoAcaoGrupo($value) {
		$this -> planoAcaoGrupoIdPlanoAcaoGrupo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setMaterialDidaticoIdMaterialDidatico($value) {
		$this -> materialDidaticoIdMaterialDidatico = ($value) ? $this -> gravarBD($value) : "NULL";
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
	 * addPlanoAcaoGrupoMaterialDidatico() Function
	 */
	function addPlanoAcaoGrupoMaterialDidatico() {
		$sql = "INSERT INTO planoAcaoGrupoMaterialDidatico (planoAcaoGrupo_idPlanoAcaoGrupo, materialDidatico_idMaterialDidatico, dataInicio, dataFim, dataCadastro) VALUES ($this->planoAcaoGrupoIdPlanoAcaoGrupo, $this->materialDidaticoIdMaterialDidatico, $this->dataInicio, $this->dataFim, $this->dataCadastro)";
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	/**
	 * deletePlanoAcaoGrupoMaterialDidatico() Function
	 */
	function deletePlanoAcaoGrupoMaterialDidatico() {
		$sql = "DELETE FROM planoAcaoGrupoMaterialDidatico WHERE idPlanoAcaoGrupoMaterialDidatico = $this->idPlanoAcaoGrupoMaterialDidatico";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldPlanoAcaoGrupoMaterialDidatico() Function
	 */
	function updateFieldPlanoAcaoGrupoMaterialDidatico($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE planoAcaoGrupoMaterialDidatico SET " . $field . " = " . $value . " WHERE idPlanoAcaoGrupoMaterialDidatico = $this->idPlanoAcaoGrupoMaterialDidatico";
		$result = $this -> query($sql, true);
	}

	/**
	 * updatePlanoAcaoGrupoMaterialDidatico() Function
	 */
	function updatePlanoAcaoGrupoMaterialDidatico() {
		$sql = "UPDATE planoAcaoGrupoMaterialDidatico SET planoAcaoGrupo_idPlanoAcaoGrupo = $this->planoAcaoGrupoIdPlanoAcaoGrupo, materialDidatico_idMaterialDidatico = $this->materialDidaticoIdMaterialDidatico, dataInicio = $this->dataInicio, dataFim = $this->dataFim,  WHERE idPlanoAcaoGrupoMaterialDidatico = $this->idPlanoAcaoGrupoMaterialDidatico";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectPlanoAcaoGrupoMaterialDidatico() Function
	 */
	function selectPlanoAcaoGrupoMaterialDidatico($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idPlanoAcaoGrupoMaterialDidatico, planoAcaoGrupo_idPlanoAcaoGrupo, materialDidatico_idMaterialDidatico, dataInicio, dataFim, dataCadastro FROM planoAcaoGrupoMaterialDidatico " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectPlanoAcaoGrupoMaterialDidaticoTr() Function
	 */
	function selectPlanoAcaoGrupoMaterialDidaticoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "") {

		$sql = "SELECT SQL_CACHE PAGMD.idPlanoAcaoGrupoMaterialDidatico, MD.nome, PAGMD.dataInicio, PAGMD.dataFim
		FROM planoAcaoGrupoMaterialDidatico AS PAGMD
		INNER JOIN materialDidatico AS MD ON MD.idMaterialDidatico = PAGMD.materialDidatico_idMaterialDidatico 
		INNER JOIN planoAcaoGrupo AS PAG ON PAG.idPlanoAcaoGrupo = PAGMD.planoAcaoGrupo_idPlanoAcaoGrupo " . $where;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {

				$idPlanoAcaoGrupoMaterialDidatico = $valor['idPlanoAcaoGrupoMaterialDidatico'];
				$dataEntrada = $valor['dataInicio'];
				$dataSaida = $valor['dataFim'];

				$entrada = $dataEntrada > date('Y-m-d') ? " - <font color=\"#009900;\"> iniciará em " . Uteis::exibirData($dataEntrada) . "</font>" : "";
				$saida = $dataSaida ? " - <font color=\"#FF0000;\"> sairá do grupo em " . Uteis::exibirData($dataSaida) . "</font>" : "";

				$html .= "<tr>";

				$onclick = "";
				$html .= "<td $onclick >" . $valor['nome'] . $entrada . $saida . "</td>";

				$html .= "<td $onclick >" . Uteis::exibirData($valor['dataInicio']) . "</td>";

				$html .= "<td $onclick >" . Uteis::exibirData($valor['dataFim']) . "</td>";

				$onclick = " onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "grupo/include/form/planoAcaoGrupoMaterialDidatico_deleta.php?id=$idPlanoAcaoGrupoMaterialDidatico', '$caminhoAtualizar', '$ondeAtualiza')\" ";
				$html .= "<td align=\"center\" $onclick >" . "<img src=\"" . CAMINHO_IMG . "excluir.png\">" . "</td>";

				$html .= "</tr>";
			}
		}
		return $html;
	}

	function selectPlanoAcaoGrupoMaterialDidaticoTr_historico($where) {

		$sql = "SELECT SQL_CACHE PAGMD.idPlanoAcaoGrupoMaterialDidatico, MD.nome, PAGMD.dataInicio, PAGMD.dataFim
		FROM planoAcaoGrupoMaterialDidatico AS PAGMD
		INNER JOIN materialDidatico AS MD ON MD.idMaterialDidatico = PAGMD.materialDidatico_idMaterialDidatico 
		INNER JOIN planoAcaoGrupo AS PAG ON PAG.idPlanoAcaoGrupo = PAGMD.planoAcaoGrupo_idPlanoAcaoGrupo 
		WHERE PAGMD.dataFim < CURDATE() " . $where;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {

				//$idPlanoAcaoGrupoMaterialDidatico = $valor['idPlanoAcaoGrupoMaterialDidatico'];

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
	 * selectPlanoAcaoGrupoMaterialDidaticoSelect() Function
	 */
	function selectPlanoAcaoGrupoMaterialDidaticoSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idPlanoAcaoGrupoMaterialDidatico, planoAcaoGrupo_idPlanoAcaoGrupo, materialDidatico_idMaterialDidatico, dataInicio, dataFim, dataCadastro FROM planoAcaoGrupoMaterialDidatico " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idPlanoAcaoGrupoMaterialDidatico\" name=\"idPlanoAcaoGrupoMaterialDidatico\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idPlanoAcaoGrupoMaterialDidatico'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idPlanoAcaoGrupoMaterialDidatico'] . "\">" . ($valor['idPlanoAcaoGrupoMaterialDidatico']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

}
?>