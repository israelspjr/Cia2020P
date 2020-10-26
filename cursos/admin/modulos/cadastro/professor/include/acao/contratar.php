<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Professor.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/IdiomaProfessor.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/ProcessoSeletivoProfessor.class.php");

$Professor = new Professor();		
$IdiomaProfessor = new IdiomaProfessor();		
$ProcessoSeletivoProfessor = new ProcessoSeletivoProfessor();		

$arrayRetorno = array();

$idProfessor = $_REQUEST['idProfessor'];	
$check_processoSeletivoProfessor = $_REQUEST['check_processoSeletivoProfessor'];	

if( $check_processoSeletivoProfessor ){
	
	$rsProf = $Professor->selectProfessor(" WHERE idProfessor = ".$idProfessor);
	
	if($rsProf[0]['documentoUnico']!=''){
		
		$Professor->setIdProfessor($idProfessor);
		$Professor->updateFieldProfessor('candidato', 0);
		
		foreach($check_processoSeletivoProfessor as $idProcessoSeletivoProfessor){
			
			$base_campo = "_processoSeletivoProfessor_".$idProcessoSeletivoProfessor;
			
			$idIdioma = $ProcessoSeletivoProfessor->getIdIdioma($idProcessoSeletivoProfessor);
			
			$IdiomaProfessor->setProfessorIdProfessor($idProfessor);
			$IdiomaProfessor->setIdiomaIdIdioma($idIdioma);
			$IdiomaProfessor->setNivelLinguisticoIdNivelLinguistico($_REQUEST['idNivelLinguistico'.$base_campo]);
			$IdiomaProfessor->setDataContratacao(Uteis::gravarData($_REQUEST['dataContratacao'.$base_campo]));
			
			$IdiomaProfessor->addIdiomaProfessor();
		}
		
		$arrayRetorno['mensagem'] = "Professor contratado com sucesso.
		<br /><small>É necessário definir o valor hora de cada idioma</small>";
			
		$arrayRetorno['fecharNivel'] = 2;
			
	}else{		
		$arrayRetorno['mensagem'] = "Preencha o CPF do professor antes de contratá-lo";
	}
		
}else{
	$arrayRetorno['mensagem'] = "Nenhum idioma foi selecionado.";
}

echo json_encode($arrayRetorno);
	
?>
