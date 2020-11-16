<?php
class ProfessorTipoImposto extends Database {
	// class attributes
	var $idProfessorTipoImposto;
	var $professorIdProfessor;
	var $tipoImpostoProfessorIdTipoImpostoProfessor;
	var $inativo;
	var $dataCadastro;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idProfessorTipoImposto = "NULL";
		$this -> professorIdProfessor = "NULL";
		$this -> tipoImpostoProfessorIdTipoImpostoProfessor = "NULL";
		$this -> inativo = "0";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdProfessorTipoImposto($value) {
		$this -> idProfessorTipoImposto = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setProfessorIdProfessor($value) {
		$this -> professorIdProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setTipoImpostoProfessorIdTipoImpostoProfessor($value) {
		$this -> tipoImpostoProfessorIdTipoImpostoProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setInativo($value) {
		$this -> inativo = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setDataCadastro($value) {
		//$this->dataCadastro = ($value) ? $this->gravarBD($value) : "NULL";
	}

	/**
	 * addProfessorTipoImposto() Function
	 */
	function addProfessorTipoImposto() {
		$sql = "INSERT INTO professorTipoImposto (professor_idProfessor, TipoImpostoProfessor_idTipoImpostoProfessor, inativo, dataCadastro) VALUES ($this->professorIdProfessor, $this->tipoImpostoProfessorIdTipoImpostoProfessor, $this->inativo, $this->dataCadastro)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteProfessorTipoImposto() Function
	 */
	function deleteProfessorTipoImposto() {
		$sql = "DELETE FROM professorTipoImposto WHERE idProfessorTipoImposto = $this->idProfessorTipoImposto";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldProfessorTipoImposto() Function
	 */
	function updateFieldProfessorTipoImposto($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE professorTipoImposto SET " . $field . " = " . $value . " WHERE idProfessorTipoImposto = $this->idProfessorTipoImposto";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateProfessorTipoImposto() Function
	 */
	function updateProfessorTipoImposto() {
		$sql = "UPDATE professorTipoImposto SET professor_idProfessor = $this->professorIdProfessor, TipoImpostoProfessor_idTipoImpostoProfessor = $this->tipoImpostoProfessorIdTipoImpostoProfessor, inativo = $this->inativo,  WHERE idProfessorTipoImposto = $this->idProfessorTipoImposto";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectProfessorTipoImposto() Function
	 */
	function selectProfessorTipoImposto($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idProfessorTipoImposto, professor_idProfessor, TipoImpostoProfessor_idTipoImpostoProfessor, inativo, dataCadastro FROM professorTipoImposto " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectProfessorTipoImpostoTr() Function
	 */
	function selectProfessorTipoImpostoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE idProfessorTipoImposto, professor_idProfessor, TipoImpostoProfessor_idTipoImpostoProfessor, inativo, dataCadastro 
		FROM professorTipoImposto " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$html .= "<td onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idProfessorTipoImposto'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $valor['idProfessorTipoImposto'] . "</td>";
				$html .= "<td>" . $valor['professor_idProfessor'] . "</td>";
				$html .= "<td>" . $valor['TipoImpostoProfessor_idTipoImpostoProfessor'] . "</td>";
				$html .= "<td>" . $valor['inativo'] . "</td>";
				$html .= "<td>" . $valor['dataCadastro'] . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "/include/acao/ProfessorTipoImposto.php', " . $valor['idProfessorTipoImposto'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	function selectProfessorTipoImpostoTr_demonstrativo($where = "", $valorTotal = "0", $ano, $mes) {
		
		
			
		$TipoImpostoProfessor = new TipoImpostoProfessor();
		
		$sql = "SELECT SQL_CACHE I.nome, I.idTipoImpostoProfessor, I.tipoImpostoProfessor_idTipoImpostoProfessor, A.porcentagem, COALESCE(A.parcelaDedutiva, 0) AS parcelaDedutiva, A.valorMaximo
		FROM professorTipoImposto AS P
		INNER JOIN tipoImpostoProfessor AS I ON I.idTipoImpostoProfessor = P.tipoImpostoProfessor_idTipoImpostoProfessor AND I.tipoImpostoProfessor_idTipoImpostoProfessor IS NULL
		INNER JOIN aliquotaTipoImpostoProfessor AS A ON I.idTipoImpostoProfessor = A.tipoImpostoProfessor_idTipoImpostoProfessor 
			AND '$valorTotal' BETWEEN COALESCE(A.de, 0) AND COALESCE(A.ate, '$valorTotal') AND '$valorTotal' IS NOT NULL 
			AND '$valorTotal' <> '' AND '$valorTotal' <> '0' AND A.excluido <> 1 " . $where;
			
			$dataFim = date($ano."-".$mes."-t");
			
		$sql .= " AND (P.dataInicio is null or P.dataInicio <= '".$ano."-".$mes."-01') AND (P.dataFim is null or P.dataFim >= '".$dataFim."')";
		$result = $this -> query($sql);
// Uteis::pr( $sql);
    //exit;
		
		if (mysqli_num_rows($result) > 0) {
				
			$res = array();
			$cont = 0;
			
			while ($valor = mysqli_fetch_array($result)) {
					
				$idTipoImpostoProfessor = $valor['idTipoImpostoProfessor'];
                $total = ($valorTotal * ($valor['porcentagem'] / 100)) - $valor['parcelaDedutiva'];
				
				if($valor['valorMaximo']>0 && $total > $valor['valorMaximo']):
				    $total = $valor['valorMaximo'];
                endif;
				
		/*		if ($valor['parcelaDedutiva'] > 0 && $total < 10) {
					$total = 0;
				}
				echo "teste";
			*/	
				
				$res[$cont]['idTipoImpostoProfessor'] = $valor['idTipoImpostoProfessor'];
				$res[$cont]['nome'] = $valor['nome'];											
				$res[$cont]['porcentagem'] = $valor['porcentagem'];
				$res[$cont]['parcelaDedutiva'] = $valor['parcelaDedutiva'];
				$res[$cont]['valorMaximo'] = $valor['valorMaximo'];
				$res[$cont]['total'] = $total;
				
				$cont++;
				
				//segunda parte							
				$valorTotal2 = $valorTotal - $total;				
				$sql = "SELECT SQL_CACHE I.nome, I.idTipoImpostoProfessor, I.tipoImpostoProfessor_idTipoImpostoProfessor, A.porcentagem, COALESCE(A.parcelaDedutiva, 0) AS parcelaDedutiva, A.valorMaximo 
				FROM professorTipoImposto AS P
				INNER JOIN tipoImpostoProfessor AS I ON I.idTipoImpostoProfessor = P.tipoImpostoProfessor_idTipoImpostoProfessor AND I.tipoImpostoProfessor_idTipoImpostoProfessor = $idTipoImpostoProfessor 
				INNER JOIN aliquotaTipoImpostoProfessor AS A ON I.idTipoImpostoProfessor = A.tipoImpostoProfessor_idTipoImpostoProfessor 
					AND '$valorTotal2' BETWEEN COALESCE(A.de, 0) AND COALESCE(A.ate, '$valorTotal2') AND '$valorTotal2' IS NOT NULL 
					AND '$valorTotal2' <> '' AND '$valorTotal2' <> '0' AND A.excluido <> 1 " . $where;
					
	//				echo $sql;
				$result2 = $this -> query($sql);
				
				if( $result2 ){					
					while ($valor2 = mysqli_fetch_array($result2)) {
						$total2 = ($valorTotal2 * ($valor2['porcentagem'] / 100)) - $valor2['parcelaDedutiva'];
                        if($valor['valorMaximo']>0 && $total > $valor['valorMaximo']):
                            $total = $valor['valorMaximo'];
                        endif;
						
						$res[$cont]['idTipoImpostoProfessor'] = $valor2['idTipoImpostoProfessor'];
						$res[$cont]['nome'] = $valor2['nome'];											
						$res[$cont]['porcentagem'] = $valor2['porcentagem'];
						$res[$cont]['parcelaDedutiva'] = $valor2['parcelaDedutiva'];
						$res[$cont]['valorMaximo'] = $valor2['valorMaximo'];
						$totalTmp = ($valorTotal2 * ($valor2['porcentagem'] / 100)) - $valor2['parcelaDedutiva'];
						
						if ($valor2['parcelaDedutiva'] > 0 && $totalTmp < 10) {
						
						$res[$cont]['total'] = 0;
						} else {
						$res[$cont]['total'] = $totalTmp;
						}
						
						$cont++;
						
					}
				}
				// segunda parte
				
			}
		}
	//	print_r($res);//exit;
		return $res;

	}

	/**
	 * selectProfessorTipoImpostoSelect() Function
	 */
	function selectProfessorTipoImpostoSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idProfessorTipoImposto, professor_idProfessor, TipoImpostoProfessor_idTipoImpostoProfessor, inativo, dataCadastro FROM professorTipoImposto " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idProfessorTipoImposto\" name=\"idProfessorTipoImposto\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idProfessorTipoImposto'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idProfessorTipoImposto'] . "\">" . ($valor['idProfessorTipoImposto']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

}
?>