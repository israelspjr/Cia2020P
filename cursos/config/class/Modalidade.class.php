<?php
class Modalidade extends Database {
	// class attributes
	var $idModalidade;
  var $migracao_id;
	var $nome;
	var $inativo;
	var $excluido;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idModalidade = "NULL";
		$this -> migracao_id = "NULL";
		$this -> nome = "NULL";
		$this -> inativo = "NULL";
		$this -> excluido = "0";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdModalidade($value) {
		$this -> idModalidade = ($value) ? $this -> gravarBD($value) : "NULL";
	}
  
  function setMigracao_id($value){
      $this->migracao_id = ($value) ? $this -> gravarBD($value) : "NULL";
  }
  
	function setNome($value) {
		$this -> nome = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setInativo($value) {
		$this -> inativo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setExcluido($value) {
		$this -> excluido = ($value) ? $this -> gravarBD($value) : "0";
	}

	/**
	 * addModalidade() Function
	 */
	function addModalidade() {
		$sql = "INSERT INTO modalidade (migracao_id, nome, inativo, excluido) VALUES ($this->migracao_id, $this->nome, $this->inativo, $this->excluido)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteModalidade() Function
	 */
	function deleteModalidade() {
		$sql = "DELETE FROM modalidade WHERE idModalidade = $this->idModalidade";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldModalidade() Function
	 */
	function updateFieldModalidade($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE modalidade SET " . $field . " = " . $value . " WHERE idModalidade = $this->idModalidade";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateModalidade() Function
	 */
	function updateModalidade() {
		$sql = "UPDATE modalidade SET migracao_id = $this->migracao_id, nome = $this->nome, inativo = $this->inativo WHERE idModalidade = $this->idModalidade";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectModalidade() Function
	 */
	function selectModalidade($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idModalidade, migracao_id, nome, inativo, excluido FROM modalidade " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectModalidadeTr() Function
	 */
	function selectModalidadeTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE idModalidade, migracao_id, nome, inativo, excluido FROM modalidade " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$idModalidade = $valor['idModalidade'];
				$nome = $valor['nome'];
				$inativo = Uteis::exibirStatus(!$valor['inativo']);

				$html .= "<td>" . $idModalidade . "</td>";
				$html .= "<td class=\"link\" onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idModalidade'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $nome . "</td>";
				$html .= "<td>" . $inativo . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "grava.php', " . $valor['idModalidade'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectModalidadeSelect() Function
	 */
	function selectModalidadeSelect($classes = "", $idAtual = 0, $and = "") {
		//echo "// idAtual = ".$idAtual;
		$sql = "SELECT SQL_CACHE idModalidade, nome FROM modalidade WHERE inativo  = 0 " . $and . " ORDER BY nome ";
		$result = $this -> query($sql);
		$html = "<select id=\"idModalidade\" name=\"idModalidade\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idModalidade'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idModalidade'] . "\">" . $valor['nome'] . "</option>";
		}
		$html .= "</select>";
		return $html;
	}

}
?>