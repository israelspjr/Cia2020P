<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/MaterialMontadoPlanoAcao.class.php");	
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");	
	
$MaterialMontadoPlanoAcao = new MaterialMontadoPlanoAcao();	


$idMaterialMontadoPlanoAcao = $_GET['id'];
$planoAcao_idPlanoAcao = $_GET['idPlanoAcao'];

if($idMaterialMontadoPlanoAcao != '' && $idMaterialMontadoPlanoAcao  > 0){

	$valorMaterialMontadoPlanoAcao = $MaterialMontadoPlanoAcao->selectMaterialMontadoPlanoAcao('WHERE idMaterialMontadoPlanoAcao='.$idMaterialMontadoPlanoAcao);
	
	$planoAcao_idPlanoAcao = $valorMaterialMontadoPlanoAcao[0]['planoAcao_idPlanoAcao'];
	$nome = $valorMaterialMontadoPlanoAcao[0]['nome'];
	$preco = Uteis::formatarMoeda($valorMaterialMontadoPlanoAcao[0]['preco']);
	$obs = $valorMaterialMontadoPlanoAcao[0]['obs'];	
}
	
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Material montado/personalizado</legend>
    <div class="agrupa" id="div_form_PlanoAcao">
      <form id="form_MaterialMontadoPlanoAcao" class="validate" action="" method="post" onsubmit="return false" >
        <input type="hidden" name="idPlanoAcao" id="idPlanoAcao" value="<?php echo $planoAcao_idPlanoAcao ?>" />
        <p>
          <label>Nome:</label>
          <input type="text" id="nome" name="nome" value="<?php echo $nome?>" class="required" />
          <span class="placeholder">Campo Obrigatório</span> </p>
        <p>
          <label>Preço (R$):</label>
          <input type="text" id="preco" name="preco" value="<?php echo $preco?>" class="required numeric" />
          <span class="placeholder">Campo Obrigatório</span> </p>
        <p>
          <label>Observação:</label>
          <textarea id="obs" name="obs" rows="4" cols="40"><?php echo $obs?></textarea>
        </p>
        <div class="linha-inteira">
          <p>
            <button class="button blue" onclick="postForm('form_MaterialMontadoPlanoAcao', '<?php echo CAMINHO_VENDAS?>planoAcao/include/acao/materialMontadoPlanoAcao.php?id=<?php echo $idMaterialMontadoPlanoAcao?>');">Salvar</button>
            
          </p>
        </div>
      </form>
    </div>
  </fieldset>
</div>
<script>ativarForm();</script>