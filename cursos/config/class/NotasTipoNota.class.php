<?php
class NotasTipoNota extends Database {
	// class attributes
	var $idNotasTipoNota;
	var $tipoNotaIdTipoNota;
	var $nome;
	var $inativo;
	var $excluido;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idNotasTipoNota = "NULL";
		$this -> tipoNotaIdTipoNota = "NULL";
		$this -> nome = "NULL";
		$this -> inativo = "0";
		$this -> excluido = "0";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdNotasTipoNota($value) {
		$this -> idNotasTipoNota = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setTipoNotaIdTipoNota($value) {
		$this -> tipoNotaIdTipoNota = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setNome($value) {
		$this -> nome = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setInativo($value) {
		$this -> inativo = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setExcluido($value) {
		$this -> excluido = ($value) ? $this -> gravarBD($value) : "0";
	}

	/**
	 * addNotasTipoNota() Function
	 */
	function addNotasTipoNota() {
		$sql = "INSERT INTO notasTipoNota (tipoNota_idTipoNota, nome, inativo, excluido) VALUES ($this->tipoNotaIdTipoNota, $this->nome, $this->inativo, $this->excluido)";
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	/**
	 * deleteNotasTipoNota() Function
	 */
	function deleteNotasTipoNota() {
		$sql = "DELETE FROM notasTipoNota WHERE idNotasTipoNota = $this->idNotasTipoNota";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldNotasTipoNota() Function
	 */
	function updateFieldNotasTipoNota($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE notasTipoNota SET " . $field . " = " . $value . " WHERE idNotasTipoNota = $this->idNotasTipoNota";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateNotasTipoNota() Function
	 */
	function updateNotasTipoNota() {
		$sql = "UPDATE notasTipoNota SET tipoNota_idTipoNota = $this->tipoNotaIdTipoNota, nome = $this->nome, inativo = $this->inativo WHERE idNotasTipoNota = $this->idNotasTipoNota";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectNotasTipoNota() Function
	 */
	function selectNotasTipoNota($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idNotasTipoNota, tipoNota_idTipoNota, nome, inativo, excluido FROM notasTipoNota " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectNotasTipoNotaTr() Function
	 */
	function selectNotasTipoNotaTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE n.idNotasTipoNota, n.tipoNota_idTipoNota, n.nome, n.inativo, n.excluido, t.nome nomeTipoNota FROM notasTipoNota n INNER JOIN tipoNota t ON t.idTipoNota = n.tipoNota_idTipoNota " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$idNotasTipoNota = $valor['idNotasTipoNota'];
				$tipoNota_idTipoNota = $valor['nomeTipoNota'];
				$nome = $valor['nome'];
				$inativo = Uteis::exibirStatus(!$valor['inativo']);
				//

				$html .= "<td>" . $idNotasTipoNota . "</td>";
				$html .= "<td class=\"link\" onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idNotasTipoNota'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $tipoNota_idTipoNota . "</td>";
				$html .= "<td>" . $nome . "</td>";
				$html .= "<td>" . $inativo . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "grava.php', " . $valor['idNotasTipoNota'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectNotasTipoNotaSelect() Function
	 */
	function selectNotasTipoNotaSelect($classes = "", $idAtual = 0, $where = "") {

		$sql = "SELECT SQL_CACHE idNotasTipoNota, nome, tipoNota_idTipoNota, inativo 
		FROM notasTipoNota WHERE excluido = 0 " . $where . " ORDER BY idNotasTipoNota ASC";
        //echo $sql;
		$result = $this -> query($sql);
		$html = "<select id=\"idNotasTipoNota\" name=\"idNotasTipoNota\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = ($idAtual == $valor['idNotasTipoNota'] ? "selected=\"selected\"" : "");
			$html .= "<option " . $selecionado . " value=\"" . $valor['idNotasTipoNota'] . "\">" . ($valor['nome']) . "</option>";
		}
		$html .= "</select>";
		return $html;
	}

	function getNome($id) {
		$rs = $this -> selectNotasTipoNota(" WHERE idNotasTipoNota = $id");
		return $rs[0]['nome'];
	}

}
?>