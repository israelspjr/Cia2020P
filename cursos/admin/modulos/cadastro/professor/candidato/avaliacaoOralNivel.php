<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
		
$ProcessoSeletivoProfessor = new ProcessoSeletivoProfessor();
$NivelLingustico = new NivelLinguistico();
$SotaqueIdiomaProfessor = new SotaqueIdiomaProfessor();

$professor_idProfessor = $_GET['id'];	

if (($professor_idProfessor!='') || ($idPSP > 0)){
	
	if ($idPSP > 0) {
		$where = " WHERE idProcessoSeletivoProfessor = ".$idPSP;
	} else {
		$where = " WHERE professor_idProfessor = ".$professor_idProfessor;
	}
	
	$valorPSP = $ProcessoSeletivoProfessor->selectProcessoSeletivoProfessor($where);
	
	$idPSP = $valorPSP[0]['idProcessoSeletivoProfessor'];
	$analiseFinal = $valorPSP[0]['oralFinal'];
	$comportamental = $valorPSP[0]['comportamental'];
	$pedagogico = $valorPSP[0]['pedagogico'];
	$linguistico = $valorPSP[0]['linguistico'];
	$final = $valorPSP[0]['finalT'];
	$dataNivel =  $valorPSP[0]['dataNivel'];
	$idNivel = $valorPSP[0]['idNivel'];
	$vpgP = $valorPSP[0]['vpgP'];
	$vpgG = $valorPSP[0]['vpgG'];
	$vpgV = $valorPSP[0]['vpgV'];
	$avaliadorOral = $valorPSP[0]['avaliador'];
	$idIdioma = $valorPSP[0]['idioma_idIdioma'];
	$idSotaque = $valorPSP[0]['idSotaque'];

	
}
	if ($geral != 1) {
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
 <?php } ?>
  <fieldset>
    <legend>Avaliação Oral e Nível</legend>
  <!--  <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="img_" onclick="abrirFormulario('div_form_idiomaProfessor', 'img_');" />-->
    <div class="agrupa" id="div_form_idiomaProfessor">
      <form id="form_AON<?php echo $idPSP?>" class="validate" method="post" action="" onsubmit="return false" >
        <input type="hidden" name="professor_idProfessor" id="professor_idProfessor" value="<?php echo $professor_idProfessor?>" />
        <input type="hidden" name="idPSP" id="idPSP" value="<?php echo $idPSP?>" />
        
        <div class="esquerda">
    <p><label>Avaliador:</label>
    <input type="text" name="avaliadorOral" id="avaliadorOral" value="<?php echo $avaliadorOral?>" />
    </p>
   <p>
          <label>Data do teste Linguístico:</label>
       <input type="date" name="dataNivel" id="dataNivel" class="data hasDatepicker" value="<?php echo $dataNivel?>" maxlength="10" autocomplete="off" />   </p>
       <p>
            <label>Aprovado SIM:            
            <input type="radio" name="analiseFinal" id="analiseFinal" value="1" <?php if ($analiseFinal == 1) {echo "checked=\"checked\""; } ?>/></label>
            <label>Reprovado:            
            <input type="radio" name="analiseFinal" id="analiseFinal" value="2" <?php if ($analiseFinal == 2) {echo "checked=\"checked\""; } ?>/></label>
   
          </p>
           <p><label>Nível Linguístico:</label>
       <?php echo $NivelLingustico->selectNivelLinguisticoSelect("", $idNivel) ?>
       </p>
       <p><label>Sotaque:</label>
       <?php echo $SotaqueIdiomaProfessor->selectSotaqueIdiomaProfessorSelect("", $idSotaque, " idioma_idIdioma = ".$idIdioma); ?></p>
   
       </div>
       <div class="direita">
          <p><strong>Casos de reprovação imediata no linguistico:</strong><br /> 	<br />		
- Professor usa outros idiomas, ou expressões em outros idiomas durante a avaliação oral.<br /> 			
- Erros de gramática básicos			<br />
- professor com sotaque de outro idioma muito forte<br />			
</p>			
			
<p><strong>Classificação de nível:</strong><br /> <br />			
Se prof acertar entre 70% - 79% = pode ser entre C e C+<br /> 			
			
Se prof acertar entre 80% - 89% = pode ser entre B e B+	<br />		
			
Se prof acertar entre 90% - 100% = pode ser B+ e A <br />
</p>	
          
         
	</div>		
        <div class="linha-inteira">
        <fieldset>
  <legend>VPG</legend>
  
  <div style="float:left;width:30%;padding:1em;" >
      <p>
        <label>Vocabulário:</label>
        <textarea name="valor_V" id="valor_V" rows="10" cols="30"><?php echo $vpgV; ?>
        </textarea>
    </p>
  </div>
    
  <div style="float:left;width:30%;padding:1em;" >
   <p>
        <label>Pronúncia:</label>
         <textarea name="valor_P" id="valor_P" rows="10" cols="30"><?php echo $vpgP; ?>
        </textarea>
    </p>
  </div>
  
  <div style="float:left;width:30%;padding:1em;" >
      <p>
        <label>Gramática:</label>
         <textarea name="valor_G" id="valor_G" rows="10" cols="30"><?php echo $vpgG; ?>
        </textarea>
      </p>
  </div>
 </fieldset>
           <p>
            <button class="button blue" onclick="enviar();" >Salvar</button>
            
          </p>
        </div>
      </form>
 <!--   </div>-->
  </fieldset>
<?php if ($geral != 1) { ?>
 </div>
<?php } ?>

<script>

function enviar() {
if ($('#dataNivel').val() == '') {	
	alert("Por favor insira uma data!");
} else {
	postForm('form_AON<?php echo $idPSP?>', '<?php echo CAMINHO_CAD."professor/"?>candidato/acao/avaliacaoOralNivel.php?geral=<?php echo $geral?>');
	}
}

</script>