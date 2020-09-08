<?php require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/padrao.php");

$Configuracoes = new Configuracoes();

$Configuracoes->setIdConfig(1);
	
$arrayRetorno = array();

if($_POST['acao']=="cadastrar"){
	
	$seguranca = $_POST['seguranca'];
	if ($seguranca != '-') {
		if ($seguranca != '') {
			$tipo = $seguranca;		
		}
	}
	
	 $Configuracoes->updateConfigField("nomeEmpresa", $_POST['nomeEmpresa']);
	 $Configuracoes->updateConfigField("logo",$_POST['foto_oculta']);
	 $Configuracoes->updateConfigField("marca",$_POST['marca_oculta']);
     $Configuracoes->updateConfigField("email",$_POST['email']);
	 $Configuracoes->updateConfigField("site",$_POST['site']);
	 $Configuracoes->updateConfigField("rodape",$_POST['rodape_oculta']);
	 $Configuracoes->updateConfigField("cabecalho",$_POST['cabecalho_oculta']);
	 $Configuracoes->updateConfigField("favIcon",$_POST['fav_oculta']);
	 $Configuracoes->updateConfigField("smtp",$_POST['smtp']);
	 $Configuracoes->updateConfigField("seguranca",$tipo);
	 $Configuracoes->updateConfigField("porta",$_POST['portaSmtp']);
	 $Configuracoes->updateConfigField("emailEnvio",$_POST['emailEnvio']);
	 $Configuracoes->updateConfigField("senhaEmail",$_POST['emailSenha']);
	 $Configuracoes->updateConfigField("whatsApp", $_POST['zap']);
	 
	 $arrayRetorno['mensagem'] = "Atualizado com sucesso!";
	

} 




echo json_encode($arrayRetorno);
?>