<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
	
	
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/AgendamentoVisita.class.php");	
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/TipoVisita.class.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Endereco.class.php");
		
	$AgendamentoVisita = new AgendamentoVisita();	
	$TipoVisita = new TipoVisita();
	$Endereco = new Endereco();
	

	
	
	
	$idAgendamentoVisita= $_GET['id'];
	$proposta_idProposta = $_GET['idProposta'];
	

	if($idAgendamentoVisita != '' && $idAgendamentoVisita  > 0){

		$valorAgendamentoVisita = $AgendamentoVisita->selectAgendamentoVisita('WHERE idAgendamentoVisita='.$idAgendamentoVisita);

		$idProposta = $valorAgendamentoVisita[0]['proposta_idProposta'];
		$idTipoVisita = $valorAgendamentoVisita[0]['tipoVisita_idTipoVisita'];
		$obs = $valorAgendamentoVisita[0]['obs'];
		$realizada = $valorAgendamentoVisita[0]['realizada'];
        $idEndereco = $valorAgendamentoVisita[0]['endereco_idEndereco'];
        $dataVisita = Uteis::exibirData($valorAgendamentoVisita[0]['dataVisita']);
        $horaInicio = Uteis::exibirHorasInput($valorAgendamentoVisita[0]['horaInicio']);
        $horaFim = Uteis::exibirHorasInput($valorAgendamentoVisita[0]['horaFim']);
	}
	
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Agendar Visita</legend>
    
      <form id="form_agendarVisita" class="validate" action="" method="post" onsubmit="return false" >

        <input type="hidden" name="proposta_idProposta" id="proposta_idProposta" value="<?php echo $proposta_idProposta ?>" />
        
         <p>
         
          <label for="realizada">Realizada</label>
          <input type="checkbox" name="realizada" id="realizada" value="1" <?php if($realizada != 0){ ?> checked="checked" <?php } ?> />
        </p>
        
        <p>
          <label>Data Visita:</label>
          <input type="text" name="dataVisita" id="dataVisita" class="required data" value="<?php echo $dataVisita?>" />
          <span class="placeholder">Campo Obrigatório</span> </p>
        <p>
        
        <p>
          <label>Hora Inicio:</label>
          <input type="text" name="horaInicio" id="horaInicio" class="required hora" value="<?php echo $horaInicio?>" />
          <span class="placeholder">Campo Obrigatório</span> </p>
        <p>
        
        <p>
          <label>Hora Fim:</label>
          <input type="text" name="horaFim" id="horaFim" class="required hora" value="<?php echo $horaFim?>" />
          <span class="placeholder">Campo Obrigatório</span> </p>
        <p>
        
        
        <p>
          <label>Tipo Visita:</label>
           
          
          <?php		  	
		   echo $TipoVisita->selectTipoVisitaSelect( "required",$idTipoVisita, $and);?>
           <span class="placeholder">Campo Obrigatório</span>
        </p>
        
        <p>
          <label>Endereço:</label>
           

          <?php		 
		   echo $Endereco->selectEnderecoSelectAgendamento("", $idEndereco, $proposta_idProposta);?>
           <span class="placeholder">Campo Obrigatório</span>
        </p>

        <p>
          <label>Observação:</label>
          <textarea name="obs" id="obs" cols="40" rows="4"><?php echo $obs ?></textarea>
        </p>

        <div class="linha-inteira">
          <p>
            <button class="button blue" onclick="postForm('form_agendarVisita', '<?php echo CAMINHO_VENDAS?>aprovacao/include/acao/agendamentoVisita.php?id=<?php echo $idAgendamentoVisita?>&idProposta=<?php echo $proposta_idProposta?>');">Salvar</button>
            
          </p>
        </div>
      </form>

  </fieldset>
</div>
<script>ativarForm();</script>