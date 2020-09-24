<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$VivenciaProfessor = new VivenciaProfessor();
$Pais = new Pais();

$idVivenciaProfessor = $_GET['id'];	
$professorIdProfessor = $_SESSION['idProfessor_SS'];

if($idVivenciaProfessor!=''){
	
	$valorVivenciaProfessor = $VivenciaProfessor->selectVivenciaProfessor(" WHERE idVivenciaProfessor=".$idVivenciaProfessor);
			
	$professorIdProfessor = $valorVivenciaProfessor[0]['professor_idProfessor'];
	$paisIdPais = $valorVivenciaProfessor[0]['pais_idPais'];
	$obs = $valorVivenciaProfessor[0]['obs'];				
}
	
?>

<!--<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
 --> <fieldset>
    <legend>Cadastro de locais de vivência do professor</legend>
    <form id="form_vivenciaProfessor" class="validate" action="" method="post" onsubmit="return false">
    	<input name="professor_idProfessor" type="hidden" value="<?php echo $professorIdProfessor?>" />
      <p>
        <label>País:</label>       
        <?php echo $Pais->selectPaisSelect("required", $paisIdPais);?> <span class="placeholder">Campo Obrigatório</span> </p>

     <p> <label>Data de partida: </label>
        <input type="date" name="dataPartida" id="dataPartida" class="required" value="<?php echo $dataPartida?>" />
          <span class="placeholder">Campo Obrigatório</span> </p>
       
       <p> <label>Data de retorno: </label>
        <input type="date" name="dataRetorno" id="dataRetorno" class="required" value="<?php echo $dataRetorno?>" />
          <span class="placeholder">Campo Obrigatório</span> </p>
 

        <p> <label>Atividade: </label>
        <input type="radio" name="atividade" id="atividade" value="1"> Turismo
         <input type="radio" name="atividade" id="atividade" value="2"> Trabalho
         <input type="radio" name="atividade" id="atividade" value="3"> Estudo
         <input type="radio" name="atividade" id="atividade" value="4"> Outras atividades
       </p>
        <p>
          <label>Observação:</label>
          <textarea name="obs" id="obs" class="" cols="40" rows="4" ><?php echo $obs?></textarea>
          <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <button class="Bblue" onclick="enviadoOK();postForm('form_vivenciaProfessor', '<?php echo "modulos/cadastro/vivenciaProfessorAcao.php?id=$idVivenciaProfessor"?>');">
        Salvar</button>
        
         <button class="button gray" onclick="zerarCentro();carregarModulo('/cursos/portais/modulos/cadastro/formacaoPerfilProf.php', '#centro');" >Fechar</button>
        
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 