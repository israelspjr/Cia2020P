<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/demonstrativo.php");

$IntegrantePlanoAcao = new IntegrantePlanoAcao();
$PlanoAcao = new PlanoAcao();
$Proposta = new Proposta();
$GerenteTem = new GerenteTem();
$Gerente = new Gerente();
$Funcionario = new Funcionario();

		$idPlanoAcao = $_REQUEST['idPlanoAcao'];
   		$idIntegrantePlanoAcao = $_REQUEST['integrante'];
		echo $idIntegrantePlanoAcao;

 $IntegrantePlanoAcao->setIdIntegrantePlanoAcao($idIntegrantePlanoAcao);
 
 $nomeIntegrante = $IntegrantePlanoAcao->nomeIntegrantePlanoAcao();
Uteis::pr($nomeIntegrante); 
 
$valorPlano = $PlanoAcao->selectPlanoAcao(" WHERE idPlanoAcao = ".$idPlanoAcao);
$idProposta = $valorPlano[0]['proposta_idProposta'];
$idClientePj = $Proposta->get_clientePj_idClientePJ($idProposta);
$valorGerente = $GerenteTem->selectGerenteTem(" WHERE clientePj_idClientePj = ".$idClientePj." AND dataExclusao IS NULL");
//Uteis::pr($valorGerente);
$idGerente = $valorGerente[0]['gerente_idGerente'];
$valorGerente = $Gerente->selectGerente(" WHERE idGerente = ".$idGerente);
//Uteis::pr($valorGerente);
$idFuncionario = $valorGerente[0]['funcionario_idFuncionario'];
$email = $Funcionario->getEmail($idFuncionario);	
//echo $email;

		$paraQuem = array("nome" => $email, "email" => $email);
		$assunto = "Aluno aceitou a PA";
		
		Uteis::enviarEmail($assunto, $conteudo_final, $paraQuem, $arquivo, $copia, $bcopia, 1); 


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Plano de Ação</title>

<?php
require_once($_SERVER['DOCUMENT_ROOT'].CAMINHO_CFG."include/css.php");
require_once($_SERVER['DOCUMENT_ROOT'].CAMINHO_CFG."include/js.php");


?>

</head>

<body class="body" > 
    <div id="centro">
		<?php 
		$data = date("Y-m-d");
		
//		$idPlanoAcao = $_REQUEST['idPlanoAcao'];
                
//		$IntegrantePlanoAcao->setIdIntegrantePlanoAcao($idIntegrantePlanoAcao);
	//	$IntegrantePlanoAcao->updateFieldIntegrantePlanoAcao("aprovacaoAluno", $data);
	//	$IntegrantePlanoAcao->updateFieldIntegrantePlanoAcao("statusAprovacao", 1);
		
		echo "<div style=\"text-align:center\">Obrigado pelo aceite, já pode fechar essa janela!</div>";
		?>
    </div>
</body>
</html>



<?php 


?>