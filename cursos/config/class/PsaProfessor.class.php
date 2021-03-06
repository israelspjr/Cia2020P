<?php
class PsaProfessor extends Database {
	// class attributes
	var $idPsaProfessor;
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
		$this -> idPsaProfessor = "NULL";
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
	function setIdPsaProfessor($value) {
		$this -> idPsaProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
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
	 * addPsaProfessor() Function
	 */
	function addPsaProfessor() {
		$sql = "INSERT INTO psaProfessor (tipo, titulo, pergunta, obs, inativo, dataCadastro, excluido) VALUES ($this->tipo, $this->titulo, $this->pergunta, $this->obs, $this->inativo, '" . date('Y-m-y H:i:s') . "', $this->excluido)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deletePsaProfessor() Function
	 */
	function deletePsaProfessor() {
		$sql = "DELETE FROM psaProfessor WHERE idPsaProfessor = $this->idPsaProfessor";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldPsaProfessor() Function
	 */
	function updateFieldPsaProfessor($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE psaProfessor SET " . $field . " = " . $value . " WHERE idPsaProfessor = $this->idPsaProfessor";
		$result = $this -> query($sql, true);
	}

	/**
	 * updatePsaProfessor() Function
	 */
	function updatePsaProfessor() {
		$sql = "UPDATE psaProfessor SET tipo = $this->tipo, titulo = $this->titulo, pergunta = $this->pergunta, obs = $this->obs, inativo = $this->inativo WHERE idPsaProfessor = $this->idPsaProfessor";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectPsaProfessor() Function
	 */
	function selectPsaProfessor($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idPsaProfessor, tipo, titulo, pergunta, obs, inativo, dataCadastro, excluido FROM psaProfessor " . $where;
//		echo $sql;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectPsaProfessorTr() Function
	 */
	function selectPsaProfessorTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE p.idPsaProfessor, p.tipo, p.titulo, p.pergunta, p.obs, p.inativo, p.dataCadastro, p.excluido, t.nome nomeTipoNota FROM psaProfessor p INNER JOIN tipoNota t ON t.idTipoNota = p.tipo " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$idPsaProfessor = $valor['idPsaProfessor'];
				$tipo = $valor['nomeTipoNota'];
				$titulo = $valor['titulo'];
				$pergunta = $valor['pergunta'];
				$obs = $valor['obs'];
				$inativo = Uteis::exibirStatus(!$valor['inativo']);
				//
				$dataCadastro = $valor['dataCadastro'];

				$html .= "<td>" . $idPsaProfessor . "</td>";
				$html .= "<td class=\"link\" onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idPsaProfessor'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $tipo . "</td>";
				$html .= "<td>" . $titulo . "</td>";
				$html .= "<td>" . $pergunta . "</td>";
				//$html .= "<td>".$obs."</td>";
				$html .= "<td>" . $inativo . "</td>";
				//$html .= "<td>".$dataCadastro."</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "grava.php', " . $valor['idPsaProfessor'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectPsaProfessorSelect() Function
	 */
	function selectPsaProfessorSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idPsaProfessor, tipo, titulo, pergunta, obs, inativo, dataCadastro, excluido FROM psaProfessor " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idPsaProfessor\" name=\"idPsaProfessor\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idPsaProfessor'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idPsaProfessor'] . "\">" . ($valor['idPsaProfessor']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

	function getNome($id) {
		$rs = $this -> selectPsaProfessor(" WHERE idPsaProfessor = $id");
		return $rs[0]['titulo'] ? $rs[0]['titulo'] : $rs[0]['pergunta'];
	}
    function conceitosPsaProfessor($tipo){ 
        $sql ="SELECT SQL_CACHE pp.titulo, n.nome, pp.tipo FROM psaProfessor AS pp 
        INNER JOIN tipoNota AS tn ON tn.idTipoNota = pp.tipo   
        INNER JOIN notasTipoNota AS n ON n.tipoNota_idTipoNota = tn.idTipoNota 
        where pp.inativo = 0 AND pp.excluido = 0";
		if ($tipo) {
		$sql .= " AND pp.tipo = ".$tipo;	
		}
        return $this->executeQuery($sql);
    }
}
?>