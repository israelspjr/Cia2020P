<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
		
$ProcessoSeletivoProfessor = new ProcessoSeletivoProfessor();

$professor_idProfessor = $_GET['id'];	

if($professor_idProfessor!=''){
	
	$valorPSP = $ProcessoSeletivoProfessor->selectProcessoSeletivoProfessor("WHERE professor_idProfessor = ".$professor_idProfessor);
	
	$idPSP = $valorPSP[0]['idProcessoSeletivoProfessor'];
	$trilha = $valorPSP[0]['trilha'];
	$dataAssinatura = $valorPSP[0]['dataTrilha'];
	
}
	
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
 
  <fieldset>
    <legend>Trilha Enviada / Professor assistiu</legend>
    <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="img_" onclick="abrirFormulario('div_form_idiomaProfessor', 'img_');" />
    <div class="agrupa" id="div_form_idiomaProfessor">
      <form id="form_trilha" class="validate" method="post" action="" onsubmit="return false" >
        <input type="hidden" name="professor_idProfessor" id="professor_idProfessor" value="<?php echo $professor_idProfessor?>" />
        <input type="hidden" name="idPSP" id="idPSP" value="<?php echo $idPSP?>" />
           <p>
            <label>SIM:
            <input type="radio" name="trilha" id="trilha" value="1" <?php if ($trilha == 1) {echo "checked=\"checked\""; } ?>/></label>
                <label>Reprovado:            
            <input type="radio" name="trilha" id="trilha" value="2" <?php if ($trilha == 2) {echo "checked=\"checked\""; } ?>/></label>
   
          </p>
           <input type="date" name="dataAssinatura" id="dataAssinatura" class="data hasDatepicker required" required value="<?php echo $dataAssinatura?>" maxlength="10" autocomplete="off" placeholder="Campo Obrigatório"/>  
        </div>
        <div class="linha-inteira">
          <p>
            <button class="button blue" onclick="enviar();" >Salvar</button>
            
          </p>
        </div>
      </form>
    </div>
  </fieldset>
 </div>
<script>

function enviar() {
if ($('#dataAssinatura').val() == '') {	
	alert("Por favor insira uma data!");
} else {
	postForm('form_trilha', '<?php echo CAMINHO_CAD."professor/"?>candidato/acao/trilha.php');
	}
}

</script>