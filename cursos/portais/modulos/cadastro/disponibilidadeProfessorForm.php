<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$DisponibilidadeProfessor = new DisponibilidadeProfessor();

$idDisponibilidadeProfessor = $_REQUEST['id'];
	
if($idDisponibilidadeProfessor){
	
	$valor = $DisponibilidadeProfessor->selectDisponibilidadeProfessor(" WHERE idDisponibilidade = ".$idDisponibilidadeProfessor);

	$professor_idProfessor = $valor[0]['professor_idProfessor'];
	$statusAgenda_idStatusAgenda= $valor[0]['statusAgenda_idStatusAgenda'];
	$horaInicio = Uteis::exibirHorasInput($valor[0]['horaInicio']);
	$horaFim = Uteis::exibirHorasInput($valor[0]['horaFim']);
	$diaSemana = $valor[0]['diaSemana'];
	$obs = $valor[0]['obs'];
			
}else{
	
	$professor_idProfessor = $_REQUEST['idProfessor'];
	$horaInicio = Uteis::exibirHorasInput($_REQUEST['horaInicio']);
	$horaFim = Uteis::exibirHorasInput($_REQUEST['horaFim']);
	$diaSemana = $_REQUEST['diaSemana'];
}
?>

<!--<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  --><fieldset>
    <legend>Disponibilidade do professor</legend>
    <form id="form_DisponibilidadeProfessor" class="validate" method="post" action="" onsubmit="return false" >
      <input name="professor_idProfessor" id="professor_idProfessor" type="hidden" value="<?php echo $professor_idProfessor?>" />
      <p>
        <label>Dia da semana:</label>
        <select name="diaSemana" id="diaSemana" class="required" >
          <option value="" >Selecione</option>
          <option value="1" <?php echo $diaSemana==1 ? "selected" : ""?>>domingo</option>
          <option value="2" <?php echo $diaSemana==2 ? "selected" : ""?>>segunda-feira</option>
          <option value="3" <?php echo $diaSemana==3 ? "selected" : ""?>>terça-feira</option>
          <option value="4" <?php echo $diaSemana==4 ? "selected" : ""?>>quarta-feira</option>
          <option value="5" <?php echo $diaSemana==5 ? "selected" : ""?>>quinta-feira</option>
          <option value="6" <?php echo $diaSemana==6 ? "selected" : ""?>>sexta-feira</option>
          <option value="7" <?php echo $diaSemana==7 ? "selected" : ""?>>sábado</option>
        </select>
        <span class="placeholder">Campo obrigatório</span> </p>
      <p>
        <label>Status:</label>
        <select name="statusAgenda_idStatusAgenda" id="statusAgenda_idStatusAgenda" class="required" >
          <option value="" >Selecione</option>
          <option value="1" <?php echo $statusAgenda_idStatusAgenda==1 ? "selected" : ""?> >Ocupado</option>
            <option value="2" <?php echo $statusAgenda_idStatusAgenda==2 ? "selected" : ""?> >Disponível somente presencial</option>
          <option value="3" <?php echo $statusAgenda_idStatusAgenda==3 ? "selected" : ""?> >Disponível somente on-lline</option>
          <option value="4" <?php echo $statusAgenda_idStatusAgenda==4 ? "selected" : ""?> >Disponível para presencial e on-line</option>
        </select>
        <span class="placeholder">Campo obrigatório</span> </p>
      <p>
        <label>Hora início:</label>
        <input type="text" name="horaInicio" id="horaInicio" class="required hora" value="<?php echo $horaInicio?>" />
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <label>Hora fim:</label>
        <input type="text" name="horaFim" id="horaFim" class="required hora" value="<?php echo $horaFim?>" />
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <label>Observação:</label>
        <textarea name="obs" id="obs" cols="40" rows="4" ><?php echo $obs?></textarea>
      </p>
      
      <div class="linha-inteira">
        <p>
          <button class="bBlue" 
          onclick="enviadoOK();postForm('form_DisponibilidadeProfessor', '<?php echo "modulos/cadastro/disponibilidadeProfessorAcao.php?id=$idDisponibilidadeProfessor"?>')">Salvar</button>
           <button class="button gray" onclick="zerarCentro();carregarModulo('/cursos/portais/modulos/cadastro/disponibilidadeProfessor.php', '#centro');">Fechar</button>
          
        </p>
      </div>
    </form>
  </fieldset>
</div>
<script>//ativarForm();
//function enviadoOK() {
//	alert("Conteúdo inserido/alterado com sucesso!");
//}
</script>