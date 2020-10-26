<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
		
$ProcessoSeletivoProfessor = new ProcessoSeletivoProfessor();

$professor_idProfessor = $_GET['id'];	

if($professor_idProfessor!=''){
	
	$valorPSP = $ProcessoSeletivoProfessor->selectProcessoSeletivoProfessor("WHERE professor_idProfessor = ".$professor_idProfessor);
	
	$idPSP = $valorPSP[0]['idProcessoSeletivoProfessor'];
	$assistiu = $valorPSP[0]['assistiu'];
	
}
	
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
 
  <fieldset>
    <legend>Prof. Assistiu vídeos/ preencheu form de cada sessão?</legend>
    <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="img_" onclick="abrirFormulario('div_form_idiomaProfessor', 'img_');" />
    <div class="agrupa" id="div_form_idiomaProfessor">
      <form id="form_assistiu" class="validate" method="post" action="" onsubmit="return false" >
        <input type="hidden" name="professor_idProfessor" id="professor_idProfessor" value="<?php echo $professor_idProfessor?>" />
        <input type="hidden" name="idPSP" id="idPSP" value="<?php echo $idPSP?>" />
           <p>
            <label>SIM:</label>
            <br />
            <input type="checkbox" name="assistiu" id="assistiu" value="1" <?php if ($assistiu == 1) {echo "checked=\"checked\""; } ?>/>
          </p>
        </div>
        <div class="linha-inteira">
          <p>
            <button class="button blue" onclick="postForm('form_assistiu', '<?php echo CAMINHO_CAD."professor/"?>candidato/acao/assistiu.php');" >Salvar</button>
            
          </p>
        </div>
      </form>
    </div>
  </fieldset>
 </div>
