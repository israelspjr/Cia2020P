<?php
class IndicacaoClientePf extends Database {
	// class attributes
	var $idIndicacaoClientePf;
	var $clientePfIdClientePf;
	var $clientePfIdClientePfIndicado;
	var $clientePjIdClientePjIndicado;
	var $produtoIdProduto;
	var $obs;
	var $interno;
	var $externo;
	var $clientePjIdClientePj;
	var $potencial;
	var $influencia;
	var $dataCadastro;
	

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idIndicacaoClientePf = "NULL";
		$this -> clientePfIdClientePf = "NULL";
		$this -> clientePfIdClientePfIndicado = "NULL";
		$this -> clientePjIdClientePjIndicado = "NULL";
		$this -> produtoIdProduto = "NULL";
		$this -> obs = "NULL";
		$this -> interno = "0";
		$this -> externo = "0";
		$this -> clientePjIdClientePj = "NULL";
		$this -> potencial = "0";
		$this -> influencia = "0";
		$this -> dataCadastro = "'" . date('Y-m-d') . "'";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdIndicacaoClientePf($value) {
		$this -> idIndicacaoClientePf = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setClientePfIdClientePf($value) {
		$this -> clientePfIdClientePf = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setClientePfIdClientePfIndicado($value) {
		$this -> clientePfIdClientePfIndicado = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setClientePjIdClientePjIndicado($value) {
		$this -> clientePjIdClientePjIndicado = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	
	function setProdutoIdProduto($value) {
		$this -> produtoIdProduto = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setObs($value) {
		$this -> obs = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setInterno($value) {
		$this -> interno = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setExterno($value) {
		$this -> externo = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setClientePjIdClientePj($value) {
		$this -> clientePjIdClientePj = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setPotencial($value) {
		$this -> potencial = ($value) ? $this -> gravarBD($value) : "0";
	}
	
	function setInfluencia($value) {
		$this -> influencia = ($value) ? $this -> gravarBD($value) : "0";
	}
	
	 function setDataCadastro($value) {
        //$this->dataCadastro = ($value) ? $this->gravarBD($value) : "NULL";
    }

	/**
	 * addIndicacaoclientepf() Function
	 */
	function addIndicacaoclientepf() {
		$sql = "INSERT INTO indicacaoClientePf (clientePf_idClientePf, clientePf_idClientePfIndicado, clientePj_idClientePjIndicado, produtoIdProduto, obs, interno, externo, clientePj_idClientePj, potencial, influencia, dataCadastro) VALUES ($this->clientePfIdClientePf, $this->clientePfIdClientePfIndicado, $this->clientePjIdClientePjIndicado, $this->produtoIdProduto, $this->obs, $this->interno, $this->externo, $this->clientePjIdClientePj, $this->potencial, $this->influencia, $this->dataCadastro)";
	//	echo $sql;
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteIndicacaoclientepf() Function
	 */
	function deleteIndicacaoclientepf() {
		$sql = "DELETE FROM indicacaoClientePf WHERE idIndicacaoClientePf = $this->idIndicacaoClientePf";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldIndicacaoclientepf() Function
	 */
	function updateFieldIndicacaoclientepf($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE indicacaoClientePf SET " . $field . " = " . $value . " WHERE idIndicacaoClientePf = $this->idIndicacaoClientePf";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateIndicacaoclientepf() Function
	 */
	function updateIndicacaoclientepf() {
		$sql = "UPDATE indicacaoClientePf SET clientePf_idClientePf = $this->clientePfIdClientePf, clientePf_idClientePfIndicado = $this->clientePfIdClientePfIndicado, clientePj_idClientePjIndicado = $this->clientePjIdClientePjIndicado, produtoIdProduto = $this->produtoIdProduto, obs = $this->obs, interno = $this->interno, externo = $this->externo, clientePj_idClientePj = $this->clientePjIdClientePj, potencial = $this->potencial, influencia = $this->influencia WHERE idIndicacaoClientePf = $this->idIndicacaoClientePf";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectIndicacaoclientepf() Function
	 */
	function selectIndicacaoclientepf($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idIndicacaoClientePf, clientePf_idClientePf, clientePf_idClientePfIndicado, clientePj_idClientePjIndicado, produtoIdProduto, obs, interno, externo, clientePj_idClientePj, dataCadastro FROM indicacaoClientePf " . $where;
		return $this -> executeQuery($sql);
	}

	function selectIndicacaoclientepfTr($caminhoAtualizar, $ondeAtualiza, $where = "", $clientePj = 0) {
		$Relatorio = new Relatorio();
		
		$sql = "SELECT SQL_CACHE idIndicacaoClientePf, clientePf_idClientePf, clientePf_idClientePfIndicado, clientePj_idClientePjIndicado, produtoIdProduto , I.obs, I.interno, I.externo, I.clientePj_idClientePj, I.potencial, I.influencia, I.dataCadastro ";
		$sql .= " FROM indicacaoClientePf AS I ";
		$sql .= $where;
    	$result = $this -> query($sql);
		

		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";
				$valorNome = $valor['obs']; //!is_null($valor['clientePf_idClientePfIndicado']) ? $valor['nome'] : $valor['razaoSocial'];
				$html .= "<td >" . $valorNome . "</td>";
				$html .= "<td >" . $valor['produtoIdProduto']. "</td>";
				$html .= "<td>"  . Uteis::exibirStatus($valor['interno'])."</td>";
				$html .= "<td>"  . Uteis::exibirStatus($valor['externo'])."</td>";	
				$html .= "<td>"  . Uteis::exibirStatus($valor['potencial'])."</td>";
				$html .= "<td>"  . Uteis::exibirStatus($valor['influencia'])."</td>";				 
				$html .= "<td onclick=\"deletaRegistro('" . CAMINHO_CAD . "clientePf/include/acao/indicacaoClientePf.php', " . $valor['idIndicacaoClientePf'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}

    return $html;
		
	}
	
	function selectRelatorioIndicacaoclientepfTr($caminhoAtualizar, $ondeAtualiza, $where = "", $clientePj = 0, $campos, $camposNome, $excel = false) {
		$Relatorio = new Relatorio();
		
		$sql = "SELECT SQL_CACHE   PF.nomeExibicao AS nomeClientePf, PJ.nomeFantasia AS nomeClientePj, idIndicacaoClientePf, clientePf_idClientePf, clientePf_idClientePfIndicado, clientePj_idClientePjIndicado, produtoIdProduto , I.obs, I.interno, I.externo, I.clientePj_idClientePj, I.potencial, I.influencia, I.dataCadastro ";
		$sql .= " FROM indicacaoClientePf AS I ";
		$sql .= " LEFT JOIN clientePf AS PF ON PF.idClientePf = I.clientePf_idClientePf";
		$sql .= " LEFT JOIN clientePj AS PJ ON PJ.idClientePj = I.clientePj_idClientePj " . $where;
	//	echo $sql;
		$result = $this -> query($sql);
		

		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				if ($campos) {
					$html .= "<tr>";
				foreach ($campos as $campo) {
					if ($campo == 'clientePf') {
						$html .= "<td >" . $valor['nomeClientePf']."</td>";
					} else if ($campo == 'clientePj') {
						$html .= "<td >" . $valor['nomeClientePj']."</td>";				
					} else if ($campo == 'nome') {
						$html .= "<td >" . $valor['obs'] . "</td>";
					} else if ($campo == 'produto') {
						$html .= "<td >" . $valor['produtoIdProduto']. "</td>";
					} else if ($campo == 'interno') {
						$html .= "<td>"  . Uteis::exibirStatus($valor['interno'], !$excel)."</td>";
					} else if ($campo == 'externo') {
						$html .= "<td>"  . Uteis::exibirStatus($valor['externo'], !$excel)."</td>";	
					} else if ($campo == 'potencial') {
						$html .= "<td>"  . Uteis::exibirStatus($valor['potencial'], !$excel)."</td>";
					} else if ($campo == 'influencia') {
						$html .= "<td>"  . Uteis::exibirStatus($valor['influencia'], !$excel)."</td>";
					} else if ($campo == 'dataCadastro') {
						$html .= "<td>"  . Uteis::exibirData($valor['dataCadastro'])."</td>";				 
					} else if ($campo == 'acao') {
						if (!$excel) {
						$html .= "<td onclick=\"deletaRegistro('" . CAMINHO_CAD . "clientePf/include/acao/indicacaoClientePf.php', " . $valor['idIndicacaoClientePf'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
						} else {
							$html .= "<td></td>";
							}
						}
					}
				$html .= "</tr>";
				}
			}
		}

		$html_base = $Relatorio -> montaTb_avancado($campos, $camposNome, $excel, $colspan, $head);
	    return $html_base . $html;
		
	}

}
?>