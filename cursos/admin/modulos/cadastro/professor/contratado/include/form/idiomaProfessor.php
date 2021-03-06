<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
		
$IdiomaProfessor = new IdiomaProfessor();
$Idioma = new Idioma();	

$idIdiomaProfessor = $_GET['id'];	
$professor_idProfessor = $_GET['idProfessor'];	

if($idIdiomaProfessor!=''){
	
	$valorIdiomaProfessor = $IdiomaProfessor->selectIdiomaProfessor("WHERE idIdiomaProfessor = ".$idIdiomaProfessor);
	
	$professor_idProfessor = $valorIdiomaProfessor[0]['professor_idProfessor'];			
	$idIdioma = $valorIdiomaProfessor[0]['idioma_idIdioma'];								
	$idNivelLinguistico = $valorIdiomaProfessor[0]['nivelLinguistico_idNivelLinguistico'];	
	$idSotaqueIdiomaProfessor = $valorIdiomaProfessor[0]['sotaqueIdiomaProfessor_idSotaqueIdiomaProfessor'];
	$inativo = $valorIdiomaProfessor[0]['inativo'];	
	$obs = $valorIdiomaProfessor[0]['obs'];	
	$dataContratacao = Uteis::exibirData($valorIdiomaProfessor[0]['dataContratacao']);	
	$dataCadastro = $valorIdiomaProfessor[0]['dataCadastro'];
	$nivel = $valorIdiomaProfessor[0]['nivel'];						
}
	
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <script>
	$(document).ready(function(){
		$('#idiomaprofessor_idioma select').change(function(){
			atualizaNivelLinguisticoPorIdioma( $(this).val() );
			atualizaSotaquePorIdioma( $(this).val() );
		});	
	});
	
	function atualizaNivelLinguisticoPorIdioma(idIdioma, idNivelLinguistico){
		if(idNivelLinguistico == '' || idNivelLinguistico == undefined) idNivelLinguistico = '';
		
		$.post('<?php echo CAMINHO_CAD."professor/"?>contratado/include/acao/idiomaProfessor.php', { acao:"NivelLinguisticoPorIdioma", idIdioma: idIdioma, idNivelLinguistico: idNivelLinguistico}, function(e){
			$('#div_NivelLinguistico').html(e);
		});
	}
	
	function atualizaSotaquePorIdioma(idIdioma, idSotaqueIdiomaProfessor){
		if(idSotaqueIdiomaProfessor == '' || idSotaqueIdiomaProfessor == undefined) idSotaqueIdiomaProfessor = '';
		
		$.post('<?php echo CAMINHO_CAD."professor/"?>contratado/include/acao/idiomaProfessor.php', { acao:"SotaquePorIdioma", idIdioma: idIdioma, idSotaqueIdiomaProfessor: idSotaqueIdiomaProfessor}, function(e){
			$('#div_SotaquePorIdioma').html(e);
		});
	}
  </script>
  <fieldset>
    <legend>Idioma do professor</legend>
    <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="img_" onclick="abrirFormulario('div_form_idiomaProfessor', 'img_');" />
    <div class="agrupa" id="div_form_idiomaProfessor">
      <form id="form_IdiomaProfessor" class="validate" method="post" action="" onsubmit="return false" >
        <input type="hidden" name="professor_idProfessor" id="professor_idProfessor" value="<?php echo $professor_idProfessor?>" />
        <div class="esquerda">
          <p id="idiomaprofessor_idioma">
            <label>Idioma:</label>
            <?php 
		  if($idIdiomaProfessor==""){	
			  $and = " AND ( ";
			  $and .= " 	disponivelAula = 1 AND idIdioma NOT IN (";
			  $and .= "			SELECT idioma_idIdioma FROM idiomaProfessor AS IP WHERE IP.professor_idProfessor = ".$professor_idProfessor;
			  $and .= " 	)";
			  $and .= " )";
			  echo $Idioma->selectIdiomaSelect("required", $idIdioma, $and);
			  echo "<span class=\"placeholder\">Campo Obrigatório</span> ";
          }else{
          	$idiomaSelecionado =  $Idioma->selectIdioma(" WHERE idIdioma = ".$idIdioma);
			echo "<strong>".$idiomaSelecionado[0]['idioma']."</strong>";
			echo "<input type=\"hidden\" name=\"idIdioma\" id=\"idIdioma\" value=\"".$idIdioma."\" />";
		  }
		 ?>
          </p>
          <div id="div_NivelLinguistico"></div>
          <div id="div_SotaquePorIdioma"></div>
          <div>
          	<label>Nível do Idioma: </label>
          		<select name="nivelF" id="nivelF">
                	<option value="" <?php if ($nivel == '') { echo "selected"; } ?>>Selecione</option>
          			<option value="1" <?php if ($nivel == 1) { echo "selected"; } ?>>Fluente</option>
          			<option value="2" <?php if ($nivel == 2) { echo "selected"; } ?>>Nativo</option>
          			<option value="3" <?php if ($nivel == 3) { echo "selected"; } ?>>Avançado</option>
          			<option value="4" <?php if ($nivel == 4) { echo "selected"; } ?>>Intermediário</option>
          			<option value="5" <?php if ($nivel == 5) { echo "selected"; } ?>>Básico</option>
          		</select>
          </div>
        </div>
       <div class="direita">
          <p>
            <label>Data de contratação:</label>
            <input type="text" name="dataContratacao" id="dataContratacao1" class="required data" value="<?php echo $dataContratacao?>" />
            <span class="placeholder">Campo Obrigatório</span> </p>
          <p>
            <label for="inativo">Inativo:</label>
            <input type="checkbox" name="inativo" id="inativo" value="1" <?php echo $inativo == 1 ? "checked" : "" ?>  />
          </p>
          <p>
            <label>Observação:</label>
            <br />
            <textarea name="obs" id="obs" cols="40" rows="4" ><?php echo $obs?></textarea>
          </p>
        </div>
        <div class="linha-inteira">
          <p>
            <button class="button blue" onclick="postForm('form_IdiomaProfessor', '<?php echo CAMINHO_CAD."professor/"?>contratado/include/acao/idiomaProfessor.php');" >Salvar</button>
            
          </p>
        </div>
      </form>
    </div>
  </fieldset>
  <?php if( $idIdiomaProfessor != ''){ ?>
  <div id="div_lista_PlanoCarreirraIdiomaProfessor" class="linha-inteira">
    <?php require_once '../resourceHTML/planoCarreirraIdiomaProfessor.php';?>
  </div>
  <div id="div_lista_experienciaProfissionalIdiomaProfessor" class="esquerda">
    <?php require_once '../resourceHTML/experienciaProfissionalIdiomaProfessor.php';?>
  </div>
  <div id="div_lista_backgroundIdiomaProfessor" class="direita">
    <?php require_once '../resourceHTML/backgroundIdiomaProfessor.php';?>
  </div>
  <?php }?>
</div>
<script>
<?php 
if($idIdioma != '' ){ ?>
	atualizaNivelLinguisticoPorIdioma( '<?php echo $idIdioma ?>', '<?php echo $idNivelLinguistico ?>' );
	atualizaSotaquePorIdioma( '<?php echo $idIdioma ?>', '<?php echo $idSotaqueIdiomaProfessor ?>' )
<?php }?>

ativarForm();
</script> 