<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/ValorHoraGrupo.class.php");	
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Modalidade.class.php");	


$Modalidade= new Modalidade();
$ValorHoraGrupo = new ValorHoraGrupo();

$idPlanoAcaoGrupo = $_REQUEST['idPlanoAcaoGrupo'];
$arrayRetorno = array();

$ValorHoraGrupo->setValorDescontoHora($_POST['valorDescontoHora']);
$ValorHoraGrupo->setValidadeDesconto($_POST['validadeDesconto']);

if(!($_POST['valorDescontoHora'] != "" && $_POST['validadeDesconto'] == '' )){

$where = " WHERE planoAcaoGrupo_idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo. "  AND (dataFim is null or dataFim = '')  LIMIT 1";
$rsValorHoraGrupo = $ValorHoraGrupo->selectValorHoraGrupo($where);
			
			if($rsValorHoraGrupo[0]['idValorHoraGrupo'] != ""){
				//inserir data fim no anterior
				$ValorHoraGrupo->setIdValorHoraGrupo($rsValorHoraGrupo[0]['idValorHoraGrupo']);
				$ValorHoraGrupo->updateFieldValorHoraGrupo('dataFim', date('Y-m-d'));
			}
			

			//inserir novo
			$ValorHoraGrupo->setPlanoAcaoGrupoIdPlanoAcaoGrupo($idPlanoAcaoGrupo);
			$ValorHoraGrupo->setModalidadeIdModalidade($_POST['idModalidade']);
			$ValorHoraGrupo->setValorHora($_POST['valorHora']);
			$ValorHoraGrupo->setCargaHorariaFixaMensal( Uteis::gravarHoras($_POST['cargaHorariaFixaMensal']));
			$ValorHoraGrupo->setValorDescontoHora($_POST['valorDescontoHora']);
			$ValorHoraGrupo->setValidadeDesconto( Uteis::gravarData($_POST['validadeDesconto']));
			
			if($_POST['previsaoReajuste'] != ""){
				$ValorHoraGrupo->setPrevisaoReajuste(Uteis::gravarData($_POST['previsaoReajuste']));
			}else{
				$ValorHoraGrupo->setPrevisaoReajuste((date('Y')+1)."-".date('m')."-".date('d'));
			}
			
			$ValorHoraGrupo->setDataInicio(date('Y-m-d'));
			
			$ValorHoraGrupo->addValorHoraGrupo();
			
			//mensagem
			$arrayRetorno['mensagem'] = "Atualizado com sucesso.";
}else{
	$arrayRetorno['mensagem'] = "Por favor, digite a validade do desconto!";
}
echo json_encode($arrayRetorno);
?>