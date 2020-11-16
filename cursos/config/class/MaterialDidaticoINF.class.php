<?php
class MaterialDidaticoINF extends Database {
	// class attributes
	var $idMaterialDidaticoINF;
	var $relacionamentoINFIdRelacionamentoINF;
	var $materialDidaticoIdMaterialDidatico;
	var $unidadeInicial;
	var $unidadeFinal;
	var $inativo;
	var $obs;
	var $excluido;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idMaterialDidaticoINF = "NULL";
		$this -> relacionamentoINFIdRelacionamentoINF = "NULL";
		$this -> materialDidaticoIdMaterialDidatico = "NULL";
		$this -> unidadeInicial = "NULL";
		$this -> unidadeFinal = "NULL";
		$this -> inativo = "0";
		$this -> obs = "NULL";
		$this -> excluido = "0";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdMaterialDidaticoINF($value) {
		$this -> idMaterialDidaticoINF = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setRelacionamentoINFIdRelacionamentoINF($value) {
		$this -> relacionamentoINFIdRelacionamentoINF = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setMaterialDidaticoIdMaterialDidatico($value) {
		$this -> materialDidaticoIdMaterialDidatico = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setUnidadeInicial($value) {
		$this -> unidadeInicial = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setUnidadeFinal($value) {
		$this -> unidadeFinal = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setInativo($value) {
		$this -> inativo = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setObs($value) {
		$this -> obs = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setExcluido($value) {
		$this -> excluido = ($value) ? $this -> gravarBD($value) : "0";
	}

	/**
	 * addMaterialDidaticoINF() Function
	 */
	function addMaterialDidaticoINF() {
		$sql = "INSERT INTO materialDidaticoINF (relacionamentoINF_idRelacionamentoINF, materialDidatico_idMaterialDidatico, unidadeInicial, unidadeFinal, inativo, obs, excluido) VALUES ($this->relacionamentoINFIdRelacionamentoINF, $this->materialDidaticoIdMaterialDidatico, $this->unidadeInicial, $this->unidadeFinal, $this->inativo, $this->obs, $this->excluido)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteMaterialDidaticoINF() Function
	 */
	function deleteMaterialDidaticoINF() {
		$sql = "DELETE FROM materialDidaticoINF WHERE idMaterialDidaticoINF = $this->idMaterialDidaticoINF";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldMaterialDidaticoINF() Function
	 */
	function updateFieldMaterialDidaticoINF($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE materialDidaticoINF SET " . $field . " = " . $value . " WHERE idMaterialDidaticoINF = $this->idMaterialDidaticoINF";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateMaterialDidaticoINF() Function
	 */
	function updateMaterialDidaticoINF() {
		$sql = "UPDATE materialDidaticoINF SET relacionamentoINF_idRelacionamentoINF = $this->relacionamentoINFIdRelacionamentoINF, materialDidatico_idMaterialDidatico = $this->materialDidaticoIdMaterialDidatico, unidadeInicial = $this->unidadeInicial, unidadeFinal = $this->unidadeFinal, inativo = $this->inativo, obs = $this->obs WHERE idMaterialDidaticoINF = $this->idMaterialDidaticoINF";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectMaterialDidaticoINF() Function
	 */
	function selectMaterialDidaticoINF($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idMaterialDidaticoINF, relacionamentoINF_idRelacionamentoINF, materialDidatico_idMaterialDidatico, unidadeInicial, unidadeFinal, inativo, obs, excluido FROM materialDidaticoINF " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectMaterialDidaticoINFTr() Function
	 */
	function selectMaterialDidaticoINFTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {

		$RelacionamentoINF = new RelacionamentoINF();

		$sql = "SELECT SQL_CACHE m.idMaterialDidaticoINF, r.idRelacionamentoINF, m.materialDidatico_idMaterialDidatico, m.unidadeInicial, m.unidadeFinal, m.inativo, md.nome as nomeMaterialDidatico 
		FROM materialDidaticoINF m 
		INNER JOIN relacionamentoINF r ON m.relacionamentoINF_idRelacionamentoINF = r.idRelacionamentoINF  
		INNER JOIN materialDidatico md ON md.idMaterialDidatico = m.materialDidatico_idMaterialDidatico " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$idMaterialDidaticoINF = $valor['idMaterialDidaticoINF'];
				$idRelacionamentoINF = $valor['idRelacionamentoINF'];
				$materialDidatico_idMaterialDidatico = $valor['nomeMaterialDidatico'];
				$unidadeInicial = $valor['unidadeInicial'];
				$unidadeFinal = $valor['unidadeFinal'];
				$inativo = Uteis::exibirStatus(!$valor['inativo']);
				//
				//$obs = $valor['obs'];

				$html .= "<td>" . $idMaterialDidaticoINF . "</td>";
				$html .= "<td class=\"link\" onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idMaterialDidaticoINF'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $RelacionamentoINF -> getRelacionamentoINF($idRelacionamentoINF) . "</td>";
				$html .= "<td>" . $materialDidatico_idMaterialDidatico . "</td>";
				$html .= "<td>" . $unidadeInicial . "</td>";
				$html .= "<td>" . $unidadeFinal . "</td>";
				$html .= "<td>" . $inativo . "</td>";
				//$html .= "<td>".$obs."</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "grava.php', " . $valor['idMaterialDidaticoINF'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectMaterialDidaticoINFSelect() Function
	 */
	function selectMaterialDidaticoINFSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idMaterialDidaticoINF, relacionamentoINF_idRelacionamentoINF, materialDidatico_idMaterialDidatico, unidadeInicial, unidadeFinal, inativo, obs, excluido FROM materialDidaticoINF " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idMaterialDidaticoINF\" name=\"idMaterialDidaticoINF\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idMaterialDidaticoINF'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idMaterialDidaticoINF'] . "\">" . ($valor['idMaterialDidaticoINF']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

}
?>