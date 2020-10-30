<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/ProdutoAdicionalPlanoAcaoGrupo.class.php");


$ProdutoAdicionalPlanoAcaoGrupo = new ProdutoAdicionalPlanoAcaoGrupo();
	
$idProdutoAdicionalPlanoAcaoGrupo = $_REQUEST['id'];
$idPlanoAcaoGrupo = $_REQUEST['idPlanoAcaoGrupo'];
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Desvincular produto adicional</legend>
    <form id="form_ProdutoAdicionalPlanoAcaoGrupo_del" class="validate"  method="post" onsubmit="return false" >
      <input type="hidden" name="acao" id="acao" value="deletar" />
      <input type="hidden" name="id" id="id" value="<?php echo $idProdutoAdicionalPlanoAcaoGrupo?>" />
      <p>
        <label>Data de saída:</label>
        <input type="text" name="dataSaida" id="dataSaida" class="required data"/>
        <span class="placeholder">Campo Obrigatório</span> </p>
      <button class="button blue" onclick="postForm('form_ProdutoAdicionalPlanoAcaoGrupo_del', '<?php echo CAMINHO_REL."grupo/include/acao/produtoAdicionalPlanoAcaoGrupo.php"?>')" > Salvar </button>
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 