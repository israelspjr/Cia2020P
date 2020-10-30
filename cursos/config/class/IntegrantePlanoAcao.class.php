<?php
class IntegrantePlanoAcao extends Database {

	// class attributes
	var $idIntegrantePlanoAcao;
	var $planoAcaoIdPlanoAcao;
	var $nivelIdNivel;
	var $clientePfIdClientePf;
	var $statusAprovacaoIdStatusAprovacao;
	var $obsDiagnosticoNivel;
	var $linkVisualizacao;
	var $aprovacaoAluno;
	var $statusAprovacao;
	var $professorIdProfessor;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idIntegrantePlanoAcao = "NULL";
		$this -> planoAcaoIdPlanoAcao = "NULL";
		$this -> nivelIdNivel = "NULL";
		$this -> clientePfIdClientePf = "NULL";
		$this -> statusAprovacaoIdStatusAprovacao = "NULL";
		$this -> obsDiagnosticoNivel = "NULL";
		$this -> linkVisualizacao = "NULL";
		$this -> aprovacaoAluno = "NULL";
		$this -> statusAprovacao = "0";
		$this -> professorIdProfessor = "0";	
	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdIntegrantePlanoAcao($value) {
		$this -> idIntegrantePlanoAcao = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPlanoAcaoIdPlanoAcao($value) {
		$this -> planoAcaoIdPlanoAcao = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setNivelIdNivel($value) {
		$this -> nivelIdNivel = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setClientePfIdClientePf($value) {
		$this -> clientePfIdClientePf = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setStatusAprovacaoIdStatusAprovacao($value) {
		$this -> statusAprovacaoIdStatusAprovacao = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setObsDiagnosticoNivel($value) {
		$this -> obsDiagnosticoNivel = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setLinkVisualizacao() {

		$link = "p=" . Uteis::base64_url_encode($this -> planoAcaoIdPlanoAcao) . "&b=" . Uteis::base64_url_encode($this -> idIntegrantePlanoAcao) . "&d=" . md5(date('YmdHis'));
		$this -> linkVisualizacao = $this -> gravarBD($link);

	}
	
	function setAprovacaoAluno($value) {
		$this -> aprovacaoAluno = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setStatusAprovacao($value) {
		$this -> statusAprovacao = ($value) ? $this -> gravarBD($value) : "0";
	}
	
	function setProfessorIdProfessor($value) {
		$this -> professorIdProfessor = ($value) ? $this -> gravarBD($value) : "0";
	}


	/**
	 * addIntegrantePlanoAcao() Function
	 */
	function addIntegrantePlanoAcao() {

		$sql = "INSERT INTO integrantePlanoAcao (planoAcao_idPlanoAcao, Nivel_IdNivel, clientePf_idClientePf, statusAprovacao_idStatusAprovacao, obsDiagnosticoNivel, linkVisualizacao, aprovacaoAluno, statusAprovacao, professor_idProfessor) VALUES ($this->planoAcaoIdPlanoAcao, $this->nivelIdNivel, $this->clientePfIdClientePf, $this->statusAprovacaoIdStatusAprovacao, $this->obsDiagnosticoNivel, $this->linkVisualizacao, $this->aprovacaoAluno, $this->statusAprovacao, $this->professorIdProfessor)";
	//	echo $sql;
		//exit;
		$result = $this -> query($sql, true);

		return mysqli_insert_id($this -> connect);
	}

	/**
	 * deleteIntegrantePlanoAcao() Function
	 */
	function deleteIntegrantePlanoAcao() {

		$where = " OR integrantePlanoAcao_idIntegrantePlanoAcao = $this->idIntegrantePlanoAcao ";

		$SubvencaoCursoPlanoAcao = new SubvencaoCursoPlanoAcao();
		$SubvencaoCursoPlanoAcao -> deleteSubvencaoCursoPlanoAcao($where);

		$SubvencaoMaterialPlanoAcao = new SubvencaoMaterialPlanoAcao();
		$SubvencaoMaterialPlanoAcao -> deleteSubvencaoMaterialPlanoAcao($where);

		$VpgPlanoAcao = new VpgPlanoAcao();
		$VpgPlanoAcao -> deleteVpgPlanoAcao($where);

		$QualidadeComunicacaoPlanoAcao = new QualidadeComunicacaoPlanoAcao();
		$QualidadeComunicacaoPlanoAcao -> deleteQualidadeComunicacaoPlanoAcao("  OR integrantesPlanoAcao_idIntegrantesPlanoAcao = $this->idIntegrantePlanoAcao ");

		$sql = "DELETE FROM integrantePlanoAcao WHERE idIntegrantePlanoAcao = $this->idIntegrantePlanoAcao";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldIntegrantePlanoAcao() Function
	 */
	function updateFieldIntegrantePlanoAcao($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE integrantePlanoAcao SET " . $field . " = " . $value . " WHERE idIntegrantePlanoAcao = $this->idIntegrantePlanoAcao";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateIntegrantePlanoAcao() Function
	 */
	function updateIntegrantePlanoAcao() {
		//, linkVisualizacao = $this->linkVisualizacao
		$sql = "UPDATE integrantePlanoAcao SET planoAcao_idPlanoAcao = $this->planoAcaoIdPlanoAcao, Nivel_IdNivel = $this->nivelIdNivel, clientePf_idClientePf = $this->clientePfIdClientePf, statusAprovacao_idStatusAprovacao = $this->statusAprovacaoIdStatusAprovacao, obsDiagnosticoNivel = $this->obsDiagnosticoNivel, aprovacaoAluno = $this->aprovacaoAluno, statusAprovacao = $this->statusAprovacao, professor_idProfessor = $this->professorIdProfessor WHERE idIntegrantePlanoAcao = $this->idIntegrantePlanoAcao";
//		echo $sql;
		$result = $this -> query($sql, true);
	}

	/**
	 * selectIntegrantePlanoAcao() Function
	 */
	function selectIntegrantePlanoAcao($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idIntegrantePlanoAcao, planoAcao_idPlanoAcao, Nivel_IdNivel, clientePf_idClientePf, statusAprovacao_idStatusAprovacao, obsDiagnosticoNivel, linkVisualizacao, aprovacaoAluno, statusAprovacao, professor_idProfessor FROM integrantePlanoAcao " . $where;
		return $this -> executeQuery($sql);
	}

	function selectIntegrantePlanoAcaoTr($where = "",$apenasVer) {
		
		$Professor = new Professor();

		$sql = "SELECT SQL_CACHE idIntegrantePlanoAcao, PF.nome, planoAcao_idPlanoAcao, PF.idClientePf, IP.professor_idProfessor FROM integrantePlanoAcao AS IP ";
		$sql .= " LEFT JOIN clientePf AS PF ON PF.idClientePf = IP.clientePf_idClientePf " . $where;
		
//		echo $sql;
		//exit;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {
			  
			//  if ($apenasVer != 1) {			
			  if ($valor['idClientePf'] > 0 ) {
				      
			  $img = "<img src=\"" . CAMINHO_IMG . "cad.png\" title=\"IR PARA O CADASTRO\" onclick=\"abrirNivelPagina(this, '" . CAMINHO_CAD . "clientePf/cadastro.php?id=" . $valor['idClientePf'] . "', '" . CAMINHO_VENDAS . "planoAcao/include/resourceHTML/integrantePlanoAcao.php?id=" . $valor['planoAcao_idPlanoAcao'] . "', '#div_lista_integrantePlanoAcao')\" >";
			  $nome = $valor['nome'];
			  }
				  
			 if ($valor['professor_idProfessor'] > 0) {
					$img = "<img src=\"" . CAMINHO_IMG . "cad.png\" title=\"IR PARA O CADASTRO\" onclick=\"abrirNivelPagina(this, '" . CAMINHO_CAD . "professor/contratado/cadastro.php?idProfessor=".$valor['idIntegranteGrupo']."&id=" . $valor['professor_idProfessor'] . "', '$caminhoAtualizar', '#div_integranteGrupo')\" >";
					$nome = $Professor->getNome($valor['professor_idProfessor']);
				} 

			//  }
			 
       	$html .= "<tr >
				
				<td>".$img."</td>
				<td onclick=\"abrirNivelPagina(this, '" . CAMINHO_VENDAS . "planoAcao/include/form/integrante.php?id=" . $valor['idIntegrantePlanoAcao'] . "', '" . CAMINHO_VENDAS . "planoAcao/include/resourceHTML/integrantePlanoAcao.php?id=" . $valor['planoAcao_idPlanoAcao'] . "', '#div_lista_integrantePlanoAcao')\" >". $nome. "</td>";
				
				if ($apenasVer != 1) {
					
		$html .= "<td onclick=\"deletaRegistro('" . CAMINHO_VENDAS . "planoAcao/include/acao/integrantePlanoAcao.php', " . $valor['idIntegrantePlanoAcao'] . ", '" . CAMINHO_VENDAS . "planoAcao/include/resourceHTML/integrantePlanoAcao.php?id=" . $valor['planoAcao_idPlanoAcao'] . "', '#div_lista_integrantePlanoAcao')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				} else {
		$html .= "<td> </td>";
				}
				
		$html .= "</tr>";

			}
		}
		return $html;
	}

	function nomeIntegrantePlanoAcao() {
		$ClientePf = new ClientePf();
		$valorClientepf = $ClientePf -> selectClientepf(" WHERE idClientepf = " . $this -> clientePfIdClientePf);

		return $valorClientepf[0]['nome'];
	}

}
?>