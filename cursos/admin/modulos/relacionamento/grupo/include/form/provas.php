<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	
$Prova = new Prova();	
$CalendarioProva = new CalendarioProva();	
	
$idPlanoAcaoGrupo = $_GET['idPlanoAcaoGrupo'];
$idCalendarioProva = $_GET['id'];

if($idCalendarioProva != '' && $idCalendarioProva  > 0){

	$valorCalendarioProva = $CalendarioProva->selectCalendarioProva(" WHERE idCalendarioProva=".$idCalendarioProva);
	
	$idProva = $valorCalendarioProva[0]['prova_idProva'];
	$idPlanoAcaoGrupo = $valorCalendarioProva[0]['planoAcaoGrupo_idPlanoAcaoGrupo'];	
	$dataPrevistaInicial = $valorCalendarioProva[0]['dataPrevistaInicial'];
	$dataPrevistaNova = $valorCalendarioProva[0]['dataPrevistaNova'];
	$dataAplicacao = $valorCalendarioProva[0]['dataAplicacao'];
	$obs = $valorCalendarioProva[0]['obs'];
	$validacao = $valorCalendarioProva[0]['validacao'];
	$provaOn = $valorCalendarioProva[0]['provaOn'];
	$codLiberacao = $valorCalendarioProva[0]['codLiberacao'];
	
}	
?>
<script>
function atualizaIntens(idProva){
	if( idProva ){
		$('#itensProva').load('<?php echo CAMINHO_REL?>grupo/include/acao/itensProva.php?idProva='+idProva);
	}
}
</script>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Cadastrar Avaliação </legend>
      <form id="form_CalendarioProva" class="validate" method="post" action="" onsubmit="return false" >
        <input name="idPlanoAcaoGrupo" type="hidden" value="<?php echo $idPlanoAcaoGrupo?>" />
    <div class="esquerda">
    
        <p>
          <label>Avaliação:</label>
          <?php 
					if($idProva){
							$rs = $Prova->selectProva(" WHERE idProva = $idProva");
							echo "<strong>".$rs[0]['nome']."</strong>";
							echo "<input type=\"hidden\" name=\"idProva\" value=\"".$idProva."\" />";
					}else{
							echo $Prova->selectProvaDisponivel($idPlanoAcaoGrupo, $idProva);
					}?>
        </p>
        <p>
          <label>Data Prevista Inicial:</label>
          <input type="text" name="dataPrevistaInicial" id="dataPrevistaInicial" class="required data" value="<?php echo Uteis::exibirData($dataPrevistaInicial)?>" />
          <span class="placeholder">Campo Obrigatório</span> </p>
        <p>
          <label>Nova Data Prevista:</label>
          <input type="text" name="dataPrevistaNova" id="dataPrevistaNova" class="data" value="<?php echo Uteis::exibirData($dataPrevistaNova)?>" />
        </p>
        <p>
          <label>Data da aplicação:</label>
          <input type="text" name="dataAplicacao" id="dataAplicacao" class="data" value="<?php echo Uteis::exibirData($dataAplicacao)?>" />
        </p>
         <p>
          <label>Data da validação (Professor):
          <?php echo Uteis::exibirData($validacao)?></label>
        </p>
        
        <p>
          <label>Observação:</label>
          <textarea name="obs" id="obs" class="" cols="40" rows="4"><?php echo $obs?></textarea>
          <span class="placeholder">Campo Obrigatório</span> </p>
    </div>
    <div class="direita">
   
      <p>
        <label><strong>Itens da Avaliação:</strong></label>
      	<div id="itensProva" class="tab2"></div>
      </p>
      
         <p>
        <label for="inativo"><strong>Avaliação on-line</strong></label>
        <input type="checkbox" name="provaOn" id="provaOn" value="1" <?php if($provaOn != 0){ ?> checked="checked" <?php } ?> />
      </p>
      
      <p><Label><strong>Código de liberação da avaliação:</strong></Label><p style="font-size:18px;    display: block;"><?php echo $codLiberacao?></p>
      Caso não tenha nenhum clique no botão salvar para gerar um novo código.
      <input type="hidden" name="codLiberacao" id="codLiberacao" value="<?php echo $codLiberacao?>" />
      
    </div>
   </form>
  </fieldset>
  

      <p>
          <button class="button blue" onclick="postForm('form_CalendarioProva', '<?php echo CAMINHO_REL?>grupo/include/acao/provas.php?id=<?php echo $idCalendarioProva?>');">
          Enviar</button>
        </p>
   
</div>
<script>
ativarForm();
atualizaIntens('<?php echo $idProva?>');
</script> 
