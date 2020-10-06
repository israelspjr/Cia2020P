<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$FeedbackProfessor = new FeedbackProfessor();
$Grupo = new Grupo();
$TipoNota = new NotasTipoNota();
$Professor = new Professor();

$idProfessor = $_GET['idProfessor'];
$idFeedbackProfessor = $_GET['id'];

if( $idFeedbackProfessor ){
	$valor = $FeedbackProfessor->selectFeedbackProfessor("WHERE idFeedbackProfessor =".$idFeedbackProfessor);
	$idProfessor =$valor[0]['professor_idProfessor'];
	$anexo =$valor[0]['anexo'];
	$obs =$valor[0]['obs'];
	$dataAvaliada =$valor[0]['dataAvaliada'];
	$status = $valor[0]['status'];
	$idGrupo = $valor[0]['grupo_idGrupo'];
	$quemAssistiu = $valor[0]['quemAssistiu'];
	$status2 = $valor[0]['status2'];
	$professor_idAssistido = $valor[0]['professor_idAssistido'];
	$pergunta1 = $valor[0]['pergunta1'];
	$pergunta2 = $valor[0]['pergunta2'];
	$pergunta3 = $valor[0]['pergunta3'];
	$pergunta4 = $valor[0]['pergunta4'];
	$pergunta5 = $valor[0]['pergunta5'];
	$pergunta6 = $valor[0]['pergunta6'];
	$pergunta7 = $valor[0]['pergunta7'];
	$pergunta8 = $valor[0]['pergunta8'];	
	$pergunta9 = $valor[0]['pergunta9'];
	$pergunta10 = $valor[0]['pergunta10'];
	$pergunta11 = $valor[0]['pergunta11'];
	$pergunta12 = $valor[0]['pergunta12'];
	$pergunta13 = $valor[0]['pergunta13'];		
}

?>
<script>
function aguardarCarregamentoFeed(){		
	if( $('#visualizar_feed[status=esperando]').length > 0 ){
		alerta('Aguarde o final do carregamento do contrato');
	}else{
		postForm('form_feed_dados', 'modulos/aulas/acao.php');
		zerarCentro();
		carregarModulo('/cursos/portais/modulos/aulas/index.php', '#centro');
	}
}
</script>

<!--<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  -->
  <fieldset>
    <form id="formulario_feed" method="post" enctype="multipart/form-data" action="modulos/aulas/acao.php" style="display:none">
      <input type="hidden" id="acao" name="acao" value="file" />
      <input type="file" id="add_file_feed" onchange="addArquivo()" name="file" />
    </form>
    <legend>Cadastro do feedback do professor</legend>
    <form id="form_feed_dados" class="validate" method="post" action="" onsubmit="return false" >
      <input type="hidden" id="quemAssistiu" name="quemAssistiu" value="<?php echo $_SESSION['idProfessor_SS'];?>" />
      <input type="hidden" id="id" name="id" value="<?php echo $idFeedbackProfessor?>" />
    <div class="esquerda">
       <p><label>Nome do Professor ? </label>
      <?php echo $Professor->selectProfessorSelect("required", $idProfessor ," WHERE candidato = 0") ?></p>
      <p>
      
       <label>Grupo:</label>
           <?php echo $Grupo->selectGrupoSelect("",$idGrupo); ?></p>
        
      </div>
      <div class="direita">
      <p>
        <label>Data da aula Assistida:</label>
        <input type="date" name="dataAvaliada" id="dataAvaliada" class="required" value="<?php echo $dataAvaliada?>"/>
        <!--<span class="placeholder">Campo Obrigatório</span> </p>
      --><p>
         <p>
      <label>Status:</label>
      <input type="radio" id="status" name="status" value="1" <?php if($status == 1) { echo "checked"; } ?>/> <img src="<?php echo CAMINHO_IMG."excelente.png"?>" title="Aula excelente"/> 
      <input type="radio" id="status" name="status" value="2" <?php if($status == 2) { echo "checked"; } ?> /> <img src="<?php echo CAMINHO_IMG."boa.png"?>" title="Aula Boa, mas pode ser melhor"/> 
      <input type="radio" id="status" name="status" value="3" <?php if($status == 3) { echo "checked"; } ?>/> <img src="<?php echo CAMINHO_IMG."regular.png"?>" /> 
      <input type="radio" id="status" name="status" value="4" <?php if($status == 4) { echo "checked"; } ?>/> <img src="<?php echo CAMINHO_IMG."ruim.png"?>" /> 
     </p>
     <p>
     <label>Nota: </label>
     <?php echo $TipoNota->selectNotasTipoNotaSelect("", $status2, " AND tipoNota_idTipoNota = 4 ") ?>

      </p>
    
      </div>
  <div class="linha-inteira"><p></p></div>
      <div class="esquerda">
        
    
            <p><label>O que mais chamou sua atenção?</label>
       <input type="text" id="pergunta1" name="pergunta1" value="<?php echo $pergunta1?>" style="    width: 500px;" /></p>
       
        <p><label>Quais técnicas ou práticas chamaram a atenção na aula assistida?</label>
       <input type="text" id="pergunta2" name="pergunta2" value="<?php echo $pergunta2?>" style="    width: 500px;"/></p>
     
       <p><label>Quais atitudes positivas você conseguiu observar?</label>
       <input type="text" id="pergunta3" name="pergunta3" value="<?php echo $pergunta3?>" style="    width: 500px;"/></p>
     
       <p><label>O que você faria de diferente?</label>
       <input type="text" id="pergunta4" name="pergunta4" value="<?php echo $pergunta4?>" style="    width: 500px;"/></p>
     
      <p><label>Usou VPG ou algo semelhante ao VPG?</label>
       <input type="text" id="pergunta5" name="pergunta5" value="<?php echo $pergunta5?>" style="    width: 500px;" /></p>
 
     <p><label>Alunos estavam envolvidos com a aula?</label>
       <input type="text" id="pergunta6" name="pergunta6" value="<?php echo $pergunta6?>" style="    width: 500px;"/></p>
      
       <p><label>A aula foi dinâmica e alegre?</label>
       <input type="text" id="pergunta7" name="pergunta7" value="<?php echo $pergunta7?>" style="    width: 500px;"/></p>
     
       <p><label>Que recursos visuais o professor utiliza na aula para auxiliar nas explicações e exposições de conteúdo? </label>
       <input type="text" id="pergunta8" name="pergunta8" value="<?php echo $pergunta8?>" style="    width: 500px;"/></p>
      
      <p><label>A aula começou e terminou no horário?</label>
      <input type="text" id="pergunta9" name="pergunta9" value="<?php echo $pergunta9?>" style="    width: 500px;"/></p>
      
	  <p><label>Como é o TTT (Teacher Talking Time)? Alto demais ou adequado dentro da proporção ideal de 70 (alunos)/30 (professor)?</label>
	  <input type="text" id="pergunta8" name="pergunta10" value="<?php echo $pergunta10?>" style="    width: 500px;"/></p>

	  <p><label>Como o professor trabalha a correção dos alunos?</label>
      <input type="text" id="pergunta8" name="pergunta11" value="<?php echo $pergunta11?>" style="    width: 500px;"/></p>

      <p><label>Professor está usando o idioma-alvo durante toda a aula? Caso não, em que momentos ele usa o português?</label>
      <input type="text" id="pergunta8" name="pergunta12" value="<?php echo $pergunta12?>" style="    width: 500px;"/></p>

      <p><label>O material está adequado ao nível dos alunos? Há desnível grande entre eles?</label>
       <input type="text" id="pergunta8" name="pergunta13" value="<?php echo $pergunta13?>" style="    width: 500px;"/></p>
      <p>
      
          <p>
        <label>Feedback:</label>
        <textarea name="obs" id="obs" class="" cols="40" rows="4" ><?php echo $obs?></textarea>
      </p>
  
        <button class="Bblue" onclick="aguardarCarregamentoFeed()">Salvar</button>
      </p>
      </div>
    </form>
    
  </fieldset>
  

<script>
function addArquivo(){
	$('#visualizar_feed').attr({'status':'esperando'}).html('Carregando arquivo...')
	$('#formulario_feed').ajaxForm({
		target:'#visualizar_feed', // o callback será no elemento com o id #visualizar	
		success: function() {
			$('#visualizar_feed').removeAttr('status');
			alert('Arquivo carregado');
		}
	}).submit();
}

//ativarForm();
//grupos();
</script> 