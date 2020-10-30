<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$AulaPermanenteGrupo = new AulaPermanenteGrupo();
$LocalAula = new LocalAula();
$Endereco = new Endereco();
$PlanoAcaoGrupo = new PlanoAcaoGrupo();
$idPlanoAcaoGrupo = $_GET['id'];
$PAG = $PlanoAcaoGrupo->selectPlanoAcaoGrupo("WHERE idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo);

$onclick = "onclick=\"enviar2()\"";
?>

  <fieldset>
    <legend>Novo dia de frequência permanente</legend>
    <form id="form_AulaPermanenteGrupo" class="validate" method="post" action="" onsubmit="return false" >
      <input type="hidden" name="idPlanoAcaoGrupo" id="idPlanoAcaoGrupo" value="<?php echo $idPlanoAcaoGrupo?>" />
   <input type="hidden" name="atualizarDia" id="atualizarDia" value="<?php echo $atualizar?>" />
    <input type="hidden" name="idAulaPermanenteGrupo" id="idAulaPermanenteGrupo" value="<?php echo $idAulaPermanenteGrupo?>" />
      <div class="esquerda">
        <p>
          <label>Dia da semana:</label>
          <select name="diaSemana" id="diaSemana" class="required" >
            <option value="" >Selecione</option>
            <option value="1" <?php if ($diaSemana == 1) { echo "selected"; } ?>>domingo</option>
            <option value="2" <?php if ($diaSemana == 2) { echo "selected"; } ?>>segunda-feira</option>
            <option value="3" <?php if ($diaSemana == 3) { echo "selected"; } ?>>terça-feira</option>
            <option value="4" <?php if ($diaSemana == 4) { echo "selected"; } ?>>quarta-feira</option>
            <option value="5" <?php if ($diaSemana == 5) { echo "selected"; } ?>>quinta-feira</option>
            <option value="6" <?php if ($diaSemana == 6) { echo "selected"; } ?>>sexta-feira</option>
            <option value="7" <?php if ($diaSemana == 7) { echo "selected"; } ?>>sábado</option>
          </select>
          <span class="placeholder">Campo obrigatório</span> </p>
        <p>
          <label>Hora de início:</label>
          <input type="text" name="horaInicio" id="horaInicio" class="required hora" value="<?php echo $horaInicio?>" />
          <span class="placeholder">Campo obrigatório</span> </p>
        <p>
          <label>Hora de término:</label>
          <input type="text" name="horaFim" id="horaFim" class="required hora" value="<?php echo $horaFim?>"/>
          <span class="placeholder">Campo obrigatório</span> </p>
        <p>
          <label>Início aula em:</label>
          <input type="text" name="dataInicio" id="dataInicio" class="required data"  value="<?php echo $dataInicio?>" />
          <span class="placeholder">Campo Obrigatório</span> </p>
        <?php if ($atualizar == 1) { ?>
        <p>
          <label>Termino da aula Data Antiga: (Será considerado um dia antes do Início da aula)</label>
          <input type="hidden" name="atualizar" id="atualizar" value="<?php echo $atualizar;?>" />
          <!--<input type="text" name="dataFim1" id="dataFim1" class="required data" value="<?php echo $dataFimO?>" />
          <span class="placeholder">Campo Obrigatório</span-->
        </p>
        
        <?php 
			$onclick = "onclick=\"enviar()\"";
		} ?>
        <p>
          <label>Termina aulas Data nova em (opcional) :</label>
          <input type="text" name="dataFim" id="dataFim" class="data" value="<?php echo $dataFim?>" />
        </p>
      </div>
      <div class="direita">
        <p>
          <label>Local alternativo de aula:</label>           
					<?php echo $LocalAula->selectLocalAulaSelect("", $idLocalAula);?> 
          <span class="placeholder">Campo obrigatório</span></p>
        <p id="op1"> 
           <label >Endereço:</label>
           <?php echo $Endereco->selectEnderecoSelect_PlanoAcaoAluno("", $idEndereco, $idPlanoAcaoGrupo);?> 
        </p>
        <p id="op2">
          <label>Endereço(Endereço, número):</label> 
          
           <?php 
//		   $idPlanoAcao = $PlanoAcaoGrupo->getIdPlanoAcao($idPlanoAcaoGrupo);
		    echo $Endereco->selectEnderecoSelectPlanoAcaoGrupoEmp("", $idEndereco, $idPlanoAcaoGrupo);?>  
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
      <p>
        <label>Observação:</label>
        <textarea name="obs" id="obs" cols="40" rows="4" value="<?php echo $obs?>"></textarea>
      </p>
      <p>
        <label>Busca urgente
          <input type="checkbox" name="urgente" id="urgente" value="1" />
        </label>
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
      
       <div id="semanas">
        <fieldset>
          <legend>Semanas do mês em que não fará aulas</legend>
          <?php for($s=1; $s < 5; $s++){?>
          <div style="float:left;width:20%">
            <label><?php echo $s?>ª semana do mês:</label>
            <input type="checkbox" name="semana_<?php echo $s?>" id="semana_<?php echo $s?>" value="1" <?php echo in_array($s, $valorNaoFaz) ? "checked" : ""?> />
          </div>
          <?php } ?>
        </fieldset>
      </div>
      <div class="linha-inteira">
      <p>
        <button class="button blue" <?php echo $onclick?>>Salvar</button>
        
      </p>
      </div>
     
    </form>
  </fieldset>

<script>
function enviar() {
	if ($('#dataFim1').val() == '') {
		alert('Por favor inclua uma data de saida da aula antiga');
	} else {
		postForm('form_AulaPermanenteGrupo', '<?php echo CAMINHO_REL."grupo/include/acao/aulaPermanenteGrupo.php"?>');
	}
}

function enviar2() {
		postForm('form_AulaPermanenteGrupo', '<?php echo CAMINHO_REL."grupo/include/acao/aulaPermanenteGrupo.php"?>');
}


ativarForm();
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




</script> 