<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$DemonstrativoCobranca = new DemonstrativoCobranca();

$arrayRetorno = array();

$idPlanoAcaoGrupo = $_REQUEST['idPlanoAcaoGrupo'];
$mes = $_REQUEST['mes'];
$ano = $_REQUEST['ano'];
$ordem = $_REQUEST['ordem'];
$caminhoAtualizar = CAMINHO_COBRANCA . "demonstrativo/include/resourceHTML/demonstrativoCobranca.php";

if($_REQUEST['acao']=="alterarStatusCobranca"){
	
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/StatusCobranca.class.php");
	$StatusCobranca = new StatusCobranca();
		
	$html = "<form id=\"form_StatusCobranca_$idPlanoAcaoGrupo\" 
	class=\"validate\" method=\"post\" action=\"\" onsubmit=\"return false\" >
		
		<input type=\"hidden\" name=\"idPlanoAcaoGrupo\" value=\"$idPlanoAcaoGrupo\" />
		<input type=\"hidden\" name=\"mes\" value=\"$mes\" />
		<input type=\"hidden\" name=\"ano\" value=\"$ano\" />

		<input type=\"hidden\" name=\"caminhoAtualizar\" value=\"$caminhoAtualizar\" />
					
		<input type=\"hidden\" name=\"acao\" value=\"gravarStatusCobranca\" />".
		$StatusCobranca->selectStatusCobrancaSelect("required", "", " WHERE inativo = 0 ")."<span class=\"placeholder\"></span>
		
		<button class=\"button blue\" onclick=\"postForm('form_StatusCobranca_$idPlanoAcaoGrupo', '".CAMINHO_COBRANCA."demonstrativo/include/acao/statusCobranca.php?tr=1&idPlanoAcaoGrupo=$idPlanoAcaoGrupo&mes=$mes&ano=$ano&ordem=$ordem')\">Gravar</button>
			
	</form>
	<script>ativarForm();</script>";
	
//			<input type=\"hidden\" name=\"ordem\" value=\"$ordem\" />
		
	$arrayRetorno['valor2'][0] = $html;
	$arrayRetorno['elementoAtualizar'][0] = "#StatusCobranca_$idPlanoAcaoGrupo";
	
}elseif($_REQUEST['acao']=="gravarStatusCobranca"){
	
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/PlanoAcaoGrupoStatusCobranca.class.php");
	$PlanoAcaoGrupoStatusCobranca = new PlanoAcaoGrupoStatusCobranca();
	
	$rs = $PlanoAcaoGrupoStatusCobranca->selectPlanoAcaoGrupoStatusCobranca("WHERE mes = ".$mes." AND ano = ".$ano." AND planoAcaoGrupo_idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo);
	
	$idStatusCobranca = $_REQUEST['idStatusCobranca'];
	
	$PlanoAcaoGrupoStatusCobranca->setStatusCobrancaIdStatusCobranca($idStatusCobranca);
	$PlanoAcaoGrupoStatusCobranca->setPlanoAcaoGrupoIdPlanoAcaoGrupo($idPlanoAcaoGrupo);
	$PlanoAcaoGrupoStatusCobranca->setMes($mes);
	$PlanoAcaoGrupoStatusCobranca->setAno($ano);
	
//	Uteis::pr($rs);
	
	if ($rs) {
		$rs3 = $PlanoAcaoGrupoStatusCobranca->setIdPlanoAcaoGrupoStatusCobranca($rs[0]['idPlanoAcaoGrupoStatusCobranca']);
		$rs2 = $PlanoAcaoGrupoStatusCobranca->updateFieldPlanoAcaoGrupoStatusCobranca("statusCobranca_idStatusCobranca",$idStatusCobranca);
		
	}else {
//		echo "teste2";
			if ($rs[0]['statusCobranca_idStatusCobranca'] != 6) {
				$idPlanoAcaoGrupoStatusCobranca = $PlanoAcaoGrupoStatusCobranca->addPlanoAcaoGrupoStatusCobranca();
			} else {
				echo "teste";
			// se for o 6 deleta o que tiver no historico.
				$rs = $PlanoAcaoGrupoStatusCobranca->selectPlanoAcaoGrupoStatusCobranca("WHERE mes = ".$mes." AND ano = ".$ano." AND planoAcaoGrupo_idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo);
				Uteis::pr($rs);
				if ($rs[0]['idPlanoAcaoGrupoStatusCobranca'] != '') {
					$PlanoAcaoGrupoStatusCobranca->setIdPlanoAcaoGrupoStatusCobranca($rs[0]['idPlanoAcaoGrupoStatusCobranca']);
					$PlanoAcaoGrupoStatusCobranca->deletePlanoAcaoGrupoStatusCobranca();
				
				}
			}
	}
	$arrayRetorno["tabela"] = "#tb_lista_DemonstrativoCobranca";
	$arrayRetorno["ordem"] = $ordem;
	$arrayRetorno["updateTr"] = $DemonstrativoCobranca->selectDemonstrativoCobrancaTr($mes, $ano, $caminhoAtualizar, "tr", " AND PAG.idPlanoAcaoGrupo = $idPlanoAcaoGrupo ", true, $idStatusCobranca);

	$arrayRetorno['mensagem'] = MSG_CADNEW;
		
}elseif($_REQUEST['acao']=="deletar"){
	
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/PlanoAcaoGrupoStatusCobranca.class.php");
	$PlanoAcaoGrupoStatusCobranca = new PlanoAcaoGrupoStatusCobranca();
	
	$idPlanoAcaoGrupoStatusCobranca = $_REQUEST['id'];
	$PlanoAcaoGrupoStatusCobranca->setIdPlanoAcaoGrupoStatusCobranca($idPlanoAcaoGrupoStatusCobranca);
	
	$PlanoAcaoGrupoStatusCobranca->deletePlanoAcaoGrupoStatusCobranca();
		
	$arrayRetorno['mensagem'] = "Desativado com sucesso";

}

echo json_encode($arrayRetorno);