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
	$analiseC = $valorPSP[0]['analiseC'];
	$avaliadorC = $valorPSP[0]['avaliadorC'];

	$dataC = $valorPSP[0]['dataC'];
	$perfilG = $valorPSP[0]['perfilG'];
	$pc2 = $valorPSP[0]['pc2'];
	$pc3 = $valorPSP[0]['pc3'];
	$pc4 = $valorPSP[0]['pc4'];
	$pc5 = $valorPSP[0]['pc5'];
	$pc6 = $valorPSP[0]['pc6'];
	$pc7 = $valorPSP[0]['pc7'];
	$pc8 = $valorPSP[0]['pc8'];
	$pc9 = $valorPSP[0]['pc9'];
	$pc10 = $valorPSP[0]['pc10'];
	$pc11 = $valorPSP[0]['pc11'];
	$pc12 = $valorPSP[0]['pc12'];
	$pc13 = $valorPSP[0]['pc13'];
	$pc14 = $valorPSP[0]['pc14'];
	$pc15 = $valorPSP[0]['pc15'];
	$pc16 = $valorPSP[0]['pc16'];
	$pc17 = $valorPSP[0]['pc17'];
	$pc18 = $valorPSP[0]['pc18'];
	$pc19 = $valorPSP[0]['pc19'];

}
	if ($geral != 1) {
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
 <?php } ?>
  <fieldset>
    <legend>Comportamental:</legend>
  <!--  <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="img_" onclick="abrirFormulario('div_form_idiomaProfessor', 'img_');" />-->
    <div class="agrupa" id="div_form_idiomaProfessor">
      <form id="form_C<?php echo $idPSP?>" class="validate" method="post" action="" onsubmit="return false" >
        <input type="hidden" name="professor_idProfessor" id="professor_idProfessor" value="<?php echo $professor_idProfessor?>" />
        <input type="hidden" name="idPSP" id="idPSP" value="<?php echo $idPSP?>" />
        
        <div class="esquerda">
        <p><label>Avaliador:</label>
    <input type="text" name="avaliadorC" id="avaliadorC" value="<?php echo $avaliadorC?>" />
    </p>
   <p>
          <label>Data do teste Comportamental:</label>
       <input type="date" name="dataC" id="dataC" class="data hasDatepicker" value="<?php echo $dataC?>" maxlength="10" autocomplete="off" />   </p>
       <p>
            <label>Aprovado SIM:            
            <input type="checkbox" name="analiseC" id="analiseC" value="1" <?php if ($analiseC == 1) {echo "checked=\"checked\""; } ?>/></label>
            <label>Reprovado:            
            <input type="checkbox" name="analiseC" id="analiseC" value="2" <?php if ($analiseC == 2) {echo "checked=\"checked\""; } ?>/></label>
          </p>
        </div>
        <div class="linha-inteira">
          <p>
        <label>Perfil Geral(Percepção):</label>
        <textarea name="perfilG" id="perfilG" cols="40" rows="4" ><?php echo $perfilG?></textarea> 
        </p>
          <p>
        <label>O que sabe sobre a Companhia de Idiomas (ou a Global)?:</label>
        <textarea name="pc2" id="pc2" cols="40" rows="4" ><?php echo $pc2?></textarea> 
        </p>
          <p>
        <label>Qual perfil de aluno você prefere não dar aulas? O que você faz com alunos desinteressados?</label>
        <textarea name="pc3" id="pc3" cols="40" rows="4" ><?php echo $pc3?></textarea> 
        </p>
         <p>
        <label>Aluno sem tempo x prof líder/ como motivar o aluno, cumprindo prazos da escola?   </label>
        <textarea name="pc4" id="pc4" cols="40" rows="4" ><?php echo $pc4?></textarea> 
        </p>
         <p>
        <label>Feedback negativo que já teve de aluno/ coord, como você recebeu e mudou suas aulas?					   </label>
        <textarea name="pc5" id="pc5" cols="40" rows="4" ><?php echo $pc5?></textarea> 
        </p>
         <p>
        <label>Situação estressante, difícil ou de conflito com algum aluno? Como resolveu?							   </label>
        <textarea name="pc6" id="pc6" cols="40" rows="4" ><?php echo $pc6?></textarea> 
        </p>
         <p>
        <label> Quais suas expectativas em relação à Companhia de Idiomas/ Global, o que vocês esperam encontrar aqui? ** Se prof falar que esperar encher horários, estabilidade, ESCLARECER como funciona na CI (contrato autônomo)					  </label>
        <textarea name="pc7" id="pc7" cols="40" rows="4" ><?php echo $pc7?></textarea> 
        </p>
         <p>
        <label> O que vc espera da coordenação? Destes 4 pontos, qual é o mais importante pra vc e o menos importante?  1) Dispobilidade e agilidade de comunicação com a coordenação    2) Suporte individual para melhorar suas aulas     3) Suporte em relação aos alunos     4) Capacitação técnica, treinamentos e workshops									  </label>
        <textarea name="pc8" id="pc8" cols="40" rows="4" ><?php echo $pc8?></textarea> 
        </p>
        <p>
        <label>   NÃO FAZER PARA GLOBAL:     A Companhia de Idiomas tem algumas expectativas em relação aos professores, como pontualidade, não faltar às aulas, comunicação ágil com a coordenação (whatsapp principalmente, trabalhamos em horários diferentes e precisamos que a comunicação seja eficiente, não pode ignorar mensagens, não dar retorno ao coord ou a qualquer outro colega de trabalho), comprometimento com o grupo por pelo menos um estágio, trabalho em time... o que você acha disso?														  </label>
        <textarea name="pc9" id="pc9" cols="40" rows="4" ><?php echo $pc9?></textarea> 
        </p>
        <p>
        <label> Como você se sente/sentiria ao ter uma aula assistida pelo coordenador ou um colega? 																		  </label>
        <textarea name="pc10" id="pc10" cols="40" rows="4" ><?php echo $pc10?></textarea> 
        </p>
        <p>
        <label> Você se importa em assistir aulas de colegas sem ser remunerado?																					  </label>
        <textarea name="pc11" id="pc11" cols="40" rows="4" ><?php echo $pc11?></textarea> 
        </p>
         <p>
        <label>SOMENTE PROFESSORES GLOBAL: 1) Global não tem escritório no Brasil, não tem suporte pedagógico e nem atendimento no Brasil para solução de possíveis casos dificeis. Como você vê isso?    2) PROFESSORES PLE trabalham muito com trechos de músicas, filmes sem contextualizar o conteúdo com o aluno, sem explorar gramática... como você faz?																										  </label>
        <textarea name="pc12" id="pc12" cols="40" rows="4" ><?php echo $pc12?></textarea> 
        </p>
        <p>
        <label> Se alguém fosse apresentá-lo para mim, qual ponto positivo e ponto negativo essa pessoa falaria																														  </label>
        <textarea name="pc13" id="pc13" cols="40" rows="4" ><?php echo $pc13?></textarea> 
        </p>
         <p>
        <label>Você está otimista ou pessimista com relação aos rumos da humanidade? Estamos ficando melhores ou piores como seres humanos?																																		  </label>
        <textarea name="pc14" id="pc14" cols="40" rows="4" ><?php echo $pc14?></textarea> 
        </p>
         <p>
        <label>Se você pudesse voltar no tempo, o que faria diferente na sua vida pessoal e profissional? 					"																																						  </label>
        <textarea name="pc15" id="pc15" cols="40" rows="4" ><?php echo $pc15?></textarea> 
        </p>
         <p>
        <label>Se você fosse rico e não precisasse trabalhar, como ocuparia seu tempo?			"																																						  </label>
        <textarea name="pc16" id="pc16" cols="40" rows="4" ><?php echo $pc16?></textarea> 
        </p>
         <p>
        <label>Conte alguma outra coisa sobre você (algo inusitado que tenha feito ou hobby)																																												  </label>
        <textarea name="pc17" id="pc17" cols="40" rows="4" ><?php echo $pc17?></textarea> 
        </p>
        <p>
        <label>Onde você mora? Pretende se mudar em breve?																																																	  </label>
        <textarea name="pc18" id="pc18" cols="40" rows="4" ><?php echo $pc18?></textarea> 
        </p>
        <p>
        <label>Você tem alguma dúvida? Anotar dúvidas do prof																																																						  </label>
        <textarea name="pc19" id="pc19" cols="40" rows="4" ><?php echo $pc19?></textarea> 
        </p>
        <p><strong>PEDIR INDICAÇÃO DE COLEGAS PROFESSORES, PARA QUE TAMBÉM POSSAMOS FAZER CONTATO, EXPLICAR QUE A COMPANHIA DE IDIOMAS FAZ RECRUTAMENTO CONSTANTE DEVIDO NECESSIDADES DOS CLIENTES POR AULAS SEMPRE PELA MANHÃ OU FINAL DO DIA</strong> </p>
        
                    <p>
            <button class="button blue" onclick="postForm('form_C<?php echo $idPSP?>', '<?php echo CAMINHO_CAD."professor/"?>candidato/acao/comportamental.php?geral=<?php echo $geral?>');" >Salvar</button>
            
          </p>
        </div>
      </form>
    </div>
  </fieldset>
<?php if ($geral != 1) { ?>
 </div>
<?php } ?>