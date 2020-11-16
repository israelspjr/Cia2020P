<?php
class Contrato extends Database {
	// class attributes
	var $idContrato;
	var $professorIdProfessor;
	var $clientePfIdClientePf;
	var $clientePjIdClientePj;
	var $planoAcaoGrupoIdPranoAcaoGrupo;
	var $contrato;
	var $obs;
	var $naoMostrar;
	var $planoAcaoIdPlanoAcao;
	var $funcionarioIdFuncionario;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idContrato = "NULL";
		$this -> professorIdProfessor = "NULL";
		$this -> clientePfIdClientePf = "NULL";
		$this -> clientePjIdClientePj = "NULL";
		$this -> planoAcaoGrupoIdPranoAcaoGrupo = "NULL";
		$this -> contrato = "NULL";
		$this -> obs = "NULL";
		$this -> naoMostrar = "0";
		$this -> planoAcaoIdPlanoAcao = "0";
		$this -> funcionarioIdFuncionario = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdContrato($value) {
		$this -> idContrato = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setProfessorIdProfessor($value) {
		$this -> professorIdProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setClientePfIdClientePf($value) {
		$this -> clientePfIdClientePf = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setClientePjIdClientePj($value) {
		$this -> clientePjIdClientePj = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setGrupoIdGrupo($value) {
		//nada só para nao dar erro onde já havia sido feito...
	}

	function setPlanoAcaoGrupoIdPranoAcaoGrupo($value) {
		$this -> planoAcaoGrupoIdPranoAcaoGrupo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setContrato($value) {
		$this -> contrato = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setObs($value) {
		$this -> obs = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setNaoMostrar($value) {
		$this -> naoMostrar = ($value) ? $this -> gravarBD($value) : "0";
	}
	
	function setPlanoAcaoIdPlanoAcao($value) {
		$this -> planoAcaoIdPlanoAcao = ($value) ? $this -> gravarBD($value) : "0";
	}
	
	function setFuncionarioIdFuncionario($value) {
		$this -> funcionarioIdFuncionario = ($value) ? $this -> gravarBD($value) : "NULL";
	}


	/**
	 * addContrato() Function
	 */
	function addContrato() {
		$sql = "INSERT INTO contrato (professor_idProfessor, clientePf_idClientePf, clientePj_idClientePj, funcionario_idFuncionario, planoAcaoGrupo_idPlanoAcaoGrupo, contrato, obs,dataCadastro, naoMostrar, planoAcao_idPlanoAcao) VALUES ($this->professorIdProfessor, $this->clientePfIdClientePf,  $this->clientePjIdClientePj, $this->funcionarioIdFuncionario, $this->planoAcaoGrupoIdPranoAcaoGrupo, $this->contrato, $this->obs, '" . date('Y-m-d H:i:s') . "', $this->naoMostrar, $this->planoAcaoIdPlanoAcao )";
	//	echo $sql;
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteContrato() Function
	 */
	function deleteContrato() {
		$sql = "DELETE FROM contrato WHERE idContrato = $this->idContrato";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldContrato() Function
	 */
	function updateFieldContrato($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE contrato SET " . $field . " = " . $value . " WHERE idContrato = $this->idContrato";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateContrato() Function
	 */
	function updateContrato() {
		$sql = "UPDATE contrato SET professor_idProfessor = $this->professorIdProfessor, clientePf_idClientePf = $this->clientePfIdClientePf, funcionario_idFuncionario = $this->funcionarioIdFuncionario, clientePj_idClientePj = $this->clientePjIdClientePj, planoAcaoGrupo_idPlanoAcaoGrupo = $this->planoAcaoGrupoIdPranoAcaoGrupo, contrato = $this->contrato, obs = $this->obs, naoMostrar = $this->naoMostrar, planoAcao_idPlanoAcao = $thid->planoAcaoIdPlanoAcao WHERE idContrato = $this->idContrato";
	//	echo $sql;
		$result = $this -> query($sql, true);
		
	}

	/**
	 * selectContrato() Function
	 */
	function selectContrato($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idContrato, professor_idProfessor, clientePf_idClientePf, clientePj_idClientePj, funcionario_idFuncionario, planoAcaoGrupo_idPlanoAcaoGrupo, contrato, obs, dataCadastro, naoMostrar, planoAcao_idPlanoAcao FROM contrato " . $where;
		return $this -> executeQuery($sql);
	}
	
	function selectContratoTr_rh($where = "") {

		$sql = "SELECT SQL_CACHE idContrato, contrato, obs  FROM contrato " . $where;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {

				$html .= "<tr>
				
				<td >" . $valor['obs'] . "</td>
				
				<td> 
					<a href=\"" . CAMINHO_UP . "arquivo/contrato/clientePj/" . $valor['contrato'] . "\" target=\"_blank\">
						<center><img src=\"" . CAMINHO_IMG . "contrato.png\" ><center>
					</a>
				</td>
								
				</tr>";

			}
		}

		return $html;
	}

	function selectContratoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "",$idPlanoAcaoGrupo, $professor,$idFuncionario ) {
		
		$PlanoAcaoGrupo = new PlanoAcaoGrupo();
		$GrupoClientePj = new GrupoClientePj();
		
		$idGrupo = $PlanoAcaoGrupo->getIdGrupo($idPlanoAcaoGrupo);
		
	//	echo $idFuncionario;
	//	Uteis::pr($_SESSION);
		if ($idFuncionario > 0) {
			$acesso = array(33,  7,  2, 8);
		}
		
		$valorGrupoClientePj = $GrupoClientePj -> selectGrupoClientePj(" WHERE grupo_idGrupo = " . $idGrupo);
		$idClientePj = $valorGrupoClientePj[0]['clientePj_idClientePj'];
		
		$sql2 ="SELECT SQL_CACHE idContrato, contrato, obs, dataCadastro FROM contrato WHERE clientePj_idClientePj =" . $idClientePj; 

		$sql = "SELECT SQL_CACHE idContrato, contrato, obs, dataCadastro, naoMostrar, funcionario_idFuncionario FROM contrato " . $where;
    if($ondeAtualiza === "#div_contrato_clientepj"){
      $pasta ="clientePj";
    }else if($ondeAtualiza === "#div_financeiro"){
      $pasta ="clientePf";
    }else if($ondeAtualiza === "#div_contrato_professor"){
      $pasta ="professor";
    }else if($ondeAtualiza === "#aba_div_outros_grupo"){
      $pasta ="grupo";
    }else if($ondeAtualiza === "#div_lista_contrato2"){
      $pasta ="planoAcao";
    }else{
       $pasta ="funcionario";  
    }
		//echo $sql;
	
		$result = $this -> query($sql);
		
		if (mysqli_num_rows($result) == 0) {
			
		$result = $this -> query($sql2);
				
		}
		

		if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {
				
				if ($pasta == 'funcionario'){
					
					if  (($valor['funcionario_idFuncionario'] == $idFuncionario) || (in_array($idFuncionario, $acesso))) {
						
						$html .= "<tr>
				
				<td onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idContrato'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $valor['obs'] . "</td>
				<td>".Uteis::exibirData($valor['dataCadastro'])."</td>
				
				<td> 
					<a href=\"" . CAMINHO_UP . "arquivo/contrato/" . $pasta . "/" . $valor['contrato'] . "\" target=\"_blank\">
						<center><img src=\"" . CAMINHO_IMG . "contrato.png\" ><center>
					</a>
				</td>";
				
						$html .= "<td onclick=\"deletaRegistro('" . CAMINHO_CAD . "funcionario/include/acao/contrato.php', " . $valor['idContrato'] . ", '" . CAMINHO_CAD . "funcionario/include/resourceHTML/contrato.php?id=$idFuncionario', '$ondeAtualiza')\">
					<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>
				</td>";
				
				
				$html .= "</tr>";

					
					}
					
					
					
				} else {

				$html .= "<tr>
				
				<td onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idContrato'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $valor['obs'] . "</td>
				<td>".Uteis::exibirData($valor['dataCadastro'])."</td>
				
				<td> 
					<a href=\"" . CAMINHO_UP . "arquivo/contrato/" . $pasta . "/" . $valor['contrato'] . "\" target=\"_blank\">
						<center><img src=\"" . CAMINHO_IMG . "contrato.png\" ><center>
					</a>
				</td>";
			
				if (($ondeAtualiza === "#div_financeiro") && ($professor != 1)){
				
				$html .= "<td>  <button class=\"button blue\" onclick=\"abrirNivelPagina(this, '".CAMINHO_CAD."clientePf/include/form/disparoEmail.php?idContrato=".$valor['idContrato']."', '$caminhoAtualizar', '$ondeAtualiza');\">Enviar Email</button></td>";
				  
				$html .= "<td>".Uteis::exibirStatus($valor['naoMostrar'])."</td>";	
					
				}
						
				if ($professor != 1) {
				
				$html .= "<td onclick=\"deletaRegistro('" . CAMINHO_CAD . "contrato/include/acao/contrato.php', " . $valor['idContrato'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">
					<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>
				</td>";
				}	
				
				$html .= "</tr>";

				}
			} 
		}

		return $html;
	}

}
?>