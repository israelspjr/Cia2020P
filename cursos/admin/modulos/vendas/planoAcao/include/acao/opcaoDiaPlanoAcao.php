<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$OpcaoDia = new OpcaoDia();
$OpcaoDiaPlanoAcao = new OpcaoDiaPlanoAcao();
$idValorSimuladoPlanoAcao = $_POST['idValorSimuladoPlanoAcao'];
$idOpcaoDia = ($_REQUEST['idOpcaoDia']!="")?$_REQUEST['idOpcaoDia']:$_REQUEST['id'];
$tipo = $_REQUEST['tipo'];

$arrayRetorno = array();
$OpcaoDia->setIdOpcao($idOpcaoDia);

if($_POST['acao'] == 'escolherTipoSimulacao'){ 
	
	$tipoSimulacao = $_POST['tipoSimulacao'];
	
	$idPlanoAcao = $_POST['idPlanoAcao'];
	$idValorSimuladoPlanoAcao = $_POST['idValorSimuladoPlanoAcao'];
	$horasPorAula = $_POST['horasPorAula'];
	
	if( $tipoSimulacao==1 ){ ?>

        <form id="form_geraFrequenciaSemanalParaDatas" class="validate" action="" method="post" onsubmit="return false" >
          <strong><p>Frequencia semanal</p></strong>
          <input type="hidden" name="acao" id="acao" value="geraFrequenciaSemanalParaDatas" />
          <input type="hidden" name="idPlanoAcao" id="idPlanoAcao" value="<?php echo $idPlanoAcao?>" />
          <input type="hidden" name="idValorSimuladoPlanoAcao" id="idValorSimuladoPlanoAcao" value="<?php echo $idValorSimuladoPlanoAcao?>" />
          <input type="hidden" name="horasPorAula" id="horasPorAula" value="<?php echo $horasPorAula?>" />
          
          <p>
            <label>Quantidade de dias</label>
            <input type="text" name="quantidadeDias" id="quantidadeDias" class="required numeric seteDias" maxlength="1" />
            <span class="placeholder">Campo obrigatório</span></p>
          <p>
            <button class="button blue" onclick="postForm('form_geraFrequenciaSemanalParaDatas', '<?php echo CAMINHO_VENDAS."planoAcao/include/acao/opcaoDiaPlanoAcao.php"?>', '', '#res');">Enviar</button>
            
          </p>
        </form>
		<script>ativarForm();</script>
    
	<?php
    }elseif( $tipoSimulacao==2 ){ 
    
        $LocalAula = new LocalAula();
        $Endereco = new Endereco();
            
        $planoAcaoIdPlanoAcao = $_POST['idPlanoAcao'];
        
        ?>
    
        <form id="form_opcaoDiaPlanoAcao" class="validate" action="" method="post" onsubmit="return false" >
           <strong><p>Data por data</p></strong>
           
           <input type="hidden" name="valorSimuladoPlanoAcao_idValorSimuladoPlanoAcao" id="valorSimuladoPlanoAcao_idValorSimuladoPlanoAcao"
	       value="<?php echo $idValorSimuladoPlanoAcao?>" />            
            <div class="esquerda">
              <p>
                <label>Data da aula:</label>
                <input type="text" name="apartir" id="apartir" class="required data"/>
                <span class="placeholder">Campo obrigatório</span> </p>
              <p>
                <label>Hora de início:</label>
                <input type="text" name="horaInicio" id="horaInicio" class="required hora"/>
                <span class="placeholder">Campo obrigatório</span> </p>
              <p>
                <label>Hora fim:</label>
                <input type="text" name="horaFim" id="horaFim" class="required hora"/>
                <span class="placeholder">Campo obrigatório</span> </p>
            </div>
            <div class="direita">
             <label>Local alternativo de aula:<?php //echo  $planoAcaoIdPlanoAcao;?></label>           
                    <?php echo $LocalAula->selectLocalAulaSelect("", $idLocalAula);?> 
          <span class="placeholder">Campo obrigatório</span></p>
        <p id="op1"> 
           <label >Endereço:</label>
           <?php echo $Endereco->selectEnderecoSelectPlanoAcao("", "",  $planoAcaoIdPlanoAcao);?> 
        </p>
        <p id="op2">
          <label>Endereço(Endereço, número):</label> 
           <?php  echo $Endereco->selectEnderecoSelectPlanoAcaoEmp("", "",  $planoAcaoIdPlanoAcao);?>  
        </p>
         <p id="op3">
          <label>Companhia de Idiomas:</label><br />
           <b><?php echo ENDERECO;?></b> 
        </p>
        <p id="op4">
          <label>Insira o Endereço:(rua, numero, cep, complemento)</label><br />
           <input type="text" name="endereco_novo" id="endereco_novo" value = "" size="50"/> 
        </p>
              </div>
        </form>
         <p>
                  <button class="button blue" onclick="gravarTipoSimulacao_dataPorData()">Salvar</button>
                  
                </p>
        <script>
		function mudarCampo(){
      var idLocalAula = $("#idLocalAula option:selected").val();
                     if(idLocalAula =="" || idLocalAula == 1 ){
                      $("#op3").hide();  
                      $("#op2").hide();
                      $("#op1").show();
					  $("#op4").hide();
                      }
                        if(idLocalAula == 3){
                        $("#op1").hide();  
                        $("#op2").show();
                        $("#op3").hide();
                        $("#op4").hide();  
                    }  
						if(idLocalAula == 2){
                        $("#op1").hide();  
                        $("#op2").hide();
                        $("#op3").show();  
						$("#op4").hide();  
                    }  
                        if(idLocalAula == 7 || idLocalAula == 6 || idLocalAula == 5){
                        $("#op1").hide();
                        $("#op3").hide();
                        $("#op2").hide();
						$("#op4").hide();  
                    } 
					    if(idLocalAula == 8){
                        $("#op1").hide();  
                        $("#op2").hide();
                        $("#op3").hide();  
						$("#op4").show();  
                    }  
                      
                }
            $('#idLocalAula').attr('onchange','mudarCampo()');
            mudarCampo();
		ativarForm();</script>
    <?php }
	
}elseif($_POST['acao'] == 'geraFrequenciaSemanalParaDatas'){ 
	
	$LocalAula = new LocalAula();
	$Endereco = new Endereco();
		
	$planoAcaoIdPlanoAcao = $_POST['idPlanoAcao']; 
	$idValorSimuladoPlanoAcao = $_POST['idValorSimuladoPlanoAcao'];
	$quantidadeDias = $_POST['quantidadeDias'];
	$horasPorAula = $_POST['horasPorAula'];
	
	?>
    <form id="form_opcaoDiaPlanoAcao" class="validate" action="" method="post" onsubmit="return false" >
      
      <strong><p>Frequencia semanal</p></strong>
      
      <input type="hidden" name="valorSimuladoPlanoAcao_idValorSimuladoPlanoAcao" id="valorSimuladoPlanoAcao_idValorSimuladoPlanoAcao"
      value="<?php echo $idValorSimuladoPlanoAcao?>" />
      
      <input type="hidden" name="frequenciaSemanalAula" id="frequenciaSemanalAula" value="<?php echo $quantidadeDias?>" />
      
      <input type="hidden" name="horasPorAula" id="horasPorAula" value="<?php echo $horasPorAula?>" />
      
      <p>
        <label>A partir de:</label>
        <input type="text" name="apartir" id="apartir" class="required data"/>
        <span class="placeholder">Campo obrigatório</span> </p>
		<?php
        for($d=0; $d<$quantidadeDias; $d++){ ?>
         
        <div class="linha-inteira" id="form_opcaoDiaPlanoAcao_<?php echo $d?>" >
        	<p><strong><?php echo ($d+1)?>º dia</strong></p>
            <div class="esquerda">
            <p>
              <label>Hora de início:</label>
              <input type="text" name="horaInicio_<?php echo $d?>" id="horaInicio_<?php echo $d?>" class="required hora"/>
              <span class="placeholder">Campo obrigatório</span> </p>
            <p>
              <label>Hora fim:</label>
              <input type="text" name="horaFim_<?php echo $d?>" id="horaFim_<?php echo $d?>" class="required hora"/>
              <span class="placeholder">Campo obrigatório</span> </p>
            <p>
              <label>Dia da semana:</label>
              <select name="diaSemana[]" id="diaSemana_<?php echo $d?>" class="required" >
                <option value="" >Selecione</option>
                <option value="1" >domingo</option>
                <option value="2" >segunda-feira</option>
                <option value="3" >terça-feira</option>
                <option value="4" >quarta-feira</option>
                <option value="5" >quinta-feira</option>
                <option value="6" >sexta-feira</option>
                <option value="7" >sábado</option>
              </select>
              <span class="placeholder">Campo obrigatório</span> </p>
            </div>
            <div class="direita">
            <p>
              <label>Local alternativo de aula:</label>              
              <?php echo $LocalAula->selectLocalAulaSelect("mudarNome\" ordem=\"".($d), $idLocalAula[$d]);?> 
              <span class="placeholder">Campo obrigatório</span></p>
            <p>
              <label>Endereço:</label>
               <?php echo $Endereco->selectEnderecoSelectPlanoAcao("mudarNome\" ordem=\"".($d), "", $planoAcaoIdPlanoAcao);?> </p>
            </div>
        </div>
        
        <?php }?>
      
      <div class="linha-inteira">
        <p>
          <button class="button blue" onclick="gravarTipoSimulacao_frequenciaSemanal()">Enviar</button>
          
        </p>
      </div>
    </form>
	<script>		
        $('.mudarNome').each(function(){
            var id = $(this).attr('id');
            var ordem = $(this).attr('ordem')
            var novoNome = id+'_'+ordem;
            $(this).attr('name', novoNome);
        });
        
        ativarForm();		
        </script>
        
<?php		
}elseif($_REQUEST['acao'] == 'gravarTipoSimulacao_dataPorData'){
	
	$idValorSimuladoPlanoAcao = $_POST['valorSimuladoPlanoAcao_idValorSimuladoPlanoAcao'];
	$idEndereco_aluno =  $_REQUEST['idEndereco_aluno'];
	$idEndereco_empresa =  $_REQUEST['idEndereco_empresa'];
	$Endereco_novo =  $_REQUEST['endereco_novo'];
	$idLocalAula =  $_REQUEST['idLocalAula'];
	
	if($idLocalAula == 1){
	$idEndereco = $idEndereco_aluno;
}elseif($idLocalAula == 2){
	$idEndereco = LOC_CIA;
}elseif($idLocalAula == 3){
	$idEndereco = $idEndereco_empresa;
}elseif($idLocalAula == 5){
	$idEndereco = P_TELEFONE;
}elseif($idLocalAula == 6){
	$idEndereco = P_SKYPE;
}else{
	$array_endereco = explode(",",$Endereco_novo);
	if($array_endereco[0]!=""){
    $end = new Endereco();
    $end->setRua($array_endereco[0]);
	$end->setNumero($array_endereco[1]);
	$end->setCep($array_endereco[2]);
	$end->setComplemento($array_endereco[3]);
	$end->setPaisIdPais(33);
	$end->setPrincipal(1);
	$end->setidPlanoAcaoGrupo($idPlanoAcaoGrupo);
	$idEndereco = $end->addEndereco();
		 }
}
	
	$temOpcaoDia = $OpcaoDia->selectOpcaoDia(" WHERE valorSimuladoPlanoAcao_idValorSimuladoPlanoAcao = ".$idValorSimuladoPlanoAcao);
	if(!$temOpcaoDia){
		$OpcaoDia->setValorSimuladoPlanoAcaoIdValorSimuladoPlanoAcao($idValorSimuladoPlanoAcao);	
		$OpcaoDia->setEscolhido("1");	
		$idOpcaoDia = $OpcaoDia->addOpcaoDia();
	}else{
		$idOpcaoDia = $temOpcaoDia[0]['idOpcao'];
		
		$OpcaoDia->setIdOpcao($idOpcaoDia);
		$OpcaoDia->updateFieldOpcaoDia("escolhido", "1");
		
	}

	$OpcaoDiaPlanoAcao->setOpcaoDiaIdOpcao($idOpcaoDia);	
	$OpcaoDiaPlanoAcao->setLocalAulaIdLocalAula($idLocalAula);  
	$OpcaoDiaPlanoAcao->setEnderecoIdEndereco($idEndereco);			
	$OpcaoDiaPlanoAcao->setHoraInicio( Uteis::gravarHoras($_POST['horaInicio']) );
	$OpcaoDiaPlanoAcao->setHoraFim( Uteis::gravarHoras($_POST['horaFim']) );
	$OpcaoDiaPlanoAcao->setDataAula( Uteis::gravarData($_POST['apartir']) );			
	
	
	$OpcaoDiaPlanoAcao->addOpcaoDiaPlanoAcao();
			
	$arrayRetorno['mensagem'] = "Dia gravado com sucesso. <br /><small>Continue inserindo se quiser.</small>";	
	
	$arrayRetorno['campoAtualizar'][0] = "#apartir";
	$arrayRetorno['valor'][0] = "";
		
	echo json_encode($arrayRetorno);
	
}elseif($_REQUEST['acao'] == 'gravarTipoSimulacao_frequenciaSemanal'){
	
	$OpcaoDia = new OpcaoDia();
	$OpcaoDiaPlanoAcao = new OpcaoDiaPlanoAcao();
		
	$idValorSimuladoPlanoAcao = $_POST['valorSimuladoPlanoAcao_idValorSimuladoPlanoAcao'];
	$frequenciaSemanalAula = $_POST['frequenciaSemanalAula'];
	$horasTotais = $_POST['horasPorAula'];	
	$apartir = strtotime(Uteis::gravarData($_POST['apartir']));
	$diaDaSemanaInicia = getdate($apartir);
	$diaDaSemanaInicia = $diaDaSemanaInicia['wday']+1;
	
	$diaSem = $_POST['diaSemana'];
	asort($diaSem);
	
	$diaSemanaSomar = 0;
	for($d=0; $d < $frequenciaSemanalAula; $d++ ){			
		$diaSemana = $diaSem[$d]; 
		if( $diaSemana >= $diaDaSemanaInicia ){
			$diaSemanaSomar = ($diaSemana - $diaDaSemanaInicia);	
			$inciarFor = $d;		
			break;				
		}elseif( $diaSemanaSomar==0 ){
			$diaSemanaSomar = (7-$diaDaSemanaInicia) + $diaSemana;
			$inciarFor = $d;
		}
	}	
	
	$dataInserida = $apartir;
	$horasTotaisInseridas = 0;
		
	$temOpcaoDia = $OpcaoDia->selectOpcaoDia(" WHERE valorSimuladoPlanoAcao_idValorSimuladoPlanoAcao = ".$idValorSimuladoPlanoAcao);
	if(!$temOpcaoDia){
		$OpcaoDia->setValorSimuladoPlanoAcaoIdValorSimuladoPlanoAcao($idValorSimuladoPlanoAcao);	
		$OpcaoDia->setEscolhido("1");	
		$idOpcaoDia = $OpcaoDia->addOpcaoDia();
	}else{
		$idOpcaoDia = $temOpcaoDia[0]['idOpcao'];
		
		$OpcaoDia->setIdOpcao($idOpcaoDia);
		$OpcaoDia->updateFieldOpcaoDia("escolhido", "1");
	}

	$OpcaoDiaPlanoAcao->setOpcaoDiaIdOpcao($idOpcaoDia);
	
	while($horasTotaisInseridas < $horasTotais){			
		
		$brecar = false;
		
		for($d = $inciarFor; $d < $frequenciaSemanalAula; $d++ ){			
			
			$diaSemana = $diaSem[$d]; 
			
			if( $horasTotaisInseridas != 0 ){
				if($ultimoDiaSemana < $diaSemana){
					$diaSemanaSomar = $diaSemana - $ultimoDiaSemana;
				}else{
					$diaSemanaSomar = (7-$ultimoDiaSemana) + $diaSemana;
				}
			}
			
			$horaInicio = Uteis::gravarHoras($_POST['horaInicio_'.$d]);
			$horaFim = Uteis::gravarHoras($_POST['horaFim_'.$d]);
						
			$horasPorAula = $horaFim - $horaInicio ;
			
			$horasTotaisInseridas += $horasPorAula;	
				
			if( $horasTotaisInseridas > $horasTotais ){
				$horasPorAula = $horasTotais - ($horasTotaisInseridas - $horasPorAula);
				$brecar = true;
			}
			
			$dataInserida = strtotime("+$diaSemanaSomar days", $dataInserida);
			
			//INSERIR
			$OpcaoDiaPlanoAcao->setLocalAulaIdLocalAula($_POST['idLocalAula_'.$d]);
			$OpcaoDiaPlanoAcao->setEnderecoIdEndereco($_POST['idEndereco_aluno_'.$d]);			
			$OpcaoDiaPlanoAcao->setHoraInicio($horaInicio);
			$OpcaoDiaPlanoAcao->setHoraFim( $horaInicio + $horasPorAula);
			$OpcaoDiaPlanoAcao->setDataAula( date('Y-m-d H:i:s', $dataInserida) );			
			
			
			$idOpcaoDiaPlanoAcao = $OpcaoDiaPlanoAcao->addOpcaoDiaPlanoAcao();
			//
			
			$ultimoDiaSemana = $diaSemana;	
			
			if($brecar)	break;				
		}
		$inciarFor = 0;
	}
	//exit;	
	$arrayRetorno['mensagem'] = "Dias gerados com sucesso";	
	$arrayRetorno['fecharNivel'] = true;	
	
	echo json_encode($arrayRetorno);
	
}elseif($_POST['acao'] == 'gravaOpcaoDia'){
	
	$OpcaoDia->atualizarOpcaoDia();
	$arrayRetorno['mensagem'] = "Opção escolhida com sucesso.";
	echo json_encode($arrayRetorno);
	
}elseif($_REQUEST['acao'] == 'deletar'){
	
	if($_REQUEST['tipo'] == 'TE'){
		$OpcaoDiaPlanoAcao->setIdOpcaoDiaPlanoAcao($_REQUEST['id']);
		$OpcaoDiaPlanoAcao->deleteOpcaoDiaPlanoAcao();
	}else{
		$OpcaoDia->deleteOpcaoDia();		
	}
	$arrayRetorno['mensagem'] = "Excluído com sucesso";
	echo json_encode($arrayRetorno);
	
}else{	
	
	$ValorSimuladoPlanoAcao = new ValorSimuladoPlanoAcao();
	
	if($idOpcaoDia == "" || $idOpcaoDia == 0 ){
		
		$OpcaoDia->setValorSimuladoPlanoAcaoIdValorSimuladoPlanoAcao($_POST['valorSimuladoPlanoAcao_idValorSimuladoPlanoAcao']);	
		$idOpcaoDia = $OpcaoDia->addOpcaoDia();
	}

	if($idOpcaoDia != "" && $idOpcaoDia > 0 ){
	
		$OpcaoDiaPlanoAcao->setOpcaoDiaIdOpcao($idOpcaoDia);
		
		$where = " WHERE idValorSimuladoPlanoAcao = ".$_POST['valorSimuladoPlanoAcao_idValorSimuladoPlanoAcao'];
		$horaFim = $ValorSimuladoPlanoAcao->selectValorSimuladoPlanoAcao($where);
		$horaFim = $horaFim[0]['horasPorAula'];
				
		if( $tipo == "R" ){
			$OpcaoDiaPlanoAcao->deleteOpcaoDiaPlanoAcao(" OR opcaoDia_idOpcao = ".$idOpcaoDia);		
			$frequenciaSemanalAula = $_POST['frequenciaSemanalAula'];
		for($d=0; $d<$frequenciaSemanalAula; $d++){	
			$OpcaoDiaPlanoAcao->setLocalAulaIdLocalAula($_POST['idLocalAula'.$d]);
			$idLocalAula =  $_REQUEST['idLocalAula'.$d];
				$idEndereco_aluno =  $_REQUEST['idEnderecoA_'.$d];
				$idEndereco_empresa =  $_REQUEST['idEndereco_empresa'.$d];
				$Endereco_novo =  $_REQUEST['endereco_novo_'.$d];
				if($idLocalAula == 1){
					$idEndereco = $idEndereco_aluno;
				}elseif($idLocalAula == 2){
					$idEndereco = LOC_CIA;
				}elseif($idLocalAula == 3){
					$idEndereco = $idEndereco_empresa;
				}elseif($idLocalAula == 5){
					$idEndereco = P_TELEFONE;
				}elseif($idLocalAula == 6){
					$idEndereco = P_SKYPE;
				}else{
					$array_endereco = explode(",",$Endereco_novo);
					if($array_endereco[0]!=""){
				    $end = new Endereco();
				    $end->setRua($array_endereco[0]);
					$end->setNumero($array_endereco[1]);
					$end->setCep($array_endereco[2]);
					$end->setComplemento($array_endereco[3]);
					$end->setPaisIdPais(33);
					$end->setPrincipal(1);
					$end->setidPlanoAcaoGrupo($idPlanoAcaoGrupo);
					$idEndereco = $end->addEndereco();
						 }
				}
				$OpcaoDiaPlanoAcao->setEnderecoIdEndereco($idEndereco);        			
				$horaInicio = Uteis::gravarHoras($_POST['horaInicio_'.$d]);
				$OpcaoDiaPlanoAcao->setHoraInicio($horaInicio);	
				$horaInicio = Uteis::gravarHoras($_POST['horaInicio_'.$d]);
				$OpcaoDiaPlanoAcao->setHoraFim($horaInicio+$horaFim);			
				$OpcaoDiaPlanoAcao->setexibirDiaSemana($_POST['diaSemana_'.$d]);			
				
				
				$idOpcaoDiaPlanoAcao = $OpcaoDiaPlanoAcao->addOpcaoDiaPlanoAcao();
			}
			
			$arrayRetorno['mensagem'] = MSG_CADNEW;
			$arrayRetorno['fecharNivel'] = true;
      
	
		}
		//else if( $tipo == "T" || $tipo == "R" ){
//
//			$OpcaoDiaPlanoAcao->setHoraInicio( Uteis::gravarHoras($_POST['horaInicio']) );
//			$OpcaoDiaPlanoAcao->setDataAula( Uteis::gravarData($_POST['dataAula']) );
//			$OpcaoDiaPlanoAcao->setLocalAulaIdLocalAula($_POST['idLocalAula']);
//			$OpcaoDiaPlanoAcao->setEnderecoIdEndereco($_POST['idEndereco']);						
//			
//			
//			$idOpcaoDiaPlanoAcao = $OpcaoDiaPlanoAcao->addOpcaoDiaPlanoAcao();
//				
//			$arrayRetorno['mensagem'] = MSG_CADNEW;
//						
//			$arrayRetorno['valor'][0] = "";
//			$arrayRetorno['campoAtualizar'][0] = "#dataAula";
//			
//			$arrayRetorno['valor'][1] = $idOpcaoDia;
//			$arrayRetorno['campoAtualizar'][1] = "#id";
//						
//		}
		
	}	
	
	echo json_encode($arrayRetorno);
	
}

?>