<?php
class CreditoDebitoGrupo extends Database {
	// class attributes
	var $idCreditoDebitoGrupo;
	var $planoAcaoGrupoIdPlanoAcaoGrupo;
	var $professorIdProfessor;
	var $tipo;
    var $quem;
	var $valor;
	var $mes;
	var $ano;
	var $obs;
	var $dataCadastro;
	var $excluido;
	var $premiacao;
	var $grupo_idGrupo;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idCreditoDebitoGrupo = "NULL";
		$this -> planoAcaoGrupoIdPlanoAcaoGrupo = "NULL";
		$this -> professorIdProfessor = "NULL";
		$this -> tipo = "NULL";
		$this -> valor = "NULL";
        $this -> quem = "NULL";
		$this -> mes = "NULL";
		$this -> ano = "NULL";
		$this -> obs = "NULL";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";
		$this -> excluido = "0";
		$this -> premiacao = "0";
		$this -> grupo_idGrupo = "0";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdCreditoDebitoGrupo($value) {
		$this -> idCreditoDebitoGrupo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPlanoAcaoGrupoIdPlanoAcaoGrupo($value) {
		$this -> planoAcaoGrupoIdPlanoAcaoGrupo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setProfessorIdProfessor($value) {
		$this -> professorIdProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setTipo($value) {
		$this -> tipo = ($value) ? $this -> gravarBD($value) : "NULL";
	}
    
    function setQuem($value) {
        $this -> quem = ($value) ? $this -> gravarBD($value) : "NULL";
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

	function setDataCadastro($value) {
		//$this->dataCadastro = ($value) ? $this->gravarBD($value) : "NULL";
	}

	function setExcluido($value) {
		$this -> excluido = ($value) ? $this -> gravarBD($value) : "0";
	}
	
	function setPremiacao($value) {
		$this -> premiacao = ($value) ? $this -> gravarBD($value) : "0";
	}
	
	function setGrupoIdGrupo($value) {
		$this -> grupo_idGrupo = ($value) ? $this -> gravarBD($value) : "0";
	}

	/**
	 * addCreditoDebitoGrupo() Function
	 */
	function addCreditoDebitoGrupo() {
		$sql = "INSERT INTO creditoDebitoGrupo (planoAcaoGrupo_idPlanoAcaoGrupo, professor_idProfessor, tipo, valor, mes, ano, obs, dataCadastro, excluido, quem, premiacao, grupo_idGrupo) VALUES ($this->planoAcaoGrupoIdPlanoAcaoGrupo, $this->professorIdProfessor, $this->tipo, $this->valor, $this->mes, $this->ano, $this->obs, $this->dataCadastro, $this->excluido, $this->quem, $this->premiacao, grupo_idGrupo = $this->grupo_idGrupo)";
	//	echo $sql;
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteCreditoDebitoGrupo() Function
	 */
	function deleteCreditoDebitoGrupo() {
		$sql = "DELETE FROM creditoDebitoGrupo WHERE idCreditoDebitoGrupo = $this->idCreditoDebitoGrupo";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldCreditoDebitoGrupo() Function
	 */
	function updateFieldCreditoDebitoGrupo($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE creditoDebitoGrupo SET " . $field . " = " . $value . " WHERE idCreditoDebitoGrupo = $this->idCreditoDebitoGrupo";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateCreditoDebitoGrupo() Function
	 */
	function updateCreditoDebitoGrupo() {
		$sql = "UPDATE creditoDebitoGrupo SET tipo = $this->tipo, valor = $this->valor, mes = $this->mes, ano = $this->ano, obs = $this->obs, quem = $this->quem, premiacao = $this->premiacao, grupo_idGrupo = $this->grupo_idGrupo WHERE idCreditoDebitoGrupo = $this->idCreditoDebitoGrupo";
//		echo $sql;
		$result = $this -> query($sql, true);
	}

	/**
	 * selectCreditoDebitoGrupo() Function
	 */
	function selectCreditoDebitoGrupo($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idCreditoDebitoGrupo, planoAcaoGrupo_idPlanoAcaoGrupo, professor_idProfessor, tipo, valor, mes, ano, obs, dataCadastro, excluido, quem, premiacao, grupo_idGrupo FROM creditoDebitoGrupo " . $where;
		//echo $sql;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectCreditoDebitoGrupoTr() Function
	 */
	function selectCreditoDebitoGrupoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "", $idProfessor) {
		
		$Grupo = new Grupo();

		$sql = "SELECT SQL_CACHE idCreditoDebitoGrupo, planoAcaoGrupo_idPlanoAcaoGrupo, professor_idProfessor, tipo, valor, mes, ano, obs, dataCadastro, excluido, quem, premiacao, grupo_idGrupo FROM creditoDebitoGrupo " . $where;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {
				
				$nomeGrupo = $Grupo->getNome($valor['grupo_idGrupo']);

				$tipo = $valor['tipo'] == 1 ? "Crédito" : "Débito";

				$html .= "<tr align=\"center\">";

				$onclick = " onclick=\"abrirNivelPagina(this, '" . $caminhoModulo . "/include/form/creditoDebitoGrupo.php?id=" . $valor['idCreditoDebitoGrupo'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" ";

				$html .= "<td $onclick >" . $tipo . "</td>";

				$obs = $valor['obs'] ? " (" . $valor['obs'] . ")" : "";
				$html .= "<td $onclick >R$ " . Uteis::formatarMoeda($valor['valor']) . $obs . "</td>";

				$html .= "<td $onclick >" . $valor['mes'] . "/" . $valor['ano'] . "</td>";
				
				if ($idProfessor == 1) {
					
					$html .= "<td>".Uteis::exibirStatus($valor['premiacao'])."</td>";
					$html .= "<td>".$nomeGrupo."</td>";
				}

				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "/include/acao/creditoDebitoGrupo.php', " . $valor['idCreditoDebitoGrupo'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";

				$html .= "</tr>";
			}
		}
		
				
		return $html;
	}

	function selectCreditoDebitoGrupoTr_demons($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $excluir = false) {

		$result = $this -> selectCreditoDebitoGrupoTr_total($where);
	
		if ($result) {

			$html = "";

			foreach ($result as $valorCreditoDebitoGrupo) {

				$tipo = $valorCreditoDebitoGrupo['tipo'] == 1 ? "Crédito" : "Débito";
				$obs = $valorCreditoDebitoGrupo['obs'] ? " (" . $valorCreditoDebitoGrupo['obs'] . ")" : "";
				
				if ($valorCreditoDebitoGrupo['premiacao'] == 1) {
				$obs .= " (Premiação)";	
					
				}

				$html .= "<tr align=\"center\">
				
				<td>" . $tipo . "</td>
				
				<td>R$ " . Uteis::formatarMoeda($valorCreditoDebitoGrupo['valor']) . $obs . "</td>
				
				</tr>";
			}
		}
		return $html;
	}

	function selectCreditoDebitoGrupoTr_total($where = "") {

		$sql = "SELECT SQL_CACHE idCreditoDebitoGrupo, tipo, valor, mes, ano, obs, quem, premiacao 
		 FROM creditoDebitoGrupo " . $where;

		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {
			$res = array();
			$cont = 0;
			while ($valor = mysqli_fetch_array($result)) {

				$res[$cont]['tipo'] = $valor['tipo'];
				$res[$cont]['valor'] = $valor['valor'];
				$res[$cont]['obs'] = $valor['obs'];
				$res[$cont]['premiacao'] = $valor['premiacao'];

				$cont++;

			}
		}
		return $res;

	}

	/**
	 * selectCreditoDebitoGrupoSelect() Function
	 */
	function selectCreditoDebitoGrupoSelect($classes = "", $idAtual = 0, $where = "") {
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

