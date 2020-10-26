<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");


	
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/ValorSimuladoPlanoAcao.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/NaoFazAulaNestaSemanaPlanoAcao.class.php");

$arrayRetorno = array();
$idValorSimuladoPlanoAcao = $_REQUEST['id'];

$ValorSimuladoPlanoAcao = new ValorSimuladoPlanoAcao();	
$NaoFazAulaNestaSemanaPlanoAcao = new NaoFazAulaNestaSemanaPlanoAcao();
	
$ValorSimuladoPlanoAcao->setIdValorSimuladoPlanoAcao($idValorSimuladoPlanoAcao);

if($_POST['acao'] == 'deletar'){
	
	$ValorSimuladoPlanoAcao->deleteValorSimuladoPlanoAcao();
	$arrayRetorno['mensagem'] = MSG_CADDEL;
	
}else{	

	$ValorSimuladoPlanoAcao->setPlanoAcaoIdPlanoAcao($_POST['planoAcaoIdPlanoAcao']);
	$ValorSimuladoPlanoAcao->setTipo($_POST['tipo']);	
		
	$ValorSimuladoPlanoAcao->setValorHora($_POST['valor']);
	
	if($_POST['tipo']=='R' || $_POST['tipo']=='T'){
		if( ($_POST['valorDescontoHora']=='' && $_POST['validadeDesconto']!='') || ($_POST['valorDescontoHora']!='' && $_POST['validadeDesconto']=='') ){
			$arrayRetorno['mensagem'] = "Preencha desconto junto com validade.";
			echo json_encode($arrayRetorno);exit;
		}
		$ValorSimuladoPlanoAcao->setValorDescontoHora($_POST['valorDescontoHora']);
		$ValorSimuladoPlanoAcao->setValidadeDesconto(  Uteis::gravarData($_POST['validadeDesconto']) );	
	}
	
	$ValorSimuladoPlanoAcao->setHorasPorAula( Uteis::gravarHoras($_POST['horas']) );
	
	if($_POST['tipo']=='R'){
		$ValorSimuladoPlanoAcao->setFrequenciaSemanalAula($_POST['frequenciaSemanalAula']);		
		$ValorSimuladoPlanoAcao->setCargaHorariaFixaMensal( Uteis::gravarHoras($_POST['horasFixa']) );
	}
	
	if($_POST['tipo']=='E'){
		$ValorSimuladoPlanoAcao->setHoraNaoGeraFf( Uteis::gravarHoras($_POST['horasNGF']) );		
	}
	
	$ValorSimuladoPlanoAcao->setObs($_POST['obs']);
	$ValorSimuladoPlanoAcao->setModalidadeIdModalidade($_POST['idModalidade']);	
	
	if($idValorSimuladoPlanoAcao != "" && $idValorSimuladoPlanoAcao > 0 ){		
		$ValorSimuladoPlanoAcao->updateValorSimuladoPlanoAcao();	
		$arrayRetorno['mensagem'] = MSG_CADATU;			
	}else{	
		$idValorSimuladoPlanoAcao = $ValorSimuladoPlanoAcao->addValorSimuladoPlanoAcao();		
		$arrayRetorno['mensagem'] = MSG_CADNEW;		
	}			
	
	$NaoFazAulaNestaSemanaPlanoAcao->deleteNaoFazAulaNestaSemanaPlanoAcao(" OR valorSimuladoPlanoAcao_idValorSimuladoPlanoAcao=".$idValorSimuladoPlanoAcao);
	if($_POST['tipo']=='R'){	
		for($s=1; $s < 6; $s++){		
			$field = $_POST["semana_".$s];					
			// INSERE AS OPÇOES MARCADAS		
			if($field==1){
				$NaoFazAulaNestaSemanaPlanoAcao->setValorSimuladoPlanoAcaoIdValorSimuladoPlanoAcao($idValorSimuladoPlanoAcao);
				$NaoFazAulaNestaSemanaPlanoAcao->setSemana($s);						
				$NaoFazAulaNestaSemanaPlanoAcao->addNaoFazAulaNestaSemanaPlanoAcao();		
			}
		}
	}
	
	$arrayRetorno['atualizarNivelAtual'] = true;
	$arrayRetorno['pagina'] = CAMINHO_VENDAS."planoAcao/include/form/valorSimulado.php?id=".$idValorSimuladoPlanoAcao;
	//$arrayRetorno['fecharNivel'] = true;			
}			

echo json_encode($arrayRetorno);


?>