<?php
class DiasBuscaAvulsa extends Database {
	// class attributes
	var $idDiasBuscaAvulsa;
	var $buscaAvulsaIdBuscaAvulsa;
	var $tipo;
	var $horaInicio;
	var $horaFim;
	var $dataAula;
	var $diaSemanaAula;
	var $obs;
	var $excluida;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idDiasBuscaAvulsa = "NULL";
		$this -> buscaAvulsaIdBuscaAvulsa = "NULL";
		$this -> tipo = "NULL";
		$this -> horaInicio = "NULL";
		$this -> horaFim = "NULL";
		$this -> dataAula = "NULL";
		$this -> diaSemanaAula = "NULL";
		$this -> obs = "NULL";
		$this -> excluida = "0";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdDiasBuscaAvulsa($value) {
		$this -> idDiasBuscaAvulsa = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setBuscaAvulsaIdBuscaAvulsa($value) {
		$this -> buscaAvulsaIdBuscaAvulsa = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setTipo($value) {
		$this -> tipo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setHoraInicio($value) {
		$this -> horaInicio = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setHoraFim($value) {
		$this -> horaFim = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataAula($value) {
		$this -> dataAula = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDiaSemanaAula($value) {
		$this -> diaSemanaAula = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setObs($value) {
		$this -> obs = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setExcluida($value) {
		$this -> excluida = ($value) ? $this -> gravarBD($value) : "0";
	}

	/**
	 * addDiasBuscaAvulsa() Function
	 */
	function addDiasBuscaAvulsa() {
		$sql = "INSERT INTO diasBuscaAvulsa (buscaAvulsa_idBuscaAvulsa, tipo, horaInicio, horaFim, dataAula, diaSemanaAula, obs, excluida) VALUES ($this->buscaAvulsaIdBuscaAvulsa, $this->tipo, $this->horaInicio, $this->horaFim, $this->dataAula, $this->diaSemanaAula, $this->obs, $this->excluida)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteDiasBuscaAvulsa() Function
	 */
	function deleteDiasBuscaAvulsa() {
		$sql = "DELETE FROM diasBuscaAvulsa WHERE idDiasBuscaAvulsa = $this->idDiasBuscaAvulsa";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldDiasBuscaAvulsa() Function
	 */
	function updateFieldDiasBuscaAvulsa($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE diasBuscaAvulsa SET " . $field . " = " . $value . " WHERE idDiasBuscaAvulsa = $this->idDiasBuscaAvulsa";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateDiasBuscaAvulsa() Function
	 */
	function updateDiasBuscaAvulsa() {
		$sql = "UPDATE diasBuscaAvulsa SET buscaAvulsa_idBuscaAvulsa = $this->buscaAvulsaIdBuscaAvulsa, tipo = $this->tipo, horaInicio = $this->horaInicio, horaFim = $this->horaFim, dataAula = $this->dataAula, diaSemanaAula = $this->diaSemanaAula, obs = $this->obs, excluida = $this->excluida WHERE idDiasBuscaAvulsa = $this->idDiasBuscaAvulsa";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectDiasBuscaAvulsa() Function
	 */
	function selectDiasBuscaAvulsa($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idDiasBuscaAvulsa, buscaAvulsa_idBuscaAvulsa, tipo, horaInicio, horaFim, dataAula, diaSemanaAula, obs, excluida FROM diasBuscaAvulsa " . $where;
//		echo $sql;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectDiasBuscaAvulsaTr() Function
	 */
	function selectDiasBuscaAvulsaTr_dias($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $professor) {

		$sql = "SELECT SQL_CACHE idDiasBuscaAvulsa, buscaAvulsa_idBuscaAvulsa, tipo, horaInicio, horaFim, dataAula, diaSemanaAula, obs, excluida 
		FROM diasBuscaAvulsa 
		WHERE excluida = 0 " . $where;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {

				$idDiasBuscaAvulsa = $valor['idDiasBuscaAvulsa'];
				$idBuscaAvulsa = $valor['buscaAvulsa_idBuscaAvulsa'];
				$horaInicio = Uteis::exibirHoras($valor['horaInicio']);
				$horaFim = Uteis::exibirHoras($valor['horaFim']);
                $obs = (strlen($valor['obs'])>2) ? '<span style="cursor:pointer;font-weight:bold;" title="'.$valor['obs'].'"> - Obs.:</span>':'';
				$dia = ($valor['tipo'] == "1") ? Uteis::exibirDiaSemana($valor['diaSemanaAula']) : Uteis::exibirData($valor['dataAula']);
				
				if ($professor != 1) {
				$html .= "<div class=\"destacaLinha\" ref=\"$idDiasBuscaAvulsa\">

					<img src=\"" . CAMINHO_IMG . "excluir.png\" onclick=\"deletaRegistro('" . CAMINHO_REL . "busca/avulsa/include/acao/dia.php', '$idDiasBuscaAvulsa', '$caminhoAtualizar', 'tr')\" title=\"Excluir dia\" />

					<font onclick=\"abrirNivelPagina(this, '$caminhoAbrir?idDiasBuscaAvulsa=$idDiasBuscaAvulsa&idBuscaAvulsa=$idBuscaAvulsa', '$caminhoAtualizar', '$ondeAtualiza')\" >$dia das $horaInicio às $horaFim</font>
					$obs
				</div>";
				} else {
				$html .= "<div class=\"destacaLinha\" ref=\"$idDiasBuscaAvulsa\">	
					<font>$dia das $horaInicio às $horaFim</font></div>";
					
				}

			}
		}
		return $html;
	}

	function selectDiasBuscaAvulsaTr_prof($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idioma) {
		
		$Professor = new Professor();

		$sql = "SELECT SQL_CACHE DB.idDiasBuscaAvulsa, DB.buscaAvulsa_idBuscaAvulsa, P.nome, DBP.valorHora, DBP.obs,P.idProfessor
		FROM diasBuscaAvulsa AS DB
		LEFT JOIN diasBuscaAvulsaProfessor AS DBP ON DBP.diasBuscaAvulsa_idDiasBuscaAvulsa = DB.idDiasBuscaAvulsa AND escolhido = 1
		LEFT JOIN professor AS P ON P.idProfessor = DBP.professor_idProfessor 
		WHERE excluida = 0 " . $where;
	//	echo $sql;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {

				$idDiasBuscaAvulsa = $valor['idDiasBuscaAvulsa'];
				$idBuscaAvulsa = $valor['buscaAvulsa_idBuscaAvulsa'];
				$nome = $valor['nome'];
				
				if ($nome != '') {
				
				$valorH = $valor['valorHora'];
				if ($valorH == '') {
					$plano = $Professor->getPlanoCarreira($valor['idProfessor'], $idioma);
					
					
					$valorH = "Valor Hora Padrão: ".$plano;
				} else {
					$valorH = "Valor Negociado: R$".$valorH.",00";
				}
				$obs = $valor['obs'];
				
				$html2 .= "<br>".$valorH."/ Obs: ".$obs;
				}

				$html .= "<div class=\"destacaLinha\" ref=\"$idDiasBuscaAvulsa\" onclick=\"abrirNivelPagina(this, '$caminhoAbrir?idDiasBuscaAvulsa=$idDiasBuscaAvulsa&idBuscaAvulsa=$idBuscaAvulsa', '$caminhoAtualizar', '$ondeAtualiza')\"  >				
					<center><img src=\"" . CAMINHO_IMG . "pa.png\" title=\"Iniciar busca de professor\" />
					$nome";
				$html .= $html2;
				$html .= "</center>					
				</div> ";

			}
		}
		return $html;
	}

	/**
	 * selectDiasBuscaAvulsaSelect() Function
	 */
	function selectDiasBuscaAvulsaSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idDiasBuscaAvulsa, buscaAvulsa_idBuscaAvulsa, tipo, horaInicio, horaFim, dataAula, diaSemanaAula, obs, excluida FROM diasBuscaAvulsa " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idDiasBuscaAvulsa\" name=\"idDiasBuscaAvulsa\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idDiasBuscaAvulsa'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idDiasBuscaAvulsa'] . "\">" . ($valor['idDiasBuscaAvulsa']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

}
?>