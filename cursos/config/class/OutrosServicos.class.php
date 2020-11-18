<?php
class OutrosServicos extends Database {
	// class attributes
	var $idOutrosServicos;
	var $professorIdProfessor;
	var $tipo;
	var $valor;
	var $mes;
	var $ano;
	var $obs;
	var $dataCadastro;
	var $impostos;


	// constructor
	function __construct() {
		parent::__construct();
		$this -> idOutrosServicos = "NULL";
		$this -> professorIdProfessor = "NULL";
		$this -> tipo = "NULL";
		$this -> valor = "NULL";
		$this -> mes = "NULL";
		$this -> ano = "NULL";
		$this -> obs = "NULL";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";
		$this -> impostos = "0";
	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setidOutrosServicos ($value) {
		$this -> idOutrosServicos  = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	
	function setProfessorIdProfessor($value) {
		$this -> professorIdProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setTipo($value) {
		$this -> tipo = ($value) ? $this -> gravarBD($value) : "NULL";
	}
    
       
	function setValor($value) {
		$this -> valor = ($value) ? $this -> gravarBD(Uteis::gravarMoeda($value)) : "NULL";
	}

	function setMes($value) {
		$this -> mes = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setAno($value) {
		$this -> ano = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setObs($value) {
		$this -> obs = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	
	function setImpostos($value) {
		$this -> impostos = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setDataCadastro($value) {
		//$this->dataCadastro = ($value) ? $this->gravarBD($value) : "NULL";
	}

	
	/**
	 * addCreditoDebitoGrupo() Function
	 */
	function addOutrosServicos() {
		$sql = "INSERT INTO outrosServicos (professor_IdProfessor, tipo, valor, mes, ano, obs, dataCadastro, impostos) VALUES ($this->professorIdProfessor, $this->tipo, $this->valor, $this->mes, $this->ano, $this->obs, $this->dataCadastro, $this->impostos)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteCreditoDebitoGrupo() Function
	 */
	function deleteOutrosServicos() {
		$sql = "DELETE FROM outrosServicos WHERE idOutrosServicos = $this->idOutrosServicos";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldCreditoDebitoGrupo() Function
	 */
	function updateFieldOutrosServicos($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE outrosServicos SET " . $field . " = " . $value . " WHERE idOutrosServicos = $this->idOutrosServicos";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateCreditoDebitoGrupo() Function
	 */
	function updateOutrosServicos() {
		$sql = "UPDATE outrosServicos SET tipo = $this->tipo, professor_idProfessor = $this->professorIdProfessor, valor = $this->valor, mes = $this->mes, ano = $this->ano, obs = $this->obs, impostos = $this->impostos WHERE idOutrosServicos = $this->idOutrosServicos";
		//echo $sql;
		$result = $this -> query($sql, true);
	}

	/**
	 * selectCreditoDebitoGrupo() Function
	 */
	function selectOutrosServicos($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idOutrosServicos, professor_idProfessor, tipo, valor, mes, ano, obs, dataCadastro, impostos FROM outrosServicos " . $where;
		//echo $sql;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectCreditoDebitoGrupoTr() Function
	 */
	function selectOutrosServicosTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {

		$sql = "SELECT SQL_CACHE idOutrosServicos, professor_idProfessor, tipo, valor, mes, ano, obs, dataCadastro, impostos FROM outrosServicos " . $where." ORDER BY idOutrosServicos desc";
	//	Uteis::pr($sql);
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {

				$tipo = $valor['tipo']; // == 1 ? "Crédito" : "Débito";
				
				switch($tipo) {
					case 1:
					 $tipoNome = "Consultoria";
					 break;
					 
					case 2:
					$tipoNome = "Tradução";
					break;
					
					case 3:
					$tipoNome = "Revisão";
					break;
					
					case 4:
					$tipoNome = "Versão";
					break;
					
					case 5:
					$tipoNome = "Correção";
					break;
					
					case 6:
					$tipoNome = "Outros";
					break;
                    
                    case 7:
                    $tipoNome = "Débitos";
                    break; 
				}
				
                $valorPago = ($tipo==7)?$valor['valor']*(-1):$valor['valor'];
				$html .= "<tr align=\"center\">";

				$onclick = " onclick=\"abrirNivelPagina(this, '" . $caminhoModulo . "/include/form/outrosServicos.php?id=" . $valor['idOutrosServicos'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" ";

				$html .= "<td $onclick >" . $tipoNome . "</td>";

				$obs = $valor['obs'] ? " (" . $valor['obs'] . ")" : "";
				$html .= "<td $onclick >R$ " . Uteis::formatarMoeda($valorPago). "</td>";

				$html .= "<td $onclick >" . $valor['mes'] . "/" . $valor['ano'] . "</td>";
				
				$html .= "<td $onclick >" . $obs . "</td>";
				
				$html .= "<td $onlick >" . Uteis::exibirStatus($valor['impostos'])."</td>";

				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "/include/acao/outrosServicos.php', id=" . $valor['idOutrosServicos'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";

				$html .= "</tr>";
			}
		}
		return $html;
	}

	function selectOutrosServicos_demons($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $excluir = false) {

		$result = $this -> selectOutrosServicosTr_total($where);
	//	Uteis::pr($result);

		if ($result) {

			$html = "";

			foreach ($result as $OutrosServicos) {

				$tipo = $OutrosServicos['tipo']; //== 1 ? "Crédito" : "Débito";
				
				
				switch($tipo) {
					case 1:
					 $tipoNome = "Consultoria";
					 break;
					 
					case 2:
					$tipoNome = "Tradução";
					break;
					
					case 3:
					$tipoNome = "Revisão";
					break;
					
					case 4:
					$tipoNome = "Versão";
					break;
					
					case 5:
					$tipoNome = "Correção";
					break;
					
					case 6:
					$tipoNome = "Outros";
					break;
                    
                    case 7:
                    $tipoNome = "Débitos";
                    break;  
				}
				
				
				$obs = $OutrosServicos['obs'] ? " (" . $OutrosServicos['obs'] . ")" : "";
                
                $valorPago =  ($tipo==7) ? $OutrosServicos['valor']*(-1):$OutrosServicos['valor'];

				$html .= "<tr align=\"center\">
				
				<td>" . $tipoNome . "</td>
				
				<td>" . $obs . "</td>
				
				<td>R$ " . Uteis::formatarMoeda($valorPago)."</td>
				
				<td>".Uteis::exibirStatus($OutrosServicos['impostos'])."</td>
				
				</tr>
				
				";
			}
		}
		return $html;
	}

	function selectOutrosServicosTr_total($where = "") {

		$sql = "SELECT SQL_CACHE idOutrosServicos, professor_idProfessor, tipo, valor, mes, ano, obs, impostos
		 FROM outrosServicos " . $where;
	//	 Uteis::pr($sql);
		 
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {
			$res = array();
			$cont = 0;
			while ($valor = mysqli_fetch_array($result)) {

				$res[$cont]['tipo'] = $valor['tipo'];
				$res[$cont]['valor'] = $valor['valor'];
				$res[$cont]['obs'] = $valor['obs'];
				$res[$cont]['impostos'] = $valor['impostos'];
				$cont++;

			}
		}
		return $res;

	}

	/**
	 * selectCreditoDebitoGrupoSelect() Function
	 */
	function selectOutrosServicosSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idCreditoDebitoGrupo, planoAcaoGrupo_idPlanoAcaoGrupo, professor_idProfessor, tipo, valor, mes, ano, obs, dataCadastro, excluido, quem FROM creditoDebitoGrupo " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idCreditoDebitoGrupo\" name=\"idCreditoDebitoGrupo\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idCreditoDebitoGrupo'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idCreditoDebitoGrupo'] . "\">" . ($valor['idCreditoDebitoGrupo']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

}
?>

