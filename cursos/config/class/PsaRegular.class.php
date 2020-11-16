<?php
class PsaRegular extends Database {
	// class attributes
	var $idPsa;
	var $tipo;
	var $titulo;
	var $pergunta;
	var $obs;
	var $inativo;
	var $dataCadastro;
	var $excluido;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idPsa = "NULL";
		$this -> tipo = "NULL";
		$this -> titulo = "NULL";
		$this -> pergunta = "NULL";
		$this -> obs = "NULL";
		$this -> inativo = "NULL";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";
		$this -> excluido = "0";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdPsa($value) {
		$this -> idPsa = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setTipo($value) {
		$this -> tipo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setTitulo($value) {
		$this -> titulo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPergunta($value) {
		$this -> pergunta = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setObs($value) {
		$this -> obs = ($value) ? $this -> gravarBD($value) : "NULL";
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
	 * addPsaRegular() Function
	 */
	function addPsaRegular() {
		$sql = "INSERT INTO psaRegular (tipo, titulo, pergunta, obs, inativo, dataCadastro, excluido) VALUES ($this->tipo, $this->titulo, $this->pergunta, $this->obs, $this->inativo, '" . date('Y-m-y H:i:s') . "', $this->excluido)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deletePsaRegular() Function
	 */
	function deletePsaRegular() {
		$sql = "DELETE FROM psaRegular WHERE idPsa = $this->idPsa";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldPsaRegular() Function
	 */
	function updateFieldPsaRegular($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE psaRegular SET " . $field . " = " . $value . " WHERE idPsa = $this->idPsa";
		$result = $this -> query($sql, true);
	}

	/**
	 * updatePsaRegular() Function
	 */
	function updatePsaRegular() {
		$sql = "UPDATE psaRegular SET tipo = $this->tipo, titulo = $this->titulo, pergunta = $this->pergunta, obs = $this->obs, inativo = $this->inativo WHERE idPsa = $this->idPsa";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectPsaRegular() Function
	 */
	function selectPsaRegular($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idPsa, tipo, titulo, pergunta, obs, inativo, dataCadastro, excluido, ordem FROM psaRegular " . $where;
	//	echo $sql;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectPsaRegularTr() Function
	 */
	function selectPsaRegularTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE p.idPsa, p.tipo, p.titulo, p.pergunta, p.obs, p.inativo, p.dataCadastro, p.excluido, t.nome nomeTipoNota FROM psaRegular p INNER JOIN tipoNota t ON t.idTipoNota = p.tipo " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$idPsa = $valor['idPsa'];
				$tipo = $valor['nomeTipoNota'];
				$titulo = $valor['titulo'];
				$pergunta = $valor['pergunta'];
				$inativo = Uteis::exibirStatus(!$valor['inativo']);
				//

				$html .= "<td>" . $idPsa . "</td>";
				$html .= "<td class=\"link\" onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idPsa'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $tipo . "</td>";
				$html .= "<td>" . $titulo . "</td>";
				$html .= "<td>" . $pergunta . "</td>";
				$html .= "<td>" . $inativo . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "grava.php', " . $valor['idPsa'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectPsaRegularSelect() Function
	 */
	function selectPsaRegularSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idPsa, tipo, titulo, pergunta, obs, inativo, dataCadastro, excluido FROM psaRegular " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idPsa\" name=\"idPsa\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idPsa'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idPsa'] . "\">" . ($valor['idPsa']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

	function getNome($id) {
		$rs = $this -> selectPsaRegular(" WHERE idPsa = $id");
		return $rs[0]['titulo'] ? $rs[0]['titulo'] : $rs[0]['pergunta'];
	}
    function conceitosPsaRegular($tipo){ 
        $sql ="SELECT SQL_CACHE pp.titulo, n.nome, pp.tipo, idPsa, pp.ordem FROM psaRegular AS pp 
        INNER JOIN tipoNota AS tn ON tn.idTipoNota = pp.tipo   
        INNER JOIN notasTipoNota AS n ON n.tipoNota_idTipoNota = tn.idTipoNota 
        where pp.inativo = 0 AND pp.excluido = 0";
		if ($tipo) {
		$sql .= " AND pp.tipo = ".$tipo;	
		}
		$sql .= " OR idPsa = 7
		ORDER BY pp.ordem";
        return $this->executeQuery($sql);
    }
}
?>