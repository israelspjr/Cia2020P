<?php
class ItenRelatorioDesempenho extends Database {
	// class attributes
	var $idItenRelatorioDesempenho;
	var $nome;
	var $inativo;
	var $tipoItenRelatorioDesempenhoIdTipoItenRelatorioDesempenho;
	var $excluido;
    var $orientacao;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idItenRelatorioDesempenho = "NULL";
		$this -> nome = "NULL";
		$this -> inativo = "NULL";
		$this -> tipoItenRelatorioDesempenhoIdTipoItenRelatorioDesempenho = "NULL";
		$this -> excluido = "0";
        $this -> orientacao = "NULL";
	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdItenRelatorioDesempenho($value) {
		$this -> idItenRelatorioDesempenho = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setNome($value) {
		$this -> nome = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setInativo($value) {
		$this -> inativo = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setTipoItenRelatorioDesempenhoIdTipoItenRelatorioDesempenho($value) {
		$this -> tipoItenRelatorioDesempenhoIdTipoItenRelatorioDesempenho = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setExcluido($value) {
		$this -> excluido = ($value) ? $this -> gravarBD($value) : "0";
	}
    
    function setOrientacao($value) {
        $this -> orientacao = ($value) ? $this -> gravarBD($value) : "NULL";
    }

	/**
	 * addItenRelatorioDesempenho() Function
	 */
	function addItenRelatorioDesempenho() {
		$sql = "INSERT INTO itenRelatorioDesempenho (nome, inativo, tipoItenRelatorioDesempenho_idTipoItenRelatorioDesempenho, excluido, orientacao) VALUES ($this->nome, $this->inativo, $this->tipoItenRelatorioDesempenhoIdTipoItenRelatorioDesempenho, $this->excluido, $this->orientacao)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteItenRelatorioDesempenho() Function
	 */
	function deleteItenRelatorioDesempenho() {
		$sql = "DELETE FROM itenRelatorioDesempenho WHERE idItenRelatorioDesempenho = $this->idItenRelatorioDesempenho";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldItenRelatorioDesempenho() Function
	 */
	function updateFieldItenRelatorioDesempenho($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE itenRelatorioDesempenho SET " . $field . " = " . $value . " WHERE idItenRelatorioDesempenho = $this->idItenRelatorioDesempenho";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateItenRelatorioDesempenho() Function
	 */
	function updateItenRelatorioDesempenho() {
		$sql = "UPDATE itenRelatorioDesempenho SET nome = $this->nome, inativo = $this->inativo, tipoItenRelatorioDesempenho_idTipoItenRelatorioDesempenho = $this->tipoItenRelatorioDesempenhoIdTipoItenRelatorioDesempenho, orientacao = $this->orientacao WHERE idItenRelatorioDesempenho = $this->idItenRelatorioDesempenho";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectItenRelatorioDesempenho() Function
	 */
	function selectItenRelatorioDesempenho($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idItenRelatorioDesempenho, nome, inativo, tipoItenRelatorioDesempenho_idTipoItenRelatorioDesempenho, excluido, orientacao FROM itenRelatorioDesempenho " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectItenRelatorioDesempenhoTr() Function
	 */
	function selectItenRelatorioDesempenhoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE i.idItenRelatorioDesempenho, i.nome, i.inativo, i.tipoItenRelatorioDesempenho_idTipoItenRelatorioDesempenho, i.excluido, i.orientacao, t.nome as nomeTipoItenRelatorioDesempenho FROM itenRelatorioDesempenho i INNER JOIN tipoItenRelatorioDesempenho t ON t.idTipoItenRelatorioDesempenho = i.tipoItenRelatorioDesempenho_idTipoItenRelatorioDesempenho " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$idItenRelatorioDesempenho = $valor['idItenRelatorioDesempenho'];
				$nome = $valor['nome'];
				$inativo = Uteis::exibirStatus(!$valor['inativo']);
				$orientacao = $valor['orientacao'];
				//
				$tipoItenRelatorioDesempenho_idTipoItenRelatorioDesempenho = $valor['nomeTipoItenRelatorioDesempenho'];

				$html .= "<td>" . $idItenRelatorioDesempenho . "</td>";
				$html .= "<td class=\"link\" onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idItenRelatorioDesempenho'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $nome . "</td>";
				$html .= "<td>" . $inativo . "</td>";
				$html .= "<td>" . $tipoItenRelatorioDesempenho_idTipoItenRelatorioDesempenho . "</td>";
				$html .= "<td>".$orientacao."</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "grava.php', " . $valor['idItenRelatorioDesempenho'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectItenRelatorioDesempenhoSelect() Function
	 */
	function selectItenRelatorioDesempenhoSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idItenRelatorioDesempenho, nome, inativo, tipoItenRelatorioDesempenho_idTipoItenRelatorioDesempenho, excluido, orientacao FROM itenRelatorioDesempenho " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idItenRelatorioDesempenho\" name=\"idItenRelatorioDesempenho\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idItenRelatorioDesempenho'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idItenRelatorioDesempenho'] . "\">" . ($valor['idItenRelatorioDesempenho']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

	function getNome($id) {
		$rs = $this -> selectItenRelatorioDesempenho(" WHERE idItenRelatorioDesempenho = $id");
		return $rs[0]['nome'];
	}

}
?>