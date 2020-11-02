<?php
class ProvaINF extends Database {
	// class attributes
	var $idProvaINF;
	var $provaIdProva;
	var $relacionamentoINFIdRelacionamentoINF;
	var $unidade;
	var $obs;
	var $inativo;
	var $excluido;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idProvaINF = "NULL";
		$this -> provaIdProva = "NULL";
		$this -> relacionamentoINFIdRelacionamentoINF = "NULL";
		$this -> unidade = "NULL";
		$this -> obs = "NULL";
		$this -> inativo = "NULL";
		$this -> excluido = "0";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdProvaINF($value) {
		$this -> idProvaINF = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setProvaIdProva($value) {
		$this -> provaIdProva = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setRelacionamentoINFIdRelacionamentoINF($value) {
		$this -> relacionamentoINFIdRelacionamentoINF = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setUnidade($value) {
		$this -> unidade = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setObs($value) {
		$this -> obs = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setInativo($value) {
		$this -> inativo = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setExcluido($value) {
		$this -> excluido = ($value) ? $this -> gravarBD($value) : "0";
	}

	/**
	 * addProvaINF() Function
	 */
	function addProvaINF() {
		$sql = "INSERT INTO provaINF (prova_idProva, relacionamentoINF_idRelacionamentoINF, unidade, obs, inativo, excluido) VALUES ($this->provaIdProva, $this->relacionamentoINFIdRelacionamentoINF, $this->unidade, $this->obs, $this->inativo, $this->excluido)";
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	/**
	 * deleteProvaINF() Function
	 */
	function deleteProvaINF() {
		$sql = "DELETE FROM provaINF WHERE idProvaINF = $this->idProvaINF";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldProvaINF() Function
	 */
	function updateFieldProvaINF($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE provaINF SET " . $field . " = " . $value . " WHERE idProvaINF = $this->idProvaINF";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateProvaINF() Function
	 */
	function updateProvaINF() {
		$sql = "UPDATE provaINF SET prova_idProva = $this->provaIdProva, relacionamentoINF_idRelacionamentoINF = $this->relacionamentoINFIdRelacionamentoINF, unidade = $this->unidade, obs = $this->obs, inativo = $this->inativo WHERE idProvaINF = $this->idProvaINF";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectProvaINF() Function
	 */
	function selectProvaINF($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idProvaINF, prova_idProva, relacionamentoINF_idRelacionamentoINF, unidade, obs, inativo, excluido FROM provaINF " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectProvaINFTr() Function
	 */
	function selectProvaINFTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE p.idProvaINF, p.prova_idProva, p.relacionamentoINF_idRelacionamentoINF, p.unidade, p.obs, p.inativo, p.excluido, pr.nome nomeProva, r.cargaHoraria nomeRelacionamentoINF, CONCAT(I.idioma, '-', N.nivel, '-', F.foco) AS tudo 
		FROM provaINF p 
		INNER JOIN prova pr ON p.prova_idProva = pr.idProva 
		INNER JOIN relacionamentoINF r ON p.relacionamentoINF_idRelacionamentoINF = r.idRelacionamentoINF 
		INNER JOIN idioma AS I ON I.idIdioma = r.idioma_idIdioma 
		INNER JOIN nivelEstudo AS N ON N.IdNivelEstudo = r.nivelEstudo_IdNivelEstudo 
		INNER JOIN focoCurso AS F ON F.idFocoCurso = r.focoCurso_idFocoCurso " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$idProvaINF = $valor['idProvaINF'];
				$prova_idProva = $valor['nomeProva'];
				$tudo = $valor['tudo'];
				$unidade = $valor['unidade'];
				$obs = $valor['obs'];
				$inativo = Uteis::exibirStatus(!$valor['inativo']);
				//

				$html .= "<td>" . $idProvaINF . "</td>";
				$html .= "<td class=\"link\" onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idProvaINF'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $prova_idProva . "</td>";
				$html .= "<td>" . $tudo . "</td>";
				$html .= "<td>" . $unidade . "</td>";
				//$html .= "<td>".$obs."</td>";
				$html .= "<td>" . $inativo . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "grava.php', " . $valor['idProvaINF'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectProvaINFSelect() Function
	 */
	function selectProvaINFSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idProvaINF, prova_idProva, relacionamentoINF_idRelacionamentoINF, unidade, obs, inativo, excluido FROM provaINF " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idProvaINF\" name=\"idProvaINF\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idProvaINF'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idProvaINF'] . "\">" . ($valor['idProvaINF']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

}
?>