<?php
class OcorrenciaFF extends Database {
	// class attributes
	var $idOcorrenciaFF;
	var $sigla;
	var $decricaoSigla;
	var $obs;
	var $inativa;
	var $pagarProfessor;
	var $reporAula;
    var $pagarReposicao;
	var $professorVe;
	var $adminVe;
    var $expira;
	var $excluido;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idOcorrenciaFF = "NULL";
		$this -> sigla = "NULL";
		$this -> decricaoSigla = "NULL";
		$this -> obs = "NULL";
		$this -> inativa = "0";
		$this -> pagarProfessor = "NULL";
		$this -> reporAula = "NULL";
        $this -> pagarReposicao = "1";
		$this -> professorVe = "NULL";
		$this -> adminVe = "NULL";
        $this -> expira = "1";
		$this -> excluido = "0";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdOcorrenciaFF($value) {
		$this -> idOcorrenciaFF = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setSigla($value) {
		$this -> sigla = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDecricaoSigla($value) {
		$this -> decricaoSigla = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setObs($value) {
		$this -> obs = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setInativa($value) {
		$this -> inativa = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setPagarProfessor($value) {
		$this -> pagarProfessor = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setReporAula($value) {
		$this -> reporAula = ($value) ? $this -> gravarBD($value) : "0";
	}
    
    function setPagarReposicao($value) {
        $this -> pagarReposicao = ($value) ? $this -> gravarBD($value) : "0";
    }

	function setProfessorVe($value) {
		$this -> professorVe = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setAdminVe($value) {
		$this -> adminVe = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setExcluido($value) {
		$this -> excluido = ($value) ? $this -> gravarBD($value) : "0";
	}
    function setExpira($value){
        $this -> expira = ($value) ? $this -> gravarBD($value) : "0";
    }
        
	/**
	 * addOcorrenciaFF() Function
	 */
	function addOcorrenciaFF() {
		$sql = "INSERT INTO ocorrenciaFF (sigla, decricaoSigla, obs, inativa, pagarProfessor, reporAula, pagarReposicao, professorVe, adminVe, expira, excluido) VALUES ($this->sigla, $this->decricaoSigla, $this->obs, $this->inativa, $this->pagarProfessor, $this->reporAula, $this->pagarReposicao, $this->professorVe, $this->adminVe, $this->expira, $this->excluido)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteOcorrenciaFF() Function
	 */
	function deleteOcorrenciaFF() {
		$sql = "DELETE FROM ocorrenciaFF WHERE idOcorrenciaFF = $this->idOcorrenciaFF";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldOcorrenciaFF() Function
	 */
	function updateFieldOcorrenciaFF($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE ocorrenciaFF SET " . $field . " = " . $value . " WHERE idOcorrenciaFF = $this->idOcorrenciaFF";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateOcorrenciaFF() Function
	 */
	function updateOcorrenciaFF() {
		$sql = "UPDATE ocorrenciaFF SET sigla = $this->sigla, decricaoSigla = $this->decricaoSigla, obs = $this->obs, inativa = $this->inativa, pagarProfessor = $this->pagarProfessor, reporAula = $this->reporAula, pagarReposicao = $this->pagarReposicao, professorVe = $this->professorVe, adminVe = $this->adminVe, expira= $this->expira WHERE idOcorrenciaFF = $this->idOcorrenciaFF";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectOcorrenciaFF() Function
	 */
	function selectOcorrenciaFF($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idOcorrenciaFF, sigla, decricaoSigla, obs, inativa, pagarProfessor, reporAula, pagarReposicao, professorVe, adminVe, expira, excluido FROM ocorrenciaFF " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectOcorrenciaFFTr() Function
	 */
	function selectOcorrenciaFFTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE idOcorrenciaFF, sigla, decricaoSigla, obs, inativa, pagarProfessor, reporAula, pagarReposicao, professorVe, adminVe, expira, excluido FROM ocorrenciaFF " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$idOcorrenciaFF = $valor['idOcorrenciaFF'];
				$sigla = $valor['sigla'];
				$decricaoSigla = $valor['decricaoSigla'];
				$obs = $valor['obs'];

				$inativa = Uteis::exibirStatus(!$valor['inativa']);
				$pagarProfessor = Uteis::exibirStatus($valor['pagarProfessor']);
				$reporAula = Uteis::exibirStatus($valor['reporAula']);
				$professorVe = Uteis::exibirStatus($valor['professorVe']);
				$adminVe = Uteis::exibirStatus($valor['adminVe']);
                $expira = Uteis::exibirStatus($valor['expira']);
                $pagarReposicao = Uteis::exibirStatus($valor['pagarReposicao']);
                
				$html .= "<td>" . $idOcorrenciaFF . "</td>";
				$html .= "<td class=\"link\" onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idOcorrenciaFF'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $sigla . "</td>";
				$html .= "<td>" . $decricaoSigla . "</td>";
				//	$html .= "<td>".$obs."</td>";
				$html .= "<td>" . $inativa . "</td>";
				$html .= "<td>" . $pagarProfessor . "</td>";
				$html .= "<td>" . $reporAula . "</td>";
				$html .= "<td>" . $pagarReposicao . "</td>";
				$html .= "<td>" . $professorVe . "</td>";
				$html .= "<td>" . $adminVe . "</td>";
                $html .= "<td>" . $expira . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "grava.php', " . $valor['idOcorrenciaFF'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	function selectOcorrenciaFFSelect($classes = "", $idAtual = 0, $where = "", $nomeElemento = "") {

		$sql = "SELECT SQL_CACHE 
		idOcorrenciaFF, sigla, decricaoSigla, obs, inativa, pagarProfessor, reporAula, pagarReposicao, professorVe, adminVe, expira 
		FROM ocorrenciaFF 
		WHERE inativa = 0 AND excluido = 0 " . $where;
		//echo $sql;
		$result = $this -> query($sql);

		$html = "<select id=\"idOcorrenciaFF\" name=\"idOcorrenciaFF\" class=\"" . $classes . "\" style=\"min-width:90px\" >
		<option value=\"\">Selecione</option>";

		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idOcorrenciaFF'] ? "selected" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idOcorrenciaFF'] . "\" title=\"" . $valor['decricaoSigla'] . "\">" . $valor['sigla'] . "</option>";
		}

		$html .= "</select>";
		return $html;
	}
	
	function selectOcorrenciaFFSelectSemRep($classes = "", $idAtual = 0, $where = "", $nomeElemento = "") {

		$sql = "SELECT SQL_CACHE 
		idOcorrenciaFF, sigla, decricaoSigla, obs, inativa, pagarProfessor, reporAula, pagarReposicao, professorVe, adminVe, expira 
		FROM ocorrenciaFF 
		WHERE idOcorrenciaFF != 7 and inativa = 0 AND excluido = 0 " . $where;
		//echo $sql;
		$result = $this -> query($sql);

		$html = "<select id=\"idOcorrenciaFF\" name=\"idOcorrenciaFF\" class=\"" . $classes . "\" style=\"min-width:90px\" >
		<option value=\"\">Selecione</option>";

		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idOcorrenciaFF'] ? "selected" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idOcorrenciaFF'] . "\" title=\"" . $valor['decricaoSigla'] . "\">" . $valor['sigla'] . "</option>";
		}

		$html .= "</select>";
		return $html;
	}
	

	function selectOcorrenciaFF_legenda() {

		$html = "";
		$rs = $this -> selectOcorrenciaFF(" WHERE excluido = 0 ");
		if ($rs) {
			foreach ($rs as $valor) {

				$html .= "<p><strong>" . $valor['sigla'] . "</strong></p>				
				<p>" . $valor['decricaoSigla'] . "</p>";
			}
		}

		return $html;
	}
    function getSiglaOcorrencia($id){
       $result = $this->selectOcorrenciaFF("WHERE inativa = 0 AND idOcorrenciaFF = ".$id);
       return $result[0]['sigla'];
    }
	
	function selectOcorrenciaFFSelectMulti($classes = "", $idAtual = 0, $where = "", $nomeElemento = "") {

		$sql = "SELECT SQL_CACHE 
		idOcorrenciaFF, sigla, decricaoSigla, obs, inativa, pagarProfessor, reporAula, pagarReposicao, professorVe, adminVe, expira 
		FROM ocorrenciaFF 
		WHERE inativa = 0 AND excluido = 0 " . $where;
		//echo $sql;
		$result = $this -> query($sql);

		$html = "<select id=\"idOcorrenciaFF\" name=\"idOcorrenciaFF[]\" class=\"" . $classes . "\" multiple=\"multiple\" >";
		$html .= "<option value=\"-\" ".(($idAtual==0)? "selected=\"selected\"":"").">Todos</option>";

		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idOcorrenciaFF'] ? "selected" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idOcorrenciaFF'] . "\" title=\"" . $valor['decricaoSigla'] . "\">" . $valor['sigla'] . "</option>";
		}

		$html .= "</select>";
		return $html;
	}
}
?>