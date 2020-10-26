<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
		
$ProcessoSeletivoProfessor = new ProcessoSeletivoProfessor();

$professor_idProfessor = $_GET['id'];	

if($professor_idProfessor!=''){
	
	$valorPSP = $ProcessoSeletivoProfessor->selectProcessoSeletivoProfessor("WHERE professor_idProfessor = ".$professor_idProfessor);
	
	$idPSP = $valorPSP[0]['idProcessoSeletivoProfessor'];
	$integracao = $valorPSP[0]['integracao'];
	$dataAssinatura = $valorPSP[0]['dataIntegracao'];
	
}
	
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
 
  <fieldset>
    <legend>Participou da integração</legend>
    <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="img_" onclick="abrirFormulario('div_form_idiomaProfessor', 'img_');" />
    <div class="agrupa" id="div_form_idiomaProfessor">
      <form id="form_integracao" class="validate" method="post" action="" onsubmit="return false" >
        <input type="hidden" name="professor_idProfessor" id="professor_idProfessor" value="<?php echo $professor_idProfessor?>" />
        <input type="hidden" name="idPSP" id="idPSP" value="<?php echo $idPSP?>" />
           <p>
            <label>SIM:</label>
            <br />
            <input type="checkbox" name="integracao" id="integracao" value="1" <?php if ($integracao == 1) {echo "checked=\"checked\""; } ?>/>
          </p>
             <p>
          <label>Data da assinatura:</label>
       <input type="date" name="dataAssinatura" id="dataAssinatura" class="data hasDatepicker" value="<?php echo $dataAssinatura?>" maxlength="10" autocomplete="off" placeholder="Campo Obrigatório"/>   
          <span class="placeholder">Campo Obrigatório</span> </p>
        </div>
        <div class="linha-inteira">
          <p>
            <button class="button blue" onclick="postForm('form_integracao', '<?php echo CAMINHO_CAD."professor/"?>candidato/acao/integracao.php');" >Salvar</button>
            
          </p>
        </div>
      </form>
    </div>
  </fieldset>
 </div>
