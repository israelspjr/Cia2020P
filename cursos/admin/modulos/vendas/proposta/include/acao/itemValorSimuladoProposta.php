<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

if($_POST['acao'] == 'atualizaValorPorModalidade'){
	
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Modalidade.class.php");		
	$Modalidade = new Modalidade(); 
	
	$_POST['idModalidade'] = $_POST['idModalidade'] ? $_POST['idModalidade'] : 0;
	
	//CARREGA VALOR HORA INDICADO	
	$sql = "SELECT SQL_CACHE MI.valorHoraPadrao ";
	$sql .= " FROM modalidadeIdioma AS MI ";
	$sql .= " INNER JOIN modalidade AS M ON M.idModalidade = MI.modalidade_idModalidade"; 
	$sql .= " INNER JOIN idioma AS I ON I.idIdioma = MI.idioma_idIdioma"; 
	$sql .= " WHERE MI.modalidade_idModalidade = ".$_POST['idModalidade']." AND MI.idioma_idIdioma = ".$_POST['idIdioma']; 	
	$valor = Uteis::executarQuery($sql);

	$arrayRetorno['campoAtualizar'][] = $_POST['campoAtualizar'];
	$arrayRetorno['valor'][] = Uteis::formatarMoeda($valor[0]['valorHoraPadrao']);
	
}else{

	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/ItemValorSimuladoProposta.class.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/NaoFazAulaNestaSemanaProposta.class.php");
		
	$arrayRetorno = array();
	$idItemValorSimuladoProposta = $_REQUEST['id'];
	
	$ItemValorSimuladoProposta = new ItemValorSimuladoProposta();		
	$NaoFazAulaNestaSemanaProposta = new NaoFazAulaNestaSemanaProposta();
	
	$ItemValorSimuladoProposta->setIdItemValorSimuladoProposta($idItemValorSimuladoProposta);
	
	if($_POST['acao'] == 'deletar'){
		
		$ItemValorSimuladoProposta->deleteItemValorSimuladoProposta();
		$arrayRetorno['mensagem'] = MSG_CADDEL;
		
	}else{	
			
		$ItemValorSimuladoProposta->setValorSimuladoPropostaIdValorSimuladoProposta($_POST['valorSimuladoPropostaIdValorSimuladoProposta']);
		$ItemValorSimuladoProposta->setTipo($_POST['tipo']);	
		$ItemValorSimuladoProposta->setModalidadeIdModalidade($_POST['idModalidade']);		
		$ItemValorSimuladoProposta->setValor($_POST['valor']);
				
		$ItemValorSimuladoProposta->setHorasPorAula( Uteis::gravarHoras($_POST['horas']) );
		
		if($_POST['tipo']=='R' || $_POST['tipo']=='T'){
			if( ($_POST['valorDescontoHora']=='' && $_POST['validadeDesconto']!='') || ($_POST['valorDescontoHora']!='' && $_POST['validadeDesconto']=='') ){
				$arrayRetorno['mensagem'] = "Preencha desconto junto com validade.";
				echo json_encode($arrayRetorno);						
				exit;
			}
			$ItemValorSimuladoProposta->setValorDescontoHora($_POST['valorDescontoHora']);
			$ItemValorSimuladoProposta->setValidadeDesconto(  Uteis::gravarData($_POST['validadeDesconto']) );	
		}
		
		if($_POST['tipo']=='R'){
			$ItemValorSimuladoProposta->setFrequenciaSemanalAula($_POST['frequenciaSemanalAula']);			
			$ItemValorSimuladoProposta->setCargaHorariaFixaMensal( Uteis::gravarHoras($_POST['horasFixa']) );
		}
		
		if($_POST['tipo']=='E'){
			$ItemValorSimuladoProposta->setHoraNaoGeraFf( Uteis::gravarHoras($_POST['horasNGF']) );		
		}
		
		$ItemValorSimuladoProposta->setObs($_POST['obs']);
			
		if($idItemValorSimuladoProposta != "" && $idItemValorSimuladoProposta > 0 ){
			
			$ItemValorSimuladoProposta->updateItemValorSimuladoProposta();				
			$arrayRetorno['mensagem'] = MSG_CADATU;			
			
		}else{	
		
			$idItemValorSimuladoProposta = $ItemValorSimuladoProposta->addItemValorSimuladoProposta();		
			$arrayRetorno['mensagem'] = MSG_CADNEW;		
		}
		
		$NaoFazAulaNestaSemanaProposta->deleteNaoFazAulaNestaSemanaProposta(" OR itemValorSimuladoProposta_idItemValorSimuladoProposta=".$idItemValorSimuladoProposta);
			
		if($_POST['tipo']=='R'){
			for($s=1; $s < 5; $s++){		
				$field = $_POST["semana_".$s];					
				// INSERE AS OPÇOES MARCADAS		
				if($field==1){
					$NaoFazAulaNestaSemanaProposta->setItemValorSimuladoPropostaIdItemValorSimuladoProposta($idItemValorSimuladoProposta);
					$NaoFazAulaNestaSemanaProposta->setSemana($s);						
					$NaoFazAulaNestaSemanaProposta->addNaoFazAulaNestaSemanaProposta();		
				}
			}
		}
		
		//$arrayRetorno['fecharNivel'] = true;			
		$arrayRetorno['atualizarNivelAtual'] = true;		
		$arrayRetorno['pagina'] = CAMINHO_VENDAS."proposta/include/form/itemValorSimuladoProposta_abas.php?id=".$idItemValorSimuladoProposta."&idValorSimuladoProposta=".$_POST['valorSimuladoPropostaIdValorSimuladoProposta'];
	
	}			
	
}

echo json_encode($arrayRetorno);
?>