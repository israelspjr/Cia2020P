<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$PlanoAcaoGrupo = new PlanoAcaoGrupo();

$arrayRetorno = array();

$idPlanoAcaoGrupo = $_REQUEST['idPlanoAcaoGrupo'];

//$IdNivelEstudo = $_REQUEST['IdNivelEstudo'];
//$idGrupo = $PlanoAcaoGrupo->getIdGrupo($idPlanoAcaoGrupo);	
//$rs = $PlanoAcaoGrupo->selectPlanoAcaoGrupo(" WHERE grupo_idGrupo = $idGrupo AND nivelEstudo_IdNivelEstudo = $IdNivelEstudo");

$arrayRetorno['atualizarNivelAtual'] = true;
if( isset($_REQUEST['mudarAba']) ){
	$arrayRetorno['depoisDeCarregar'] = json_encode(array("mudarAba" => "#".$_REQUEST['mudarAba'], "mensagem" => "Nivel carregado com sucesso."));
}
	
//$arrayRetorno['pagina'] = CAMINHO_REL."grupo/cadastro.php?id=".$rs[0]['idPlanoAcaoGrupo'];
$arrayRetorno['pagina'] = CAMINHO_REL."grupo/cadastro.php?id=".$idPlanoAcaoGrupo;


echo json_encode($arrayRetorno);
?>