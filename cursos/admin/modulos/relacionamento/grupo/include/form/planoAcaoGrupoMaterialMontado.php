<?php

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/PlanoAcaoGrupoMaterialMontado.class.php");


$PlanoAcaoGrupoMaterialMontado = new PlanoAcaoGrupoMaterialMontado();

$idPlanoAcaoGrupo = $_REQUEST['idPlanoAcaoGrupo'];

//$idPlanoAcaoGrupoMaterialMontado = $_REQUEST['id'];
//if($idPlanoAcaoGrupoMaterialMontado){
//
//	$valor = $PlanoAcaoGrupoMaterialMontado->selectPlanoAcaoGrupoMaterialMontado(" WHERE idPlanoAcaoGrupoMaterialMontado = ".$idPlanoAcaoGrupoMaterialMontado);
//	
//	$IdPlanoAcaoGrupoMaterialMontado= $valor[0]['idPlanoAcaoGrupoMaterialMontado'];
//	$planoAcaoGrupo_idPlanoAcaoGrupo= $valor[0]['planoAcaoGrupo_idPlanoAcaoGrupo'];
//	$Nome= $valor[0]['nome'];
//	$Preco= $valor[0]['preco'];
//	$obs= $valor[0]['obs'];
//	$DataInicio= $valor[0]['dataInicio'];
//	$DataFim= $valor[0]['dataFim'];
//	$DataCadastro= $valor[0]['dataCadastro'];
//
//}
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Material montado/personalizado</legend>
    <form id="form_PlanoAcaoGrupoMaterialMontado" class="validate" method="post" action="" onsubmit="return false" >
      <input type="hidden" name="idPlanoAcaoGrupo" id="idPlanoAcaoGrupo" value="<?php echo $idPlanoAcaoGrupo?>" />
      <p>
        <label>Nome:</label>
        <input type="text" name="nome" id="nome" class="required" value="<?php echo $nome?>" />
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <label>Preço:</label>
        <input type="text" name="preco" id="preco" class="required numeric" value="<?php echo $preco?>" />
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <label>Inicio:</label>
        <input type="text" name="dataInicio" id="dataInicio" class="required data" value="<?php echo $dataInicio?>" />
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <label>Fim(opcional):</label>
        <input type="text" name="dataFim" id="dataFim" class="data" value="<?php echo $dataFim?>" />
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <label>Observação:</label>
        <textarea name="obs" id="obs" cols="40" rows="4"><?php echo $obs?></textarea>
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <button class="button blue" onclick="postForm('form_PlanoAcaoGrupoMaterialMontado', '<?php echo CAMINHO_REL."grupo/include/acao/planoAcaoGrupoMaterialMontado.php"?>');" > Enviar</button>
        
      </p>
    </form>
  </fieldset>
</div>
<script>
ativarForm();</script> 
