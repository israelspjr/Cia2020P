<?php
class AtividadeExtraProfessor extends Database {
	// class attributes
	var $idAtividadeExtraProfessor;
	var $tipoAtividadeExtraProfessorIdTipoAtividadeExtraProfessor;
	var $nome;
	var $inativo;
    var $ativar;
    

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idAtividadeExtraProfessor = "NULL";
		$this -> tipoAtividadeExtraProfessorIdTipoAtividadeExtraProfessor = "NULL";
        $this -> nome = "NULL";
		$this -> inativo = "NULL";
        $this -> ativar = 0;        
	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdAtividadeExtraProfessor($value) {
		$this -> idAtividadeExtraProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setTipoAtividadeExtraProfessorIdTipoAtividadeExtraProfessor($value) {
		$this -> tipoAtividadeExtraProfessorIdTipoAtividadeExtraProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setNome($value) {
		$this -> nome = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setInativo($value) {
		$this -> inativo = ($value) ? $this -> gravarBD($value) : "0";
	}
    
    function setAtivar($value) {
        $this -> ativar = ($value) ? $this -> gravarBD($value) : "0";
    }
   
	/**
	 * addAtividadeextraprofessor() Function
	 */
	function addAtividadeextraprofessor() {
		$sql = "INSERT INTO atividadeExtraProfessor (tipoAtividadeExtraProfessor_idTipoAtividadeExtraProfessor, nome, inativo, ativar) VALUES ($this->tipoAtividadeExtraProfessorIdTipoAtividadeExtraProfessor, $this->nome, $this->inativo, $this->ativar)";
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	/**
	 * deleteAtividadeextraprofessor() Function
	 */
	function deleteAtividadeextraprofessor() {
		$sql = "DELETE FROM atividadeExtraProfessor WHERE idAtividadeExtraProfessor = $this->idAtividadeExtraProfessor";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldAtividadeextraprofessor() Function
	 */
	function updateFieldAtividadeextraprofessor($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE atividadeExtraProfessor SET " . $field . " = " . $value . " WHERE idAtividadeExtraProfessor = $this->idAtividadeExtraProfessor";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateAtividadeextraprofessor() Function
	 */
	function updateAtividadeextraprofessor() {
		$sql = "UPDATE atividadeExtraProfessor SET tipoAtividadeExtraProfessor_idTipoAtividadeExtraProfessor = $this->tipoAtividadeExtraProfessorIdTipoAtividadeExtraProfessor, nome = $this->nome, inativo = $this->inativo, ativar = $this->ativar WHERE idAtividadeExtraProfessor = $this->idAtividadeExtraProfessor";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectAtividadeextraprofessor() Function
	 */
	function selectAtividadeextraprofessor($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idAtividadeExtraProfessor, tipoAtividadeExtraProfessor_idTipoAtividadeExtraProfessor, nome, inativo, ativar FROM atividadeExtraProfessor " . $where;
		return $this -> executeQuery($sql);
	}

	function selectAtividadeextraprofessorCheckbox($id, $origem = "") {
		$sql = "SELECT SQL_CACHE idAtividadeExtraProfessor, nome, ativar FROM atividadeExtraProfessor 
		WHERE inativo = 0 AND tipoAtividadeExtraProfessor_idTipoAtividadeExtraProfessor = " . $this -> tipoAtividadeExtraProfessorIdTipoAtividadeExtraProfessor;
	//	echo $sql;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {
			$html = "";

			$OpcaoAtividadeExtraProfessorClientePf = new OpcaoAtividadeExtraProfessorClientePf();
			$OpcaoAtividadeExtraProfessor = new OpcaoAtividadeExtraProfessor();

			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<div style=\"float:left;width:25%;\">
				<label for=\"check_Atividadeextraprofessor_" . $valor['idAtividadeExtraProfessor'] . "\">
				<input type=\"checkbox\" id=\"check_Atividadeextraprofessor_" . $valor['idAtividadeExtraProfessor'] . "\" name=\"check_Atividadeextraprofessor_" . $valor['idAtividadeExtraProfessor'] . "\"";

				if ($origem == "clientePf") {
					$where = " WHERE clientePf_idClientePf = " . $id . " AND atividadeExtraProfessor_idAtividadeExtraProfessor = " . $valor['idAtividadeExtraProfessor'];
					$op = $OpcaoAtividadeExtraProfessorClientePf -> selectOpcaoatividadeextraprofessorclientepf($where);
					$html .= $op[0]['idOpcaoAtividadeExtraProfessorClientePf'] ? " checked " : "";
                     if($valor['ativar']==1){
                            $extra = ", Complemento:<textarea name=\"obs_Atividadeextraprofessor_" . $valor['idAtividadeExtraProfessor']."\" id=\"obs_Atividadeextraprofessor_" . $valor['idAtividadeExtraProfessor']."\" >".$op[0]['obs']."</textarea>";    
                    }else{
                        $extra ="";
                    }
				}

				if ($origem == "professor") {
					$where = " WHERE professor_idProfessor = " . $id . " AND atividadeExtraProfessor_idAtividadeExtraProfessor = " . $valor['idAtividadeExtraProfessor'];
					$html .= $OpcaoAtividadeExtraProfessor -> selectOpcaoAtividadeExtraProfessor($where) ? " checked " : "";
				}
               
				$html .= " value=\"1\" /> " . $valor['nome'] ."&nbsp;".$extra."</label></div>";
			}
		}
		return $html;
	}

	/**
	 * selectAtividadeExtraProfessorTr() Function
	 */
	function selectAtividadeExtraProfessorTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE a.idAtividadeExtraProfessor, a.tipoAtividadeExtraProfessor_idTipoAtividadeExtraProfessor, a.nome, a.inativo, a.excluido, a.ativar, t.nome as nomeTipoAtividadeExtraProfessor FROM atividadeExtraProfessor a INNER JOIN tipoAtividadeExtraProfessor t ON t.idTipoAtividadeExtraProfessor = a.tipoAtividadeExtraProfessor_idTipoAtividadeExtraProfessor" . $where;
		//echo $sql;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$idAtividadeExtraProfessor = $valor['idAtividadeExtraProfessor'];
				$tipoAtividadeExtraProfessor_idTipoAtividadeExtraProfessor = $valor['nomeTipoAtividadeExtraProfessor'];
				$nome = $valor['nome'];
				$ativar = Uteis::exibirStatus($valor['ativar']);
				$inativo = Uteis::exibirStatus(!$valor['inativo']);
				//

				$html .= "<td>" . $idAtividadeExtraProfessor . "</td>";
				$html .= "<td class=\"link\" onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idAtividadeExtraProfessor'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $tipoAtividadeExtraProfessor_idTipoAtividadeExtraProfessor . "</td>";
				$html .= "<td>" . $nome . "</td>";
				$html .= "<td>" . $inativo . "</td>";
                $html .= "<td>" . $ativar . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "grava.php', " . $valor['idAtividadeExtraProfessor'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectAtividadeExtraProfessorSelect() Function
	 */
	function selectAtividadeExtraProfessorSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idAtividadeExtraProfessor, tipoAtividadeExtraProfessor_idTipoAtividadeExtraProfessor, nome, inativo, excluido FROM atividadeExtraProfessor " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idAtividadeExtraProfessor\" name=\"idAtividadeExtraProfessor\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idAtividadeExtraProfessor'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idAtividadeExtraProfessor'] . "\">" . ($valor['nome']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

}
?>