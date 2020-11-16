<?php
class PsaControle extends Database {
	// class attributes
	var $idPsaControle;
	var $clientePfIdClientePf;
	var $dataPsa;
	var $ativo;
	var $tipoPsa;
	var $excluido;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idPsaControle = "NULL";
		$this -> clientePfIdClientePf = "NULL";
		$this -> dataPsa = "'" . date('Y-m-d'). "'"; 
		$this -> ativo = "0";
		$this -> tipoPsa = "NULL";
		$this -> excluido = "NULL";
	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdPsaControle($value) {
		$this -> idPsaControle = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setClientePfIdClientePf($value) {
		$this -> clientePfIdClientePf = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataPsa($value) {
//		$this -> solicitacao = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setAtivo($value) {
		$this -> ativo = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setTipoPsa($value) {
		$this -> tipoPsa = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setExcluido($value) {
		$this -> excluido = ($value) ? $this -> gravarBD($value) : "NULL";
	}


	/**
	 * addChamados() Function
	 */
	function addPsaControle() {
		$sql = "INSERT INTO psaControle (clientePf_idClientePf, dataPsa, ativo, tipoPsa, excluido) VALUES ($this->clientePfIdClientePf, $this->dataPsa, $this->ativo, $this->tipoPsa, $this->excluido)";
	//	echo $sql;
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteChamados() Function
	 */
	function deletePsaControle($id) {
		$sql = "DELETE FROM psaControle WHERE idPsaControle = " . $id . "";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldChamados() Function
	 */
	function updateFieldPsaControle($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE psaControle SET " . $field . " = " . $value . " WHERE idPsaControle = $this->idPsaControle";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateChamados() Function
	 */
	function updatePsaControle() {
		$sql = "UPDATE psaControle SET clientePf_idClientePf = $this->clientePfIdClientePf, dataPsa = $this->dataPsa, ativo = $this->ativo, tipoPsa = $this->tipoPsa, $excluido = $this->excluido WHERE idPsaControle = $this->idPsaControle";
	//	echo $sql;
		$result = $this -> query($sql, true);
	}

	/**
	 * selectChamados() Function
	 */
	function selectPsaControle($where = "") {
		$sql = "SELECT SQL_CACHE idPsaControle, clientePf_idClientePf, dataPsa, ativo, tipoPsa, excluido from psaControle " . $where;
	//	echo $sql;
		return $this -> executeQuery($sql);
	}

	function selectPsaControleTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $excel = false) {
		
		$Relatorio = new Relatorio();
		/*
		$colunas = array("Número", "Funcionario", "Sistema", "Solicitação", "Urgência", "Data Solicitação", "Data Solução", "Testado", "Finalizado");
		
		if ($excel == true) {
			$obs = "ok";
		}

		$sql = "SELECT SQL_CACHE T.idChamados, T.funcionario_idFuncionario, T.solicitacao, T.tipoUrgencia, T.dataSolicitacao, T.dataSolucao, DT.nome, T.finalizado, T.testado, T.sistema 
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
				
			//	$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
				
				
				$testado = $valor['testado'];

				$onclick = " onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=$idChamados', '$caminhoAtualizar', '$ondeAtualiza')\" ";

				$html .= "<tr>";
				
				$html .= "<td  $onclick >" . $idChamados . "</td> ";
				
				$html .= "<td  $onclick >" . $nome . "</td> ";
				
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
				
//				<td onclick=\"deletaRegistro('" . $caminhoAbrir . "acao/telefone.php', '$idTelefone', '$caminhoAtualizar', '$ondeAtualiza')\">
//					<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>
//				</td>
				
				$html .= "</tr>";

			}
			 $html .= "</tbody>";
		}
	
		$html_base = $Relatorio->montaTb($colunas, $excel);

		*/
		return $html_base . $html;
	}

}
?>