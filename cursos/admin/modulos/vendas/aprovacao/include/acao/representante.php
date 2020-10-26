<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Proposta.class.php");


$Proposta = new Proposta();

$idProposta= $_REQUEST['id'];
$idRepresentante = $_REQUEST['idRepresentante'];
          
if($_REQUEST['acao']=="carregaRepresentanteIdioma"){
	
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/RepresentanteIdioma.class.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Idioma.class.php");
	
	$RepresentanteIdioma = new RepresentanteIdioma(); 
	$Idioma = new Idioma(); 
	
	$idRepresentante = $idRepresentante ? $idRepresentante : "0";
	$idiomas = $RepresentanteIdioma->selectRepresentanteIdioma(" WHERE representante_idRepresentante = ".$idRepresentante);
	$idiomas = Uteis::arrayCampoEspecifico($idiomas, 'idioma_idIdioma');
	$idiomas = $idiomas ? implode(",",$idiomas) : "0";
	$idiomas = $Idioma->selectIdioma(" WHERE idIdioma IN(".$idiomas.")");
	$idiomas = Uteis::arrayCampoEspecifico($idiomas, 'idioma');
	$idiomas = implode(", ", $idiomas);
	$idiomas = $idiomas!="" ? $idiomas : "sem idioma vínculado";
	echo "<strong>".$idiomas."</strong>";
	
	?>
	
<?php
}else{
	$Proposta->setIdProposta($idProposta);
	$Proposta->updateFieldProposta('representante_idRepresentante', $idRepresentante);
	
	$arrayRetorno['mensagem'] = "Representante atribuído com sucesso";			
	$arrayRetorno['fecharNivel'] = true;
	
	echo json_encode($arrayRetorno);
}

?>