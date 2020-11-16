<?php
class ItenMotivoFechamento extends Database {
	// class attributes
	var $idItenMotivoFechamento;
	var $iten;
	var $inativo;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idItenMotivoFechamento = "NULL";
		$this -> iten = "NULL";
		$this -> inativo = "NULL";
		$this -> excluido = "0";
	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdItenMotivoFechamento($value) {
		$this -> idItenMotivoFechamento = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setIten($value) {
		$this -> iten = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setInativo($value) {
		$this -> inativo = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setExcluido($value) {
		$this -> excluido = ($value) ? $this -> gravarBD($value) : "0";
	}

	/**
	 * addItenMotivoFechamento() Function
	 */
	function addItenMotivoFechamento() {
		$sql = "INSERT INTO itenMotivoFechamento (iten, inativo, excluido) VALUES ($this->iten, $this->inativo, $this->excluido)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteItenMotivoFechamento() Function
	 */
	function deleteItenMotivoFechamento() {
		$sql = "DELETE FROM itenMotivoFechamento WHERE idItenMotivoFechamento = $this->idItenMotivoFechamento ";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldItenMotivoFechamento() Function
	 */
	function updateFieldItenMotivoFechamento($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE itenMotivoFechamento SET " . $field . " = " . $value . " WHERE idItenMotivoFechamento = $this->idItenMotivoFechamento";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateItenMotivoFechamento() Function
	 */
	function updateItenMotivoFechamento() {
		$sql = "UPDATE itenMotivoFechamento SET iten = $this->iten, inativo = $this->inativo WHERE idItenMotivoFechamento = $this->idItenMotivoFechamento";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectItenMotivoFechamento() Function
	 */
	function selectItenMotivoFechamento($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idItenMotivoFechamento, iten, inativo, excluido FROM itenMotivoFechamento " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectItenMotivoFechamentoTr() Function
	 */
	function selectItenMotivoFechamentoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE idItenMotivoFechamento, iten, inativo, excluido FROM itenMotivoFechamento " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$idItenMotivoFechamento = $valor['idItenMotivoFechamento'];
				$iten = $valor['iten'];
				$inativo = Uteis::exibirStatus(!$valor['inativo']);
				//

				$html .= "<td>" . $idItenMotivoFechamento . "</td>";
				$html .= "<td class=\"link\" onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idItenMotivoFechamento'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $iten . "</td>";
				$html .= "<td>" . $inativo . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "grava.php', " . $valor['idItenMotivoFechamento'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectItenMotivoFechamentoSelect() Function
	 */
	function selectItenMotivoFechamentoSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idItenMotivoFechamento, iten, inativo, excluido FROM itenMotivoFechamento " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idItenMotivoFechamento\" name=\"idItenMotivoFechamento\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idItenMotivoFechamento'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idItenMotivoFechamento'] . "\">" . ($valor['iten']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

	function selectItenMotivoFechamentoCheckbox($where = "", $idFechamentoGrupo = "") {

		$sql = "SELECT SQL_CACHE idItenMotivoFechamento, iten, inativo, excluido FROM itenMotivoFechamento WHERE inativo = 0 AND excluido = 0 " . $where;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$html = "";
			$FechamentoGrupoItenMotivoFechamento = new FechamentoGrupoItenMotivoFechamento();

			while ($valor = mysqli_fetch_array($result)) {

				$idItenMotivoFechamento = $valor['idItenMotivoFechamento'];

				$html .= "<div style=\"float:left;width:50%;\">
				
				<label for=\"check_itenMotivoFechamento_" . $valor['idItenMotivoFechamento'] . "\">
				<input type=\"checkbox\" id=\"check_itenMotivoFechamento_" . $valor['idItenMotivoFechamento'] . "\" name=\"check_itenMotivoFechamento[]\"";

				if ($idFechamentoGrupo) {
					$where = " WHERE itenMotivoFechamento_idItenMotivoFechamento = $idItenMotivoFechamento AND fechamentoGrupo_idFechamentoGrupo = $idFechamentoGrupo";
					$html .= $FechamentoGrupoItenMotivoFechamento -> selectFechamentoGrupoItenMotivoFechamento($where) ? " checked " : "";
				}

				$html .= " value=\"$idItenMotivoFechamento\" />" . $valor['iten'] . "</label>
				</div>";
			}
		}
		return $html;
	}

}
?>