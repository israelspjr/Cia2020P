<?php
class DiaFolhaPonto extends Database {
	// class attributes
	var $idDiaFolhaPonto;
	var $folhaPontoIdFolhaPonto;
	var $dia;
	var $diaDaSemana;
	var $entrada;
	var $saidaAlmoco;
	var $voltaAlmoco;
	var $saida;
    var $creditos;
	var $debitos;	
	var $ocorrenciaFP;
	var $obs;
	var $banco;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idDiaFolhaPonto = "NULL";
		$this -> folhaPontoIdFolhaPonto = "NULL";
		$this -> dia = "NULL";
		$this -> diaDaSemana = "NULL";
		$this -> entrada = "0";
		$this -> saidaAlmoco = "0";
		$this -> voltaAlmoco = "0";
		$this -> saida = "0";
        $this -> creditos = "0";
		$this -> debitos = "0";		
		$this -> ocorrenciaFP = "0";
		$this -> obs = "NULL";
		$this -> banco = "NULL";
	
	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdDiaFolhaPonto($value) {
		$this -> idDiaFolhaPonto = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setFolhaPontoIdFolhaPonto($value) {
		$this -> folhaPontoIdFolhaPonto = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDia($value) {
		$this -> dia = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDiaDaSemana($value) {
		$this -> diaDaSemana = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setEntrada($value) {
		$this -> entrada = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setSaidaAlmoco($value) {
		$this -> saidaAlmoco = ($value) ? $this -> gravarBD($value) : "0";
	}
	
	function setVoltaAlmoco($value) {
		$this -> voltaAlmoco = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setSaida($value) {
		$this -> saida = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setCreditos($value) {
		$this -> creditos = ($value) ? $this -> gravarBD($value) : "0";
	}
    
	function setDebitos($value) {
        $this -> debitos = ($value) ? $this -> gravarBD($value) : "0";
    }
    
	function setOcorrenciaFP($value) {
		$this -> ocorrenciaFP = ($value) ? $this -> gravarBD($value) : "0";
	}
	
	function setObs($value) {
		$this -> obs = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setBanco($value) {
		$this -> banco = ($value) ? $this -> gravarBD($value) : "0";
	}

	/**
	 * addDiaFP() Function
	 */
	function addDiaFP() {
		$sql = "INSERT INTO `diaFolhaPonto` (`idDiaFolhaPonto`, `folhaPonto_idFolhaPonto`,
`dia`, `diaDaSemana`, `entrada`, `saidaAlmoco`, `voltaAlmoco`, `saida`, `creditos`, `debitos`, `ocorrenciaFP`,`obs`, `banco`) VALUES ($this->idDiaFolhaPonto , $this->folhaPontoIdFolhaPonto, $this->dia , $this->diaDaSemana, $this->entrada, $this->saidaAlmoco, $this->voltaAlmoco, $this->saida, $this->creditos, $this->debitos,$this->ocorrenciaFP,$this->obs, $this->banco);
";
//		echo $sql;
		$result = $this -> query($sql);
		return mysqli_insert_id($this -> connect);
	}

	function deleteDiaFP() {

		$sql = "DELETE FROM diaFolhaPonto WHERE idDiaFolhaPonto = $this->idDiaFolhaPonto";
		return $result = $this -> query($sql);
	}

	/**
	 * updateFieldDiaFP() Function
	 */
	function updateFieldDiaFP($field, $value, $idFolhaPonto, $idDia) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE diaFolhaPonto SET " . $field . " = " . $value . " WHERE folhaPonto_idFolhaPonto = $idFolhaPonto AND dia = $idDia";
	//	echo "<BR>$sql";
		$result = $this -> query($sql);
	}

	function updateDiaFP($idFolhaPonto, $idDia) {
		$sql = "UPDATE `diaFolhaPonto` SET `folhaPonto_idFolhaPonto` = $this->folhaPontoIdFolhaPonto, `dia` = $this->dia, `entrada` = $this->entrada, `saidaAlmoco` = $this->saidaAlmoco, `voltaAlmoco` = $this->voltaAlmoco, `saida` = $this->saida, `creditos` = $this->creditos, `debitos` = $this->debitos, `ocorrenciaFP` = $this->ocorrenciaFP, `obs` = $this->obs, `banco` = $this->banco
WHERE folhaPonto_idFolhaPonto = $idFolhaPonto AND dia = $idDia";
	//	echo $sql;
		$result = $this -> query($sql);
	}

	/**
	 * selectDiaFP() Function
	 */
	function selectDiaFP($where = "WHERE 1") {
		$sql = "SELECT `idDiaFolhaPonto`, `folhaPonto_idFolhaPonto`, `dia`, `diaDaSemana`, `entrada`, `saidaAlmoco`, `voltaAlmoco`, `saida`, `creditos`, `debitos`, `ocorrenciaFP`, `obs`, `banco` FROM  `diaFolhaPonto` " . $where;
	//	echo $sql;
		return $this -> executeQuery($sql);
	}
	
	 function selectOcorrenciaSelect($classes = "", $idAtual = 0, $where = "", $x, $finalizar) {
		 if ($finalizar == 1) {
			$classes = "selectBlock"; 
		 }
//		 echo $idAtual;
        $sql = "SELECT SQL_CACHE idOcorrenciaFP, descricao, inativo FROM ocorrenciaFolhaPonto " . $where;
        $result = $this -> query($sql);
        $html = "<select id=\"idOcorrenciaFP_".$x."\" name=\"idOcorrenciaFP_".$x."\"  class=\"" . $classes . "\" onChange=\"calcularFP(".$x.")\">";
        $html .= "<option value=\"\">Selecione</option>";
        while ($valor = mysqli_fetch_array($result)) {
	          $selecionado = $idAtual == $valor['idOcorrenciaFP'] ? "selected=\"selected\"" : "";
            $html .= "<option " . $selecionado . " value=\"" . $valor['idOcorrenciaFP'] . "\">" . ($valor['descricao']) . "</option>";
        }

        $html .= "</select>";
        return $html;
    }
}
?>