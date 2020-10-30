<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$AulaDataFixa = new AulaDataFixa();
$BuscaProfessor = new BuscaProfessor();

$arrayRetorno = array();

$idAulaDataFixa = $_REQUEST['id'];

if($_POST['acao'] == 'escolherTipoSimulacao'){ 
	
	$tipoSimulacao = $_POST['tipoSimulacao'];
	$idPlanoAcaoGrupo = $_POST['idPlanoAcaoGrupo'];
	
	if( $tipoSimulacao==1 ){ ?>
    	
    	<form id="form_geraFrequenciaSemanalParaDatas" class="validate" action="" method="post" onsubmit="return false" >
          
          <strong><p>Frequencia semanal</p></strong>
          
          <input type="hidden" name="acao" id="acao" value="geraFrequenciaSemanalParaDatas" />
          <input type="hidden" name="idPlanoAcaoGrupo" id="idPlanoAcaoGrupo" value="<?php echo $idPlanoAcaoGrupo?>" />
          
          <p>
            <label>Quantidade de dias</label>
            <input type="text" name="quantidadeDias" id="quantidadeDias" class="required numeric seteDias" maxlength="1" />
            <span class="placeholder">Campo obrigatório</span></p>
            
          <p>
            <label>Horas totais</label>
            <input type="text" name="horasTotais" id="horasTotais" class="required hora" />
            <span class="placeholder">Campo obrigatório</span></p>
            
          <p>  
            <button class="button blue" onclick="postForm('form_geraFrequenciaSemanalParaDatas', '<?php echo CAMINHO_REL."grupo/include/acao/aulaDataFixa.php"?>', '', '#res');">Salvar</button>            
          </p>
        </form>
        <script>ativarForm();</script>
        
    <?php
    }elseif( $tipoSimulacao==2 ){ 
		
		$LocalAula = new LocalAula();
		$Endereco = new Endereco();   
		
		$idPlanoAcaoGrupo = $_POST['idPlanoAcaoGrupo'];
		?>
		
        <form id="form_aulaDataFixa" class="validate" action="" method="post" onsubmit="return false" >
          <strong><p>Data por data</p></strong>
          
          <input type="hidden" name="idPlanoAcaoGrupo" id="idPlanoAcaoGrupo" value="<?php echo $idPlanoAcaoGrupo?>" />
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
              <input type="hidden" name="addFrom" id="addForm" value = "0" />
          </div>
          <div class="direita">
            <p>
                  <label>Local alternativo de aula:</label>           
                   <?php echo $LocalAula->selectLocalAulaSelect("", "","",1);?> 
                  <span class="placeholder">Campo obrigatório</span></p>
                <p id="op5"> 
                   <label >Endereço:</label>
                   <?php echo $Endereco->selectEnderecoSelectPlanoAcao("", $idEndereco, $idPlanoAcaoGrupo);?> 
                </p>
                <p id="op6">
                  <label>Endereço(Endereço, número):</label>                  
                  <div id="op6html"> </div> 
                </p>
                 <p id="op7">
                  <label>Companhia de Idiomas:</label><br />
                   <b><?php echo ENDERECO;?></b> 
                </p>
                <p id="op8">
                  <label>Insira o Endereço:</label><br />
                  <label>Endereço = (Endereço, número, CEP(00000-000), Complemento):</label>
                  <input type="text" name="endereco_novo" id="endereco_novo" size="80" value = ""/>
                </p>
                 <p>
        <label>Observação:</label>
        <textarea name="obs" id="obs" cols="40" rows="4" ></textarea>
      </p>
                 <p>
        <label>Tipo busca 
        <?php 
		$sql = "SELECT idTipoBusca, tipo FROM tipoBusca where inativo =0";
		
		$result = Uteis::executarQuery($sql);
		
		?>
        <select id="tipo" name="tipo" >
		<option value="-">Selecione</option>
        <?php
		foreach($result as $valor) {
		echo "<option value='".$valor['idTipoBusca']."' >".$valor['tipo']."</option>";	
		
		}
		?>
		</select>
        	
        </label>
      </p>
          </div>
          <div class="linha-inteira">
            <p>
              <button class="button blue" onclick="postForm('form_aulaDataFixa', '<?php echo CAMINHO_REL."grupo/include/acao/aulaDataFixa.php"?>');">Salvar</button>
              
            </p>
          </div>
        </form>
        <script>
        function mudarCampo1(){
            var idLocalAula = $("#idLocalAula1 option:selected").val();
                     if(idLocalAula =="" || idLocalAula == 1 ){
                //   $("#idEndereco").val("");  
                      $("#EndHTML").empty();
                      $("#op7").hide();  
                      $("#op6").hide();
                      $("#op5").show();
                      $("#op8").hide();
                      $("#op6html").empty();
                      }
                        if(idLocalAula == 3){
                        $("#EndHTML").empty();
                        $("#op5").hide();  
                        $("#op6").show();
                        $("#op7").hide();
                        $("#op8").hide();
                        $("#op6html").append("<?=$SelectEmp?>");  
                    }  
                        if(idLocalAula == 2){
                        $("#idEndereco2").val("<?php echo $LocalCI;?>");
                        $("#EndHTML").empty();
                        $("#op5").hide();  
                        $("#op6").hide();
                        $("#op7").show();  
                        $("#op8").hide(); 
                        $("#op6html").empty(); 
                    }  
                        if(idLocalAula == 6){
                        $("#idEndereco2").val("<?php echo $PorSkype;?>");
                        $("#EndHTML").empty();
                        $("#op5").hide();
                        $("#op7").hide();
                        $("#op6").hide();
                        $("#op8").hide(); 
                        $("#op6html").empty(); 
                    } 
                        if(idLocalAula == 5){
                        $("#idEndereco2").val("<?php echo $PorTelefone;?>");
                        $("#EndHTML").empty();
                        $("#op5").hide();
                        $("#op7").hide();
                        $("#op6").hide();
                        $("#op8").hide(); 
                        $("#op6html").empty(); 
                    } 
                        if(idLocalAula == 8){
                        $("#idEndereco2").val("");
                        $("#op5").hide();  
                        $("#op6").hide();
                        $("#op7").hide();  
                        $("#op8").show();  
                        $("#op6html").empty();
                        
                    }  
                      
                }
            $('#idLocalAula1').attr('onchange','mudarCampo1()');
            
            mudarCampo1();

            </script>
		<script>ativarForm();</script>
        
	 <?php }
	 exit;

}elseif($_POST['acao'] == 'geraFrequenciaSemanalParaDatas'){ 
	
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/LocalAula.class.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Endereco.class.php");

	$LocalAula = new LocalAula();
	$Endereco = new Endereco();
	
    	
	$idPlanoAcaoGrupo = $_POST['idPlanoAcaoGrupo']; 
	
	$quantidadeDias = $_POST['quantidadeDias'];
	$horasTotais = Uteis::gravarHoras($_POST['horasTotais']);
	$SelectEmp = str_replace('"','\'',$Endereco->selectEnderecoSelectPlanoAcaoEmp('', $idEndereco, $idPlanoAcaoGrupo));
	?>
    <form id="form_aulaDataFixa" class="validate" action="" method="post" onsubmit="return false" >
      <strong><p>Frequencia semanal</p></strong>
      <input type="hidden" name="acao" id="acao" value="gravarTipoSimulacao_frequenciaSemanal" />
      <input type="hidden" name="quantidadeDias" id="quantidadeDias" value="<?php echo $quantidadeDias?>" />
      <input type="hidden" name="idPlanoAcaoGrupo" id="idPlanoAcaoGrupo" value="<?php echo $idPlanoAcaoGrupo?>" />
      <input type="hidden" name="horasTotais" id="horasTotais" value="<?php echo $horasTotais?>" />
               
      <p>
        <label>A partir de:</label>
        <input type="text" name="apartir" id="apartir" class="required data"/>
        <span class="placeholder">Campo obrigatório</span> </p>
     
      <?php
      for($d=0; $d<$quantidadeDias; $d++){ ?>
      
            <div class="linha-inteira" id="form_aulaDataFixa<?php echo $d?>" >
				<p><strong><?php echo $d+1?>º dia</strong></p>            
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
                             <?php echo $LocalAula->selectLocalAulaSelect("", $idLocalAula2,"",$d);?> 
                  <span class="placeholder">Campo obrigatório</span></p>
                <p id="op5_<?=$d;?>"> 
                   <label >Endereço:</label>
                   <?php echo $Endereco->selectEnderecoSelectPlanoAcao("", $idEndereco, $idPlanoAcaoGrupo);?> 
                </p>
                <p id="op6_<?=$d;?>">
                  <label>Endereço(Endereço, número):</label>                  
                  <div id="op2html"> </div> 
                </p>
                 <p id="op7_<?=$d;?>">
                  <label>Companhia de Idiomas:</label><br />
                   <b><?php echo ENDERECO;?></b> 
                </p>
                <p id="op8_<?=$d;?>">
                  <label>Insira o Endereço:</label><br />
                  <label>Endereço = (Endereço, número, CEP(00000-000), Complemento):</label>
                  <input type="text" name="endereco_novo_<?=$d;?>" id="endereco_novo_<?=$d;?>" size="80" value = ""/>
                </p>
              </div>
            </div>
          <script>
function mudarCampo_<?=$d;?>(){
      var idLocalAula = $("#idLocalAula2_<?=$d;?> option:selected").val();
                     if(idLocalAula =="" || idLocalAula == 1 ){
                //   $("#idEndereco").val("");  
                      $("#EndHTML").empty();
                      $("#op7_<?=$d;?>").hide();  
                      $("#op6_<?=$d;?>").hide();
                      $("#op5_<?=$d;?>").show();
                      $("#op8_<?=$d;?>").hide();
                      $("#op6html_<?=$d;?>").empty();
                      }
                        if(idLocalAula == 3){
                        $("#EndHTML").empty();
                        $("#op5_<?=$d;?>").hide();  
                        $("#op6_<?=$d;?>").show();
                        $("#op7_<?=$d;?>").hide();
                        $("#op8_<?=$d;?>").hide();
                        $("#op6html_<?=$d;?>").append("<?=$SelectEmp?>");  
                    }  
                        if(idLocalAula == 2){
                        $("#idEndereco2_<?=$d;?>").val("<?php echo $LocalCI;?>");
                        $("#EndHTML").empty();
                        $("#op5_<?=$d;?>").hide();  
                        $("#op6_<?=$d;?>").hide();
                        $("#op7_<?=$d;?>").show();  
                        $("#op8_<?=$d;?>").hide(); 
                        $("#op6html").empty(); 
                    }  
                        if(idLocalAula == 6){
                        $("#idEndereco2_<?=$d;?>").val("<?php echo $PorSkype;?>");
                        $("#EndHTM_<?=$d;?>L").empty();
                        $("#op5_<?=$d;?>").hide();
                        $("#op7_<?=$d;?>").hide();
                        $("#op6_<?=$d;?>").hide();
                        $("#op8_<?=$d;?>").hide(); 
                        $("#op6html_<?=$d;?>").empty(); 
                    } 
                        if(idLocalAula == 5){
                        $("#idEndereco2_<?=$d;?>").val("<?php echo $PorTelefone;?>");
                        $("#EndHTML_<?=$d;?>").empty();
                        $("#op5_<?=$d;?>").hide();
                        $("#op7_<?=$d;?>").hide();
                        $("#op6_<?=$d;?>").hide();
                        $("#op8_<?=$d;?>").hide(); 
                        $("#op6html_<?=$d;?>").empty(); 
                    } 
                        if(idLocalAula == 8){
                        $("#idEndereco2_<?=$d;?>").val("");
                        $("#op5_<?=$d;?>").hide();  
                        $("#op6_<?=$d;?>").hide();
                        $("#op7_<?=$d;?>").hide();  
                        $("#op8_<?=$d;?>").show();  
                        $("#op6html_<?=$d;?>").empty();
                        
                    }  
                      
                }
            $('#idLocalAula2_<?=$d;?>').attr('onchange','mudarCampo_<?=$d;?>()');
            
            mudarCampo_<?=$d;?>();

            </script>
      <?php }?>
      
      <div class="linha-inteira">
        <p>
          <button class="button blue" onclick="postForm('form_aulaDataFixa', '<?php echo CAMINHO_REL."grupo/include/acao/aulaDataFixa.php"?>');">Salvar</button>
        </p>
      </div>
      
    </form>
	
	<script>		
	$('#form_aulaDataFixa .mudarNome').each(function(){
		var id = $(this).attr('id');
		var ordem = $(this).attr('ordem')
		var novoNome = id+'_'+ordem;
		$(this).attr('name', novoNome);
	});
	
	ativarForm();		
	</script>
        
	<?php		
	exit;
	
}elseif($_REQUEST['acao'] == 'gravarTipoSimulacao_frequenciaSemanal'){
	
	//print_r($_POST);
		
	$idPlanoAcaoGrupo = $_POST['idPlanoAcaoGrupo'];
	$frequenciaSemanalAula = $_POST['quantidadeDias'];
	$horasTotais = $_POST['horasTotais'];	
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
	
	$AulaDataFixa->setPlanoAcaoGrupoIdPlanoAcaoGrupo($idPlanoAcaoGrupo);
		
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
			$AulaDataFixa->setDataAula( date('Y-m-d H:i:s', $dataInserida) );	
			$AulaDataFixa->setHoraInicio($horaInicio);
			$AulaDataFixa->setHoraFim(($horaInicio+$horasPorAula));			
			$AulaDataFixa->setLocalAulaIdLocalAula($_POST['idLocalAula_'.$d]);
			$AulaDataFixa->setEnderecoIdEndereco($_POST['idEndereco_'.$d]);														
			$AulaDataFixa->setAddFrom(0);
			
			$idAulaDataFixa = $AulaDataFixa->addAulaDataFixa();
			//
						
			$ultimoDiaSemana = $diaSemana;	
			
			if($brecar)	break;
		}
		
		$inciarFor = 0;
		
	}
		
	$arrayRetorno['mensagem'] = "Dias gerados com sucesso";	
	$arrayRetorno['fecharNivel'] = true;				
	
}elseif($_REQUEST['acao']=="deletar"){
		
	$AulaDataFixa->setIdAulaDataFixa($idAulaDataFixa);
	$AulaDataFixa->updateFieldAulaDataFixa("excluido", "1");
	
	$arrayRetorno['mensagem'] = "Desvinculado com sucesso.";
	
}else{	

//		 $AulaDataFixa->setLocalAulaIdLocalAula($_POST['idLocalAula']);
		 $Endereco_novo = $_POST['endereco_novo'];
		 $idLocalAula = $_POST['idLocalAula1'];
		
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
}elseif($idLocalAula == 8) {
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

	$AulaDataFixa->setPlanoAcaoGrupoIdPlanoAcaoGrupo($_POST['idPlanoAcaoGrupo']);
	$AulaDataFixa->setLocalAulaIdLocalAula($idLocalAula);
	$AulaDataFixa->setEnderecoIdEndereco($idEndereco);			
	$AulaDataFixa->setDataAula( Uteis::gravarData($_POST['apartir']) );
	$AulaDataFixa->setHoraInicio( Uteis::gravarHoras($_POST['horaInicio']) );
	$AulaDataFixa->setHoraFim( Uteis::gravarHoras($_POST['horaFim']) );
	$AulaDataFixa->setAddFrom($_POST['addFrom']);
	
	
	$idAulaDataFixaNova = $AulaDataFixa->addAulaDataFixa();
	
	//Criando Busca
					$BuscaProfessor->setAulaDataFixaIdAulaDataFixa($idAulaDataFixaNova);				
				$BuscaProfessor->setObs($_POST['obs']);
				$BuscaProfessor->setUrgente($_POST['urgente']);	
				$BuscaProfessor->setDataApartir(Uteis::gravarData($_POST['apartir']));	
				$BuscaProfessor->setTipoBuscaIdTipoBusca($_POST['tipo']);			
				
				$BuscaProfessor->addBuscaProfessor();
				
				$arrayRetorno['mensagem'] = "Inserido na busca com sucesso.";
	
	$arrayRetorno['mensagem'] = "Dia gravado com sucesso. <br /><small>Continue inserindo se quiser.</small>";	
	
	$arrayRetorno['campoAtualizar'][0] = "#apartir";
	$arrayRetorno['valor'][0] = "";
}

echo json_encode($arrayRetorno);

?>	