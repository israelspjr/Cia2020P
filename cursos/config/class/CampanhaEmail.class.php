<?php
class CampanhaEmail extends Database {
	// class attributes
	var $idCampanhaEmail;
	var $titulo;
	var $texto;
	var $dataCadastro;
	var $dataEnvio;
	var $inativo;
	var $assunto;	
	var $nomeEnvio;
	var $clientePjIdClientePj;
	var $clientePfIdClientePf;
	var $horaEnvio;
	var $emailEnvio;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idCampanhaEmail = "NULL";
		$this -> titulo = "NULL";
		$this -> texto = "0";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";
		$this -> dataEnvio = "NULL";
		$this -> inativo = "NULL";
		$this -> assunto = "NULL";
		$this -> nomeEnvio = "NULL";
		$this -> clientePjIdClientePj = "NULL";
		$this -> clientePfIdClientePf = "NULL";		
		$this -> horaEnvio = "NULL";
		$this -> emailEnvio = "NULL";
	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdCampanhaEmail($value) {
		$this -> idCampanhaEmail = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setTitulo($value) {
		$this -> titulo = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setTexto($value) {
		$this -> texto = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setDataCadastro($value) {
        //$this->dataCadastro = ($value) ? $this->gravarBD($value) : "NULL";
    }
	
	function setDataEnvio($value) {
        $this->dataEnvio = ($value) ? $this->gravarBD($value) : "NULL";
    }

	function setInativo($value) {
		$this -> inativo = ($value) ? $this -> gravarBD($value) : "0";
	}
	
	function setAssunto($value) {
        $this->assunto = ($value) ? $this->gravarBD($value) : "NULL";
    }
	
	function setNomeEnvio($value) {
        $this->nomeEnvio = ($value) ? $this->gravarBD($value) : "NULL";
    }
	
	function setClientePjIdClientePj($value) {
		$this -> clientePjIdClientePj = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setClientePfIdClientePf($value) {
		$this -> clientePfIdClientePf = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setHoraEnvio($value) {
		$this -> horaEnvio = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setEmailEnvio($value) {
        $this->emailEnvio = ($value) ? $this->gravarBD($value) : "NULL";
    }

	/**
	 * addTipoNota() Function
	 */
	function addCampanhaEmail() {
		$sql = "INSERT INTO `campanhaEmail`(`titulo`, `texto`, `dataCadastro`, `dataEnvio`, `inativo`, `assunto`, `nomeEnvio`, `clientePj_idClientePj`, `clientePf_idClientePf`, `horaEnvio`, `emailEnvio`) VALUES ($this->titulo, $this->texto, $this->dataCadastro, $this->dataEnvio, $this->inativo, $this->assunto, $this->nomeEnvio, $this->clientePjIdClientePj, $this->clientePfIdClientePf, $this->horaEnvio, $this->emailEnvio)";
	//	echo $sql;
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	/**
	 * deleteTipoNota() Function
	 */
	function deleteCampanhaEmail() {
		$sql = "DELETE FROM campanhaEmail WHERE idCampanhaEmail = $this->idCampanhaEmail";
//		echo $sql;
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldTipoNota() Function
	 */
	function updateFieldCampanhaEmail($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE campanhaEmail SET " . $field . " = " . $value . " WHERE idCampanhaEmail = $this->idCampanhaEmail";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateTipoNota() Function
	 */
	function updateCampanhaEmail() {
		$sql = "UPDATE campanhaEmail SET titulo = $this->titulo, texto = $this->texto, dataEnvio = $this->dataEnvio, inativo = $this->inativo, assunto = $this->assunto, nomeEnvio = $this->nomeEnvio, clientePj_idClientePj = $this->clientePjIdClientePj, clientePf_idClientePf = $this->clientePfIdClientePf, horaEnvio = $this->horaEnvio, emailEnvio = $this->emailEnvio WHERE idCampanhaEmail = $this->idCampanhaEmail";
		//echo $sql;
		$result = $this -> query($sql, true);
	}

	/**
	 * selectTipoNota() Function
	 */
	function selectCampanhaEmail($where = "WHERE 1") {
		$sql = "SELECT `idCampanhaEmail`, `titulo`, `texto`, `dataCadastro`, `dataEnvio`, `inativo`, `assunto`, `nomeEnvio`, `clientePj_idClientePj`, `clientePf_idClientePf`, `horaEnvio`, `emailEnvio` FROM campanhaEmail " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectTipoNotaTr() Function
	 */
	function selectCampanhaEmailTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT `idCampanhaEmail`, `titulo`, `texto`, `dataCadastro`, `dataEnvio`, `inativo`, `assunto`, `nomeEnvio`, `clientePj_idClientePj`, `clientePf_idClientePf`, `horaEnvio` FROM campanhaEmail " . $where;
		$result = $this -> query($sql);
		$ClientePj = new ClientePj();
		$ClientePf = new ClientePf();		
		
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$idTipoNota = $valor['idCampanhaEmail'];
				$titulo = $valor['titulo'];
				$horaEnvio = $valor['horaEnvio'];
				$dataCadastro = Uteis::exibirData($valor['dataCadastro']);
				$dataEnvio = Uteis::exibirData($valor['dataEnvio']);				
				$inativo = Uteis::exibirStatus(!$valor['inativo']);
				$assunto = $valor['assunto'];
				$nomeEnvio = $valor['nomeEnvio'];				
				$idClientePj = $valor['clientePj_idClientePj'];
				$idClientePf = $valor['clientePf_idClientePf'];				
				
				$html .= "<td>" . $idTipoNota . "</td>";
				$html .= "<td class=\"link\" onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idCampanhaEmail'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $titulo . "</td>";
//				$html .= "<td class=\"link\" onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idCampanhaEmail'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $nome . "</td>";
		//		$html .= "<td align='center'>" . $texto . "</td>";
				$html .= "<td align='center'>" . $ClientePj->getNome($idClientePj). "</td>";
				$html .= "<td align='center'>" . $ClientePf->getNome($idClientePf). "</td>";
	    		$html .= "<td align='center'>" . $dataCadastro . "</td>";
				$html .= "<td align='center'>" . $dataEnvio . "</td>";
				$html .= "<td align='center'>" . $horaEnvio . "</td>";
				$html .= "<td align='center'>" . $nomeEnvio . "</td>";
				$html .= "<td align='center'>" . $inativo . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . CAMINHO_REL . "campanhaEmail/grava.php', " . $valor['idCampanhaEmail'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}
	
	/*function selectCampanhaEmailSelect($idAtual = 0, $classes = "", $and = "") {
		$sql = "SELECT SQL_CACHE idCampanhaEmail, descricao, inativo, clientePj_idClientePj FROM CampanhaEmail ";
		$sql .= " WHERE inativo = 0 " . $and . " ORDER BY descricao";
		$result = $this -> query($sql);
		//echo $sql; 
		//exit;
		$html = "<select id=\"idCampanhaEmail\" name=\"idCampanhaEmail\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idCampanhaEmail'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idCampanhaEmail'] . "\">" . ($valor['descricao']) . "</option>";
		}
		$html .= "</select>";
		return $html;
	}*/
}
?>