<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$VivenciaProfessor = new VivenciaProfessor();
$Pais = new Pais();

$idVivenciaProfessor = $_GET['id'];	
$professorIdProfessor = $_GET['idProfessor'];	

if($idVivenciaProfessor!=''){
	
	$valorVivenciaProfessor = $VivenciaProfessor->selectVivenciaProfessor("WHERE idVivenciaProfessor=".$idVivenciaProfessor);
			
	$professorIdProfessor = $valorVivenciaProfessor[0]['professor_idProfessor'];
	$paisIdPais = $valorVivenciaProfessor[0]['pais_idPais'];
	$obs = $valorVivenciaProfessor[0]['obs'];	
	$dataPartida = Uteis::exibirData($valorVivenciaProfessor[0]['dataPartida']);
	$dataRetorno = Uteis::exibirData($valorVivenciaProfessor[0]['dataRetorno']);
	$atividade = $valorVivenciaProfessor[0]['atividade'];					
}
	
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Cadastro de locais de vivência do professor</legend>
    <form id="form_vivenciaProfessor" class="validate" action="" method="post" onsubmit="return false">
    	<input name="professor_idProfessor" type="hidden" value="<?php echo $professorIdProfessor?>" />
      <p>
        <label>País:</label>       
        <?php echo $Pais->selectPaisSelect("required", $paisIdPais);?> <span class="placeholder">Campo Obrigatório</span> </p>
        
       <p> <label>Data de partida: </label>
        <input type="text" name="dataPartida" id="dataPartida" class="required data" value="<?php echo $dataPartida?>" />
          <span class="placeholder">Campo Obrigatório</span> </p>
       
       <p> <label>Data de retorno: </label>
        <input type="text" name="dataRetorno" id="dataRetorno" class="required data" value="<?php echo $dataRetorno?>" />
          <span class="placeholder">Campo Obrigatório</span> </p>
        
        <p> <label>Atividade: </label>
        <input type="radio" name="atividade" id="atividade" value="1" <?php if ($atividade== 1) {echo "checked='checked'";} ?> /> Turismo
         <input type="radio" name="atividade" id="atividade" value="2" <?php if ($atividade == 2) { echo "checked='checked'"; } ?> /> Trabalho
         <input type="radio" name="atividade" id="atividade" value="3" <?php if ($atividade == 3) {echo "checked='checked'"; } ?> /> Estudo
         <input type="radio" name="atividade" id="atividade" value="4" <?php if ($atividade == 4) {echo "checked='checked'"; } ?> /> Outras atividades
   
        
        </p>
        
        
        <p>
          <label>Observação:</label>
          <textarea name="obs" id="obs" class="" cols="40" rows="4" ><?php echo $obs?></textarea>
          <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <button class="button blue" onclick="postForm('form_vivenciaProfessor', '<?php echo CAMINHO_CAD."professor/include/acao/vivenciaProfessor.php?id=$idVivenciaProfessor"?>');">Salvar</button>
        
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 