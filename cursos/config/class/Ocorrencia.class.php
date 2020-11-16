<?php

class Ocorrencia extends Database {
	
	// class attributes
	var $idOcorrencia;
	var $clientePf_idClientePf;
	var $dataContato;
	var $observacao;
	var $dataRetorno;
	var $status;
	var $funcionarioIdFuncionario;
	var $outro;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idOcorrencia = "NULL";
		$this -> clientePf_IdClientePf = "NULL";
		$this -> dataContato = "'" . date('Y-m-d H:i:s') . "'";
		$this -> observacao = "NULL";
		$this -> dataRetorno = "NULL";
		$this -> status = "NULL";
		$this -> funcionarioIdFuncionario = 0;
		$this -> outro = "NULL";
	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdOcorrencia($value) {
		$this -> idOcorrencia = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setClientePf_idClientePf($value) {
		$this -> clientePf_idClientePf = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataContato($value) {
//		$this -> dataContato = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setObservacao($value) {
		$this -> observacao = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataRetorno($value) {
		$this -> dataRetorno = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setStatus($value) {
		$this -> status = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setFuncionarioIdFuncionario($value) {
		$this -> funcionarioIdFuncionario = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setOutro($value) {
		$this -> outro = ($value) ? $this -> gravarBD($value) : "NULL";
	}


	/**
	 * addChamados() Function
	 */
	function addOcorrencia() {
		$sql = "INSERT INTO ocorrencia (clientePf_idClientePf, dataContato, observacao, dataRetorno, status, funcionario_idFuncionario, outro) VALUES ($this->clientePf_idClientePf, $this->dataContato, $this->observacao, $this->dataRetorno, $this->status, $this->funcionarioIdFuncionario, $this->outro )";
//		echo $sql;
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteChamados() Function
	 */
	function deleteOcorrencia($id) {
		$sql = "DELETE FROM ocorrencia WHERE idOcorrencia = " . $id . "";
//		echo $sql;
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldChamados() Function
	 */
	function updateFieldOcorrencia($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE ocorrencia SET " . $field . " = " . $value . " WHERE idOcorrencia = $this->idOcorrencia";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateChamados() Function
	 */
	function updateOcorrencia() {
		$sql = "UPDATE ocorrencia SET clientePf_idClientePf = $this->clientePf_idClientePf, dataContato = $this->dataContato, observacao = $this->observacao, dataRetorno = $this->dataRetorno, status = $this->status, funcionario_idFuncionario = $this->funcionarioIdFuncionario, outro = $this->outro WHERE idOcorrencia = $this->idOcorrencia";
	//	echo $sql;
		$result = $this -> query($sql, true);
	}

	/**
	 * selectChamados() Function
	 */
	function selectOcorrencia($where = "") {
		$sql = "SELECT SQL_CACHE idOcorrencia, clientePf_idCLientePf, dataContato, observacao, dataRetorno, status, funcionario_idFuncionario, outro from ocorrencia " . $where;
	//	echo $sql;
		return $this -> executeQuery($sql);
	}
	
	function getUltimaData($idClientePf) {
		$sql = "SELECT SQL_CACHE idOcorrencia, clientePf_idCLientePf, dataContato, observacao, dataRetorno, status, funcionario_idFuncionario, outro from ocorrencia " . $where . "order by idOcorrencia DESC";
	//	echo $sql;
		$rs =  $this -> executeQuery($sql);
		return $rs[0]['dataRetorno'];
		
	}
	

	function selectOcorrenciaTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $excel = false, $campos, $camposNome) {
		
		$Funcionario = new Funcionario();
		
		$Relatorio = new Relatorio();
			
//		$colunas = array("Nome", "Data de contato", "Observação", "Data de Retorno", "Status");
		
		if ($excel == true) {
			$obs = "ok";
		}

		$sql = "SELECT SQL_CACHE PF.nome, T.idOcorrencia, T.clientePf_idClientePf, T.dataContato, T.observacao, T.dataRetorno, T.status, T.funcionario_idFuncionario, T.outro
		FROM ocorrencia AS T 
		INNER JOIN clientePf AS PF ON PF.idClientePf = T.clientePf_idClientePf " . $where;
		
		$result = $this -> query($sql);
			
		 $html .= "<tbody>";

		if (mysqli_num_rows($result) > 0) {
	
			while ($valor = mysqli_fetch_array($result)) {

				$idOcorrencia = $valor['idOcorrencia'];
				$nome = $valor['nome'];
				$observacao = $valor['observacao'];
				$dataContato = $valor['dataContato'];
				$dataRetorno = $valor['dataRetorno'];
				$status = $valor['status'];
				$idClientePf = $valor['clientePf_idClientePf'];
				$nomeFunc = $Funcionario->getNome($valor['funcionario_idFuncionario']);
			
				
				if ($status == 1) {
					 	$valorStatus = "Continuar contato";
			
				} else if ($status == 2) {
						$valorStatus = "Não tem interesse";
				
				} else if ($status == 3) {
						$valorStatus = "Tem interesse em promoções";
				}
				
				$onclick = " onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?idOcorrencia=$idOcorrencia&idClientePf=$idClientePf', '$caminhoAtualizar', '$ondeAtualiza')\" ";

				$html .= "<tr>";
				
				$html .= "<td  $onclick >" . $nome . "</td> ";
				
				$html .= "<td  $onclick >" . $valor['outro'] . "</td> ";
				
				$html .= "<td  $onclick >" . Uteis::exibirData($dataContato) . "</td>";
				
				$html .= "<td  $onclick >" . $observacao . "</td>";
				
				$html .= "<td  $onclick >" . Uteis::exibirData($dataRetorno) . "</td>";
				
				$html .= "<td  $onclick >" . $nomeFunc. "</td>";
				
				$html .= "<td $onclick >" . $valorStatus . "</td>";
				
				$html .= "<td onclick=\"deletaRegistro('" . CAMINHO_CAD . "clientePf/include/acao/ocorrencia.php', '$idOcorrencia', '$caminhoAtualizar', '$ondeAtualiza')\">
					<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>
				</td>";
				
				$html .= "</tr>";

			}
			
		}
		
		 $html .= "</tbody>";
		
    	$html_base = $Relatorio->montaTb($colunas, $excel,"",1);

		
		return $html;
	}


}
?>