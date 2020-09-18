<?php
class ComoConheceu extends Database {
	// class attributes
	var $idComoConheceu;
    var $id_migracao;
	var $comoConheceu;
	var $inativo;
	var $excluido;
	var $aluno;
	var $professor;
	var $geral;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idComoConheceu = "NULL";
        $this -> id_migracao = "0";
		$this -> comoConheceu = "NULL";
		$this -> inativo = "0";
		$this -> excluido = "0";
		$this -> aluno = "0";
		$this -> professor = "0";
		$this -> geral = "0";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdComoConheceu($value) {
		$this -> idComoConheceu = ($value) ? $this -> gravarBD($value) : "NULL";
	}
  
    function setMigracao_id($value){
       $this -> id_migracao = ($value) ? $this -> gravarBD($value) : "0";
    }
  
	function setComoConheceu($value) {
		$this -> comoConheceu = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setInativo($value) {
		$this -> inativo = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setExcluido($value) {
		$this -> excluido = ($value) ? $this -> gravarBD($value) : "0";
	}
	
	function setAluno($value) {
		$this -> aluno = ($value) ? $this -> gravarBD($value) : "0";
	}
	
	function setProfessor($value) {
		$this -> professor = ($value) ? $this -> gravarBD($value) : "0";
	}
	
	function setGeral($value) {
		$this -> geral = ($value) ? $this -> gravarBD($value) : "0";
	}

	/**
	 * addComoConheceu() Function
	 */
	function addComoConheceu() {
		$sql = "INSERT INTO comoConheceu (id_migracao, comoConheceu, inativo, excluido,aluno,professor,geral) VALUES ($this->id_migracao, $this->comoConheceu, $this->inativo, $this->excluido, $this->aluno, $this->professor, $this->geral)";
	//	echo $sql;
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	/**
	 * deleteComoConheceu() Function
	 */
	function deleteComoConheceu() {
		$sql = "DELETE FROM comoConheceu WHERE idComoConheceu = $this->idComoConheceu";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldComoConheceu() Function
	 */
	function updateFieldComoConheceu($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE comoConheceu SET " . $field . " = " . $value . " WHERE idComoConheceu = $this->idComoConheceu";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateComoConheceu() Function
	 */
	function updateComoConheceu() {
		$sql = "UPDATE comoConheceu SET id_migracao = $this->id_migracao, comoConheceu = $this->comoConheceu, inativo = $this->inativo, aluno = $this->aluno, professor = $this->professor, geral = $this->geral WHERE idComoConheceu = $this->idComoConheceu";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectComoConheceu() Function
	 */
	function selectComoConheceu($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idComoConheceu, id_migracao, comoConheceu, inativo, excluido, aluno, professor, geral FROM comoConheceu " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectComoConheceuTr() Function
	 */
	function selectComoConheceuTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE idComoConheceu, comoConheceu, inativo, excluido, aluno, professor, geral FROM comoConheceu " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$idComoConheceu = $valor['idComoConheceu'];
				$comoConheceu = $valor['comoConheceu'];
				$inativo = Uteis::exibirStatus(!$valor['inativo']);
				$aluno = Uteis::exibirStatus($valor['aluno']);
				$professor = Uteis::exibirStatus($valor['professor']);
				$geral = Uteis::exibirStatus($valor['geral']);
				//

				$html .= "<td>" . $idComoConheceu . "</td>";
				$html .= "<td class=\"link\" onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idComoConheceu'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $comoConheceu . "</td>";
				$html .= "<td>".$aluno."</td>";
				$html .= "<td>".$professor."</td>";
				$html .= "<td>".$geral."</td>";
				$html .= "<td>" . $inativo . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "grava.php', " . $valor['idComoConheceu'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	function selectComoConheceuSelect($classes = "", $idAtual = 0, $and) {
		$sql = "SELECT SQL_CACHE idComoConheceu, comoConheceu FROM comoConheceu  WHERE inativo = 0 " . $and . " ORDER BY comoConheceu";
		$result = $this -> query($sql);
		$html = "<select id=\"idComoConheceu\" name=\"idComoConheceu\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idComoConheceu'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idComoConheceu'] . "\">" . ($valor['comoConheceu']) . "</option>";
		}
		$html .= "</select>";
		return $html;
	}
	
	function getNome($id) {
		$rs = self::selectComoConheceu(" WHERE idcomoConheceu = ".$id);
		return $rs[0]['comoConheceu'];	
	}

}
?>