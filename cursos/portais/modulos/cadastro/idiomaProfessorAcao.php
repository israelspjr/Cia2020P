<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");


if($_REQUEST['acao'] == 'NivelLinguisticoPorIdioma'){
	
	$NivelLinguistico = new NivelLinguistico();
	
	?>
    <p>
    <label>Nivel linguistico:</label>
    <?php 
    $and = " idNivelLinguistico IN ( SELECT nivelLinguistico_idNivelLinguistico FROM nivelLinguisticoIdioma WHERE inativo = 0  AND idioma_idIdioma = ".$_REQUEST['idIdioma'].")" ;	
    echo $NivelLinguistico->selectNivelLinguisticoSelect("required", $_REQUEST['idNivelLinguistico'], $and)?>
    <span class="placeholder">Campo Obrigatório</span></p>


<?php         
}elseif($_REQUEST['acao'] == 'SotaquePorIdioma'){

	$SotaqueIdiomaProfessor = new SotaqueIdiomaProfessor();
	
	?>
    <p>
    <label>Sotaque:</label>
    <?php 
    $and = " idioma_idIdioma = ".$_REQUEST['idIdioma'] ;	
    echo $SotaqueIdiomaProfessor->selectSotaqueIdiomaProfessorSelect("", $_REQUEST['idSotaqueIdiomaProfessor'], $and)?>
    <span class="placeholder">Campo Obrigatório</span></p>

<?php         
}else{

	$arrayRetorno = array();
	$idIdiomaProfessor = $_REQUEST['id'];	
	
	$IdiomaProfessor = new IdiomaProfessor();	
			
	$IdiomaProfessor->setidIdiomaProfessor($idIdiomaProfessor);
	
	if($_POST['acao'] == 'deletar'){
		
		$IdiomaProfessor->updateFieldIdiomaProfessor(" inativo ", "1");
		$arrayRetorno['mensagem'] = "Cadastro arquivado com sucesso.<br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";
		
	}else{	
		
		$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
	
		$IdiomaProfessor->setProfessorIdProfessor($_POST['professor_idProfessor']);
		$IdiomaProfessor->setIdiomaIdIdioma($_POST['idIdioma']);
		$IdiomaProfessor->setNivelLinguisticoIdNivelLinguistico($_POST['idNivelLinguistico']);
		$IdiomaProfessor->setSotaqueIdiomaProfessorIdSotaqueIdiomaProfessor($_POST['idSotaqueIdiomaProfessor']);
		$IdiomaProfessor->setDataContratacao( Uteis::gravarData($_POST['dataContratacao']));
		$IdiomaProfessor->setInativo($inativo);
		$IdiomaProfessor->setObs($_POST['obs']);
		
		
		if($idIdiomaProfessor != "" && $idIdiomaProfessor > 0 ){
			$IdiomaProfessor->updateIdiomaProfessor();
			$arrayRetorno['mensagem'] = MSG_CADATU;			
		}else{
			$idIdiomaProfessor = $IdiomaProfessor->addIdiomaProfessor();											
			$arrayRetorno['mensagem'] = "Cadastro efetuado com sucesso.";
		}
		
		$arrayRetorno['atualizarNivelAtual'] = true;
		$arrayRetorno['pagina'] = "modulos/cadastro/idiomaProfessor.php?id=".$idIdiomaProfessor;
	}
	
	echo json_encode($arrayRetorno);
			
}
?>