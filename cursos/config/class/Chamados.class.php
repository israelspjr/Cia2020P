<?php
class Chamados extends Database {
	// class attributes
	var $idChamados;
	var $funcionario_idFuncionario;
	var $solicitacao;
	var $tipoUrgencia;
	//var $dataSolicitacao;
	var $dataSolucao;
	var $testado;
	var $finalizado;
	var $sistema;
	var $setor_idSetor;
	var $descartado;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idChamados = "NULL";
		$this -> funcionario_idFuncionario = "NULL";
		$this -> solicitacao = "NULL";
		$this -> tipoUrgencia = "NULL";
	//	$this -> dataSolicitacao = "NULL";
		$this -> dataSolucao = "NULL";
		$this -> testado = "NULL";
		$this -> finalizado = "NULL";
		$this -> sistema = "NULL";
		$this -> setor_idSetor = "NULL";
		$this -> descartado = "NULL";
	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdChamados($value) {
		$this -> idChamados = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setFuncionario_idFuncionario($value) {
		$this -> funcionario_idFuncionario = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setSolicitacao($value) {
		$this -> solicitacao = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setTipoUrgencia($value) {
		$this -> tipoUrgencia = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataSolucao($value) {
		$this -> dataSolucao = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setDataSolicitacao($value) {
	//	$this -> dataSolicitacao = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setTestado($value) {
		$this -> testado = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setFinalizado($value) {
		$this -> finalizado = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setSistema($value) {
		$this -> sistema = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setSetorIdSetor($value) {
		$this -> setor_idSetor = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setDescartado($value) {
		$this -> descartado = ($value) ? $this -> gravarBD($value) : "0";
	}
	

	/**
	 * addChamados() Function
	 */
	function addChamados() {
		$sql = "INSERT INTO chamados (funcionario_idFuncionario, solicitacao, tipoUrgencia, dataSolucao, testado, finalizado, sistema, setor_idSetor, descartado) VALUES ($this->funcionario_idFuncionario, $this->solicitacao, $this->tipoUrgencia,  $this->dataSolucao, $this->testado, $this->finalizado, $this->sistema, $this->setor_idSetor, $this->descartado)";
	//	echo $sql;
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	/**
	 * deleteChamados() Function
	 */
	function deleteChamados($id) {
		$sql = "DELETE FROM chamados WHERE idChamados = " . $id . "";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldChamados() Function
	 */
	function updateFieldChamados($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE chamados SET " . $field . " = " . $value . " WHERE idChamados = $this->idChamados";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateChamados() Function
	 */
	function updateChamados() {
		$sql = "UPDATE chamados SET funcionario_idFuncionario = $this->funcionario_idFuncionario, solicitacao = $this->solicitacao, tipoUrgencia = $this->tipoUrgencia, dataSolucao = $this->dataSolucao, testado = $this->testado, finalizado = $this->finalizado, sistema = $this->sistema, setor_idSetor = $this->setor_idSetor, descartado = $this->descartado WHERE idChamados = $this->idChamados";
	//	echo $sql;
		$result = $this -> query($sql, true);
	}

	/**
	 * selectChamados() Function
	 */
	function selectChamados($where = "") {
		$sql = "SELECT SQL_CACHE idChamados, funcionario_idFuncionario, solicitacao, tipoUrgencia, dataSolicitacao, dataSolucao, testado, finalizado, sistema, setor_idSetor, descartado from chamados " . $where;
	//	echo $sql;
		return $this -> executeQuery($sql);
	}

	function selectChamadosTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $excel = false) {
		
		$Relatorio = new Relatorio();
		$Setor = new Setor();
		
		$colunas = array("Número", "Funcionario", "Setor", "Sistema", "Solicitação", "Urgência", "Data Solicitação", "Data Solução", "Testado", "Finalizado", "Descartado");
		
		if ($excel == true) {
			$obs = "ok";
		}

		$sql = "SELECT SQL_CACHE T.idChamados, T.funcionario_idFuncionario, T.solicitacao, T.tipoUrgencia, T.dataSolicitacao, T.dataSolucao, DT.nome, T.finalizado, T.testado, T.sistema, T.setor_idSetor, T.descartado
		FROM chamados AS T 
		LEFT JOIN funcionario AS DT ON DT.idFuncionario = T.funcionario_idFuncionario " . $where;
		
	//	echo $sql;

		$result = $this -> query($sql);
		
		 $html .= "<tbody>";

		if (mysqli_num_rows($result) > 0) {

		//	$html = "";

			while ($valor = mysqli_fetch_array($result)) {

				$idChamados = $valor['idChamados'];
				$nome = $valor['nome'];
				$solicitacao = $valor['solicitacao'];
				$tipoUrgencia = $valor['tipoUrgencia'];
				$idSetor = $valor['setor_idSetor'];
				
				$nomeSetor = $Setor->getNome($idSetor);
				
				
				if ($tipoUrgencia == 1) {
					 	$tipoUrgencia = "Urgente 1 - Vendas";
			
				} else if ($tipoUrgencia == 2) {
						$tipoUrgencia = "Urgente 2 - Financeiro";
				
				} else if ($tipoUrgencia == 3) {
						$tipoUrgencia = "Urgente 3 - Administrativo";
				
				} else if ($tipoUrgencia == 4) {
						$tipoUrgencia = "Urgente 4 - Terceiros";
				
				} else if ($tipoUrgencia == 5) {
						$tipoUrgencia = "Urgente 5 - Outros";
				
				} else if ($tipoUrgencia == 6) {
						$tipoUrgencia = "Melhoria 1 - Vendas";
				
				} else if ($tipoUrgencia == 7) {
						$tipoUrgencia = "Melhoria 2 - Administrativo";
				
				} else if ($tipoUrgencia == 8) {
						$tipoUrgencia = "Melhoria 3 - Outros";
				
				}
				
				$sistema = $valor['sistema'];
				if ($sistema == 1) {
					 	$sistema = "Cursos";
			
				} else if ($sistema == 2) {
						$sistema = "Consultoria";
				
				} else if ($sistema == 3) {
						$sistema = "Site Principal";
				
				} else if ($sistema == 4) {
						$sistema = "Profcerto";
				
				} else if ($sistema == 5) {
						$sistema = "Outros sites";
				
				} else if ($sistema == 6) {
						$sistema = "Hardwares";
				
				} else if ($sistema == 7) {
						$sistema = "Servidores";
						
				} else if ($sistema == 8) {
						$sistema = "Emails";
				}
				
				
				$dataSolicitacao = $valor['dataSolicitacao'];
				$dataSolucao = $valor['dataSolucao'];
				$finalizado = $valor['finalizado'];
				$descartado = $valor['descartado'];
				
			//	$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
				
				
				$testado = $valor['testado'];

				$onclick = " onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=$idChamados', '$caminhoAtualizar', '$ondeAtualiza')\" ";

				$html .= "<tr>";
				
				$html .= "<td  $onclick >" . $idChamados . "</td> ";
				
				$html .= "<td  $onclick >" . $nome . "</td> ";
				
				$html .= "<td  $onclick >" . $nomeSetor . "</td>";
				
				$html .= "<td  $onclick >" . $sistema . "</td>";
				
				$html .= "<td >" . $solicitacao . "</td>";
				
				$html .= "<td  $onclick >" . $tipoUrgencia . "</td>";
				
				$html .= "<td $onclick >" . Uteis::exibirData($dataSolicitacao) . "</td>";
				
				$html .= "<td $onclick >" . Uteis::exibirData($dataSolucao) . "</td>";
				
				$html .= "<td $onclick >";
				 if ($excel == false) {
					 $html .= Uteis::exibirStatus($testado);
				 } elseif ($testado == 1) {				 
					  $html .= $obs; 
					  }
					  $html .= "</td>";
				
				$html .= "<td $onclick >";
				if ($excel == false) {
				 $html .= Uteis::exibirStatus($finalizado);
				} elseif ($finalizado == 1) {
					$html .= $obs;
				}
				$html .= "</td>";
				
				$html .= "<td $onclick >";
				if ($excel == false) {
				 $html .= Uteis::exibirStatus($descartado);
				} elseif ($descartado == 1) {
					$html .= $obs;
				}
				$html .= "</td>";
				
				
//				<td onclick=\"deletaRegistro('" . $caminhoAbrir . "acao/telefone.php', '$idTelefone', '$caminhoAtualizar', '$ondeAtualiza')\">
//					<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>
//				</td>
				
				$html .= "</tr>";

			}
			 $html .= "</tbody>";
		}
	
		$html_base = $Relatorio->montaTb($colunas, $excel);

		
		return $html_base . $html;
	}


}
?>