<?php
class DisparoEmail extends Database {
	
	// class attributes
	var $idDisparoEmail;
	var $propostaIdProposta;
	var $planoAcaoIdPlanoAcao;
	var $integranteGrupoIdIntegranteGrupo;
	var $integranteGrupoIdIntegranteGrupoPsa;
	var $acompanhamentoCursoIdAcompanhamentoCurso;
	var $planoAcaoGrupoIdPlanoAcaoGrupo;
	var $certificadoCursoIntegranteGrupoId;
	var $funcionario_idFuncionario;
    var $clientePJ_idClientePj;
	var $destino;
	var $copia;
	var $copiaOculta;
	var $assunto;
	var $conteudoEmail;
	var $anexo;
	var $campanhaEmailIdCampanhaEmail;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idDisparoEmail = "NULL";
		$this -> propostaIdProposta = "NULL";
		$this -> planoAcaoIdPlanoAcao = "NULL";
		$this -> integranteGrupoIdIntegranteGrupo = "NULL";
		$this -> integranteGrupoIdIntegranteGrupoPsa = "NULL";
		$this -> acompanhamentoCursoIdAcompanhamentoCurso = "NULL";
		$this -> planoAcaoGrupoIdPlanoAcaoGrupo = "NULL";
		$this -> certificadoCursoIntegranteGrupoId = "NULL";		
		$this -> funcionario_idFuncionario = $_SESSION['idFuncionario_SS'];
        $this -> clientePJ_idClientePj = "NULL";
		$this -> destino = "NULL";
		$this -> copia = "NULL";
		$this -> copiaOculta = "NULL";
		$this -> assunto = "NULL";
		$this -> conteudoEmail = "NULL";
		$this -> anexo = "NULL";
		$this -> campanhaEmailIdCampanhaEmail = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdDisparoEmail($value) {
		$this -> idDisparoEmail = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPropostaIdProposta($value) {
		$this -> propostaIdProposta = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPlanoAcaoIdPlanoAcao($value) {
		$this -> planoAcaoIdPlanoAcao = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setIntegranteGrupoIdIntegranteGrupo($value) {
		$this -> integranteGrupoIdIntegranteGrupo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setIntegranteGrupoIdIntegranteGrupoPsa($value) {
		$this -> integranteGrupoIdIntegranteGrupoPsa = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setAcompanhamentoCursoIdAcompanhamentoCurso($value) {
		$this -> acompanhamentoCursoIdAcompanhamentoCurso = ($value) ? $this -> gravarBD($value) : "NULL";
	}
    
    function setClientePJ_idClientePj($value){
        $this -> clientePJ_idClientePj = ($value) ? $this -> gravarBD($value) : "NULL";
    }

	function setPlanoAcaoGrupoIdPlanoAcaoGrupo($value) {
		$this -> planoAcaoGrupoIdPlanoAcaoGrupo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setCertificadoCursoIntegranteGrupoId($value) {
		$this -> certificadoCursoIntegranteGrupoId = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDestino($value) {
		$this -> destino = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setCopia($value) {
		$this -> copia = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setCopiaOculta($value) {
		$this -> copiaOculta = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setAssunto($value) {
		$this -> assunto = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setConteudoEmail($value) {
		$this -> conteudoEmail = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setAnexo($value) {
		$this -> anexo = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setCampanhaEmailIdCampanhaEmail($value) {
		$this -> campanhaEmailIdCampanhaEmail = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function addDisparoEmail() {
		$sql = "INSERT INTO disparoEmail (proposta_idProposta, planoAcao_idPlanoAcao, integranteGrupo_idIntegranteGrupo, integranteGrupo_idIntegranteGrupoPsa, acompanhamentoCurso_idAcompanhamentoCurso, 
		planoAcaoGrupo_idPlanoAcaoGrupo, certificadoCurso_IntegranteGrupo_id, funcionario_idFuncionario, clientePJ_idClientePj, destino, copia, copiaOculta, assunto, conteudoEmail, anexo, campanhaEmail_idCampanhaEmail) 
		VALUES ($this->propostaIdProposta, $this->planoAcaoIdPlanoAcao, $this->integranteGrupoIdIntegranteGrupo, $this->integranteGrupoIdIntegranteGrupoPsa, $this->acompanhamentoCursoIdAcompanhamentoCurso, 
		$this->planoAcaoGrupoIdPlanoAcaoGrupo, $this->certificadoCursoIntegranteGrupoId, $this->funcionario_idFuncionario, $this->clientePJ_idClientePj, $this->destino, $this->copia, $this->copiaOculta, $this->assunto, $this->conteudoEmail, 
		$this->anexo, $this->campanhaEmailIdCampanhaEmail)";
//		echo $sql;
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	function deleteDisparoEmail() {
		$sql = "DELETE FROM disparoEmail WHERE idDisparoEmail = $this->idDisparoEmail";
		$result = $this -> query($sql, true);
	}

	function updateFieldDisparoEmail($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE disparoEmail SET " . $field . " = " . $value . " WHERE idDisparoEmail = $this->idDisparoEmail";
		$result = $this -> query($sql, true);
	}

	function updateDisparoEmail() {
		$sql = "UPDATE disparoEmail SET proposta_idProposta = $this->propostaIdProposta, planoAcao_idPlanoAcao = $this->planoAcaoIdPlanoAcao, integranteGrupo_idIntegranteGrupo = $this->integranteGrupoIdIntegranteGrupo, 
		integranteGrupo_idIntegranteGrupoPsa = $this->integranteGrupoIdIntegranteGrupoPsa, acompanhamentoCurso_idAcompanhamentoCurso = $this->acompanhamentoCursoIdAcompanhamentoCurso, 
		planoAcaoGrupo_idPlanoAcaoGrupo = $this->planoAcaoGrupoIdPlanoAcaoGrupo, certificadoCurso_IntegranteGrupo_id = $this->certificadoCursoIntegranteGrupoId, funcionario_idFuncionario = $this->funcionario_idFuncionario, clientePJ_idClientePj = this->clientePJ_idClientePj, destino = $this->destino, copia = $this->copia, copiaOculta = $this->copiaOculta, assunto = $this->assunto, conteudoEmail = $this->conteudoEmail, anexo = $this->anexo, campanhaEmail_idCampanhaEmail = $this->campnhaEmailIdCampanhaEmail 
		WHERE idDisparoEmail = $this->idDisparoEmail";
		$result = $this -> query($sql, true);
	}
	
	function selectDisparoEmail($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idDisparoEmail, proposta_idProposta, planoAcao_idPlanoAcao, integranteGrupo_idIntegranteGrupo, integranteGrupo_idIntegranteGrupoPsa, acompanhamentoCurso_idAcompanhamentoCurso, 
		planoAcaoGrupo_idPlanoAcaoGrupo, certificadoCurso_IntegranteGrupo_id, dataDisparo, funcionario_idFuncionario, clientePJ_idClientePj, destino, copia, copiaOculta, assunto, conteudoEmail, anexo, campanhaEmail_idCampanhaEmail FROM disparoEmail " . $where;
		return $this -> executeQuery($sql);
	}

	function selectDisparoEmailTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "") {

		$sql = " SELECT idDisparoEmail, dataDisparo, funcionario_idFuncionario, destino, assunto FROM disparoEmail " . $where;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {

				$idDisparoEmail = $valor['idDisparoEmail'];

				$html .= "<tr onclick=\"abrirNivelPagina(this, '" . CAMINHO_MODULO . "disparoEmail/form.php?id=$idDisparoEmail', '$caminhoAtualizar', '$ondeAtualiza')\" >
				
				<td >" . strtotime($valor['dataDisparo']) . "</td>
								
				<td  >" . Uteis::exibirDataHora($valor['dataDisparo']) . "</td>								
				
				<td>" . $valor['destino'] . "</td>
				
				<td>" . $valor['assunto'] . "</td>
				
				</tr>";
			}
		}
		return $html;
	}

	function formEmail($id) {

		$Funcionario = new Funcionario();
		
		    $rs = $this -> selectDisparoEmail(" WHERE idDisparoEmail = $id");
			$dataDisparo = $rs[0]['dataDisparo'];
			$funcionario_idFuncionario = $rs[0]['funcionario_idFuncionario'];
			$destino = $rs[0]['destino'];
			$copia = $rs[0]['copia'];
			$copiaOculta = $rs[0]['copiaOculta'];
			$assunto = $rs[0]['assunto'];
			$conteudoEmail = $rs[0]['conteudoEmail'];
			$anexo = $rs[0]['anexo'];

		$html = "
		
		<p><strong>Disparado em:</strong> " . Uteis::exibirDataHora($dataDisparo) . "</p>		
		
		<p><strong>Remetente:</strong> " . $Funcionario->getNome($funcionario_idFuncionario) . "</p>		
		
		<p><strong>Enviado para:</strong> " . $destino . "</p>" . ($copia ? "<p><strong>Cópia para:</strong> " . $copia . "</p>" : "") 
		. ($copiaOculta ? "<p><strong>Cópia oculta para:</strong> " . $copiaOculta . "</p>" : "") . "
		
		<p><strong>Assunto:</strong> " . $assunto . "</p>" . ($anexo ? ".<p><strong>Anexo:</strong> " . $anexo . "</p>" : "") . "
		
		<p><strong>E-mail:</strong></p>
		
		<p>		
			<textarea name=\"email_log_base\" id=\"email_log_base\" >" . $conteudoEmail . "</textarea>
			<textarea name=\"email_log\" id=\"email_log\" ></textarea>
		</p>	
			
		<script>viraEditor('email_log');</script> ";

		return $html;
	}

}
?>