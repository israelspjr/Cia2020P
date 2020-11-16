<?php
class NivelEstudo extends Database {
	// class attributes
	var $idNivelEstudo;
	var $nivel;
	var $inativo;
	var $dataCadastro;
	var $excluido;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idNivelEstudo = "NULL";
		$this -> nivel = "NULL";
		$this -> inativo = "NULL";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";
		$this -> excluido = "0";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdNivelEstudo($value) {
		$this -> idNivelEstudo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setNivel($value) {
		$this -> nivel = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setInativo($value) {
		$this -> inativo = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setDataCadastro($value) {
		//$this->dataCadastro = ($value) ? $this->gravarBD($value) : "NULL";
	}

	function setExcluido($value) {
		$this -> excluido = ($value) ? $this -> gravarBD($value) : "0";
	}

	/**
	 * addNivelEstudo() Function
	 */
	function addNivelEstudo() {
		$sql = "INSERT INTO nivelEstudo (nivel, inativo, dataCadastro, excluido) VALUES ($this->nivel, $this->inativo, '" . date('Y-m-y H:i:s') . "', $this->excluido)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteNivelEstudo() Function
	 */
	function deleteNivelEstudo() {
		$sql = "DELETE FROM nivelEstudo WHERE IdNivelEstudo = $this->idNivelEstudo";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldNivelEstudo() Function
	 */
	function updateFieldNivelEstudo($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE nivelEstudo SET " . $field . " = " . $value . " WHERE IdNivelEstudo = $this->idNivelEstudo";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateNivelEstudo() Function
	 */
	function updateNivelEstudo() {
		$sql = "UPDATE nivelEstudo SET nivel = $this->nivel, inativo = $this->inativo WHERE IdNivelEstudo = $this->idNivelEstudo";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectNivelEstudo() Function
	 */
	function selectNivelEstudo($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE IdNivelEstudo, nivel, inativo, dataCadastro, excluido FROM nivelEstudo " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectNivelEstudoTr() Function
	 */
	function selectNivelEstudoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE IdNivelEstudo, nivel, inativo, dataCadastro, excluido FROM nivelEstudo " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$IdNivelEstudo = $valor['IdNivelEstudo'];
				$nivel = $valor['nivel'];
				$inativo = Uteis::exibirStatus(!$valor['inativo']);
				$dataCadastro = $valor['dataCadastro'];

				$html .= "<td>" . $IdNivelEstudo . "</td>";
				$html .= "<td class=\"link\" onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['IdNivelEstudo'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $nivel . "</td>";
				$html .= "<td>" . $inativo . "</td>";
				//$html .= "<td>".$dataCadastro."</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "grava.php', " . $valor['IdNivelEstudo'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectNivelEstudoSelect() Function
	 */
	function selectNivelEstudoSelect($classes = "", $idAtual = 0, $addQuery = "") {
		$sql = "SELECT SQL_CACHE N.IdNivelEstudo, N.nivel FROM nivelEstudo AS N " . $addQuery . " WHERE N.inativo = 0 AND N.excluido = 0 ORDER BY N.nivel ";
	//	echo $sql;
		$result = $this -> query($sql);
		$html = "<select id=\"IdNivelEstudo\" name=\"IdNivelEstudo\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['IdNivelEstudo'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['IdNivelEstudo'] . "\">" . $valor['nivel'] . "</option>";
		}
		$html .= "</select>";
		return $html;
	}

	function selectNivelEstudoSelect_con($classes = "", $idSelecionado = "", $where = "", $idPlanoAcaoGrupo_atual) {

		$sql = " SELECT N.IdNivelEstudo, N.nivel, PAG.idPlanoAcaoGrupo 
		FROM planoAcaoGrupo AS PAG
		INNER JOIN planoAcao AS PA ON PA.idPlanoAcao = PAG.planoAcao_idPlanoAcao
		INNER JOIN nivelEstudo AS N ON N.IdNivelEstudo = PA.nivelEstudo_IdNivelEstudo
		INNER JOIN nivelEstudoIdioma AS NI ON NI.nivel_IdNivel = N.IdNivelEstudo 
		INNER JOIN idioma AS I ON I.idIdioma = NI.idioma_idIdioma " . $where . "		 
		ORDER BY N.nivel ";
		//echo "";
//		echo $sql;
		$result = $this -> query($sql);

		$html = "<select id=\"idPlanoAcaoGrupo\" name=\"idPlanoAcaoGrupo\"  class=\"" . $classes . "\" >
		<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = ($idSelecionado == $valor['idPlanoAcaoGrupo']) ? "selected=\"selected\"" : "";			
			$txtAtual = ($valor['idPlanoAcaoGrupo'] == $idPlanoAcaoGrupo_atual ) ? " [atual]" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idPlanoAcaoGrupo'] . "\">" . $valor['nivel'] . $txtAtual. "</option>";
		}
		$html .= "</select>";
		return $html;
	}

	function selectNivelEstudoSelectMult($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE N.IdNivelEstudo, N.nivel FROM nivelEstudo AS N $where ORDER BY N.nivel ";
	//	echo $sql;
		$result = $this -> query($sql);
		$html = "<select id=\"IdNivelEstudo\" name=\"IdNivelEstudo[]\" class=\"" . $classes . "\" multiple=\"multiple\" >";
		$html .= "<option value=\"\">Todos</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['IdNivelEstudo'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['IdNivelEstudo'] . "\">" . $valor['nivel'] . "</option>";
		}
		$html .= "</select>";
		return $html;
	}

	function getNome($id) {
		$rs = $this -> selectNivelEstudo(" WHERE IdNivelEstudo = $id");
		return $rs[0]['nivel'];
	}

}
?>