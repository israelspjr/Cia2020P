<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
		
$ProcessoSeletivoProfessor = new ProcessoSeletivoProfessor();

$professor_idProfessor = $_GET['id'];	

if($professor_idProfessor!=''){
	
	$valorPSP = $ProcessoSeletivoProfessor->selectProcessoSeletivoProfessor("WHERE professor_idProfessor = ".$professor_idProfessor);
	
	$idPSP = $valorPSP[0]['idProcessoSeletivoProfessor'];
	$obs = $valorPSP[0]['regiaoAtende'];
	
}
	
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
 
  <fieldset>
    <legend>Regiões que atende</legend>
    <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="img_" onclick="abrirFormulario('div_form_idiomaProfessor', 'img_');" />
    <div class="agrupa" id="div_form_idiomaProfessor">
      <form id="form_regiaoAtende" class="validate" method="post" action="" onsubmit="return false" >
        <input type="hidden" name="professor_idProfessor" id="professor_idProfessor" value="<?php echo $professor_idProfessor?>" />
        <input type="hidden" name="idPSP" id="idPSP" value="<?php echo $idPSP?>" />
           <p>
            <label>Regiões:</label>
            <br />
            <textarea name="obs" id="obs" cols="40" rows="4" ><?php echo $obs?></textarea>
          </p>
        </div>
        <div class="linha-inteira">
          <p>
            <button class="button blue" onclick="postForm('form_regiaoAtende', '<?php echo CAMINHO_CAD."professor/"?>candidato/acao/regiaoAtende.php');" >Salvar</button>
            
          </p>
        </div>
      </form>
    </div>
  </fieldset>
 </div>
