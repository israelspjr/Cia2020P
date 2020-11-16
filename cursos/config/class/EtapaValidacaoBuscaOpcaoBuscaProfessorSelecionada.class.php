<?php
class EtapaValidacaoBuscaOpcaoBuscaProfessorSelecionada extends Database {
	// class attributes
	var $idEtapaValidacaoBuscaOpcaoBuscaProfessorSelecionada;
	var $etapaValidacaoBuscaIdEtapaValidacaoBusca;
	var $opcaoBuscaProfessorSelecionadaIdOpcaoBuscaProfessorSelecionada;
	var $concluida;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idEtapaValidacaoBuscaOpcaoBuscaProfessorSelecionada = "NULL";
		$this -> etapaValidacaoBuscaIdEtapaValidacaoBusca = "NULL";
		$this -> opcaoBuscaProfessorSelecionadaIdOpcaoBuscaProfessorSelecionada = "NULL";
		$this -> concluida = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdEtapaValidacaoBuscaOpcaoBuscaProfessorSelecionada($value) {
		$this -> idEtapaValidacaoBuscaOpcaoBuscaProfessorSelecionada = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setEtapaValidacaoBuscaIdEtapaValidacaoBusca($value) {
		$this -> etapaValidacaoBuscaIdEtapaValidacaoBusca = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setOpcaoBuscaProfessorSelecionadaIdOpcaoBuscaProfessorSelecionada($value) {
		$this -> opcaoBuscaProfessorSelecionadaIdOpcaoBuscaProfessorSelecionada = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setConcluida($value) {
		$this -> concluida = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	/**
	 * addEtapaValidacaoBuscaOpcaoBuscaProfessorSelecionada() Function
	 */
	function addEtapaValidacaoBuscaOpcaoBuscaProfessorSelecionada() {
		$sql = "INSERT INTO etapaValidacaoBuscaOpcaoBuscaProfessorSelecionada (etapaValidacaoBusca_idEtapaValidacaoBusca, opcaoBuscaProfessorSelecionada_idOpcaoBuscaProfessorSelecionada, concluida) VALUES ($this->etapaValidacaoBuscaIdEtapaValidacaoBusca, $this->opcaoBuscaProfessorSelecionadaIdOpcaoBuscaProfessorSelecionada, $this->concluida)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteEtapaValidacaoBuscaOpcaoBuscaProfessorSelecionada() Function
	 */
	function deleteEtapaValidacaoBuscaOpcaoBuscaProfessorSelecionada($or = "") {
		$sql = "DELETE FROM etapaValidacaoBuscaOpcaoBuscaProfessorSelecionada WHERE idEtapaValidacaoBuscaOpcaoBuscaProfessorSelecionada = $this->idEtapaValidacaoBuscaOpcaoBuscaProfessorSelecionada " . $or;
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldEtapaValidacaoBuscaOpcaoBuscaProfessorSelecionada() Function
	 */
	function updateFieldEtapaValidacaoBuscaOpcaoBuscaProfessorSelecionada($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE etapaValidacaoBuscaOpcaoBuscaProfessorSelecionada SET " . $field . " = " . $value . " WHERE idEtapaValidacaoBuscaOpcaoBuscaProfessorSelecionada = $this->idEtapaValidacaoBuscaOpcaoBuscaProfessorSelecionada";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateEtapaValidacaoBuscaOpcaoBuscaProfessorSelecionada() Function
	 */
	function updateEtapaValidacaoBuscaOpcaoBuscaProfessorSelecionada() {
		$sql = "UPDATE etapaValidacaoBuscaOpcaoBuscaProfessorSelecionada SET etapaValidacaoBusca_idEtapaValidacaoBusca = $this->etapaValidacaoBuscaIdEtapaValidacaoBusca, opcaoBuscaProfessorSelecionada_idOpcaoBuscaProfessorSelecionada = $this->opcaoBuscaProfessorSelecionadaIdOpcaoBuscaProfessorSelecionada, concluida = $this->concluida WHERE idEtapaValidacaoBuscaOpcaoBuscaProfessorSelecionada = $this->idEtapaValidacaoBuscaOpcaoBuscaProfessorSelecionada";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectEtapaValidacaoBuscaOpcaoBuscaProfessorSelecionada() Function
	 */
	function selectEtapaValidacaoBuscaOpcaoBuscaProfessorSelecionada($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idEtapaValidacaoBuscaOpcaoBuscaProfessorSelecionada, etapaValidacaoBusca_idEtapaValidacaoBusca, opcaoBuscaProfessorSelecionada_idOpcaoBuscaProfessorSelecionada, concluida FROM etapaValidacaoBuscaOpcaoBuscaProfessorSelecionada " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectEtapaValidacaoBuscaOpcaoBuscaProfessorSelecionadaTr() Function
	 */
	function selectEtapaValidacaoBuscaOpcaoBuscaProfessorSelecionadaTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE idEtapaValidacaoBuscaOpcaoBuscaProfessorSelecionada, etapaValidacaoBusca_idEtapaValidacaoBusca, opcaoBuscaProfessorSelecionada_idOpcaoBuscaProfessorSelecionada, concluida FROM etapaValidacaoBuscaOpcaoBuscaProfessorSelecionada " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$html .= "<td onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idEtapaValidacaoBuscaOpcaoBuscaProfessorSelecionada'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $valor['idEtapaValidacaoBuscaOpcaoBuscaProfessorSelecionada'] . "</td>";
				$html .= "<td>" . $valor['etapaValidacaoBusca_idEtapaValidacaoBusca'] . "</td>";
				$html .= "<td>" . $valor['opcaoBuscaProfessorSelecionada_idOpcaoBuscaProfessorSelecionada'] . "</td>";
				$html .= "<td>" . $valor['concluida'] . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "/include/acao/EtapaValidacaoBuscaOpcaoBuscaProfessorSelecionada.php', " . $valor['idEtapaValidacaoBuscaOpcaoBuscaProfessorSelecionada'] . ", '$caminhoAtualizar', 'tr')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectEtapaValidacaoBuscaOpcaoBuscaProfessorSelecionadaSelect() Function
	 */
	function selectEtapaValidacaoBuscaOpcaoBuscaProfessorSelecionadaSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idEtapaValidacaoBuscaOpcaoBuscaProfessorSelecionada, etapaValidacaoBusca_idEtapaValidacaoBusca, opcaoBuscaProfessorSelecionada_idOpcaoBuscaProfessorSelecionada, concluida FROM etapaValidacaoBuscaOpcaoBuscaProfessorSelecionada " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idEtapaValidacaoBuscaOpcaoBuscaProfessorSelecionada\" name=\"idEtapaValidacaoBuscaOpcaoBuscaProfessorSelecionada\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idEtapaValidacaoBuscaOpcaoBuscaProfessorSelecionada'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idEtapaValidacaoBuscaOpcaoBuscaProfessorSelecionada'] . "\">" . ($valor['idEtapaValidacaoBuscaOpcaoBuscaProfessorSelecionada']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

}
?>

