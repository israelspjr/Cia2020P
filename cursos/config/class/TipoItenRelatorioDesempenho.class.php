<?php
class TipoItenRelatorioDesempenho extends Database {
	// class attributes
	var $idTipoItenRelatorioDesempenho;
	var $nome;
	var $inativo;
	var $excluido;
    var $avaliacao;
    var $reavaliacao;         

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idTipoItenRelatorioDesempenho = "NULL";
		$this -> nome = "NULL";
		$this -> inativo = "NULL";
		$this -> excluido = "0";
        $this -> avaliacao = "NULL";
        $this -> reavaliacao = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdTipoItenRelatorioDesempenho($value) {
		$this -> idTipoItenRelatorioDesempenho = ($value) ? $this -> gravarBD($value) : "NULL";
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
    function setAvaliacao($value) {
        $this -> avaliacao = ($value) ? $this -> gravarBD($value) : "0";
    }
    function setReavaliacao($value) {
        $this -> reavaliacao = ($value) ? $this -> gravarBD($value) : "0";
    }
	/**
	 * addTipoItenRelatorioDesempenho() Function
	 */
	function addTipoItenRelatorioDesempenho() {
		$sql = "INSERT INTO tipoItenRelatorioDesempenho (nome, inativo, excluido, avaliacao, reavaliacao) VALUES ($this->nome, $this->inativo, $this->excluido, $this->avaliacao, $this->reavaliacao)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteTipoItenRelatorioDesempenho() Function
	 */
	function deleteTipoItenRelatorioDesempenho() {
		$sql = "DELETE FROM tipoItenRelatorioDesempenho WHERE idTipoItenRelatorioDesempenho = $this->idTipoItenRelatorioDesempenho";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldTipoItenRelatorioDesempenho() Function
	 */
	function updateFieldTipoItenRelatorioDesempenho($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE tipoItenRelatorioDesempenho SET " . $field . " = " . $value . " WHERE idTipoItenRelatorioDesempenho = $this->idTipoItenRelatorioDesempenho";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateTipoItenRelatorioDesempenho() Function
	 */
	function updateTipoItenRelatorioDesempenho() {
		$sql = "UPDATE tipoItenRelatorioDesempenho SET nome = $this->nome, inativo = $this->inativo, avaliacao = $this->avaliacao, reavaliacao = $this->reavaliacao WHERE idTipoItenRelatorioDesempenho = $this->idTipoItenRelatorioDesempenho";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectTipoItenRelatorioDesempenho() Function
	 */
	function selectTipoItenRelatorioDesempenho($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idTipoItenRelatorioDesempenho, nome, inativo, excluido, avaliacao, reavaliacao FROM tipoItenRelatorioDesempenho " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectTipoItenRelatorioDesempenhoTr() Function
	 */
	function selectTipoItenRelatorioDesempenhoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE idTipoItenRelatorioDesempenho, nome, inativo, excluido, avaliacao, reavaliacao FROM tipoItenRelatorioDesempenho " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$idTipoItenRelatorioDesempenho = $valor['idTipoItenRelatorioDesempenho'];
				$nome = $valor['nome'];
				$inativo = Uteis::exibirStatus(!$valor['inativo']);
                $avaliacao = Uteis::retornaNomeMes($valor['avaliacao']);
                $reavaliacao = Uteis::retornaNomeMes($valor['reavaliacao']); 
				//

				$html .= "<td>" . $idTipoItenRelatorioDesempenho . "</td>";
				$html .= "<td class=\"link\" onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idTipoItenRelatorioDesempenho'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $nome . "</td>";
				$html .= "<td>" . $inativo . "</td>";
				$html .= "<td>". $avaliacao ."</td>";
                $html .= "<td>". $reavaliacao ."</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "grava.php', " . $valor['idTipoItenRelatorioDesempenho'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectTipoItenRelatorioDesempenhoSelect() Function
	 */
	function selectTipoItenRelatorioDesempenhoSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idTipoItenRelatorioDesempenho, nome, inativo, excluido FROM tipoItenRelatorioDesempenho " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idTipoItenRelatorioDesempenho\" name=\"idTipoItenRelatorioDesempenho\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idTipoItenRelatorioDesempenho'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idTipoItenRelatorioDesempenho'] . "\">" . ($valor['nome']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

}
?>