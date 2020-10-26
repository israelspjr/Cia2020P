<?php
//pagina conteudo o formulario 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Regras = new Regras();
$TipoCurso = new TipoCurso();
		
$idRegras = $_REQUEST['id'];
$idPlanoAcao = $_REQUEST['idPlanoAcao'];

if($idRegras != '' && $idRegras  > 0){

	$valor = $Regras->selectRegras('WHERE idRegras='.$idRegras);
	
	//$idRegras = $valor[0]['idRegras'];
	 $tituloRegra = $valor[0]['tituloRegra'];
	 $regra = $valor[0]['regra'];
	 $inativo = $valor[0]['inativo'];
	 $padrao = $valor[0]['padrao'];
	 $dataCadastro = $valor[0]['dataCadastro'];
	 $excluido = $valor[0]['excluido'];
	 $tipoCursoD =  $valor[0]['tipoCursoIdCurso'];	 
	 $B2B = $valor[0]['B2B'];
	 $B2C = $valor[0]['B2C'];
}

?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Cadastro - Regras</legend>
    <form id="form_RegrasC" class="validate"  method="post" onsubmit="return false" >
      <input name="id" type="hidden" value="<?php echo $idRegras ?>" />
      <input type="hidden" id="idPlanoAcao" name="idPlanoAcao" value="<?php echo $idPlanoAcao?>" />
       <div class="esquerda">
      <p>
        <label for="inativo">Inativo</label>
        <input type="checkbox" name="inativo" id="inativo" value="1" <?php if($inativo != 0){ ?> checked="checked" <?php } ?> />
      </p>
        <p>
        <label for="padrao">Padrão</label>
        <input type="checkbox" name="padrao" id="padrao" value="1" <?php if($padrao != 0){ ?> checked="checked" <?php } ?> />
      </p>
      <p>
        <label>Título Regra:</label>
        <input type="text" name="tituloRegra" id="tituloRegra" class="required" value="<?php echo $tituloRegra?>" style="width:500px"/>
        <span class="placeholder">Campo Obrigatório</span> </p>
      </div>
      <div class="direita">
       <p>
        <label for="inativo">B2B</label>
        <input type="checkbox" name="B2B" id="B2B" value="1" <?php if($B2B != 0){ ?> checked="checked" <?php } ?> />
      </p>
       <p>
        <label for="inativo">B2C</label>
        <input type="checkbox" name="B2C" id="B2C" value="1" <?php if($B2C != 0){ ?> checked="checked" <?php } ?> />
      </p>
      <p>
        <label>Tipo de curso: </label>
        <?php echo $TipoCurso->selectTipoCursoCheckbox($idPlanoAcao, $and, "", $tipoCursoD) ?>
                                
      </p>
      </div>
    <div class="linha-inteira">
      <p>
        <label>Regra:</label>
        <textarea name="regra_base" id="regra_base" cols="40" rows="4"><?php echo $regra?></textarea>
        <textarea name="regra" id="regra" class="required" ></textarea>
        <span class="placeholder">Campo Obrigatório</span> </p>
      <button class="button blue" onclick="postForm_editor('regra', 'form_RegrasC', '<?php echo CAMINHO_MODULO?>configuracoes/regras/grava.php')">Salvar</button>
      
      </p>
      </div>
    </form>
  </fieldset>
</div>
<script>
ativarForm();
viraEditor('regra');
</script> 
