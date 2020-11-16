<?php
class TipoCurso extends Database {
	// class attributes
	var $idTipoCurso;
	var $nome;
	var $inativo;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idTipoCurso = "NULL";
		$this -> nome = "NULL";
		$this -> inativo = "0";
	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdTipoCurso($value) {
		$this -> idTipoCurso = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setNome($value) {
		$this -> nome = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setInativo($value) {
		$this -> inativo = ($value) ? $this -> gravarBD($value) : "0";
	}

	/**
	 * addTipoCurso() Function
	 */
	function addTipoCurso() {
		$sql = "INSERT INTO tipoCurso (nome, inativo) VALUES ($this->nome, $this->inativo)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteTipoCurso() Function
	 */
	function deleteTipoCurso() {
		$sql = "DELETE FROM tipoCurso WHERE idTipoCurso = $this->idTipoCurso";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldTipoCurso() Function
	 */
	function updateFieldTipoCurso($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE tipoCurso SET " . $field . " = " . $value . " WHERE idTipoCurso = $this->idTipoCurso";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateTipoCurso() Function
	 */
	function updateTipoCurso() {
		$sql = "UPDATE tipoCurso SET nome = $this->nome, inativo = $this->inativo WHERE idTipoCurso = $this->idTipoCurso";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectTipoCurso() Function
	 */
	function selectTipoCurso($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idTipoCurso, nome, inativo FROM tipoCurso " . $where;
	//	echo $sql;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectTipoCursoTr() Function
	 */
	function selectTipoCursoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE idTipoCurso, nome, inativo FROM tipoCurso " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$idTipoCurso = $valor['idTipoCurso'];
				$tipo = $valor['nome'];
				$inativo = Uteis::exibirStatus(!$valor['inativo']);
				//

				$html .= "<td>" . $idTipoCurso . "</td>";
				$html .= "<td class=\"link\" onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idTipoCurso'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $tipo . "</td>";
				$html .= "<td>" . $inativo . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "grava.php', " . $valor['idTipoCurso'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectTipoCursoSelect() Function
	 */
	function selectTipoCursoSelect($classes = "", $idAtual = 0, $and) {
		$sql = "SELECT SQL_CACHE idTipoCurso, nome FROM tipoCurso  WHERE inativo = 0 " . $and . " ORDER BY nome";
		$result = $this -> query($sql);
		$html = "<select id=\"idTipoCurso\" name=\"idTipoCurso\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idTipoCurso'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idTipoCurso'] . "\">" . ($valor['nome']) . "</option>";
		}
		$html .= "</select>";
		return $html;
	}
	
	function selectTipoCursoCheckbox($idPlanoAcao, $and = "",$apenasVer, $tipoCursoD) {

		$sql = "SELECT SQL_CACHE idTipoCurso, nome FROM tipoCurso  WHERE inativo = 0 " . $and . " ORDER BY nome";
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {
			$html = "";

			$tipos = explode(",", $tipoCursoD);		
		//	Uteis::pr($tipos);
			while ($valor = mysqli_fetch_array($result)) {
				
				if(in_array($valor['idTipoCurso'], $tipos, TRUE)) {
						$checked= 'checked'; 
					} else {
						$checked = '';
					}

				$html .= "<div  >";

    			$html .= "<input type=\"checkbox\" id=\"idTipoCurso[]\" name=\"idTipoCurso[]\" $checked value=\"".$valor['idTipoCurso']."\" ". $disabled." />";

				$html .=  strtoupper($valor['nome']);

				$html .= "</label>";

                $html .= "</div>";
			}
		}
		return $html;
	}

}
?>