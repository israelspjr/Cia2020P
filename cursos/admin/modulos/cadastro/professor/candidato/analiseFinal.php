<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
		
$ProcessoSeletivoProfessor = new ProcessoSeletivoProfessor();
$NivelLingustico = new NivelLinguistico();

$professor_idProfessor = $_GET['id'];	

if (($professor_idProfessor!='') || ($idPSP > 0)){
	
	if ($idPSP > 0) {
		$where = " WHERE idProcessoSeletivoProfessor = ".$idPSP;
	} else {
		$where = " WHERE professor_idProfessor = ".$professor_idProfessor;
	}
	
	$valorPSP = $ProcessoSeletivoProfessor->selectProcessoSeletivoProfessor($where);
	
	$idPSP = $valorPSP[0]['idProcessoSeletivoProfessor'];
	$analiseFinal = $valorPSP[0]['analiseFinal'];
	$comportamental = $valorPSP[0]['comportamental'];
	$pedagogico = $valorPSP[0]['pedagogico'];
	$linguistico = $valorPSP[0]['linguistico'];
	$final = $valorPSP[0]['finalT'];
	$dataNivel =  $valorPSP[0]['dataNivel'];
	$idNivel = $valorPSP[0]['idNivel'];
	$vpgP = $valorPSP[0]['vpgP'];
	$vpgG = $valorPSP[0]['vpgG'];
	$vpgV = $valorPSP[0]['vpgV'];
	
}
	if ($geral != 1) {
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
 <?php } ?>
  <fieldset>
    <legend>Analise Final, Aprovado?</legend>
  <!--  <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="img_" onclick="abrirFormulario('div_form_idiomaProfessor', 'img_');" />-->
    <div class="agrupa" id="div_form_idiomaProfessor">
      <form id="form_A<?php echo $idPSP?>" class="validate" method="post" action="" onsubmit="return false" >
        <input type="hidden" name="professor_idProfessor" id="professor_idProfessor" value="<?php echo $professor_idProfessor?>" />
        <input type="hidden" name="idPSP" id="idPSP" value="<?php echo $idPSP?>" />
        
        <div class="esquerda">
        <p>
        <label>Comportamental:</label>
        <textarea name="comportamental" id="comportamental" cols="40" rows="4" ><?php echo $comportamental?></textarea> 
        </p>
        <p>
        <label>Pedagógico:</label>
        <textarea name="pedagogico" id="pedagogico" cols="40" rows="4" ><?php echo $pedagogico?></textarea> 
        </p>
        <p>
        <label>linguístico:</label>
        <textarea name="linguistico" id="linguistico" cols="40" rows="4" ><?php echo $linguistico?></textarea> 
        </p>
        <p>
        <label>Final:</label>
        <textarea name="final" id="final" cols="40" rows="4" ><?php echo $final?></textarea> 
        </p>
         <p>
            <label>Aprovado SIM:            
            <input type="radio" name="analiseFinal" id="analiseFinal" value="1" <?php if ($analiseFinal == 1) {echo "checked=\"checked\""; } ?>/></label>
            <label>Reprovado:            
            <input type="radio" name="analiseFinal" id="analiseFinal" value="2" <?php if ($analiseFinal == 2) {echo "checked=\"checked\""; } ?>/></label>
         </p>
        </div>
        <?php if ($geral != 1) { ?>
        <div class="esquerda">
        <p><strong>Casos de reprovação imediata no linguistico:</strong><br /> 	<br />		
- Professor usar outros idiomas, ou expressões em outros idiomas durante a avaliação oral.<br /> 			
- Erros de gramática básicos			<br />
- professor com sotaque de outro idioma muito forte<br />			
</p>			
			
<p><strong>Classificação de nível:</strong><br /> <br />			
Se prof acertar entre 70% - 79% = pode ser entre C e C+<br /> 			
			
Se prof acertar entre 80% - 89% = pode ser entre B e B+	<br />		
			
Se prof acertar entre 90% - 100% = pode ser B+ e A <br />
</p>	
  
      
         
	</div>
    <?php } ?>		
 <div class="linha-inteira">
            <p>
            <button class="button blue" onclick="postForm('form_A<?php echo $idPSP?>', '<?php echo CAMINHO_CAD."professor/"?>candidato/acao/analiseFinal.php?geral=<?php echo $geral?>');" >Salvar</button>
            
          </p>
        </div>
      </form>
    </div>
  </fieldset>
 </div>
