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
	$analiseP = $valorPSP[0]['analiseP'];
	$avaliadorP = $valorPSP[0]['avaliadorP'];

	$dataP = $valorPSP[0]['dataP'];
	$pp1 = $valorPSP[0]['pp1'];
	$pp2 = $valorPSP[0]['pp2'];
	$pp3 = $valorPSP[0]['pp3'];
	$pp4 = $valorPSP[0]['pp4'];
	$pp5 = $valorPSP[0]['pp5'];
	$pp6 = $valorPSP[0]['pp6'];
	$pp7 = $valorPSP[0]['pp7'];
	$pp8 = $valorPSP[0]['pp8'];
	$pp9 = $valorPSP[0]['pp9'];
	$pp10 = $valorPSP[0]['pp10'];
	$pp11 = $valorPSP[0]['pp11'];
	$pp12 = $valorPSP[0]['pp12'];
	$pp13 = $valorPSP[0]['pp13'];
	$pp14 = $valorPSP[0]['pp14'];

}
		if ($geral != 1) {
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <?php } ?>
  <fieldset>
    <legend>Pedagógico:</legend>
   <!-- <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="img_" onclick="abrirFormulario('div_form_idiomaProfessor', 'img_');" />-->
    <div class="agrupa" id="div_form_idiomaProfessor">
      <form id="form_P<?php echo $idPSP?>" class="validate" method="post" action="" onsubmit="return false" >
        <input type="hidden" name="professor_idProfessor" id="professor_idProfessor" value="<?php echo $professor_idProfessor?>" />
        <input type="hidden" name="idPSP" id="idPSP" value="<?php echo $idPSP?>" />
        
        <div class="esquerda">
        <p><label>Avaliador:</label>
    <input type="text" name="avaliadorP" id="avaliadorP" value="<?php echo $avaliadorP?>" />
    </p>
   <p>
          <label>Data do teste Pedagógico:</label>
       <input type="date" name="dataP" id="dataP" class="data hasDatepicker" value="<?php echo $dataP?>" maxlength="10" autocomplete="off" />   </p>
       <p>
            <label>Aprovado SIM:            
            <input type="radio" name="analiseP" id="analiseP" value="1" <?php if ($analiseP == 1) {echo "checked=\"checked\""; } ?>/></label>
   
            <label>Reprovado:            
            <input type="radio" name="analiseP" id="analiseP" value="2" <?php if ($analiseP == 2) {echo "checked=\"checked\""; } ?>/></label>
   
          </p>
        </div>
        <div class="linha-inteira">
          <p>
        <label>Professor preparou a aula ou foi improvisada?</label>
        <textarea name="pp1" id="pp1" cols="40" rows="4" ><?php echo $pp1?></textarea> 
        </p>
          <p>
        <label>Teve clareza? Entendemos o que o professor preparou e a mensagem que queria passar?</label>
        <textarea name="pp2" id="pp2" cols="40" rows="4" ><?php echo $pp2?></textarea> 
        </p>
          <p>
        <label>A aula teve foco no aluno, e não aula-show ou autocentrada?</label>
        <textarea name="pp3" id="pp3" cols="40" rows="4" ><?php echo $pp3?></textarea> 
        </p>
         <p>
        <label>organização na comunicação, no material, na aula como um todo?</label>
        <textarea name="pp4" id="pp4" cols="40" rows="4" ><?php echo $pp4?></textarea> 
        </p>
         <p>
        <label>Correção, corrigir sem constranger o aluno.</label>
        <textarea name="pp5" id="pp5" cols="40" rows="4" ><?php echo $pp5?></textarea> 
        </p>
         <p>
        <label>Equilíbrio de tempo de fala em grupo (o professor foca em apenas um aluno ou divide bem o tempo de fala?										   </label>
        <textarea name="pp6" id="pp6" cols="40" rows="4" ><?php echo $pp6?></textarea> 
        </p>
         <p>
        <label> Como ele é como aluno? Ele participa da aula dos outros ou não presta atenção?							  </label>
        <textarea name="pp7" id="pp7" cols="40" rows="4" ><?php echo $pp7?></textarea> 
        </p>
         <p>
        <label> Atualização - o conteúdo selecionado é atual e relevante?											  </label>
        <textarea name="pp8" id="pp8" cols="40" rows="4" ><?php echo $pp8?></textarea> 
        </p>
        <p>
        <label>O professor é "raso" ou demonstra ter bastante conhecimento e informação?																  </label>
        <textarea name="pp9" id="pp9" cols="40" rows="4" ><?php echo $pp9?></textarea> 
        </p>
        <p>
        <label> Observação sobre o comportamental NA PEDAGÓGICA																					  </label>
        <textarea name="pp10" id="pp10" cols="40" rows="4" ><?php echo $pp10?></textarea> 
        </p>
        <p>
        <label>  APÓS A AULA: Você usa tecnologia em sala de aula? O que usa?                                     																								  </label>
        <textarea name="pp11" id="pp11" cols="40" rows="4" ><?php echo $pp11?></textarea> 
        </p>
         <p>
        <label> APÓS A AULA: Como faz a correção dos seus alunos?                       																												  </label>
        <textarea name="pp12" id="pp12" cols="40" rows="4" ><?php echo $pp12?></textarea> 
        </p>
        <p>
        <label> Se alguém fosse apresentá-lo para mim, qual ponto positivo e ponto negativo essa pessoa falaria																														  </label>
        <textarea name="pp13" id="pp13" cols="40" rows="4" ><?php echo $pp13?></textarea> 
        </p>
         <p>
        <label>APÓS A AULA: Tem experiência com aulas Online?			"																																					  </label>
        <textarea name="pp14" id="pp14" cols="40" rows="4" ><?php echo $pp14?></textarea> 
        </p>
     
                    <p>
            <button class="button blue" onclick="postForm('form_P<?php echo $idPSP?>', '<?php echo CAMINHO_CAD."professor/"?>candidato/acao/pedagogico.php?geral=<?php echo $geral?>');" >Salvar</button>
            
          </p>
        </div>
      </form>
    </div>
  </fieldset>
<?php if ($geral != 1) { ?>
 </div>
 <?php } ?>
