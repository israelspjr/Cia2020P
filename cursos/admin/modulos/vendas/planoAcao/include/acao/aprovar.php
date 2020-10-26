<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
			
$PlanoAcao = new PlanoAcao();
$OpcaoDia = new OpcaoDia();
$IntegrantePlanoAcao = new IntegrantePlanoAcao();	
$SubvencaoCursoPlanoAcao = new SubvencaoCursoPlanoAcao();
$SubvencaoMaterialPlanoAcao = new SubvencaoMaterialPlanoAcao();			
$ValorSimuladoPlanoAcao = new ValorSimuladoPlanoAcao();		
$OpcaoDiaPlanoAcao = new OpcaoDiaPlanoAcao();	
$ClientePf = new ClientePf();
$arrayRetorno = array();

$idPlanoAcao = $_REQUEST['idPlanoAcao'];
$idStatus = $_REQUEST['idStatus'];

$PlanoAcao->setIdPlanoAcao($idPlanoAcao);

if($idStatus==3){
		
	$PlanoAcao->updateFieldPlanoAcao("statusAprovacao_idStatusAprovacao", $idStatus);
	
	$arrayRetorno['fecharNivel'] = true;
	$arrayRetorno['mensagem'] = "Plano de ação reprovado com sucesso.";
	
}elseif($idStatus==2){

	//VALIDAÇÃO DE DADOS OBRIGATÓRIOS PARA O PA			
	
	//INTEGRANTE PA	
	$where = " WHERE planoAcao_idPlanoAcao = ".$idPlanoAcao;
	$temIntegrantePlanoAcao = $IntegrantePlanoAcao->selectIntegrantePlanoAcao($where);
	
	if( $temIntegrantePlanoAcao ){
		
		//SUBVENCAO CURSO			
		for($row=0; $row < count($temIntegrantePlanoAcao,0); $row++){
			if($temIntegrantePlanoAcao[$row]['clientePf_idClientePf']){
                $ClientePf->setIdClientePf($temIntegrantePlanoAcao[$row]['clientePf_idClientePf']);
                $ClientePf->updateFieldClientepf("tipoCliente_idTipoCliente", 3);
            }
			$idIntegrantePlanoAcao = $temIntegrantePlanoAcao[$row]['idIntegrantePlanoAcao'];
						
			$where = " WHERE integrantePlanoAcao_idIntegrantePlanoAcao = ".$idIntegrantePlanoAcao;
			$temSubvencaoCursoPlanoAcao = $SubvencaoCursoPlanoAcao->selectSubvencaoCursoPlanoAcao($where);
			
			if( $temSubvencaoCursoPlanoAcao ){
	
				//SUBVENCAO MATERIAL				
				$where = " WHERE integrantePlanoAcao_idIntegrantePlanoAcao = ".$idIntegrantePlanoAcao;
				$temSubvencaoMaterialPlanoAcao = $SubvencaoMaterialPlanoAcao->selectSubvencaoMaterialPlanoAcao($where);
				
				if( !$temSubvencaoMaterialPlanoAcao ) $arrayRetorno['mensagem'] = "Favor definir subvenção de material para todos integrantes.";		

			}else{				
				$arrayRetorno['mensagem'] = "Favor definir subvenção de curso para todos integrantes.";			
			}	
		}
	}else{			
		$arrayRetorno['mensagem'] = "Favor inserir integrantes no plano de ação.";			
	}
		
	//VERIFICA VALORES SIMULADOS
	$where = " WHERE planoAcao_idPlanoAcao = ".$idPlanoAcao;
	$temValorSimuladoPlanoAcao = $ValorSimuladoPlanoAcao->selectValorSimuladoPlanoAcao($where);
	
	if( $temValorSimuladoPlanoAcao ){		
		
		for($row=0; $row < count($temValorSimuladoPlanoAcao); $row++){	
		
			$idValorSimuladoPlanoAcao = $temValorSimuladoPlanoAcao[$row]['idValorSimuladoPlanoAcao'];
			$tipo = $temValorSimuladoPlanoAcao[$row]['tipo'];
			$freq = $temValorSimuladoPlanoAcao[$row]['frequenciaSemanalAula'];	
			$horasTotais = $temValorSimuladoPlanoAcao[$row]['horasPorAula'];
			if($temValorSimuladoPlanoAcao[$row]['horaNaoGeraFf']) $horasTotais -= $temValorSimuladoPlanoAcao[$row]['horaNaoGeraFf'];	
			
			//VERIFICA SIMULAÇÃO DE DIAS E HORARIOS								
			$where = " WHERE valorSimuladoPlanoAcao_idValorSimuladoPlanoAcao = ".$idValorSimuladoPlanoAcao;
			$temOpcaoDia = $OpcaoDia->selectOpcaoDia($where);	
			
			if( $temOpcaoDia ){	
													
				$where = " WHERE escolhido = 1 AND valorSimuladoPlanoAcao_idValorSimuladoPlanoAcao = ".$idValorSimuladoPlanoAcao;
				$temOpcaoDia = $OpcaoDia->selectOpcaoDia($where);				
				
				if( !$temOpcaoDia ){	
					//echo $where;exit;		
					$arrayRetorno['mensagem'] = "Favor escolher uma opção de dias e horários para cada valor simulado.";			
				}else{					
					//VERIFICA AS OPÇOES DE DIAS
					$valorOpcaoDiaPlanoAcao = $OpcaoDiaPlanoAcao->selectOpcaoDiaPlanoAcao(" WHERE opcaoDia_idOpcao = ".$temOpcaoDia[0]['idOpcao']);
					
					if($tipo == "R"){			
						if(count($valorOpcaoDiaPlanoAcao) != $freq) $arrayRetorno['mensagem'] = "Existem opçoes de frequência que nao batem com o total de dias simulados.";			
					}elseif($tipo == "T" || $tipo == "E"){
						$totalVal = 0;
						foreach($valorOpcaoDiaPlanoAcao as $val) $totalVal += ($val['horaFim'] - $val['horaInicio']);
						if($totalVal > $horasTotais)  $arrayRetorno['mensagem'] = "Existem mais horas simuladas (".Uteis::exibirHoras($totalVal).") do que a carga horaria do programa (".Uteis::exibirHoras($horasTotais).").";			
					}
				}
					
			}else{
				$arrayRetorno['mensagem'] = "Favor simular dias e horários para os valores inseridos.";				
			}
		}
	}else{		
		$arrayRetorno['mensagem'] = "Favor inserir um valor simulado.";		
	}

	//REGRAS
	$PlanoAcaoRegras = new PlanoAcaoRegras();
	
	$where = " WHERE planoAcao_idPlanoAcao = ".$idPlanoAcao;
	$temPlanoAcaoRegras = $PlanoAcaoRegras->selectPlanoAcaoRegras($where);
	
	if( !$temPlanoAcaoRegras ){		
		$arrayRetorno['mensagem'] = "Favor definir regras do plano de ação.";		
	}
		
	if( $arrayRetorno['mensagem']==""){    
        
		$PlanoAcao->updateFieldPlanoAcao("statusAprovacao_idStatusAprovacao", $idStatus);	
		$PlanoAcao->updateFieldPlanoAcao("dataAprovacao", date('Y-m-d H:i:s') );	
		
		$arrayRetorno['mensagem'] = "Plano de ação aprovado com sucesso! <br /><small> A partir de agora o plano de ação aparecerá na tela de batismo de grupos.</small>";
		
		
		
		$arrayRetorno['fecharNivel'] = true;	
		
	}
	
}

echo json_encode($arrayRetorno);

?>